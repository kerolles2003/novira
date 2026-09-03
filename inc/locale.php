<?php
/**
 * Novira Academy — Locale Abstraction (Multilingual Foundation — closure)
 *
 * THE single source of truth for how the theme renders per language.
 *
 * Division of responsibility (deliberate):
 *   - A multilingual plugin's ONLY job is to report the current locale
 *     (novira_active_locale()). It never decides direction, typography, or
 *     metadata.
 *   - The THEME decides everything downstream — language code, text direction,
 *     Open Graph locale, and typography — from ONE registry (novira_locales()).
 *
 * Consequences:
 *   - Adding a language later = add one array entry here (+ translate the .po
 *     and load its webfont). No template, SEO, or CSS edits.
 *   - With no plugin installed the site stays Arabic regardless of the WP admin
 *     "Site Language" setting — the theme forces its primary locale, exactly as
 *     it always has. The plugin, when present, is the only thing that can move
 *     the active locale off Arabic.
 *
 * @package Novira_Academy
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Is multilingual UX enabled?
 *
 * True only when a supported multilingual plugin is active (or forced via the
 * filter). This gates user-facing multilingual functionality — above all the
 * language switcher, which must never expose an inactive feature.
 *
 * @return bool
 */
function novira_multilingual_enabled() {
	$active = function_exists( 'pll_the_languages' )   // Polylang
		|| defined( 'POLYLANG_VERSION' )
		|| function_exists( 'icl_get_languages' )      // WPML
		|| defined( 'ICL_SITEPRESS_VERSION' );

	/**
	 * Filter whether multilingual UX is enabled.
	 *
	 * Allows a staging environment to force the switcher on before a plugin is
	 * configured, or to force it off during maintenance.
	 *
	 * @param bool $active Detected from active plugins.
	 */
	return (bool) apply_filters( 'novira_multilingual_enabled', $active );
}

/**
 * The theme's primary (default) locale.
 *
 * The language the site falls back to whenever no plugin is dictating one.
 * Arabic is and remains primary.
 *
 * @return string WordPress locale, e.g. 'ar'.
 */
function novira_primary_locale() {
	/**
	 * Filter the primary/default locale.
	 *
	 * @param string $locale Primary locale.
	 */
	return apply_filters( 'novira_primary_locale', 'ar' );
}

/**
 * The active locale — the ONE thing a multilingual plugin provides.
 *
 * Asks Polylang / WPML for the current locale. With no plugin, returns the
 * theme's primary locale (NOT get_locale()), so the WP admin "Site Language"
 * setting can never silently flip the public site's language or direction.
 *
 * @return string WordPress locale, e.g. 'ar', 'en_US'.
 */
function novira_active_locale() {
	$locale = '';

	if ( novira_multilingual_enabled() ) {
		if ( function_exists( 'pll_current_language' ) ) {
			// Polylang returns the full locale when asked for 'locale'.
			$locale = (string) pll_current_language( 'locale' );
		} elseif ( isset( $GLOBALS['sitepress'] ) && is_object( $GLOBALS['sitepress'] )
			&& method_exists( $GLOBALS['sitepress'], 'get_locale' ) ) {
			// WPML: resolve the current language code to a full locale.
			$sitepress = $GLOBALS['sitepress'];
			$code      = method_exists( $sitepress, 'get_current_language' )
				? $sitepress->get_current_language()
				: ( defined( 'ICL_LANGUAGE_CODE' ) ? ICL_LANGUAGE_CODE : '' );
			if ( $code ) {
				$locale = (string) $sitepress->get_locale( $code );
			}
		}
	}

	if ( '' === $locale ) {
		$locale = novira_primary_locale();
	}

	/**
	 * Filter the active locale (final override).
	 *
	 * @param string $locale Resolved active locale.
	 */
	return apply_filters( 'novira_active_locale', $locale );
}

/**
 * Guarantee Arabic is the primary language on the public site.
 *
 * WordPress auto-loads the translation whose file matches the site locale
 * (get_locale). If the WP "Site Language" is English (en_US — the WordPress
 * default) and an en_US.mo is present, the root URL "/" would render English.
 * That is NOT the intended behavior: Arabic is the permanent default.
 *
 * Rule:
 *   - A multilingual plugin (Polylang/WPML) is active → it OWNS the per-request
 *     locale (Arabic at "/", English at "/en/"); we defer to it completely.
 *   - No plugin → force the front end to the primary locale (Arabic), so "/"
 *     always renders Arabic and en_US.mo is never loaded there.
 *   - Admin / AJAX / REST / CLI are left on WordPress's own locale.
 *
 * @param string $locale Locale WordPress resolved for this request.
 * @return string
 */
