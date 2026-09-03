<?php
/**
 * Certified-Translation Landing — helpers, routing and asset loading.
 *
 * Self-contained support for page-translation.php:
 *  - novira_tl_icon()    inline stroke-icon set (Lucide-style)
 *  - novira_tl_flag()    compact SVG language flags
 *  - novira_tl_doc_art() larger decorative illustrations
 *  - template_include route so the `translation` page uses page-translation.php
 *  - conditional CSS/JS enqueue for the landing only
 *
 * @package Novira_Academy
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Inline stroke icon.
 *
 * @param string $name Icon key.
 * @param int    $size Pixel size.
 * @return string SVG markup.
 */
function novira_tl_icon( $name, $size = 20 ) {
	$paths = array(
		'file'     => '<path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="8" y1="13" x2="16" y2="13"/><line x1="8" y1="17" x2="14" y2="17"/>',
		'shield'   => '<path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/><path d="M9 12l2 2 4-4"/>',
		'seal'     => '<circle cx="12" cy="9" r="6"/><path d="M9 13.5 8 22l4-2 4 2-1-8.5"/><path d="M12 6.5l1.1 2.2 2.4.2-1.8 1.6.6 2.4-2.3-1.3-2.3 1.3.6-2.4-1.8-1.6 2.4-.2z"/>',
		'bolt'     => '<polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"/>',
		'lock'     => '<rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/>',
		'tag'      => '<path d="M20.6 13.4 12 22l-9-9V4a1 1 0 0 1 1-1h8z"/><circle cx="7.5" cy="7.5" r="1.3"/>',
		'whatsapp' => '<path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"/>',
		'building' => '<path d="M3 21h18"/><path d="M5 21V8l7-4 7 4v13"/><path d="M9 21v-6h6v6"/><line x1="9" y1="11" x2="9" y2="11"/><line x1="15" y1="11" x2="15" y2="11"/>',
		'passport' => '<rect x="4" y="2" width="16" height="20" rx="2"/><circle cx="12" cy="10" r="3"/><path d="M9 16h6"/>',
		'plane'    => '<path d="M17.8 19.2 16 11l3.5-3.5a2.1 2.1 0 0 0-3-3L13 8 4.8 6.2a.5.5 0 0 0-.5.8l3.9 4-2.2 2.2-1.9-.5-.9.9 2.7 1.6L8.4 20l.9-.9-.5-1.9L11 15l4 3.9a.5.5 0 0 0 .8-.5z"/>',
		'bank'     => '<line x1="3" y1="21" x2="21" y2="21"/><path d="M3 10 12 4l9 6"/><line x1="5" y1="21" x2="5" y2="10"/><line x1="9" y1="21" x2="9" y2="10"/><line x1="15" y1="21" x2="15" y2="10"/><line x1="19" y1="21" x2="19" y2="10"/>',
		'cap'      => '<path d="M22 10 12 5 2 10l10 5 10-5z"/><path d="M6 12v5c0 1 2.7 2.5 6 2.5s6-1.5 6-2.5v-5"/>',
		'eye'      => '<path d="M2 12s3.5-7 10-7 10 7 10 7-3.5 7-10 7-10-7-10-7z"/><circle cx="12" cy="12" r="3"/>',
		'stack'    => '<polygon points="12 2 2 7 12 12 22 7 12 2"/><polyline points="2 12 12 17 22 12"/><polyline points="2 17 12 22 22 17"/>',
		'scale'    => '<path d="M12 3v18"/><path d="M7 21h10"/><path d="M5 7h14"/><path d="M5 7 2.5 13a3 3 0 0 0 5 0z"/><path d="M19 7l-2.5 6a3 3 0 0 0 5 0z"/>',
		'target'   => '<circle cx="12" cy="12" r="9"/><circle cx="12" cy="12" r="5"/><circle cx="12" cy="12" r="1.4"/>',
		'headset'  => '<path d="M4 13a8 8 0 0 1 16 0"/><path d="M4 13v3a2 2 0 0 0 2 2h1v-6H6a2 2 0 0 0-2 1z"/><path d="M20 13v3a2 2 0 0 1-2 2h-1v-6h1a2 2 0 0 1 2 1z"/>',
		'clock'    => '<circle cx="12" cy="12" r="9"/><polyline points="12 7 12 12 15 14"/>',
		'send'     => '<path d="M22 2 11 13"/><path d="M22 2 15 22l-4-9-9-4z"/>',
		'pen'      => '<path d="M12 20h9"/><path d="M16.5 3.5a2.1 2.1 0 0 1 3 3L7 19l-4 1 1-4z"/>',
		'upload'   => '<path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 9 12 4 17 9"/><line x1="12" y1="4" x2="12" y2="16"/>',
		'doc'      => '<rect x="4" y="3" width="16" height="18" rx="2"/><line x1="8" y1="8" x2="16" y2="8"/><line x1="8" y1="12" x2="16" y2="12"/><line x1="8" y1="16" x2="13" y2="16"/>',
		'briefcase'=> '<rect x="2" y="7" width="20" height="14" rx="2"/><path d="M8 7V5a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/><line x1="2" y1="13" x2="22" y2="13"/>',
		'truck'    => '<path d="M2 6.5A1.5 1.5 0 0 1 3.5 5H14a1 1 0 0 1 1 1v10H8.5"/><path d="M15 9h3.6a2 2 0 0 1 1.7 1l1.5 2.5a2 2 0 0 1 .2.9V16h-3"/><circle cx="6.5" cy="17.5" r="2"/><circle cx="17.5" cy="17.5" r="2"/>',
		'medical'  => '<path d="M6 3v6a4 4 0 0 0 8 0V3"/><path d="M4 3h4"/><path d="M12 3h4"/><path d="M14 13v2a5 5 0 0 0 5 5 3 3 0 0 0 3-3v-1"/><circle cx="20" cy="16" r="1.6"/>',
	);

	$star   = 'star' === $name;
	$fill   = ( 'whatsapp' === $name || $star ) ? 'currentColor' : 'none';
	$stroke = ( 'whatsapp' === $name || $star ) ? 'none' : 'currentColor';
	$body   = $star
		? '<polygon points="12 2 15 9 22 9.5 16.5 14 18.5 21 12 17 5.5 21 7.5 14 2 9.5 9 9"/>'
		: ( isset( $paths[ $name ] ) ? $paths[ $name ] : '' );

	return sprintf(
		'<svg width="%1$d" height="%1$d" viewBox="0 0 24 24" fill="%2$s" stroke="%3$s" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">%4$s</svg>',
		(int) $size,
		esc_attr( $fill ),
		esc_attr( $stroke ),
		$body
	);
}

