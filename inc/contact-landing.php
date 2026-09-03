<?php
/**
 * Contact ("تواصل معنا") Landing — helpers, routing and asset loading.
 *
 * Self-contained support for page-contact.php (pixel-matched rebuild from
 * contact.png). Mirrors the about / education / translation landing pattern:
 *  - novira_ct_icon()  inline stroke-icon set (Lucide-style)
 *  - template_include route so the `contact` page uses page-contact.php
 *  - conditional CSS/JS enqueue for the landing only
 *
 * Additive only: force-routed at priority 99 so any legacy "تواصل معنا" custom
 * template still assigned to the Contact page is superseded, exactly like the
 * other bespoke landings.
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
function novira_ct_icon( $name, $size = 24 ) {
	$paths = array(
		// Channels + actions.
		'whatsapp'  => '<path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"/>',
		'phone'     => '<path d="M22 16.9v3a2 2 0 0 1-2.2 2 19.8 19.8 0 0 1-8.6-3.1 19.5 19.5 0 0 1-6-6A19.8 19.8 0 0 1 2 4.2 2 2 0 0 1 4 2h3a2 2 0 0 1 2 1.7c.1 1 .4 1.9.7 2.8a2 2 0 0 1-.5 2.1L8 9.9a16 16 0 0 0 6 6l1.3-1.3a2 2 0 0 1 2.1-.4c.9.3 1.8.6 2.8.7A2 2 0 0 1 22 16.9z"/>',
		'instagram' => '<rect x="3" y="3" width="18" height="18" rx="5.2"/><circle cx="12" cy="12" r="4.1"/><circle cx="17.4" cy="6.6" r="1.1" fill="currentColor" stroke="none"/>',
		'facebook'  => '<path d="M15.5 8.5H14c-.6 0-1 .4-1 1v2h2.4l-.4 2.6H13V21h-2.7v-6.9H8.2V11.5h2.1V9.2c0-2.1 1.3-3.2 3.2-3.2.9 0 1.7.1 2 .1v2.4z"/>',
		'pin'       => '<path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0z"/><circle cx="12" cy="10" r="3"/>',
		'directions'=> '<path d="M12 2 22 12 12 22 2 12z"/><path d="M9 13v-2a2 2 0 0 1 2-2h4"/><path d="m13.5 6.5 2.5 2.5-2.5 2.5"/>',
		'clock'     => '<circle cx="12" cy="12" r="9"/><polyline points="12 7 12 12 15 14"/>',
		'headset'   => '<path d="M4 14v-2a8 8 0 0 1 16 0v2"/><path d="M20 15a2 2 0 0 1-2 2h-1v-5h1a2 2 0 0 1 2 2z"/><path d="M4 15a2 2 0 0 0 2 2h1v-5H6a2 2 0 0 0-2 2z"/><path d="M18 17v1a3 3 0 0 1-3 3h-3"/>',
		'heart'     => '<path d="M20.8 5.6a5 5 0 0 0-7.1 0L12 7.3l-1.7-1.7a5 5 0 0 0-7.1 7.1l1.7 1.7L12 21.5l7.1-7.1 1.7-1.7a5 5 0 0 0 0-7.1z"/>',

		// Location feature mini-cards.
		'building'  => '<rect x="5" y="3" width="14" height="18" rx="1.5"/><path d="M9 7h.01M12 7h.01M15 7h.01M9 11h.01M12 11h.01M15 11h.01M9 15h.01M15 15h.01"/><path d="M11 21v-3.5a1 1 0 0 1 2 0V21"/>',
		'car'       => '<path d="M5 17h14"/><path d="M6.5 17V19a1 1 0 0 1-2 0v-2M19.5 17V19a1 1 0 0 1-2 0v-2"/><path d="M4 12l1.6-4.2A2 2 0 0 1 7.5 6.5h9a2 2 0 0 1 1.9 1.3L20 12v4a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1z"/><path d="M4 12h16"/><circle cx="7.5" cy="14" r=".6" fill="currentColor" stroke="none"/><circle cx="16.5" cy="14" r=".6" fill="currentColor" stroke="none"/>',
		'landmark'  => '<path d="M3 21h18"/><path d="M5 21V10M9 21V10M15 21V10M19 21V10"/><path d="M12 3 3.5 8h17z"/>',
		'shield'    => '<path d="M12 2.5 5 5.2v5.3c0 4.4 3 8.5 7 9.9 4-1.4 7-5.5 7-9.9V5.2z"/><path d="m9.2 12 2 2 3.6-3.6"/>',

		// Trust row.
		'lifebuoy'  => '<circle cx="12" cy="12" r="9"/><circle cx="12" cy="12" r="3.6"/><path d="m5.6 5.6 3.9 3.9M14.5 14.5l3.9 3.9M18.4 5.6l-3.9 3.9M9.5 14.5l-3.9 3.9"/>',
		'pulse'     => '<path d="M3 12h4l2 6 4-13 2 7h6"/>',
		'users'     => '<path d="M16 20v-1.5a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4V20"/><circle cx="9" cy="7.5" r="3.5"/><path d="M22 20v-1.5a4 4 0 0 0-3-3.9"/><path d="M16 4.1a3.5 3.5 0 0 1 0 6.8"/>',
		'bookcheck' => '<path d="M4 5.5A2.5 2.5 0 0 1 6.5 3H20v14H6.5A2.5 2.5 0 0 0 4 19.5z"/><path d="M4 19.5A2.5 2.5 0 0 0 6.5 22H20"/><path d="m9 9.5 2 2 3.5-3.7"/>',
		'award'     => '<circle cx="12" cy="9" r="6"/><path d="m8.5 13.7-1.5 7 5-2.7 5 2.7-1.5-7"/><path d="m9.8 9 1.5 1.5L14.4 7.4"/>',

		// Decorative + misc.
		'sparkle'   => '<path d="M12 3l1.9 5.6L19.5 10l-5.6 1.9L12 17l-1.9-5.1L4.5 10l5.6-1.4z"/>',
		'chevron'   => '<polyline points="15 18 9 12 15 6"/>',
	);

	// These read best as filled glyphs.
	$solid  = array( 'whatsapp', 'facebook', 'heart', 'sparkle' );
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
 * Route the Contact page to its dedicated landing template.
 *
 * @param string $template Path WordPress resolved for the request.
 * @return string
 */
