<?php
/**
 * Novira Academy – Theme Functions
 *
 * @package Novira_Academy
 * @version 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'NOVIRA_VERSION', '1.0.0' );
define( 'NOVIRA_DIR', get_template_directory() );
define( 'NOVIRA_URI', get_template_directory_uri() );

/**
 * Theme Setup
 */
function novira_setup() {
	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	// Let WordPress manage the document title.
	add_theme_support( 'title-tag' );

	// Enable support for Post Thumbnails on posts and pages.
	add_theme_support( 'post-thumbnails' );

	// Custom logo support
	add_theme_support( 'custom-logo', array(
		'height'      => 80,
		'width'       => 250,
		'flex-height' => true,
		'flex-width'  => true,
	) );

	// HTML5 markup support
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
		'style',
		'script',
	) );

	// Gutenberg block support
	add_theme_support( 'wp-block-styles' );
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'align-wide' );

	// Custom background support
	add_theme_support( 'custom-background', array(
		'default-color' => 'ffffff',
	) );

	// Register navigation menus
	register_nav_menus( array(
		'primary'   => __( 'Primary Menu', 'novira-academy' ),
		'footer'    => __( 'Footer Menu', 'novira-academy' ),
		'social'    => __( 'Social Links Menu', 'novira-academy' ),
	) );

	// Set content width
	$GLOBALS['content_width'] = apply_filters( 'novira_content_width', 1200 );

	// Load text domain for translations
	load_theme_textdomain( 'novira-academy', NOVIRA_DIR . '/languages' );
}
add_action( 'after_setup_theme', 'novira_setup' );

/**
 * Register widget areas
 */
function novira_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'novira-academy' ),
		'id'            => 'sidebar-1',
		'description'   => __( 'Add widgets here to appear in the sidebar.', 'novira-academy' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer Column 1', 'novira-academy' ),
		'id'            => 'footer-1',
		'description'   => __( 'First footer column widget area.', 'novira-academy' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="footer-widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer Column 2', 'novira-academy' ),
		'id'            => 'footer-2',
		'description'   => __( 'Second footer column widget area.', 'novira-academy' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="footer-widget-title">',
		'after_title'   => '</h3>',
	) );
}
add_action( 'widgets_init', 'novira_widgets_init' );

/**
 * Enqueue scripts and styles
 */