/**
 * Compact language flag.
 *
 * @param string $code Two-letter code or 'globe'.
 * @return string SVG markup.
 */
function novira_tl_flag( $code ) {
	$w = 26;
	$h = 18;
	$open  = '<svg class="tl-flag" width="' . $w . '" height="' . $h . '" viewBox="0 0 26 18" aria-hidden="true"><defs><clipPath id="tlf' . esc_attr( $code ) . '"><rect width="26" height="18" rx="3"/></clipPath></defs><g clip-path="url(#tlf' . esc_attr( $code ) . ')">';
	$close = '</g><rect x=".5" y=".5" width="25" height="17" rx="2.5" fill="none" stroke="rgba(0,0,0,.12)"/></svg>';

	switch ( $code ) {
		case 'us':
			$b = '<rect width="26" height="18" fill="#fff"/>';
			for ( $i = 0; $i < 7; $i++ ) {
				$b .= '<rect y="' . ( $i * 2.57 ) . '" width="26" height="1.28" fill="#b22234"/>';
			}
			$b .= '<rect width="11" height="9" fill="#3c3b6e"/>';
			break;
		case 'gb':
			$b = '<rect width="26" height="18" fill="#012169"/><path d="M0 0l26 18M26 0L0 18" stroke="#fff" stroke-width="3.4"/><path d="M0 0l26 18M26 0L0 18" stroke="#c8102e" stroke-width="1.8"/><path d="M13 0v18M0 9h26" stroke="#fff" stroke-width="5"/><path d="M13 0v18M0 9h26" stroke="#c8102e" stroke-width="2.6"/>';
			break;
		case 'de':
			$b = '<rect width="26" height="6" fill="#000"/><rect y="6" width="26" height="6" fill="#dd0000"/><rect y="12" width="26" height="6" fill="#ffce00"/>';
			break;
		case 'fr':
			$b = '<rect width="8.67" height="18" fill="#002395"/><rect x="8.67" width="8.67" height="18" fill="#fff"/><rect x="17.33" width="8.67" height="18" fill="#ed2939"/>';
			break;
		case 'it':
			$b = '<rect width="8.67" height="18" fill="#009246"/><rect x="8.67" width="8.67" height="18" fill="#fff"/><rect x="17.33" width="8.67" height="18" fill="#ce2b37"/>';
			break;
		case 'es':
			$b = '<rect width="26" height="18" fill="#c60b1e"/><rect y="4.5" width="26" height="9" fill="#ffc400"/>';
			break;
		case 'tr':
			$b = '<rect width="26" height="18" fill="#e30a17"/><circle cx="10.5" cy="9" r="4.2" fill="#fff"/><circle cx="11.8" cy="9" r="3.3" fill="#e30a17"/><path d="M15.4 9l3.4-1.1-2.1 2.9v-3.6l2.1 2.9z" fill="#fff"/>';
			break;
		case 'ru':
			$b = '<rect width="26" height="6" fill="#fff"/><rect y="6" width="26" height="6" fill="#0039a6"/><rect y="12" width="26" height="6" fill="#d52b1e"/>';
			break;
		default: // globe
			return '<svg class="tl-flag tl-flag--globe" width="26" height="18" viewBox="0 0 24 24" fill="none" stroke="#7b2cff" stroke-width="1.8" aria-hidden="true"><circle cx="12" cy="12" r="9"/><path d="M3 12h18M12 3a15 15 0 0 1 0 18M12 3a15 15 0 0 0 0 18"/></svg>';
	}

	return $open . $b . $close;
}

