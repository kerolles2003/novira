<?php
/**
 * Novira — one-shot bilingual activation (Arabic default, English at /en/).
 *
 * WHAT THIS DOES (idempotent — safe to re-run):
 *   1. Ensures the two Polylang languages exist: العربية (ar, default, RTL) and
 *      English (en_US, LTR). If it can't create them from CLI, it tells you the
 *      one 60-second UI step and you re-run.
 *   2. Sets Polylang so Arabic is the permanent default and lives at "/",
 *      English lives under "/en/", and first-time visitors are NOT auto-redirected
 *      by browser language.
 *   3. Assigns all existing content to Arabic (nothing Arabic changes or breaks).
 *   4. Creates the English translation of each completed page using the SAME
 *      slug + parent as its Arabic counterpart (Polylang allows shared slugs),
 *      so every slug-based route/schema/breadcrumb keeps working with no code
 *      change:  American Diploma hub, EST, Digital SAT, ACT, and the homepage.
 *   5. Links each English page as the Polylang translation of its Arabic page, so
 *      the header language switcher navigates AR↔EN to the matching page (no 404).
 *   6. Flushes rewrite rules.
 *
 * RUN:
 *   wp eval-file wp-content/themes/novira-theme/docs/novira-bilingual-setup.php
 *
 * PREREQUISITE (one command):
 *   wp plugin install polylang --activate
 */

if ( ! defined( 'WP_CLI' ) || ! WP_CLI ) {
	// Do not disclose the absolute server path on direct web access.
	echo "Run this via WP-CLI (wp eval-file) from the theme's docs/ directory.\n";
	return;
}
if ( ! function_exists( 'pll_languages_list' ) ) {
	WP_CLI::error( "Polylang is not active. Run first:  wp plugin install polylang --activate" );
}

$log = function ( $m ) { WP_CLI::log( $m ); };

/* ------------------------------------------------------------------ *
 * 1. LANGUAGES — Arabic (default, RTL) + English (en_US, LTR)
 * ------------------------------------------------------------------ */
$existing = pll_languages_list(); // slugs, e.g. ['ar','en']
$need_ar  = ! in_array( 'ar', $existing, true );
$need_en  = ! in_array( 'en', $existing, true );

if ( $need_ar || $need_en ) {
	$opts = get_option( 'polylang', array() );
	if ( class_exists( 'PLL_Admin_Model' ) ) {
		$model = new PLL_Admin_Model( $opts );
		if ( $need_ar ) {
			$model->add_language( array( 'name' => 'العربية', 'slug' => 'ar', 'locale' => 'ar', 'rtl' => 1, 'term_group' => 0, 'flag' => 'eg' ) );
			$log( '+ language added: العربية (ar, RTL)' );
		}
		if ( $need_en ) {
			$model->add_language( array( 'name' => 'English', 'slug' => 'en', 'locale' => 'en_US', 'rtl' => 0, 'term_group' => 1, 'flag' => 'us' ) );
			$log( '+ language added: English (en_US, LTR)' );
		}
		if ( method_exists( $model, 'clean_languages_cache' ) ) { $model->clean_languages_cache(); }
		wp_cache_flush();
	} else {
		WP_CLI::error(
			"Could not create languages from CLI. Add them in wp-admin → Languages (60s), then re-run:\n" .
			"  • العربية — locale ar — RTL — set as DEFAULT\n" .
			"  • English — locale en_US — LTR"
		);
	}
}

/* ------------------------------------------------------------------ *
 * 2. OPTIONS — Arabic default at "/", English at "/en/", no browser redirect
 * ------------------------------------------------------------------ */
$opts                  = get_option( 'polylang', array() );
$opts['default_lang']  = 'ar'; // Arabic is the permanent default.
$opts['force_lang']    = 1;    // 1 = language code in the directory → /en/.
$opts['hide_default']  = 1;    // default (ar) has NO prefix → "/" is Arabic.
$opts['rewrite']       = 1;
$opts['redirect_lang'] = 0;
$opts['browser']       = 0;    // do NOT auto-redirect by browser language.
update_option( 'polylang', $opts );
$log( '* Polylang options: default=ar, "/"=Arabic, "/en/"=English, no browser redirect' );

/* ------------------------------------------------------------------ *
 * 3. Assign existing content to Arabic (so nothing is language-less)
 * ------------------------------------------------------------------ */
