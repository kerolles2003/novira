<?php
/**
 * Learning-journey recommendation engine (BLOG-01.2C) — data only.
 *
 * Powers the post-article "continue learning" experience by consuming the
 * Semantic Entity Layer (inc/blog-entities.php): articles are related by SHARED
 * educational entities (weighted), with graceful fallbacks to the blog category
 * and then most-recent. Also maps an article's program/exam entities to the
 * matching Novira program page for context-aware guidance.
 *
 * Rendering lives in template-parts/blog/journey.php — this file has no output.
 *
 * @package Novira_Academy
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Relevance weight per entity taxonomy — topic-defining entities (program, exam,
 * subject) rank a relationship higher than context ones (audience, difficulty).
 *
 * @param string $tax Entity taxonomy key.
 * @return int
 */
function novira_blog_entity_weight( $tax ) {
	$weights = array(
		'nv_program'    => 6,
		'nv_exam'       => 6,
		'nv_subject'    => 4,
		'nv_technique'  => 3,
		'nv_skill'      => 3,
		'nv_stage'      => 2,
		'nv_level'      => 2,
		'nv_university' => 2,
		'nv_language'   => 2,
		'nv_country'    => 1,
		'nv_audience'   => 1,
		'nv_difficulty' => 1,
	);
	return isset( $weights[ $tax ] ) ? $weights[ $tax ] : 1;
}

/**
 * The ranked pool of related post IDs for an article (cached). Scores candidates
 * by weighted shared entity terms, then tops up with same-category and recent
 * posts so there is always something to recommend. Excludes the article itself.
 *
 * @param int $post_id Article ID.
 * @return int[] Ordered post IDs (best first), up to 10.
 */
function novira_blog_ranked_related( $post_id ) {
	$post_id = (int) $post_id;
	$key     = 'nv_rel_' . $post_id;
	$cached  = get_transient( $key );
	if ( is_array( $cached ) ) {
		return $cached;
	}

	$entity_taxes = function_exists( 'novira_blog_entity_registry' ) ? array_keys( novira_blog_entity_registry() ) : array();

	// The article's own entity terms, per taxonomy.
	$my_terms = array();
	$any_term = array();
	foreach ( $entity_taxes as $tax ) {
		$ids = wp_get_object_terms( $post_id, $tax, array( 'fields' => 'ids' ) );
		if ( ! is_wp_error( $ids ) && $ids ) {
			$my_terms[ $tax ] = array_map( 'intval', $ids );
			$any_term         = array_merge( $any_term, $my_terms[ $tax ] );
		}
	}

	$ranked = array();

	// 1) Entity-scored candidates.
	if ( $any_term ) {
		$tax_query = array( 'relation' => 'OR' );
		foreach ( $my_terms as $tax => $ids ) {
			$tax_query[] = array( 'taxonomy' => $tax, 'field' => 'term_id', 'terms' => $ids );
		}
		$candidates = get_posts(
			array(
				'post_type'           => 'blog_post',
				'post_status'         => 'publish',
				'posts_per_page'      => 25,
				'post__not_in'        => array( $post_id ),
				'tax_query'           => $tax_query, // phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_tax_query
				'fields'              => 'ids',
				'no_found_rows'       => true,
				'ignore_sticky_posts' => true,
				'orderby'             => 'date',
				'order'               => 'DESC',
			)
		);

		$scores = array();
		foreach ( $candidates as $cid ) {
			$score = 0;
			foreach ( $my_terms as $tax => $ids ) {
				$their = wp_get_object_terms( $cid, $tax, array( 'fields' => 'ids' ) );
				if ( is_wp_error( $their ) || ! $their ) {
					continue;
				}
				$shared = array_intersect( $ids, array_map( 'intval', $their ) );
				if ( $shared ) {
					$score += count( $shared ) * novira_blog_entity_weight( $tax );
				}
			}
			if ( $score > 0 ) {
				$scores[ $cid ] = $score;
			}
		}
		arsort( $scores ); // highest relevance first; ties keep recency order.
		$ranked = array_keys( $scores );
	}

	// 2) Top up from the same blog category.
	if ( count( $ranked ) < 10 && function_exists( 'novira_blog_primary_category' ) ) {
		$cat = novira_blog_primary_category( $post_id );
		if ( $cat ) {
			$more = get_posts(
				array(
					'post_type'           => 'blog_post',
					'post_status'         => 'publish',
					'posts_per_page'      => 10,
					'post__not_in'        => array_merge( array( $post_id ), $ranked ),
					'tax_query'           => array( array( 'taxonomy' => 'blog_category', 'field' => 'term_id', 'terms' => array( $cat->term_id ) ) ), // phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_tax_query
					'fields'              => 'ids',
					'no_found_rows'       => true,
					'ignore_sticky_posts' => true,
					'orderby'             => 'date',
					'order'               => 'DESC',
				)
			);
			$ranked = array_merge( $ranked, $more );
		}
	}

	// 3) Final top up with the most recent posts.
	if ( count( $ranked ) < 10 ) {
		$recent = get_posts(
			array(
				'post_type'           => 'blog_post',
				'post_status'         => 'publish',
				'posts_per_page'      => 10,
				'post__not_in'        => array_merge( array( $post_id ), $ranked ),
				'fields'              => 'ids',
				'no_found_rows'       => true,
				'ignore_sticky_posts' => true,
				'orderby'             => 'date',
				'order'               => 'DESC',
			)
		);
		$ranked = array_merge( $ranked, $recent );
	}

	$ranked = array_values( array_unique( array_map( 'intval', array_slice( $ranked, 0, 10 ) ) ) );

	set_transient( $key, $ranked, 6 * HOUR_IN_SECONDS );
	return $ranked;
}

