<?php
/**
 * Blog Archive — premium editorial archive for the `blog_post` CPT (/blog).
 *
 * Self-contained and additive. Provides the small data helpers the premium
 * archive/taxonomy templates consume (reading time, primary category, and a
 * stable per-category brand accent that color-codes the library) and enqueues
 * the scoped `blog-archive.css` on the /blog archive and blog_category views.
 *
 * Single blog posts, events, search, and the default taxonomies keep using
 * blog-events.css — see the enqueue block in functions.php, which no longer
 * targets the blog_post archive so the two stylesheets never overlap.
 *
 * @package Novira_Academy
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Estimated reading time for a post, in whole minutes.
 *
 * Uses a Unicode-aware whitespace split so Arabic word counts are accurate
 * (str_word_count() undercounts non-Latin scripts). Floors at one minute.
 *
 * @param int|null $post_id Optional post ID; defaults to the current post.
 * @return int Minutes (>= 1).
 */
function novira_blog_reading_time( $post_id = null ) {
	$post_id = $post_id ? $post_id : get_the_ID();
	$text    = trim( wp_strip_all_tags( (string) get_post_field( 'post_content', $post_id ) ) );
	$words   = ( '' === $text ) ? 0 : count( preg_split( '/\s+/u', $text ) );

	return max( 1, (int) ceil( $words / 200 ) );
}

/**
 * Localised reading-time label, e.g. "4 دقائق قراءة".
 *
 * @param int|null $post_id Optional post ID.
 * @return string
 */
function novira_blog_reading_time_label( $post_id = null ) {
	$minutes = novira_blog_reading_time( $post_id );

	/* translators: %d: estimated minutes to read the article. */
	return sprintf( _n( '%d دقيقة قراءة', '%d دقائق قراءة', $minutes, 'novira-academy' ), $minutes );
}

/**
 * A consistent <time> element for a post's date. Shows the publish date in a
 * fixed "j F Y" format; when the article was revised on a later day it shows the
 * updated date instead (labelled "محدّث"), so freshness reads at a glance.
 *
 * @param int|null $post_id Optional post ID.
 * @return string Safe <time> HTML.
 */
function novira_blog_meta_date( $post_id = null ) {
	$post_id = $post_id ? $post_id : get_the_ID();
	$pub_key = get_the_date( 'Ymd', $post_id );
	$mod_key = get_the_modified_date( 'Ymd', $post_id );

	if ( $mod_key > $pub_key ) {
		$datetime = get_the_modified_date( 'c', $post_id );
		/* translators: %s: date the article was last updated. */
		$label = sprintf( __( 'محدّث %s', 'novira-academy' ), get_the_modified_date( 'j F Y', $post_id ) );
	} else {
		$datetime = get_the_date( 'c', $post_id );
		$label    = get_the_date( 'j F Y', $post_id );
	}

	return '<time datetime="' . esc_attr( $datetime ) . '">' . esc_html( $label ) . '</time>';
}

/**
 * The post's primary blog_category term (first assigned), or null.
 *
 * @param int|null $post_id Optional post ID.
 * @return WP_Term|null
 */
function novira_blog_primary_category( $post_id = null ) {
	$terms = get_the_terms( $post_id ? $post_id : get_the_ID(), 'blog_category' );

	if ( is_wp_error( $terms ) || empty( $terms ) ) {
		return null;
	}

	return $terms[0];
}

/**
 * Stable brand accent colour for a category term.
 *
 * Maps each term to one of six brand accents by term ID so a category always
 * wears the same colour across the library, and new categories slot in without
 * any code change. Falls back to the primary purple when uncategorised.
 *
 * @param WP_Term|null $term Category term.
 * @return string Hex colour.
 */
function novira_blog_accent( $term = null ) {
	$palette = array( '#5b14e6', '#7b2cff', '#2196ff', '#14b8a6', '#ec4899', '#f59e0b' );
	$index   = ( $term && isset( $term->term_id ) ) ? ( (int) $term->term_id % count( $palette ) ) : 0;

	return $palette[ $index ];
}

/**
 * A brand-styled inline SVG icon for a category, matched by slug/name keyword so
 * new categories get a sensible icon with zero code changes (falls back to a
 * generic tag). Icons are stroke-based, currentColor, 24-viewBox.
 *
 * @param WP_Term|null $term Category term.
 * @return string Inline SVG markup.
 */