function novira_enqueue_assets() {
	// Google Fonts (Arabic families + shared Latin display). Unchanged.
	wp_enqueue_style( 'novira-fonts',
		'https://fonts.googleapis.com/css2?family=Almarai:wght@300;400;700;800&family=Noto+Kufi+Arabic:wght@400;600;700;800;900&family=Plus+Jakarta+Sans:wght@400;600;700;800&family=IBM+Plex+Sans+Arabic:wght@400;600&display=swap',
		array(),
		null
	);

	// Locale webfont — load the ACTIVE locale's font family only when it differs
	// from the primary (Arabic). Today (Arabic active) this is a no-op, so the
	// Arabic site is byte-identical; when English is active it adds IBM Plex Sans
	// so the Latin typography from the locale registry actually renders.
	if ( function_exists( 'novira_active_locale' ) && function_exists( 'novira_primary_locale' ) ) {
		$active_locale = novira_active_locale();
		$active_lang   = strtolower( substr( (string) $active_locale, 0, 2 ) );
		$primary_lang  = strtolower( substr( novira_primary_locale(), 0, 2 ) );
		if ( $active_lang !== $primary_lang && function_exists( 'novira_locale_webfont_query' ) ) {
			$locale_webfont = novira_locale_webfont_query( $active_locale );
			if ( '' !== $locale_webfont ) {
				wp_enqueue_style( 'novira-fonts-locale',
					'https://fonts.googleapis.com/css2?family=' . $locale_webfont . '&display=swap',
					array( 'novira-fonts' ),
					null
				);
			}
		}
	}

	// Main stylesheet
	wp_enqueue_style( 'novira-main',
		NOVIRA_URI . '/assets/css/main.css',
		array( 'novira-fonts' ),
		filemtime( NOVIRA_DIR . '/assets/css/main.css' )
	);

	// Tailwind utilities
	wp_enqueue_style( 'novira-tailwind',
		NOVIRA_URI . '/assets/css/tailwind-compiled.css',
		array( 'novira-main' ),
		filemtime( NOVIRA_DIR . '/assets/css/tailwind-compiled.css' )
	);

	// Homepage-specific styles (loaded only on front page)
	if ( is_front_page() ) {
		// Material Symbols icon font — only the front-page hero + trust bar use
		// it, so it is scoped here instead of loading site-wide.
		wp_enqueue_style( 'novira-material-symbols',
			'https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap',
			array(),
			null
		);

		// Stitch Pixel-Perfect Homepage Styles
		wp_enqueue_style( 'novira-stitch-homepage',
			NOVIRA_URI . '/assets/css/stitch-homepage.css',
			array( 'novira-main' ),
			filemtime( NOVIRA_DIR . '/assets/css/stitch-homepage.css' )
		);

		// Carousel Styles
		wp_enqueue_style( 'novira-carousel',
			NOVIRA_URI . '/assets/css/carousel.css',
			array(),
			filemtime( NOVIRA_DIR . '/assets/css/carousel.css' )
		);

		// Carousel Script
		wp_enqueue_script( 'novira-carousel',
			NOVIRA_URI . '/assets/js/carousel.js',
			array(),
			filemtime( NOVIRA_DIR . '/assets/js/carousel.js' ),
			true
		);
	}

	// American Diploma hub landing page (pixel-perfect design)
	if ( is_page( 'american-diploma' ) ) {
		wp_enqueue_style( 'novira-american-diploma',
			NOVIRA_URI . '/assets/css/american-diploma.css',
			array( 'novira-main' ),
			filemtime( NOVIRA_DIR . '/assets/css/american-diploma.css' )
		);
	}

	// EST exam spoke — dedicated pixel-perfect landing page styles.
	if ( function_exists( 'novira_is_diploma_exam' ) && novira_is_diploma_exam()
		&& function_exists( 'novira_current_exam_slug' ) && 'est' === novira_current_exam_slug() ) {
		wp_enqueue_style( 'novira-est-page',
			NOVIRA_URI . '/assets/css/est-page.css',
			array( 'novira-main' ),
			filemtime( NOVIRA_DIR . '/assets/css/est-page.css' )
		);
		// Shared premium-exam component styles (definition section + FAQ accordion)
		// now used by EST too, so it composes from the same reusable components as
		// the Digital SAT / ACT spokes. Loads after est-page.css to reuse --est-*.
		wp_enqueue_style( 'novira-premium-exam',
			NOVIRA_URI . '/assets/css/premium-exam.css',
			array( 'novira-est-page' ),
			filemtime( NOVIRA_DIR . '/assets/css/premium-exam.css' )
		);
	}

	// Premium exam spokes (Digital SAT today; future ACT) reuse the EST premium
	// stylesheet for one product-family look. The EST block above is unchanged;
	// this block only fires for the premium non-EST slugs (mutually exclusive),
	// so it can safely share the 'novira-est-page' handle.
	if ( function_exists( 'novira_is_diploma_exam' ) && novira_is_diploma_exam()
		&& function_exists( 'novira_current_exam_slug' )
		&& in_array( novira_current_exam_slug(), array( 'digital-sat', 'act' ), true ) ) {
		wp_enqueue_style( 'novira-est-page',
			NOVIRA_URI . '/assets/css/est-page.css',
			array( 'novira-main' ),
			filemtime( NOVIRA_DIR . '/assets/css/est-page.css' )
		);
		// Supplementary premium styles (wordmark sizing + FAQ accordion). Loads
		// after est-page.css so it can reuse the --est-* tokens.
		wp_enqueue_style( 'novira-premium-exam',
			NOVIRA_URI . '/assets/css/premium-exam.css',
			array( 'novira-est-page' ),
			filemtime( NOVIRA_DIR . '/assets/css/premium-exam.css' )
		);
	}

	// Generic exam spoke styles — loaded for ALL offered exam spokes
	// (EST / Digital SAT / ACT / future AP). Styles the shared .exam-* markup
	// rendered by page-diploma-exam.php + template-parts/sections/exam/s1..s9.
	if ( function_exists( 'novira_is_diploma_exam' ) && novira_is_diploma_exam() ) {
		wp_enqueue_style( 'novira-exam',
			NOVIRA_URI . '/assets/css/exam.css',
			array( 'novira-main' ),
			filemtime( NOVIRA_DIR . '/assets/css/exam.css' )
		);

		// Course catalog section (Sprint 4.3.6) — shared "Courses" section on every
		// premium exam spoke (EST / Digital SAT / ACT / future AP). Loads after
		// est-page.css so it reuses the --est-* tokens; est-page.css is not edited.
		wp_enqueue_style( 'novira-exam-courses',
			NOVIRA_URI . '/assets/css/exam-courses.css',
			array( 'novira-est-page' ),
			filemtime( NOVIRA_DIR . '/assets/css/exam-courses.css' )
		);
	}

	// Blog and events styles.
	// NOTE: the blog_post archive (/blog), blog_category views, and single blog posts
	// are intentionally excluded — they load the premium, self-contained
	// assets/css/blog-archive.css / blog-article.css via inc/blog-archive.php +
	// inc/blog-single.php instead, so the stylesheets never overlap.
	if ( is_post_type_archive( 'event' ) || is_singular( 'event' ) || is_category() || is_tag() || is_search() ) {
		wp_enqueue_style( 'novira-blog-events',
			NOVIRA_URI . '/assets/css/blog-events.css',
			array( 'novira-main' ),
			filemtime( NOVIRA_DIR . '/assets/css/blog-events.css' )
		);
	}

	// Department page styles (loaded only on department pages)
	if ( is_page_template( 'page-department.php' ) ) {
		$slug = get_post_field( 'post_name', get_the_ID() );
		
		if ( 'education' === $slug ) {
			wp_enqueue_style( 'novira-department-education',
				NOVIRA_URI . '/assets/css/department-education.css',
				array( 'novira-main' ),
				NOVIRA_VERSION
			);
		} elseif ( 'translation' === $slug ) {
			wp_enqueue_style( 'novira-department-translation',
				NOVIRA_URI . '/assets/css/department-translation.css',
				array( 'novira-main' ),
				NOVIRA_VERSION
			);
			wp_enqueue_style( 'novira-translation-workflow',
				NOVIRA_URI . '/assets/css/translation-workflow.css',
				array( 'novira-main' ),
				NOVIRA_VERSION
			);
		} elseif ( 'american-diploma' === $slug ) {
			wp_enqueue_style( 'novira-department-american-diploma',
				NOVIRA_URI . '/assets/css/department-american-diploma.css',
				array( 'novira-main' ),
				NOVIRA_VERSION
			);
		}
	}

	// Media components styles - only on pages that use media components
	if ( is_front_page() || is_page_template( 'page-department.php' ) || is_singular( array( 'blog_post', 'event' ) ) || is_post_type_archive( array( 'blog_post', 'event' ) ) ) {
		wp_enqueue_style( 'novira-media-components',
			NOVIRA_URI . '/assets/css/media-components.css',
			array( 'novira-main' ),
			filemtime( NOVIRA_DIR . '/assets/css/media-components.css' )
		);

		wp_enqueue_style( 'novira-variables',
			NOVIRA_URI . '/assets/css/variables.css',
			array( 'novira-main' ),
			filemtime( NOVIRA_DIR . '/assets/css/variables.css' )
		);
	}

	// RTL is handled with CSS logical properties in main.css (and per-page
	// scoped [dir] overrides), so no separate RTL stylesheet is enqueued.
	// NOTE: assets/css/rtl.css is NOT auto-loaded — core only auto-loads an
	// rtl.css located in the theme ROOT, not under assets/css/. It is unused.

	// Navigation script
	wp_enqueue_script( 'novira-navigation',
		NOVIRA_URI . '/assets/js/navigation.js',
		array(),
		filemtime( NOVIRA_DIR . '/assets/js/navigation.js' ),
		true
	);

	// Main script
	wp_enqueue_script( 'novira-main',
		NOVIRA_URI . '/assets/js/main.js',
		array( 'novira-navigation' ),
		filemtime( NOVIRA_DIR . '/assets/js/main.js' ),
		true
	);
	// Note: no global wp_localize_script here — main.js consumes no AJAX data,
	// and baking a nonce into every (cacheable) page is a full-page-cache
	// foot-gun. Form scripts localize their own nonce where they load.
}
add_action( 'wp_enqueue_scripts', 'novira_enqueue_assets' );

