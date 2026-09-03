<?php
/**
 * Exams ("امتحانات نوفيرا") Landing — helpers, page, routing and assets.
 *
 * Self-contained support for page-exams.php (pixel-matched rebuild from
 * exams.png). Mirrors the contact / about / education landing pattern:
 *  - novira_exl_icon()      inline stroke-icon set (Lucide-style)
 *  - novira_exl_ensure_page() creates the `exams` Page once (it is a brand-new
 *    route with no pre-existing WP page), so is_page('exams') can resolve
 *  - template_include route so the `exams` page uses page-exams.php
 *  - conditional CSS/JS enqueue for the landing only
 *
 * Additive only. The diploma-exam router (novira_is_diploma_exam) requires an
 * `american-diploma` parent, so this top-level `exams` page never collides.
 *
 * @package Novira_Academy
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Inline stroke icon (24x24 viewBox, Lucide-style).
 *
 * @param string $name Icon key.
 * @param int    $size Pixel size.
 * @return string SVG markup.
 */
function novira_exl_icon( $name, $size = 24 ) {
	$paths = array(
		'gauge'      => '<path d="M12 13a2 2 0 1 0 0-4 2 2 0 0 0 0 4z"/><path d="M13.5 10.5 16 8"/><path d="M4.6 17.5a9 9 0 1 1 14.8 0"/>',
		'globe'      => '<circle cx="12" cy="12" r="9"/><path d="M3 12h18"/><path d="M12 3c2.6 2.7 3.9 5.9 3.9 9s-1.3 6.3-3.9 9c-2.6-2.7-3.9-5.9-3.9-9S9.4 5.7 12 3z"/>',
		'bolt'       => '<path d="M13 3 4 14h6l-1 7 9-11h-6z"/>',
		'chartup'    => '<path d="M4 20h16"/><rect x="6" y="11" width="3" height="7" rx="1"/><rect x="10.5" y="7.5" width="3" height="10.5" rx="1"/><rect x="15" y="4" width="3" height="14" rx="1"/>',
		'target'     => '<circle cx="12" cy="12" r="8"/><circle cx="12" cy="12" r="4"/><circle cx="12" cy="12" r="1.2" fill="currentColor" stroke="none"/>',
		'route'      => '<circle cx="6.5" cy="18" r="2.5"/><circle cx="17.5" cy="6" r="2.5"/><path d="M9 17.4h5.5a3 3 0 0 0 3-3V8.5"/>',
		'award'      => '<circle cx="12" cy="9" r="5.5"/><path d="m8.9 13.4-1.4 6.6 4.5-2.4 4.5 2.4-1.4-6.6"/><path d="m9.8 9 1.6 1.6L14.5 7.4"/>',
		'clock'      => '<circle cx="12" cy="12" r="9"/><path d="M12 7.5V12l3 2"/>',
		'quiet'      => '<path d="M4 9.5v5h3.5L13 19V5L7.5 9.5H4z"/><path d="m16.5 9.5 4 5M20.5 9.5l-4 5"/>',
		'wifi'       => '<path d="M2.5 9a15 15 0 0 1 19 0"/><path d="M5.5 12.5a10 10 0 0 1 13 0"/><path d="M8.5 16a5 5 0 0 1 7 0"/><circle cx="12" cy="19.4" r="1" fill="currentColor" stroke="none"/>',
		'shieldcheck'=> '<path d="M12 2.5 5 5.2v5.3c0 4.4 3 8.5 7 9.9 4-1.4 7-5.5 7-9.9V5.2z"/><path d="m9.2 12 2 2 3.6-3.6"/>',
		'whatsapp'   => '<path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"/>',
		'phone'      => '<path d="M22 16.9v3a2 2 0 0 1-2.2 2 19.8 19.8 0 0 1-8.6-3.1 19.5 19.5 0 0 1-6-6A19.8 19.8 0 0 1 2 4.2 2 2 0 0 1 4 2h3a2 2 0 0 1 2 1.7c.1 1 .4 1.9.7 2.8a2 2 0 0 1-.5 2.1L8 9.9a16 16 0 0 0 6 6l1.3-1.3a2 2 0 0 1 2.1-.4c.9.3 1.8.6 2.8.7A2 2 0 0 1 22 16.9z"/>',
		'sparkle'    => '<path d="M12 3l1.9 5.6L19.5 10l-5.6 1.9L12 17l-1.9-5.1L4.5 10l5.6-1.4z"/>',
		'arrow'      => '<path d="M11 6l-6 6 6 6"/><path d="M18 12H5"/>',
	);

	$solid  = array( 'bolt', 'whatsapp', 'sparkle' );
	$fill   = in_array( $name, $solid, true ) ? 'currentColor' : 'none';
	$stroke = in_array( $name, $solid, true ) ? 'none' : 'currentColor';
	$body   = isset( $paths[ $name ] ) ? $paths[ $name ] : '';

	return sprintf(
		'<svg width="%1$d" height="%1$d" viewBox="0 0 24 24" fill="%2$s" stroke="%3$s" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">%4$s</svg>',
		(int) $size,
		esc_attr( $fill ),
		esc_attr( $stroke ),
		$body
	);
}

/**
 * Ensure the `exams` Page exists (this is a brand-new route). Runs once — the
 * result is cached in an option so it is effectively free on later requests.
 */
function novira_exl_ensure_page() {
	if ( get_option( 'novira_exams_page_ready' ) ) {
		return;
	}
	$existing = get_page_by_path( 'exams' );
	if ( ! $existing ) {
		wp_insert_post( array(
			'post_title'   => __( 'الامتحانات', 'novira-academy' ),
			'post_name'    => 'exams',
			'post_status'  => 'publish',
			'post_type'    => 'page',
			'post_content' => '',
			'comment_status' => 'closed',
		) );
	}
	update_option( 'novira_exams_page_ready', 1 );
}
add_action( 'init', 'novira_exl_ensure_page' );

/**
 * Route the Exams page to its dedicated landing template.
 *
 * @param string $template Path WordPress resolved for the request.
 * @return string
 */
function novira_force_exams_template( $template ) {
	if ( is_page( 'exams' ) ) {
		$landing = locate_template( 'page-exams.php' );
		if ( $landing ) {
			return $landing;
		}
	}
	return $template;
}
add_filter( 'template_include', 'novira_force_exams_template', 99 );

/**
 * Enqueue the landing's stylesheet + behaviour, scoped to the Exams page.
 */
function novira_exams_landing_assets() {
	if ( ! is_page( 'exams' ) ) {
		return;
	}

	wp_enqueue_style(
		'novira-exams-landing',
		NOVIRA_URI . '/assets/css/exams-landing.css',
		array( 'novira-main' ),
		file_exists( NOVIRA_DIR . '/assets/css/exams-landing.css' ) ? filemtime( NOVIRA_DIR . '/assets/css/exams-landing.css' ) : NOVIRA_VERSION
	);

	wp_enqueue_script(
		'novira-exams-landing',
		NOVIRA_URI . '/assets/js/exams-landing.js',
		array(),
		file_exists( NOVIRA_DIR . '/assets/js/exams-landing.js' ) ? filemtime( NOVIRA_DIR . '/assets/js/exams-landing.js' ) : NOVIRA_VERSION,
		true
	);
}
add_action( 'wp_enqueue_scripts', 'novira_exams_landing_assets', 20 );