$all_ids  = get_posts( array( 'post_type' => array( 'page', 'post' ), 'numberposts' => -1, 'post_status' => 'any', 'fields' => 'ids', 'suppress_filters' => true ) );
$assigned = 0;
foreach ( $all_ids as $pid ) {
	if ( function_exists( 'pll_get_post_language' ) && ! pll_get_post_language( $pid ) ) {
		pll_set_post_language( $pid, 'ar' );
		$assigned++;
	}
}
$log( "* assigned {$assigned} existing item(s) to Arabic" );

/* ------------------------------------------------------------------ *
 * helper: ensure the English translation of an Arabic page exists
 * ------------------------------------------------------------------ */
$ensure_en = function ( $ar_id, $slug, $title_en, $parent_en_id ) use ( $log ) {
	if ( ! $ar_id ) { return 0; }
	$en_id = pll_get_post( $ar_id, 'en' );
	if ( $en_id && get_post( $en_id ) ) {
		// Keep slug/parent aligned (idempotent correction).
		wp_update_post( array( 'ID' => $en_id, 'post_name' => $slug, 'post_parent' => $parent_en_id ) );
		return $en_id;
	}
	$en_id = wp_insert_post( array(
		'post_title'   => $title_en,
		'post_name'    => $slug,
		'post_status'  => 'publish',
		'post_type'    => 'page',
		'post_parent'  => $parent_en_id,
		'post_content' => '', // template renders everything; en_US.mo supplies the text
	), true );
	if ( is_wp_error( $en_id ) || ! $en_id ) {
		$log( "! failed to create EN page '{$slug}'" );
		return 0;
	}
	pll_set_post_language( $en_id, 'en' );
	// Re-assert the slug AFTER the language is set — Polylang then allows the
	// English page to share the Arabic slug (differentiated by the /en/ prefix).
	wp_update_post( array( 'ID' => $en_id, 'post_name' => $slug, 'post_parent' => $parent_en_id ) );
	pll_save_post_translations( array( 'ar' => (int) $ar_id, 'en' => (int) $en_id ) );
	$log( "+ EN page '{$slug}' (#{$en_id}) linked to AR #{$ar_id}" );
	return $en_id;
};

/* ------------------------------------------------------------------ *
 * 4. Hub + exam spokes (same slugs, English titles)
 * ------------------------------------------------------------------ */
$en_hub_id = 0;
$ar_hub    = get_page_by_path( 'american-diploma' );
if ( $ar_hub ) {
	$en_hub_id = $ensure_en( $ar_hub->ID, 'american-diploma', 'American Diploma', 0 );
} else {
	$log( '! Arabic page "american-diploma" not found — create it first, then re-run.' );
}

if ( $en_hub_id ) {
	foreach ( array( 'est' => 'EST', 'digital-sat' => 'Digital SAT', 'act' => 'ACT' ) as $slug => $title ) {
		$ar_spoke = get_page_by_path( 'american-diploma/' . $slug );
		if ( $ar_spoke ) {
			$ensure_en( $ar_spoke->ID, $slug, $title, $en_hub_id );
		} else {
			$log( "! Arabic spoke 'american-diploma/{$slug}' not found — create it first, then re-run." );
		}
	}
}

/* ------------------------------------------------------------------ *
 * 5. Homepage
 * ------------------------------------------------------------------ */
$front_id = (int) get_option( 'page_on_front' );
if ( 'page' === get_option( 'show_on_front' ) && $front_id ) {
	$ar_home_slug = get_post_field( 'post_name', $front_id );
	$ensure_en( $front_id, $ar_home_slug, 'Home', 0 );
	$log( '* static front page translated → Polylang serves the English home at /en/' );
} else {
	$log( '* homepage is "latest posts" → /en/ renders the English homepage automatically (front-page.php + en_US.mo)' );
}

/* ------------------------------------------------------------------ *
 * 6. Flush + summary
 * ------------------------------------------------------------------ */
flush_rewrite_rules();
$log( '* rewrite rules flushed' );

$log( '' );
$log( 'URLs now live:' );
$log( '  /                              → Arabic homepage' );
$log( '  /en/                           → English homepage' );
$log( '  /american-diploma/             ↔ /en/american-diploma/' );
$log( '  /american-diploma/est/         ↔ /en/american-diploma/est/' );
$log( '  /american-diploma/digital-sat/ ↔ /en/american-diploma/digital-sat/' );
$log( '  /american-diploma/act/         ↔ /en/american-diploma/act/' );
WP_CLI::success( 'Bilingual setup complete. Arabic default at "/", English at "/en/", switcher links AR↔EN.' );
