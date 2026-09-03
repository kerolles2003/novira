<?php
/**
 * Novira Academy – Language Infrastructure (Foundation Sprint — Localization)
 *
 * Plugin-agnostic language registry + header language switcher.
 *
 * Design:
 *   - novira_languages() is the single source of truth for which languages
 *     exist and where they live. It adapts to Polylang or WPML when either is
 *     active; with neither installed it returns Arabic (active) plus English
 *     as a visibly disabled placeholder — a <span>, never a link, so it can
 *     never 404 or produce a broken href.
 *   - novira_language_switcher() renders the toggle. Same component for
 *     desktop and mobile (context modifier only) — no duplicated navigation.
 *   - When a multilingual plugin IS active, the same registry feeds the
 *     dormant hreflang emitter in inc/seo.php automatically, so enabling
 *     English is configuration, not development.
 *
 * No JavaScript: the switcher is plain links, keyboard accessible by nature.
 *
 * @package Novira_Academy
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Absolute URL of the current request (safe fallback chain).
 *
 * @return string
 */
function novira_current_page_url() {
	if ( function_exists( 'novira_canonical_url' ) ) {
		return novira_canonical_url();
	}
	global $wp;
	return $wp instanceof WP ? home_url( add_query_arg( array(), $wp->request ) ) : home_url( '/' );
}

/**
 * The language registry — single source of truth for the switcher, the
 * hreflang bridge, and any future language-aware component.
 *
 * Each entry:
 *   'code'      string  Two-letter code ('ar', 'en').
 *   'label'     string  Short UI label ('AR', 'EN').
 *   'name'      string  Native language name ('العربية', 'English').
 *   'url'       string  Target URL for this language ('' when unavailable).
 *   'active'    bool    Currently displayed language.
 *   'available' bool    A real destination exists (false → disabled state).
 *   'source'    string  'polylang' | 'wpml' | 'fallback'.
 *
 * Never-404 guarantee: plugin adapters always resolve missing translations to
 * the language home page; the no-plugin fallback renders no link at all for
 * the unavailable language.
 *
 * @return array[]
 */
function novira_languages() {
	$languages = array();

	if ( function_exists( 'pll_the_languages' ) ) {
		// ---- Polylang -------------------------------------------------------
		$raw = pll_the_languages( array(
			'raw'           => 1,
			'hide_if_empty' => 0,
		) );

		foreach ( (array) $raw as $lang ) {
			if ( empty( $lang['slug'] ) ) {
				continue;
			}
			$url = ! empty( $lang['url'] ) ? $lang['url'] : '';
			if ( '' === $url && function_exists( 'pll_home_url' ) ) {
				$url = pll_home_url( $lang['slug'] ); // Missing translation → language home, never 404.
			}
			if ( '' === $url ) {
				$url = home_url( '/' );
			}
			$languages[] = array(
				'code'      => $lang['slug'],
				'label'     => strtoupper( $lang['slug'] ),
				'name'      => isset( $lang['name'] ) ? $lang['name'] : strtoupper( $lang['slug'] ),
				'url'       => $url,
				'active'    => ! empty( $lang['current_lang'] ),
				'available' => true,
				'source'    => 'polylang',
			);
		}
	} elseif ( function_exists( 'icl_get_languages' ) ) {
		// ---- WPML -----------------------------------------------------------
		// skip_missing=0 → WPML returns its configured fallback URL (language
		// home) for untranslated content, so links never 404.
		$raw = icl_get_languages( 'skip_missing=0&orderby=code&order=asc' );

		foreach ( (array) $raw as $lang ) {
			$code = isset( $lang['language_code'] ) ? $lang['language_code'] : ( isset( $lang['code'] ) ? $lang['code'] : '' );
			if ( '' === $code ) {
				continue;
			}
			$languages[] = array(
				'code'      => $code,
				'label'     => strtoupper( $code ),
				'name'      => isset( $lang['native_name'] ) ? $lang['native_name'] : strtoupper( $code ),
				'url'       => ! empty( $lang['url'] ) ? $lang['url'] : home_url( '/' ),
				'active'    => ! empty( $lang['active'] ),
				'available' => true,
				'source'    => 'wpml',
			);
		}
	}

	if ( empty( $languages ) ) {
		// ---- No multilingual plugin (today's state) --------------------------
		// Arabic is the site; English is a visible, disabled placeholder.
		$languages = array(
			array(
				'code'      => 'ar',
				'label'     => 'AR',
				'name'      => __( 'العربية', 'novira-academy' ),
				'url'       => novira_current_page_url(),
				'active'    => true,
				'available' => true,
				'source'    => 'fallback',
			),
			array(
				'code'      => 'en',
				'label'     => 'EN',
				'name'      => 'English',
				'url'       => '',
				'active'    => false,
				'available' => false,
				'source'    => 'fallback',
			),
		);
	}

	/**
	 * Filter the language registry.
	 *
	 * @param array[] $languages See novira_languages() docblock for shape.
	 */
	return apply_filters( 'novira_languages', $languages );
}

