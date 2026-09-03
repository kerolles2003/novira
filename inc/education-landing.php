<?php
/**
 * Education & Skills Landing — helpers, routing and asset loading.
 *
 * Self-contained support for page-education.php (pixel-matched rebuild from
 * education.png). Mirrors the certified-translation landing pattern:
 *  - novira_edu_icon()  inline stroke-icon set (Lucide-style)
 *  - template_include route so the `education` page uses page-education.php
 *  - conditional CSS/JS enqueue for the landing only
 *
 * Additive only: page-department.php keeps its education branch untouched — it
 * is simply never reached because this force-route outranks it (priority 99),
 * exactly like the translation / diploma / exam force-routes.
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
function novira_edu_icon( $name, $size = 24 ) {
	$paths = array(
		// Field cards.
		'chat'      => '<path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"/><path d="M8 10h8M8 13.5h5"/>',
		'code'      => '<polyline points="16 18 22 12 16 6"/><polyline points="8 6 2 12 8 18"/>',
		'chart'     => '<line x1="4" y1="20" x2="20" y2="20"/><rect x="5" y="12" width="3" height="6" rx="1"/><rect x="10.5" y="8" width="3" height="10" rx="1"/><rect x="16" y="4" width="3" height="14" rx="1"/>',
		'palette'   => '<circle cx="8.5" cy="10.5" r="1.2"/><circle cx="12" cy="7.5" r="1.2"/><circle cx="15.5" cy="10.5" r="1.2"/><path d="M12 3a9 9 0 1 0 0 18c1 0 1.7-.8 1.7-1.8 0-.5-.2-.9-.5-1.2-.3-.3-.5-.7-.5-1.2 0-1 .8-1.8 1.8-1.8H16a5 5 0 0 0 5-5c0-3.9-4-7-9-7z"/>',
		'briefcase' => '<rect x="2.5" y="7.5" width="19" height="12.5" rx="2.5"/><path d="M8.5 7.5V6a2.5 2.5 0 0 1 2.5-2.5h2A2.5 2.5 0 0 1 15.5 6v1.5"/><path d="M2.5 12.5h19"/>',
		'globe-exam' => '<circle cx="12" cy="12" r="9"/><path d="M3 12h18M12 3a15 15 0 0 1 0 18M12 3a15 15 0 0 0 0 18"/>',

		// Why-Novira band.
		'shield'    => '<path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/><path d="M9 12l2 2 4-4"/>',
		'doc'       => '<path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="8" y1="13" x2="16" y2="13"/><line x1="8" y1="17" x2="14" y2="17"/>',
		'user-check' => '<path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><polyline points="16 11 18 13 22 9"/>',
		'award'     => '<circle cx="12" cy="9" r="6"/><path d="M9 13.5 8 22l4-2 4 2-1-8.5"/><path d="M12 6.3l1.1 2.2 2.4.4-1.7 1.7.4 2.4-2.2-1.2-2.2 1.2.4-2.4-1.7-1.7 2.4-.4z"/>',
		'flex'      => '<path d="M4 12a8 8 0 0 1 13.7-5.6L20 8"/><polyline points="20 3 20 8 15 8"/><path d="M20 12a8 8 0 0 1-13.7 5.6L4 16"/><polyline points="4 21 4 16 9 16"/>',
		'teacher'   => '<circle cx="12" cy="7" r="3.2"/><path d="M5.5 21a6.5 6.5 0 0 1 13 0"/><path d="M12 10.5V14"/>',

		// Learn-modes cards.
		'monitor'   => '<rect x="2.5" y="4" width="19" height="12.5" rx="2"/><path d="M8 20.5h8M12 16.5v4"/><polygon points="10.5 8 15 10.2 10.5 12.4 10.5 8"/>',
		'play'      => '<circle cx="12" cy="12" r="9.2"/><polygon points="10 8.5 16 12 10 15.5 10 8.5"/>',
		'pin'       => '<path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0z"/><circle cx="12" cy="10" r="3"/>',

		// Stats band.
		'cap'       => '<path d="M22 10 12 5 2 10l10 5 10-5z"/><path d="M6 12v5c0 1.4 2.7 2.6 6 2.6s6-1.2 6-2.6v-5"/>',
		'book'      => '<path d="M4 5.5A2.5 2.5 0 0 1 6.5 3H20v15H6.5A2.5 2.5 0 0 0 4 20.5z"/><path d="M4 20.5A2.5 2.5 0 0 1 6.5 18H20"/>',
		'user'      => '<circle cx="12" cy="8" r="4"/><path d="M5.5 21a6.5 6.5 0 0 1 13 0"/>',
		'calendar'  => '<rect x="3.5" y="5" width="17" height="16" rx="2.5"/><path d="M3.5 10h17M8 3v4M16 3v4"/>',

		// Programs + misc.
		'rocket'    => '<path d="M5 15c-1.5 1.3-2 5-2 5s3.7-.5 5-2c.7-.8.7-2 0-2.8a2 2 0 0 0-3 0z"/><path d="M9 12c1.5-4 4-7 9-8 .5 4-1 8-6 11z"/><path d="M9 12l3 3"/><circle cx="14.5" cy="9.5" r="1.3"/>',
		'star'      => '',
		'check'     => '<circle cx="12" cy="12" r="9.5"/><path d="M8 12.2l2.6 2.6L16 9.5"/>',
		'book-open' => '<path d="M12 6.5C10.5 5.3 8.5 4.8 4.5 4.8V18c4 0 6 .5 7.5 1.7 1.5-1.2 3.5-1.7 7.5-1.7V4.8c-4 0-6 .5-7.5 1.7z"/><path d="M12 6.5V19.7"/>',
		'whatsapp'  => '<path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"/>',
		'arrow-l'   => '<polyline points="15 18 9 12 15 6"/>',
		'arrow-r'   => '<polyline points="9 18 15 12 9 6"/>',
		'grid'      => '<rect x="3" y="3" width="7" height="7" rx="1.5"/><rect x="14" y="3" width="7" height="7" rx="1.5"/><rect x="3" y="14" width="7" height="7" rx="1.5"/><rect x="14" y="14" width="7" height="7" rx="1.5"/>',
		'quote'     => '',
		'aa'        => '',
	);

	$solid_fill = array( 'star', 'whatsapp', 'quote' );
	$fill       = in_array( $name, $solid_fill, true ) ? 'currentColor' : 'none';
	$stroke     = in_array( $name, $solid_fill, true ) ? 'none' : 'currentColor';

	if ( 'star' === $name ) {
		$body = '<polygon points="12 2 15 9 22 9.5 16.5 14 18.5 21 12 17 5.5 21 7.5 14 2 9.5 9 9"/>';
	} elseif ( 'quote' === $name ) {
		$body = '<path d="M9 7H5a2 2 0 0 0-2 2v4a2 2 0 0 0 2 2h2v3l3-3V9a2 2 0 0 0-1-1.7zM19 7h-4a2 2 0 0 0-2 2v4a2 2 0 0 0 2 2h2v3l3-3V9a2 2 0 0 0-1-1.7z"/>';
	} else {
		$body = isset( $paths[ $name ] ) ? $paths[ $name ] : '';
	}

	return sprintf(
		'<svg width="%1$d" height="%1$d" viewBox="0 0 24 24" fill="%2$s" stroke="%3$s" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">%4$s</svg>',
		(int) $size,
		esc_attr( $fill ),
		esc_attr( $stroke ),
		$body
	);
}

/**
 * Route the education page to its dedicated landing template.
 *
 * Mirrors the translation / diploma / exam force-route (template_include,
 * priority 99): the WP `education` page keeps its saved template meta, but
 * renders through page-education.php. Other department pages are untouched.
 *
 * @param string $template Path WordPress resolved for the request.
 * @return string
 */