/**
 * Custom template tags for this theme
 */
function novira_header_menu() {
	wp_nav_menu( array(
		'theme_location' => 'primary',
		'container'      => false,
		'menu_class'     => 'nav-links',
		'fallback_cb'    => 'novira_fallback_menu',
		'depth'          => 2,
	) );
}

/**
 * Fallback menu when no menu is assigned
 */
function novira_fallback_menu() {
	echo '<ul class="nav-links">';
	echo '<li><a href="' . esc_url( home_url( '/' ) ) . '">' . esc_html__( 'الرئيسية', 'novira-academy' ) . '</a></li>';
	// Only link /services when that page actually exists (avoid a site-wide 404 link).
	if ( get_page_by_path( 'services' ) ) {
		echo '<li><a href="' . esc_url( home_url( '/services' ) ) . '">' . esc_html__( 'خدماتنا', 'novira-academy' ) . '</a></li>';
	}
	echo '<li><a href="' . esc_url( home_url( '/about' ) ) . '">' . esc_html__( 'من نحن', 'novira-academy' ) . '</a></li>';
	echo '<li><a href="' . esc_url( home_url( '/contact' ) ) . '" class="nav-cta">' . esc_html__( 'تواصل معنا', 'novira-academy' ) . '</a></li>';
	echo '</ul>';
}