function novira_blog_category_icon( $term ) {
	$slug = ( $term && isset( $term->slug ) ) ? strtolower( $term->slug ) : '';
	$name = ( $term && isset( $term->name ) ) ? $term->name : '';
	$hay  = $slug . ' ' . $name;

	$has = static function ( $needles ) use ( $hay ) {
		foreach ( (array) $needles as $needle ) {
			if ( '' !== $needle && false !== strpos( $hay, $needle ) ) {
				return true;
			}
		}
		return false;
	};

	$open = '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">';

	// Order matters: check the most specific keywords first.
	if ( $has( array( 'diploma', 'american', 'دبلوم', 'أمريكي', 'امريكي' ) ) ) {
		return $open . '<path d="M22 10 12 5 2 10l10 5 10-5Z"/><path d="M6 12v5c0 1.3 2.7 3 6 3s6-1.7 6-3v-5"/><path d="M22 10v6"/></svg>';
	}
	if ( $has( array( 'digital-sat', 'digital sat', 'sat' ) ) ) {
		return $open . '<rect x="3" y="4" width="18" height="12.5" rx="2"/><path d="M2 20.5h20M9.5 16.5v4M14.5 16.5v4"/></svg>';
	}
	if ( $has( array( 'est' ) ) ) {
		return $open . '<circle cx="12" cy="12" r="9"/><circle cx="12" cy="12" r="4.6"/><circle cx="12" cy="12" r="1.3" fill="currentColor" stroke="none"/></svg>';
	}
	if ( $has( array( 'act' ) ) ) {
		return $open . '<rect x="5" y="4" width="14" height="17" rx="2"/><path d="M9 4.5V3.2h6v1.3"/><path d="M8.8 12.2l2.2 2.2 4.2-4.4"/></svg>';
	}
	if ( $has( array( 'study', 'skill', 'مهار', 'دراس', 'مذاكر', 'تعلّم', 'تعلم' ) ) ) {
		return $open . '<path d="M9.5 18h5M10.5 21h3"/><path d="M12 3a6 6 0 0 0-3.8 10.6c.7.6 1.1 1.3 1.2 2.4h5.2c.1-1.1.5-1.8 1.2-2.4A6 6 0 0 0 12 3Z"/></svg>';
	}
	if ( $has( array( 'universit', 'college', 'admission', 'تقديم', 'جامع', 'قبول', 'كلية' ) ) ) {
		return $open . '<path d="M3 21h18M5 21V10l7-3.8 7 3.8v11"/><path d="M9.5 21v-5h5v5"/><path d="M12 6.2V3.5"/></svg>';
	}

	// Default — an article/tag mark.
	return $open . '<path d="M20.6 13.4 12 22l-9-9V4a1 1 0 0 1 1-1h8z"/><circle cx="7.5" cy="7.5" r="1.4" fill="currentColor" stroke="none"/></svg>';
}

/**
 * Top blog categories by post count (for the Popular Categories directory).
 *
 * @param int $limit Max terms.
 * @return WP_Term[]
 */
function novira_blog_top_categories( $limit = 6 ) {
	$terms = get_terms( array(
		'taxonomy'   => 'blog_category',
		'hide_empty' => true,
		'orderby'    => 'count',
		'order'      => 'DESC',
		'number'     => $limit,
	) );

	return is_wp_error( $terms ) ? array() : $terms;
}

/**
 * Trending posts for the lead rail — most-discussed first, then most recent as a
 * fallback so the rail is populated even before comments accrue.
 *
 * @param int   $limit    Max posts.
 * @param int[] $exclude  Post IDs to skip (e.g. the featured post).
 * @return WP_Post[]
 */
function novira_blog_trending_posts( $limit = 5, $exclude = array() ) {
	return get_posts( array(
		'post_type'           => 'blog_post',
		'post_status'         => 'publish',
		'posts_per_page'      => $limit,
		'post__not_in'        => array_map( 'intval', (array) $exclude ),
		'orderby'             => array( 'comment_count' => 'DESC', 'date' => 'DESC' ),
		'ignore_sticky_posts' => true,
		'no_found_rows'       => true,
	) );
}

/**
 * Emit a CollectionPage + ItemList JSON-LD node for the archive / category views.
 * Additive to inc/seo.php's graph; gives the library an explicit, crawlable list
 * of its articles. Runs late on wp_head.
 */
function novira_blog_archive_schema() {
	if ( ! ( is_post_type_archive( 'blog_post' ) || is_tax( 'blog_category' ) ) ) {
		return;
	}

	$items = array();
	if ( have_posts() ) {
		$position = 1;
		global $wp_query;
		foreach ( (array) $wp_query->posts as $blog_item ) {
			$items[] = array(
				'@type'    => 'ListItem',
				'position' => $position,
				'url'      => get_permalink( $blog_item ),
				'name'     => get_the_title( $blog_item ),
			);
			$position++;
		}
	}

	if ( empty( $items ) ) {
		return;
	}

	$url  = function_exists( 'novira_canonical_url' ) ? novira_canonical_url() : home_url( add_query_arg( array() ) );
	$node = array(
		'@context'   => 'https://schema.org',
		'@type'      => 'CollectionPage',
		'@id'        => $url . '#collection',
		'name'       => wp_get_document_title(),
		'url'        => $url,
		'isPartOf'   => array( '@id' => home_url( '/#website' ) ),
		'mainEntity' => array(
			'@type'           => 'ItemList',
			'numberOfItems'   => count( $items ),
			'itemListElement' => $items,
		),
	);

	echo "\n" . '<script type="application/ld+json">' . wp_json_encode( $node, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES ) . '</script>' . "\n";
}
add_action( 'wp_head', 'novira_blog_archive_schema', 20 );

/**
 * Enqueue the premium archive stylesheet on /blog and blog_category views only.
 */
function novira_blog_archive_assets() {
	if ( is_post_type_archive( 'blog_post' ) || is_tax( 'blog_category' ) ) {
		wp_enqueue_style(
			'novira-blog-archive',
			NOVIRA_URI . '/assets/css/blog-archive.css',
			array( 'novira-main' ),
			filemtime( NOVIRA_DIR . '/assets/css/blog-archive.css' )
		);
	}
}
add_action( 'wp_enqueue_scripts', 'novira_blog_archive_assets', 20 );
