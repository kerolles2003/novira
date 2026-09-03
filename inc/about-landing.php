<?php
/**
 * About ("من نحن") Landing — helpers, routing and asset loading.
 *
 * Self-contained support for page-about.php (pixel-matched rebuild from
 * template-parts/sections/about-us.png). Mirrors the education / translation
 * landing pattern:
 *  - novira_abt_icon()  inline stroke-icon set (Lucide-style)
 *  - template_include route so the `about` page uses page-about.php
 *  - conditional CSS/JS enqueue for the landing only
 *
 * Additive only: force-routed at priority 99 so any legacy template assigned to
 * the About page is superseded, exactly like the other bespoke landings.
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
function novira_abt_icon( $name, $size = 24 ) {
	$paths = array(
		// Card badges.
		'headphones' => '<path d="M4 14a8 8 0 0 1 16 0"/><rect x="2.5" y="13.5" width="4.5" height="7.5" rx="2.2"/><rect x="17" y="13.5" width="4.5" height="7.5" rx="2.2"/>',
		'chat'       => '<path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"/>',
		'sprout'     => '<path d="M12 22V11"/><path d="M12 11C12 7 9.5 4.5 5 4.5c0 4.2 2.8 6.5 7 6.5z"/><path d="M12 13c0-3 2-5 6.5-5 0 3.2-2.3 5-6.5 5z"/>',
		'firstaid'   => '<rect x="2.5" y="6" width="19" height="14" rx="3"/><path d="M12 10v6M9 13h6"/><path d="M8 6V5a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v1"/>',
		'monitor'    => '<rect x="2.5" y="4" width="19" height="12.5" rx="2"/><path d="M8 20.5h8M12 16.5v4"/>',
		'code'       => '<polyline points="16 18 22 12 16 6"/><polyline points="8 6 2 12 8 18"/>',
		'users'      => '<path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/>',
		'book'       => '<path d="M12 6.5C10.5 5.3 8.5 4.8 4.5 4.8V18c4 0 6 .5 7.5 1.7 1.5-1.2 3.5-1.7 7.5-1.7V4.8c-4 0-6 .5-7.5 1.7z"/><path d="M12 6.5V19.7"/>',
		'hash'       => '<line x1="4.5" y1="9" x2="20" y2="9"/><line x1="4" y1="15" x2="19.5" y2="15"/><line x1="10.5" y1="3.5" x2="8.5" y2="20.5"/><line x1="15.5" y1="3.5" x2="13.5" y2="20.5"/>',
		'brain'      => '<path d="M12 5a3 3 0 0 0-5.8-1.1A2.6 2.6 0 0 0 4 8.5a2.8 2.8 0 0 0-.7 4.4A2.7 2.7 0 0 0 5 17.7 2.8 2.8 0 0 0 9 19a3 3 0 0 0 3 0V5z"/><path d="M12 5a3 3 0 0 1 5.8-1.1A2.6 2.6 0 0 1 20 8.5a2.8 2.8 0 0 1 .7 4.4A2.7 2.7 0 0 1 19 17.7 2.8 2.8 0 0 1 15 19a3 3 0 0 1-3 0"/>',

		// Section icons.
		'send'    => '<path d="M22 2 11 13"/><path d="M22 2 15 22l-4-9-9-4z"/>',
		'eye'     => '<path d="M2 12s3.5-7 10-7 10 7 10 7-3.5 7-10 7-10-7-10-7z"/><circle cx="12" cy="12" r="3"/>',
		'target'  => '<circle cx="12" cy="12" r="9"/><circle cx="12" cy="12" r="5"/><circle cx="12" cy="12" r="1.4"/>',
		'user'    => '<circle cx="12" cy="8" r="4"/><path d="M5.5 21a6.5 6.5 0 0 1 13 0"/>',
		'pin'     => '<path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0z"/><circle cx="12" cy="10" r="3"/>',
		'clock'   => '<circle cx="12" cy="12" r="9"/><polyline points="12 7 12 12 15 14"/>',
		'phone'   => '<path d="M22 16.9v3a2 2 0 0 1-2.2 2 19.8 19.8 0 0 1-8.6-3.1 19.5 19.5 0 0 1-6-6A19.8 19.8 0 0 1 2 4.2 2 2 0 0 1 4 2h3a2 2 0 0 1 2 1.7c.1 1 .4 1.9.7 2.8a2 2 0 0 1-.5 2.1L8 9.9a16 16 0 0 0 6 6l1.3-1.3a2 2 0 0 1 2.1-.4c.9.3 1.8.6 2.8.7A2 2 0 0 1 22 16.9z"/>',
		'whatsapp'=> '<path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"/>',
		'calendar'=> '<rect x="3.5" y="5" width="17" height="16" rx="2.5"/><path d="M3.5 10h17M8 3v4M16 3v4"/>',
		'check'   => '<circle cx="12" cy="12" r="9.5"/><path d="M8 12.2l2.6 2.6L16 9.5"/>',
		'chevron' => '<polyline points="15 18 9 12 15 6"/>',
		'sparkle' => '<path d="M12 3l1.9 5.6L19.5 10l-5.6 1.9L12 17l-1.9-5.1L4.5 10l5.6-1.4z"/>',
	);

	$solid = array( 'whatsapp', 'sparkle' );
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
 * Route the About page to its dedicated landing template.
 *
 * @param string $template Path WordPress resolved for the request.
 * @return string
 */
function novira_force_about_template( $template ) {
	if ( is_page( 'about' ) ) {
		$landing = locate_template( 'page-about.php' );
		if ( $landing ) {
			return $landing;
		}
	}
	return $template;
}
add_filter( 'template_include', 'novira_force_about_template', 99 );

/**
 * Enqueue the landing's stylesheet + behaviour, scoped to the About page.
 */
function novira_about_landing_assets() {
	if ( ! is_page( 'about' ) ) {
		return;
	}

	wp_enqueue_style(
		'novira-about-landing',
		NOVIRA_URI . '/assets/css/about-landing.css',
		array( 'novira-main' ),
		file_exists( NOVIRA_DIR . '/assets/css/about-landing.css' ) ? filemtime( NOVIRA_DIR . '/assets/css/about-landing.css' ) : NOVIRA_VERSION
	);

	wp_enqueue_script(
		'novira-about-landing',
		NOVIRA_URI . '/assets/js/about-landing.js',
		array(),
		file_exists( NOVIRA_DIR . '/assets/js/about-landing.js' ) ? filemtime( NOVIRA_DIR . '/assets/js/about-landing.js' ) : NOVIRA_VERSION,
		true
	);
}
add_action( 'wp_enqueue_scripts', 'novira_about_landing_assets', 20 );