/**
 * Related post IDs for an article, honouring an exclusion list (e.g. the prev/
 * next posts) so the same article is never recommended twice on the page.
 *
 * @param int   $post_id Article ID.
 * @param int   $limit   How many to return.
 * @param int[] $exclude Post IDs to skip.
 * @return int[]
 */
function novira_blog_related_posts( $post_id, $limit = 3, $exclude = array() ) {
	$exclude = array_map( 'intval', array_merge( array( (int) $post_id ), (array) $exclude ) );
	$out     = array();
	foreach ( novira_blog_ranked_related( $post_id ) as $cid ) {
		if ( ! in_array( $cid, $exclude, true ) ) {
			$out[] = $cid;
			if ( count( $out ) >= $limit ) {
				break;
			}
		}
	}
	return $out;
}

/**
 * Refresh an article's cached recommendations when it is saved.
 *
 * @param int $post_id Post ID.
 */
function novira_blog_clear_related_cache( $post_id ) {
	delete_transient( 'nv_rel_' . (int) $post_id );
}
add_action( 'save_post_blog_post', 'novira_blog_clear_related_cache' );

/**
 * Context-aware program guidance derived from the article's entities. Maps an
 * Exam entity (EST / Digital SAT / ACT) to its spoke page, or a Program entity
 * (American Diploma) to the hub — framed as educational guidance, not an ad.
 * Returns null when the article isn't tied to a Novira program.
 *
 * @param int $post_id Article ID.
 * @return array|null [ eyebrow, title, desc, url, cta ]
 */
function novira_blog_program_link( $post_id ) {
	$result = null;

	// Exam-specific spokes take priority (most specific).
	$exam_slugs = array(
		'EST'         => 'est',
		'Digital SAT' => 'digital-sat',
		'ACT'         => 'act',
	);
	$exams = wp_get_object_terms( $post_id, 'nv_exam', array( 'fields' => 'names' ) );
	if ( ! is_wp_error( $exams ) ) {
		foreach ( $exams as $name ) {
			if ( isset( $exam_slugs[ $name ] ) ) {
				$result = array(
					'eyebrow' => __( 'من التعلّم إلى المسار', 'novira-academy' ),
					/* translators: %s: exam name (EST / Digital SAT / ACT). */
					'title'   => sprintf( __( 'يمهّد هذا المقال لمسار %s الكامل', 'novira-academy' ), $name ),
					'desc'    => __( 'ما قرأته جزء من إعدادٍ أطول. تعرّف على البرنامج ومحتواه وخطة الإعداد خطوة بخطوة داخل الدبلومة الأمريكية.', 'novira-academy' ),
					'url'     => home_url( '/american-diploma/' . $exam_slugs[ $name ] . '/' ),
					'cta'     => __( 'تعرّف على البرنامج', 'novira-academy' ),
				);
				break;
			}
		}
	}

	// Fall back to the American Diploma program entity.
	if ( null === $result ) {
		$programs = wp_get_object_terms( $post_id, 'nv_program', array( 'fields' => 'names' ) );
		if ( ! is_wp_error( $programs ) ) {
			foreach ( $programs as $name ) {
				if ( false !== strpos( $name, 'الدبلومة الأمريكية' ) ) {
					$result = array(
						'eyebrow' => __( 'من التعلّم إلى المسار', 'novira-academy' ),
						'title'   => __( 'استكشف مسار الدبلومة الأمريكية', 'novira-academy' ),
						'desc'    => __( 'برنامج متكامل يرافق الطالب من الصف العاشر حتى القبول الجامعي — بإعداد أكاديمي متدرّج واختبارات دولية معتمدة.', 'novira-academy' ),
						'url'     => home_url( '/american-diploma/' ),
						'cta'     => __( 'تعرّف على البرنامج', 'novira-academy' ),
					);
					break;
				}
			}
		}
	}

	/**
	 * Filter the program-guidance target for an article (future mappings /
	 * cornerstone links). Return an array to override, or null for none.
	 *
	 * @param array|null $result  [ eyebrow, title, desc, url, cta ] or null.
	 * @param int        $post_id Article ID.
	 */
	return apply_filters( 'novira_blog_program_link', $result, $post_id );
}