/**
 * Larger decorative illustration.
 *
 * @param string $key Illustration key.
 * @return string SVG markup.
 */
function novira_tl_doc_art( $key ) {
	switch ( $key ) {
		case 'study':
			return '<svg viewBox="0 0 120 90" fill="none" aria-hidden="true"><rect x="20" y="58" width="80" height="9" rx="2" fill="#c9b8ff"/><rect x="26" y="49" width="68" height="9" rx="2" fill="#a789ff"/><rect x="32" y="40" width="56" height="9" rx="2" fill="#7b4dff"/><path d="M60 16 22 32l38 16 38-16z" fill="#5b14e6"/><path d="M38 40v10c0 5 10 9 22 9s22-4 22-9V40" stroke="#2a0a66" stroke-width="3" fill="none"/><path d="M98 32v14" stroke="#c99a2e" stroke-width="2.4" stroke-linecap="round"/><circle cx="98" cy="49" r="3" fill="#c99a2e"/></svg>';
		case 'travel':
			return '<svg viewBox="0 0 120 90" fill="none" aria-hidden="true"><rect x="30" y="16" width="46" height="60" rx="6" fill="#5b14e6"/><rect x="36" y="22" width="34" height="48" rx="3" fill="#efeaff"/><circle cx="53" cy="40" r="9" fill="none" stroke="#5b14e6" stroke-width="2.4"/><path d="M53 31v18M44 40h18" stroke="#5b14e6" stroke-width="1.5"/><rect x="44" y="58" width="18" height="3" rx="1.5" fill="#7b2cff"/><path d="M92 24l-4 16 6-2 2 12 4-1-1-13 8-5a3 3 0 0 0-3-5l-7 4-9-4a1 1 0 0 0-1 1z" fill="#c99a2e"/></svg>';
		case 'business':
			return '<svg viewBox="0 0 120 90" fill="none" aria-hidden="true"><rect x="30" y="34" width="60" height="40" rx="6" fill="#2a0a66"/><rect x="30" y="46" width="60" height="6" fill="#1c0647"/><path d="M48 34v-5a5 5 0 0 1 5-5h14a5 5 0 0 1 5 5v5" stroke="#5b14e6" stroke-width="3.4" fill="none"/><rect x="54" y="49" width="12" height="8" rx="2" fill="#c99a2e"/></svg>';
		case 'medical':
			return '<svg viewBox="0 0 120 90" fill="none" aria-hidden="true"><path d="M44 22v18a12 12 0 0 0 24 0V22" stroke="#5b14e6" stroke-width="3.6" fill="none" stroke-linecap="round"/><path d="M40 22h8M64 22h8" stroke="#5b14e6" stroke-width="3.6" stroke-linecap="round"/><path d="M68 52v6a12 12 0 0 0 12 12 8 8 0 0 0 8-8v-4" stroke="#7b2cff" stroke-width="3.6" fill="none" stroke-linecap="round"/><circle cx="88" cy="54" r="5.5" fill="#c99a2e"/></svg>';
		case 'consult':
			return '<svg viewBox="0 0 200 150" fill="none" aria-hidden="true"><rect x="46" y="20" width="108" height="118" rx="6" fill="#fff" transform="rotate(-4 100 79)"/><g transform="rotate(-4 100 79)"><rect x="60" y="34" width="60" height="7" rx="3" fill="#5b14e6"/><rect x="60" y="50" width="80" height="4" rx="2" fill="#d9d0f5"/><rect x="60" y="60" width="70" height="4" rx="2" fill="#d9d0f5"/><rect x="60" y="70" width="76" height="4" rx="2" fill="#d9d0f5"/><rect x="60" y="80" width="54" height="4" rx="2" fill="#d9d0f5"/><circle cx="128" cy="104" r="16" fill="#f6d67b" stroke="#c99a2e" stroke-width="2"/><path d="M128 96l2.4 4.9 5.4.8-3.9 3.8.9 5.4-4.8-2.5-4.8 2.5.9-5.4-3.9-3.8 5.4-.8z" fill="#fff8e6"/></g><rect x="118" y="96" width="20" height="24" rx="5" fill="#3a1a8a" transform="rotate(8 128 108)"/><rect x="112" y="118" width="32" height="9" rx="3" fill="#c99a2e"/></svg>';
		case 'gift':
			return '<svg viewBox="0 0 130 130" fill="none" aria-hidden="true"><rect x="28" y="58" width="74" height="52" rx="6" fill="#7b2cff"/><rect x="28" y="58" width="74" height="16" rx="4" fill="#9a5bff"/><rect x="58" y="58" width="14" height="52" fill="#ffd24a"/><path d="M65 56c-6-2-16-6-16-14a8 8 0 0 1 16 2 8 8 0 0 1 16-2c0 8-10 12-16 14z" fill="#ffd24a"/><circle cx="65" cy="40" r="4" fill="#fff0b8"/></svg>';
	}
	return '';
}