function novira_force_education_template( $template ) {
	if ( is_page( 'education' ) ) {
		$landing = locate_template( 'page-education.php' );
		if ( $landing ) {
			return $landing;
		}
	}
	return $template;
}
add_filter( 'template_include', 'novira_force_education_template', 99 );

/**
 * Enqueue the landing's stylesheet + behaviour, scoped to the education page.
 */
function novira_education_landing_assets() {
	if ( ! is_page( 'education' ) ) {
		return;
	}

	wp_enqueue_style(
		'novira-education-landing',
		NOVIRA_URI . '/assets/css/education-landing.css',
		array( 'novira-main' ),
		file_exists( NOVIRA_DIR . '/assets/css/education-landing.css' ) ? filemtime( NOVIRA_DIR . '/assets/css/education-landing.css' ) : NOVIRA_VERSION
	);

	wp_enqueue_script(
		'novira-education-landing',
		NOVIRA_URI . '/assets/js/education-landing.js',
		array(),
		file_exists( NOVIRA_DIR . '/assets/js/education-landing.js' ) ? filemtime( NOVIRA_DIR . '/assets/js/education-landing.js' ) : NOVIRA_VERSION,
		true
	);
}
add_action( 'wp_enqueue_scripts', 'novira_education_landing_assets', 20 );