function novira_enforce_primary_locale( $locale ) {
	if ( is_admin()
		|| ( function_exists( 'wp_doing_ajax' ) && wp_doing_ajax() )
		|| ( defined( 'REST_REQUEST' ) && REST_REQUEST )
		|| ( defined( 'WP_CLI' ) && WP_CLI ) ) {
		return $locale;
	}

	// Polylang/WPML present → they set the correct per-request locale; don't fight it.
	if ( novira_multilingual_enabled() ) {
		return $locale;
	}

	// Single-language site → the public front end is always Arabic.
	return novira_primary_locale();
}
add_filter( 'determine_locale', 'novira_enforce_primary_locale', 99 );

/**
 * The locale registry — the ONE place that maps a locale to how it renders.
 *
 * Each entry:
 *   'lang'         string  Two-letter <html lang> / hreflang code.
 *   'dir'          string  'rtl' | 'ltr'.
 *   'og_locale'    string  Open Graph lang_TERRITORY.
 *   'native_name'  string  Endonym for the language switcher.
 *   'font_body'    string  CSS font-family stack applied to --ff-body.
 *   'font_display' string  CSS font-family stack applied to --ff-display.
 *   'font_target'  string  The chosen STANDARD stack for this locale, documented
 *                          for a future typography refresh. Not applied today —
 *                          font_body/font_display carry what actually renders so
 *                          the live Arabic site stays pixel-identical.
 *   'webfont'      string  Google-Fonts family query for this locale's fonts.
 *                          The single place to update when a locale's webfont
 *                          must be loaded (see novira_locale_webfont_query()).
 *
 * @return array<string,array>
 */
function novira_locales() {
	$locales = array(
		// ---- Arabic (primary, live) ----------------------------------------
		'ar' => array(
			'lang'         => 'ar',
			'dir'          => 'rtl',
			'og_locale'    => 'ar_EG',
			'native_name'  => __( 'العربية', 'novira-academy' ),
			// APPLIED today — the exact live stack (zero visual change).
			'font_body'    => "'Almarai', 'Cairo', sans-serif",
			'font_display' => "'Noto Kufi Arabic', 'Cairo', sans-serif",
			// STANDARD target for a future typography refresh (documented, not
			// applied — flip font_body/font_display to this when approved).
			'font_target'  => "'IBM Plex Sans Arabic', 'Almarai', 'Cairo', sans-serif",
			'webfont'      => 'Almarai:wght@300;400;700;800&family=Noto+Kufi+Arabic:wght@400;600;700;800;900&family=IBM+Plex+Sans+Arabic:wght@400;600',
		),
		// ---- English (ready, dormant) --------------------------------------
		'en' => array(
			'lang'         => 'en',
			'dir'          => 'ltr',
			'og_locale'    => 'en_US',
			'native_name'  => 'English',
			'font_body'    => "'IBM Plex Sans', 'Segoe UI', system-ui, sans-serif",
			'font_display' => "'IBM Plex Sans', 'Segoe UI', system-ui, sans-serif",
			'font_target'  => "'IBM Plex Sans', 'Segoe UI', system-ui, sans-serif",
			'webfont'      => 'IBM+Plex+Sans:wght@400;500;600;700',
		),
	);

	/**
	 * Filter the locale registry (add languages here, or from a plugin bridge).
	 *
	 * @param array $locales Locale => config map.
	 */
	return apply_filters( 'novira_locales', $locales );
}

/**
 * Resolve the render config for a locale (defaults to the active one).
 *
 * Matching: exact locale → two-letter language → primary locale entry. So both
 * 'en_US' and 'en_GB' resolve to the 'en' entry with no extra config.
 *
 * @param string|null $locale Locale to resolve; null = active locale.
 * @return array Config with an added 'locale' key.
 */
function novira_locale_config( $locale = null ) {
	if ( null === $locale ) {
		$locale = novira_active_locale();
	}

	$registry = novira_locales();

	if ( isset( $registry[ $locale ] ) ) {
		$config = $registry[ $locale ];
	} else {
		$lang = strtolower( substr( (string) $locale, 0, 2 ) );
		if ( isset( $registry[ $lang ] ) ) {
			$config = $registry[ $lang ];
		} else {
			$primary = novira_primary_locale();
			$config  = isset( $registry[ $primary ] ) ? $registry[ $primary ] : reset( $registry );
		}
	}

	$config['locale'] = $locale;

	/**
	 * Filter the resolved locale config.
	 *
	 * @param array  $config Resolved config.
	 * @param string $locale The locale it was resolved for.
	 */
	return apply_filters( 'novira_locale_config', $config, $locale );
}