/**
 * Footer menu
 */
function novira_footer_menu() {
	wp_nav_menu( array(
		'theme_location' => 'footer',
		'container'      => false,
		'menu_class'     => 'footer-links',
		'fallback_cb'    => 'novira_fallback_footer_menu',
		'depth'          => 1,
	) );
}

/**
 * Fallback footer menu
 */
function novira_fallback_footer_menu() {
	$items = '';
	// Only render each link when its page exists, so the footer never points at
	// a 404 (these pages are created as part of the launch checklist).
	if ( get_page_by_path( 'privacy' ) ) {
		$items .= '<li><a href="' . esc_url( home_url( '/privacy' ) ) . '">' . esc_html__( 'سياسة الخصوصية', 'novira-academy' ) . '</a></li>';
	}
	if ( get_page_by_path( 'terms' ) ) {
		$items .= '<li><a href="' . esc_url( home_url( '/terms' ) ) . '">' . esc_html__( 'الشروط والأحكام', 'novira-academy' ) . '</a></li>';
	}
	if ( '' !== $items ) {
		echo '<ul class="footer-links">' . $items . '</ul>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- pieces escaped above.
	}
}

/**
 * Baseline production hardening.
 *
 * Removes the WordPress version generator meta/RSS tags and disables XML-RPC
 * (the theme uses no pingback/remote-publishing features). Server-level
 * headers (X-Frame-Options, HSTS, etc.) belong in the Hostinger .htaccess and
 * are documented in the deployment notes.
 */
remove_action( 'wp_head', 'wp_generator' );
add_filter( 'the_generator', '__return_empty_string' );
add_filter( 'xmlrpc_enabled', '__return_false' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function novira_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'novira_pingback_header' );

/**
 * Add custom body classes
 */
function novira_body_classes( $classes ) {
	if ( is_singular() ) {
		$classes[] = 'singular';
	}

	if ( is_front_page() && ! is_home() ) {
		$classes[] = 'front-page';
	}

	return $classes;
}
add_filter( 'body_class', 'novira_body_classes' );

/**
 * Custom excerpt length
 */
function novira_excerpt_length( $length ) {
	return 25;
}
add_filter( 'excerpt_length', 'novira_excerpt_length', 999 );

/**
 * Custom excerpt more
 */
function novira_excerpt_more( $more ) {
	return '&hellip;';
}
add_filter( 'excerpt_more', 'novira_excerpt_more' );

/**
 * Include customizer settings
 */
require NOVIRA_DIR . '/inc/customizer.php';

/**
 * Include custom fields for department pages
 */
require NOVIRA_DIR . '/inc/custom-fields.php';

/**
 * Include form handling for quote requests
 */
require NOVIRA_DIR . '/inc/form-handling.php';

/**
 * Include form handling for registration interest
 */