/**
 * Render the header language switcher.
 *
 * FEATURE-FLAGGED: renders ONLY when multilingual UX is enabled (a supported
 * plugin is active or novira_multilingual_enabled is forced true). While the
 * site is single-language the switcher is hidden completely — inactive
 * functionality is never shown to users, so there is no "disabled English"
 * state on the live Arabic site.
 *
 * Markup contract (when it does render):
 *   - <nav aria-label> wrapper announcing itself to screen readers.
 *   - Active language: <a aria-current="true"> back to the current page.
 *   - Available language: plain <a hreflang lang> — no JS involved.
 *   - Unavailable language: <span aria-disabled="true"> + visually-hidden
 *     explanation. Not a link — cannot 404, cannot break. (Defensive: only
 *     reachable when a plugin is active but a target translation is missing.)
 *
 * @param string $context 'desktop' or 'mobile' (style modifier only).
 */
function novira_language_switcher( $context = 'desktop' ) {
	// Hard gate: no multilingual support → no switcher at all.
	if ( ! novira_multilingual_enabled() ) {
		return;
	}

	/**
	 * Filter whether the language switcher renders at all.
	 *
	 * @param bool   $enabled Default true (multilingual already confirmed on).
	 * @param string $context 'desktop' | 'mobile'.
	 */
	if ( ! apply_filters( 'novira_language_switcher_enabled', true, $context ) ) {
		return;
	}

	$languages = novira_languages();
	if ( count( $languages ) < 2 ) {
		return; // Nothing to switch between.
	}
	?>
	<nav class="lang-switcher lang-switcher--<?php echo esc_attr( $context ); ?>"
		aria-label="<?php esc_attr_e( 'اختيار اللغة', 'novira-academy' ); ?>">
		<ul class="lang-switcher__list" role="list">
			<?php foreach ( $languages as $language ) : ?>
				<li class="lang-switcher__item">
					<?php if ( $language['active'] ) : ?>
						<a class="lang-switcher__link is-active"
							href="<?php echo esc_url( $language['url'] ? $language['url'] : novira_current_page_url() ); ?>"
							lang="<?php echo esc_attr( $language['code'] ); ?>"
							hreflang="<?php echo esc_attr( $language['code'] ); ?>"
							aria-current="true">
							<?php echo esc_html( $language['label'] ); ?>
							<span class="screen-reader-text"><?php echo esc_html( $language['name'] ); ?> (<?php esc_html_e( 'اللغة الحالية', 'novira-academy' ); ?>)</span>
						</a>
					<?php elseif ( $language['available'] && $language['url'] ) : ?>
						<a class="lang-switcher__link"
							href="<?php echo esc_url( $language['url'] ); ?>"
							lang="<?php echo esc_attr( $language['code'] ); ?>"
							hreflang="<?php echo esc_attr( $language['code'] ); ?>">
							<?php echo esc_html( $language['label'] ); ?>
							<span class="screen-reader-text"><?php echo esc_html( $language['name'] ); ?></span>
						</a>
					<?php else : ?>
						<span class="lang-switcher__link is-disabled"
							lang="<?php echo esc_attr( $language['code'] ); ?>"
							aria-disabled="true"
							title="<?php esc_attr_e( 'غير متاحة حالياً', 'novira-academy' ); ?>">
							<?php echo esc_html( $language['label'] ); ?>
							<span class="screen-reader-text"><?php echo esc_html( $language['name'] ); ?> (<?php esc_html_e( 'غير متاحة حالياً', 'novira-academy' ); ?>)</span>
						</span>
					<?php endif; ?>
				</li>
			<?php endforeach; ?>
		</ul>
	</nav>
	<?php
}

/**
 * Bridge: feed the dormant hreflang emitter (inc/seo.php) from the language
 * registry — but ONLY when a real multilingual plugin provides the URLs.
 *
 * Today (no plugin) the fallback registry is ignored, so nothing is emitted
 * and English stays un-indexed. The moment Polylang/WPML is configured with a
 * second language, hreflang (incl. x-default → Arabic) goes live untouched.
 *
 * @param array $alternates Existing alternates (win if already populated).
 * @return array
 */
function novira_languages_to_hreflang( $alternates ) {
	if ( ! empty( $alternates ) ) {
		return $alternates;
	}

	$out     = array();
	$default = '';
	foreach ( novira_languages() as $language ) {
		if ( 'fallback' === $language['source'] || ! $language['available'] || '' === $language['url'] ) {
			continue;
		}
		$out[ $language['code'] ] = $language['url'];
		if ( 'ar' === $language['code'] ) {
			$default = $language['url']; // Arabic is the primary language.
		}
	}

	if ( count( $out ) < 2 ) {
		return $alternates; // Single-language site → stay dormant.
	}

	if ( '' !== $default ) {
		$out['x-default'] = $default;
	}

	return $out;
}
add_filter( 'novira_hreflang_alternates', 'novira_languages_to_hreflang' );