/**
 * Google-Fonts family query for the active locale (single place to configure).
 *
 * Not used to re-enqueue today — the existing font enqueue already loads the
 * Arabic families. Exposed so the activation bridge can append a new locale's
 * webfont from the registry rather than editing functions.php by hand.
 *
 * @param string|null $locale Locale; null = active.
 * @return string Family query fragment, or '' if none.
 */
function novira_locale_webfont_query( $locale = null ) {
	$config = novira_locale_config( $locale );
	return isset( $config['webfont'] ) ? (string) $config['webfont'] : '';
}

/**
 * Emit the active locale's typography as :root custom-property overrides.
 *
 * This is what makes the registry actually drive rendering: --ff-body and
 * --ff-display follow the active locale. Today the active locale is Arabic and
 * its font_body/font_display equal the values already in main.css, so this is a
 * visual no-op; when English activates, the page renders in its stack with no
 * CSS edits. Printed late so it wins the cascade over the linked stylesheet.
 */
function novira_locale_typography_css() {
	$config  = novira_locale_config();
	$body    = isset( $config['font_body'] ) ? novira_sanitize_font_stack( $config['font_body'] ) : '';
	$display = isset( $config['font_display'] ) ? novira_sanitize_font_stack( $config['font_display'] ) : '';

	if ( '' === $body && '' === $display ) {
		return;
	}

	// `html:root` (specificity 0,1,1) outranks main.css's `:root` (0,1,0), so
	// the locale font wins the cascade no matter the head print order.
	$css = 'html:root{';
	if ( '' !== $body ) {
		$css .= '--ff-body:' . $body . ';';
	}
	if ( '' !== $display ) {
		$css .= '--ff-display:' . $display . ';';
	}
	$css .= '}';

	printf( "\n<style id=\"novira-locale-typography\">%s</style>\n", $css ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- sanitized above; CSS context, not HTML.
}
// Priority 100: print after enqueued stylesheets so the override is unambiguous.
add_action( 'wp_head', 'novira_locale_typography_css', 100 );

/**
 * Resolve a theme asset URL to its localized variant when one exists.
 *
 * FUTURE INSERTION POINT (dormant). Convention: a localized sibling lives next
 * to the default with a language suffix before the extension —
 *   assets/images/courses/math-course-placeholder.svg   (default / Arabic)
 *   assets/images/courses/math-course-placeholder.en.svg (English variant)
 *
 * Behavior today: the active locale is the primary (Arabic), so this always
 * returns the default URL — zero change, and it can never yield a broken link
 * because it falls back to the default whenever a variant is absent.
 *
 * Only the four text-bearing course placeholders need variants later (see the
 * asset-localization audit); everything else is language-independent. Templates
 * are NOT wired to this yet — it is provided as the lightest-touch mechanism to
 * adopt when localized assets are actually produced.
 *
 * @param string      $relative_path Theme-relative path, e.g. 'assets/images/courses/math-course-placeholder.svg'.
 * @param string|null $locale        Locale; null = active.
 * @return string Absolute asset URL (localized variant or default).
 */
function novira_localized_asset( $relative_path, $locale = null ) {
	$relative_path = ltrim( (string) $relative_path, '/' );
	$default_uri   = get_template_directory_uri() . '/' . $relative_path;

	if ( null === $locale ) {
		$locale = novira_active_locale();
	}
	$lang         = strtolower( substr( (string) $locale, 0, 2 ) );
	$primary_lang = strtolower( substr( novira_primary_locale(), 0, 2 ) );

	// Primary locale IS the default asset — no suffix lookup, no disk hit.
	if ( $lang !== $primary_lang ) {
		$dot = strrpos( $relative_path, '.' );
		if ( false !== $dot ) {
			$variant_rel = substr( $relative_path, 0, $dot ) . '.' . $lang . substr( $relative_path, $dot );
			if ( file_exists( get_template_directory() . '/' . $variant_rel ) ) {
				$default_uri = get_template_directory_uri() . '/' . $variant_rel;
			}
		}
	}

	/**
	 * Filter the resolved (possibly localized) asset URL.
	 *
	 * @param string $default_uri   Resolved URL.
	 * @param string $relative_path Requested theme-relative path.
	 * @param string $locale        Active/target locale.
	 */
	return apply_filters( 'novira_localized_asset', $default_uri, $relative_path, $locale );
}

/**
 * Sanitize a CSS font-family stack for safe inline emission.
 *
 * Font stacks are trusted (from the registry) but may be filtered, so we allow
 * only the characters a font-family list can contain — no braces, angle
 * brackets, semicolons, or other CSS-injection vectors survive.
 *
 * @param string $stack Font-family list.
 * @return string
 */
function novira_sanitize_font_stack( $stack ) {
	return trim( preg_replace( "/[^A-Za-z0-9 ,'\"_.\-]/", '', (string) $stack ) );
}