/**
 * Route the certified-translation page to its dedicated landing template.
 *
 * Mirrors the diploma/exam force-route pattern (template_include, priority 99):
 * the WP `translation` page keeps its saved template meta, but renders through
 * page-translation.php. Other department pages are untouched.
 *
 * @param string $template Path WordPress resolved for the request.
 * @return string
 */
function novira_force_translation_template( $template ) {
	if ( is_page( 'translation' ) ) {
		$landing = locate_template( 'page-translation.php' );
		if ( $landing ) {
			return $landing;
		}
	}
	return $template;
}
add_filter( 'template_include', 'novira_force_translation_template', 99 );

/**
 * Enqueue the landing's stylesheet + behaviour, scoped to the translation page.
 */
function novira_translation_landing_assets() {
	if ( ! is_page( 'translation' ) ) {
		return;
	}

	wp_enqueue_style(
		'novira-translation-landing',
		NOVIRA_URI . '/assets/css/translation-landing.css',
		array( 'novira-main' ),
		file_exists( NOVIRA_DIR . '/assets/css/translation-landing.css' ) ? filemtime( NOVIRA_DIR . '/assets/css/translation-landing.css' ) : NOVIRA_VERSION
	);

	wp_enqueue_script(
		'novira-translation-landing',
		NOVIRA_URI . '/assets/js/translation-landing.js',
		array(),
		file_exists( NOVIRA_DIR . '/assets/js/translation-landing.js' ) ? filemtime( NOVIRA_DIR . '/assets/js/translation-landing.js' ) : NOVIRA_VERSION,
		true
	);
}
add_action( 'wp_enqueue_scripts', 'novira_translation_landing_assets', 20 );