require NOVIRA_DIR . '/inc/registration-handling.php';

/**
 * Include custom post types for blog and events
 */
require NOVIRA_DIR . '/inc/custom-post-types.php';

/**
 * Include the premium blog archive layer (reading-time / primary-category /
 * category-accent helpers + the scoped /blog + blog_category stylesheet enqueue).
 * Consumed by archive-blog_post.php and taxonomy-blog_category.php.
 */
require NOVIRA_DIR . '/inc/blog-archive.php';

/**
 * Include the premium single learning-article layer (reading progress, TOC, and
 * the educational learning-block shortcodes) for single blog_post views.
 * Consumed by single-blog_post.php.
 */
require NOVIRA_DIR . '/inc/blog-single.php';

/**
 * Include the semantic entity layer — internal (non-public) taxonomies that let
 * articles connect to educational concepts, plus the consolidated editor meta box.
 * Data architecture only; not yet exposed on the front-end or in SEO output.
 */
require NOVIRA_DIR . '/inc/blog-entities.php';

/**
 * Include the learning-journey recommendation engine — entity-aware related
 * posts + program guidance mapping. Consumed by template-parts/blog/journey.php.
 */
require NOVIRA_DIR . '/inc/blog-recommendations.php';

/**
 * Include cornerstone EEAT wiring — flags authoritative guides and feeds the
 * dormant reviewer/sources schema hooks from post meta. Data only, no output.
 */
require NOVIRA_DIR . '/inc/blog-cornerstones.php';

/**
 * Include translation request handler
 */
require NOVIRA_DIR . '/inc/translation-request-handler.php';

/**
 * Include media categories
 */
require NOVIRA_DIR . '/inc/media-categories.php';

/**
 * Include featured image handler
 */
require NOVIRA_DIR . '/inc/featured-images.php';

/**
 * Include media query functions
 */
require NOVIRA_DIR . '/inc/media-functions.php';

/**
 * Include exam integration layer
 */
require NOVIRA_DIR . '/inc/exam-integration.php';

/**
 * Include student authentication hooks
 */
require NOVIRA_DIR . '/inc/student-auth-hooks.php';

/**
 * Include locale abstraction (single source of truth: active locale → language,
 * direction, Open Graph locale, and typography). Must load before SEO and the
 * language switcher, which both derive from it.
 */
require NOVIRA_DIR . '/inc/locale.php';

/**
 * Include SEO foundation (meta tags + structured data)
 */
require NOVIRA_DIR . '/inc/seo.php';

/**
 * Include language infrastructure (plugin-agnostic registry + header
 * language switcher + hreflang bridge — Polylang/WPML compatible)
 */
require NOVIRA_DIR . '/inc/language-switcher.php';

/**
 * Include American Diploma data layer (single source of truth for the
 * Academic Ecosystem: journey, programs, disclaimer, FAQ, program schema data)
 */
require NOVIRA_DIR . '/inc/diploma.php';

/**
 * Include exam data layer (slug-driven contracts for EST / Digital SAT / ACT /
 * future AP — meta, FAQ, and current-exam detection helpers)
 */
require NOVIRA_DIR . '/inc/exams.php';

/**
 * Include the exam course catalog (Sprint 4.3.6) — one slug-driven dataset of
 * preparation courses shared across every exam spoke; filtered per exam.
 */
require NOVIRA_DIR . '/inc/exam-courses.php';

/**
 * Include premium exam-spoke helpers (shared icon set, flag SVG, and the
 * self-contained Course + FAQPage JSON-LD builder used by page-digital-sat.php
 * and the template-parts/sections/premium-exam/* components). Additive only —
 * EST does not consume these yet.
 */
require NOVIRA_DIR . '/inc/premium-exam.php';

/**
 * Include custom navigation walkers (render WordPress-managed primary menus with
 * the same dropdown markup/classes as the header fallback).
 */
require NOVIRA_DIR . '/inc/nav-walkers.php';

/**
 * Certified-translation landing page: inline icon/flag/illustration helpers,
 * the template_include force-route to page-translation.php, and its scoped
 * CSS/JS enqueue. Self-contained and additive — other department pages are
 * untouched.
 */
require NOVIRA_DIR . '/inc/translation-landing.php';

