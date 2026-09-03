<?php
/**
 * Premium Exam Spoke — shared presentation helpers (Sprint 5.0)
 *
 * Data-only helpers shared by the premium exam templates (Digital SAT today;
 * EST will adopt these in a future consolidation sprint). Provides the
 * Lucide-style icon set and the decorative US-flag SVG used by the components in
 * template-parts/sections/premium-exam/*.
 *
 * Structured data is NOT built here — it lives in the centralized SEO layer
 * (inc/seo.php). No HTML echo, no side effects. Escape at the call site.
 *
 * @package Novira_Academy
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Inline SVG icon library (Lucide-style line icons) shared by premium spokes.
 *
 * Keys mirror the set page-est.php defines inline, so the premium partials can
 * be reused by EST verbatim at consolidation.
 *
 * @return array<string,string> Icon key => inline SVG markup.
 */
function novira_premium_exam_icons() {
	return array(
		'cap'        => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 10L12 5 2 10l10 5 10-5z"/><path d="M6 12v5c3 2.5 9 2.5 12 0v-5"/></svg>',
		'clipboard'  => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="8" y="3" width="8" height="4" rx="1"/><path d="M16 5h2a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V7a2 2 0 0 1 2-2h2"/><path d="m9 13 2 2 4-4"/></svg>',
		'route'      => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="6" cy="19" r="3"/><circle cx="18" cy="5" r="3"/><path d="M9 19h5a4 4 0 0 0 0-8H10a4 4 0 0 1 0-8h5"/></svg>',
		'calendar'   => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2"/><path d="M16 2v4M8 2v4M3 10h18"/></svg>',
		'pen'        => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 20h9"/><path d="M16.5 3.5a2.12 2.12 0 0 1 3 3L7 19l-4 1 1-4Z"/></svg>',
		'target'     => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="9"/><circle cx="12" cy="12" r="5"/><circle cx="12" cy="12" r="1"/></svg>',
		'check'      => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="m5 13 4 4L19 7"/></svg>',
		'message'    => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>',
		'pulse'      => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 12h4l3 8 4-16 3 8h4"/></svg>',
		'file'       => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 3v4a1 1 0 0 0 1 1h4"/><path d="M17 21H7a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h7l5 5v11a2 2 0 0 1-2 2Z"/><path d="M9 13h6M9 17h4"/></svg>',
		'pin'        => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/><circle cx="12" cy="10" r="3"/></svg>',
		'refresh'    => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 12a9 9 0 0 1 15-6.7L21 8"/><path d="M21 3v5h-5"/><path d="M21 12a9 9 0 0 1-15 6.7L3 16"/><path d="M3 21v-5h5"/></svg>',
		'trophy'     => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 9H4.5a2.5 2.5 0 0 1 0-5H6"/><path d="M18 9h1.5a2.5 2.5 0 0 0 0-5H18"/><path d="M4 22h16"/><path d="M10 14.66V17c0 .55-.47.98-.97 1.21C7.85 18.75 7 20.24 7 22"/><path d="M14 14.66V17c0 .55.47.98.97 1.21C16.15 18.75 17 20.24 17 22"/><path d="M18 2H6v7a6 6 0 0 0 12 0V2Z"/></svg>',
		'whatsapp'   => '<svg viewBox="0 0 24 24" fill="currentColor"><path d="M12.04 2C6.58 2 2.13 6.45 2.13 11.91c0 1.75.46 3.45 1.32 4.95L2 22l5.25-1.38a9.9 9.9 0 0 0 4.79 1.22h.01c5.46 0 9.9-4.45 9.9-9.91 0-2.65-1.03-5.14-2.9-7.01A9.82 9.82 0 0 0 12.04 2Zm5.8 14.16c-.24.68-1.42 1.31-1.95 1.36-.5.05-.97.24-3.28-.69-2.76-1.09-4.52-3.92-4.66-4.1-.14-.18-1.12-1.49-1.12-2.85 0-1.36.71-2.02.97-2.3.24-.27.53-.34.71-.34.18 0 .36 0 .51.01.16.01.39-.06.6.46.24.56.81 1.93.88 2.07.07.14.12.3.02.48-.1.18-.15.3-.29.46-.14.16-.3.36-.43.48-.14.14-.29.29-.12.57.17.27.74 1.22 1.59 1.98 1.1.97 2.02 1.27 2.31 1.41.29.14.46.12.63-.07.18-.2.72-.84.91-1.13.19-.29.39-.24.65-.14.27.09 1.71.81 2 .95.29.14.49.21.56.32.07.12.07.66-.17 1.34Z"/></svg>',
		'star'       => '<svg viewBox="0 0 24 24" fill="currentColor"><path d="m12 2 2.9 6.26L22 9.27l-5 4.87L18.18 22 12 18.56 5.82 22 7 14.14l-5-4.87 7.1-1.01L12 2Z"/></svg>',
	);
}

/**
 * Decorative US-flag SVG (accent only). Class name is passed so a consumer can
 * scope it (est-hero__flag / est-cognia__flag).
 *
 * @param string $class SVG class attribute.
 * @return string
 */
function novira_premium_exam_flag( $class = 'est-hero__flag' ) {
	return '<svg class="' . esc_attr( $class ) . '" viewBox="0 0 38 26" aria-hidden="true" xmlns="http://www.w3.org/2000/svg">'
		. '<rect width="38" height="26" fill="#fff"/>'
		. '<g fill="#B22234"><rect width="38" height="2" y="0"/><rect width="38" height="2" y="4"/><rect width="38" height="2" y="8"/><rect width="38" height="2" y="12"/><rect width="38" height="2" y="16"/><rect width="38" height="2" y="20"/><rect width="38" height="2" y="24"/></g>'
		. '<rect width="16" height="14" fill="#3C3B6E"/>'
		. '<g fill="#fff"><circle cx="3" cy="3" r="1"/><circle cx="8" cy="3" r="1"/><circle cx="13" cy="3" r="1"/><circle cx="5.5" cy="7" r="1"/><circle cx="10.5" cy="7" r="1"/><circle cx="3" cy="11" r="1"/><circle cx="8" cy="11" r="1"/><circle cx="13" cy="11" r="1"/></g>'
		. '</svg>';
}