function novira_force_contact_template( $template ) {
	if ( is_page( 'contact' ) ) {
		$landing = locate_template( 'page-contact.php' );
		if ( $landing ) {
			return $landing;
		}
	}
	return $template;
}
add_filter( 'template_include', 'novira_force_contact_template', 99 );

/**
 * Enqueue the landing's stylesheet + behaviour, scoped to the Contact page.
 */
function novira_contact_landing_assets() {
	if ( ! is_page( 'contact' ) ) {
		return;
	}

	wp_enqueue_style(
		'novira-contact-landing',
		NOVIRA_URI . '/assets/css/contact-landing.css',
		array( 'novira-main' ),
		file_exists( NOVIRA_DIR . '/assets/css/contact-landing.css' ) ? filemtime( NOVIRA_DIR . '/assets/css/contact-landing.css' ) : NOVIRA_VERSION
	);

	wp_enqueue_script(
		'novira-contact-landing',
		NOVIRA_URI . '/assets/js/contact-landing.js',
		array(),
		file_exists( NOVIRA_DIR . '/assets/js/contact-landing.js' ) ? filemtime( NOVIRA_DIR . '/assets/js/contact-landing.js' ) : NOVIRA_VERSION,
		true
	);
}
add_action( 'wp_enqueue_scripts', 'novira_contact_landing_assets', 20 );
