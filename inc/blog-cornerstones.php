<?php
/**
 * Cornerstone EEAT wiring (BLOG-01.5) — data only, renders nothing itself.
 *
 * Marks selected `blog_post` articles as authoritative "cornerstone" guides and
 * feeds the dormant EEAT extension points already defined in inc/blog-single.php
 * with real data, so no new UI or template change is needed:
 *
 *   - novira_blog_article_reviewer → "Reviewed by" contributor Person (schema).
 *   - novira_blog_article_sources  → visible «المصادر والمراجع» list
 *                                    (novira_blog_render_sources) + `citation` schema.
 *
 * Cornerstone status and the per-article source list live in post meta, set when
 * the article is authored/seeded, so the EEAT data travels with the post itself.
 * This introduces no runtime capability, no conditional logic and no output.
 *
 * @package Novira_Academy
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Whether an article is flagged as a cornerstone guide.
 *
 * @param int|null $post_id Optional post ID (defaults to current).
 * @return bool
 */
function novira_blog_is_cornerstone( $post_id = null ) {
	$post_id = $post_id ? (int) $post_id : (int) get_the_ID();
	return (bool) get_post_meta( $post_id, '_nv_cornerstone', true );
}

/**
 * Reviewed-by contributor for cornerstone guides (EEAT). Feeds the schema
 * `contributor` Person only; the visible "reviewed by" line lives in the article
 * body. Never overrides a value another extension already supplied.
 *
 * @param array $reviewer Existing reviewer [ name, url ] (empty by default).
 * @param int   $post_id  Article ID.
 * @return array
 */
function novira_blog_cornerstone_reviewer( $reviewer, $post_id ) {
	if ( ! empty( $reviewer['name'] ) ) {
		return $reviewer;
	}
	if ( ! novira_blog_is_cornerstone( $post_id ) ) {
		return $reviewer;
	}
	return array(
		'name' => __( 'الفريق الأكاديمي في أكاديمية نوفيرا', 'novira-academy' ),
		'url'  => home_url( '/about/' ),
	);
}
add_filter( 'novira_blog_article_reviewer', 'novira_blog_cornerstone_reviewer', 10, 2 );

/**
 * Sources / references for a cornerstone guide (EEAT). Read from post meta so the
 * reference list is authored with the article. Feeds BOTH the visible
 * «المصادر والمراجع» section and the Article `citation` schema (one source of truth).
 *
 * @param array $sources Existing sources (empty by default).
 * @param int   $post_id Article ID.
 * @return array Rows of [ 'title' => string, 'url' => string ].
 */
function novira_blog_cornerstone_sources( $sources, $post_id ) {
	if ( ! empty( $sources ) ) {
		return $sources;
	}
	$stored = get_post_meta( $post_id, '_nv_cornerstone_sources', true );
	if ( is_array( $stored ) && $stored ) {
		return $stored;
	}
	return $sources;
}
add_filter( 'novira_blog_article_sources', 'novira_blog_cornerstone_sources', 10, 2 );