/**
 * Education & Skills landing page: inline icon helpers, the template_include
 * force-route to page-education.php, and its scoped CSS/JS enqueue.
 * Self-contained and additive — page-department.php's education branch is
 * untouched (simply out-ranked by the priority-99 force-route).
 */
require NOVIRA_DIR . '/inc/education-landing.php';

/**
 * About ("من نحن") landing page: inline icon helpers, the template_include
 * force-route to page-about.php, and its scoped CSS/JS enqueue. Self-contained
 * and additive.
 */
require NOVIRA_DIR . '/inc/about-landing.php';

/**
 * Contact ("تواصل معنا") landing page: inline icon helpers, the template_include
 * force-route to page-contact.php, and its scoped CSS/JS enqueue. Self-contained
 * and additive — supersedes any legacy template assigned to the Contact page.
 */
require NOVIRA_DIR . '/inc/contact-landing.php';

/**
 * Exams ("امتحانات نوفيرا") placement-test hub landing: inline icon helpers,
 * one-time `exams` Page creation, the template_include force-route to
 * page-exams.php, and its scoped CSS/JS enqueue. Self-contained and additive.
 */
require NOVIRA_DIR . '/inc/exams-landing.php';

/**
 * Courses catalog landing (/courses): inline icon helpers, the shared study-system
 * + course catalog data providers, one-time `courses` Page creation, the
 * template_include force-route to page-courses.php, and its scoped CSS/JS enqueue.
 * Self-contained and additive.
 */
require NOVIRA_DIR . '/inc/courses-landing.php';

/**
 * Force the American Diploma hub template for the hub page.
 *
 * Guarantees page-american-diploma.php renders for the `american-diploma` page
 * even if a legacy "Department Page" custom template is still assigned to it
 * (custom templates normally outrank page-{slug}.php). Resolves the template
 * interception blocker without requiring a manual Page Attributes change.
 *
 * Only the hub page itself is affected — child spokes (e.g. american-diploma/est)
 * are different pages and are not intercepted.
 *
 * @param string $template Path WordPress resolved for the request.
 * @return string
 */
function novira_force_diploma_hub_template( $template ) {
	if ( is_page( 'american-diploma' ) ) {
		$hub = locate_template( 'page-american-diploma.php' );
		if ( $hub ) {
			return $hub;
		}
	}
	return $template;
}
add_filter( 'template_include', 'novira_force_diploma_hub_template', 99 );

/**
 * Route every offered exam spoke to the single generic exam template.
 *
 * Any child of the American Diploma hub whose slug is an offered program
 * (EST / Digital SAT / ACT / future AP) renders through a premium template:
 * EST → page-est.php, and any spoke with a dedicated page-{slug}.php uses it
 * (Digital SAT → page-digital-sat.php). Spokes without one fall back to the
 * generic page-diploma-exam.php. Slug-driven via novira_is_diploma_exam().
 *
 * @param string $template Path WordPress resolved for the request.
 * @return string
 */
function novira_force_diploma_exam_template( $template ) {
	if ( function_exists( 'novira_is_diploma_exam' ) && novira_is_diploma_exam() ) {
		// EST has a dedicated, pixel-perfect landing template; Digital SAT and
		// ACT keep rendering through the generic exam template.
		if ( function_exists( 'novira_current_exam_slug' ) && 'est' === novira_current_exam_slug() ) {
			$est = locate_template( 'page-est.php' );
			if ( $est ) {
				return $est;
			}
		}
		// Premium spokes (Digital SAT today; future ACT) use a dedicated
		// page-{slug}.php when present. EST already returned above, so this
		// never affects EST; any other offered spoke without a dedicated
		// template falls through to the generic page-diploma-exam.php.
		$novira_spoke_slug = function_exists( 'novira_current_exam_slug' ) ? novira_current_exam_slug() : '';
		if ( $novira_spoke_slug ) {
			$novira_spoke_tpl = locate_template( 'page-' . $novira_spoke_slug . '.php' );
			if ( $novira_spoke_tpl ) {
				return $novira_spoke_tpl;
			}
		}
		$exam = locate_template( 'page-diploma-exam.php' );
		if ( $exam ) {
			return $exam;
		}
	}
	return $template;
}
add_filter( 'template_include', 'novira_force_diploma_exam_template', 99 );
