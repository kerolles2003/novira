<?php
/**
 * Novira Academy – SEO Foundation (Sprint 3)
 *
 * Centralised, truth-first SEO layer:
 *   - Single source of truth for NAP (Name / Address / Phone).
 *   - Meta description, canonical, Open Graph, Twitter Cards.
 *   - JSON-LD @graph (EducationalOrganization + LocalBusiness, WebSite,
 *     WebPage, BreadcrumbList, FAQPage).
 *   - AggregateRating ONLY when real Google Business values are supplied
 *     in the Customizer. Nothing is ever invented.
 *
 * Philosophy: help Google understand the real institution.
 * Never fabricate reviews, ratings, entities, prices, or dates.
 *
 * @package Novira_Academy
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Single source of truth for the academy's identity (NAP).
 *
 * Every SEO surface reads from here so the name, address, phone, geo,
 * and hours never drift apart again. Visible templates should migrate to
 * these values over time to close the remaining NAP inconsistencies.
 *
 * @return array
 */
function novira_nap() {
	$phone_raw = get_theme_mod( 'novira_phone', '01090600927' );
	$digits    = preg_replace( '/\D+/', '', $phone_raw );
	$e164      = '+20' . ltrim( $digits, '0' );

	return array(
		'name_en'      => 'Novira Academy',
		'name_ar'      => __( 'نوفيرا أكاديمي', 'novira-academy' ),
		// Canonical address = the Customizer value (also used by footer + contact page).
		'street'       => __( 'طريق الإبراهيمية، آخر شارع مستشفى أبو عوف', 'novira-academy' ),
		'locality'     => __( 'بني مزار', 'novira-academy' ),          // Beni Mazar
		'locality_en'  => 'Beni Mazar',
		'region'       => __( 'المنيا', 'novira-academy' ),            // Minya Governorate
		'region_en'    => 'Minya',
		'country'      => 'EG',
		'postal'       => '',                  // Unknown — left empty rather than invented.
		'lat'          => '28.4988907',
		'lng'          => '30.8024849',
		'phone_display'=> $phone_raw,
		'phone_e164'   => $e164,
		'whatsapp'     => get_theme_mod( 'novira_whatsapp', '201090600927' ),
		'email'        => get_theme_mod( 'novira_email', 'noviraacademy@gmail.com' ),
		'maps_url'     => 'https://maps.google.com/?q=' . rawurlencode( 'Novira Academy ' . get_theme_mod( 'novira_address', 'بني مزار المنيا' ) ),
	);
}

/**
 * Verified opening hours (single source of truth).
 *
 * Source: contact page + FAQ. The homepage map section currently shows a
 * looser "daily 10–10" string that should be reconciled to match this.
 *
 * @return array Schema.org openingHoursSpecification entries.
 */
function novira_opening_hours() {
	return array(
		array(
			'@type'     => 'OpeningHoursSpecification',
			'dayOfWeek' => array( 'Saturday', 'Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday' ),
			'opens'     => '10:00',
			'closes'    => '22:00',
		),
		array(
			'@type'     => 'OpeningHoursSpecification',
			'dayOfWeek' => 'Friday',
			'opens'     => '13:00',
			'closes'    => '22:00',
		),
	);
}

/**
 * Social profiles for sameAs (only non-empty URLs).
 *
 * @return string[]
 */
function novira_social_profiles() {
	$candidates = array(
		get_theme_mod( 'novira_facebook', 'https://www.facebook.com/noviraacademy' ),
		get_theme_mod( 'novira_instagram', 'https://www.instagram.com/noviraacademy?igsh=MXBlcnZ1b3o4NThraw==' ),
		get_theme_mod( 'novira_tiktok', 'https://www.tiktok.com/@noviraacademy' ),
		get_theme_mod( 'novira_youtube', 'https://youtube.com/@noviraacadem?si=C2tRTrf-D1X9a9dY' ),
	);

	return array_values( array_filter( array_map( 'esc_url_raw', $candidates ) ) );
}

/**
 * Build a clean, truthful meta description for the current context.
 *
 * @return string
 */
function novira_meta_description() {
	$default = __( 'نوفيرا أكاديمي — مؤسسة تعليمية في بني مزار، المنيا، معتمدة دولياً من Cognia. الدبلومة الأمريكية (EST، SAT، ACT، AP)، الترجمة المعتمدة، وبرامج اللغات والمهارات.', 'novira-academy' );

	// Exam spokes (EST / Digital SAT / ACT / future AP): the page copy lives in
	// the template, so the excerpt/content path below would fall back to the
	// shared default. Reuse the authoritative per-exam definition instead so
	// every spoke has a unique, truthful snippet.
	if ( function_exists( 'novira_is_diploma_exam' ) && novira_is_diploma_exam()
		&& function_exists( 'novira_current_exam_meta' ) ) {
		$exam_meta = novira_current_exam_meta();
		$exam_desc = '';
		if ( ! empty( $exam_meta['definition'] ) ) {
			$exam_desc = $exam_meta['definition'];
		} elseif ( ! empty( $exam_meta['hero_desc'] ) ) {
			$exam_desc = $exam_meta['hero_desc'];
		}
		if ( '' !== $exam_desc ) {
			$desc = wp_strip_all_tags( $exam_desc );
			if ( function_exists( 'mb_strlen' ) && mb_strlen( $desc ) > 160 ) {
				$desc = rtrim( mb_substr( $desc, 0, 157 ) ) . '…';
			}
			return $desc;
		}
	}

	// Force-routed standalone landings render all copy in the template (their
	// backing WP pages are empty), so map each slug to a unique description
	// rather than emitting the shared tagline on every one of them.
	$landing_desc = array(
		'american-diploma' => __( 'الدبلومة الأمريكية في نوفيرا أكاديمي — إعداد متكامل لاختبارات EST وDigital SAT وACT ضمن رحلة تعليمية معتمدة دولياً من Cognia في بني مزار، المنيا.', 'novira-academy' ),
		'translation'      => __( 'الترجمة المعتمدة في نوفيرا أكاديمي — ترجمة دقيقة وموثوقة للمستندات الرسمية والأكاديمية والقانونية بمعايير احترافية معتمدة.', 'novira-academy' ),
		'education'        => __( 'التعليم وتنمية المهارات في نوفيرا أكاديمي — كورسات عملية في اللغات والبرمجة والمهارات الرقمية للصغار والكبار بإشراف مدربين متخصصين.', 'novira-academy' ),
		'courses'          => __( 'كورسات نوفيرا أكاديمي — اللغات والاختبارات الدولية والبرمجة ومهارات الحاسب وبرامج الأطفال، بنظام مستويات متدرّج: شهر لكل مستوى و8 حصص شهرياً.', 'novira-academy' ),
		'about'            => __( 'تعرّف على نوفيرا أكاديمي — مؤسسة تعليمية في بني مزار، المنيا، معتمدة دولياً من Cognia، متخصصة في الدبلومة الأمريكية والترجمة وتنمية المهارات.', 'novira-academy' ),
		'contact'          => __( 'تواصل مع نوفيرا أكاديمي في بني مزار، المنيا — احجز تقييماً أو استشارة مجانية عبر الهاتف أو واتساب، ونرد عليك خلال ساعات العمل.', 'novira-academy' ),
		'exams'            => __( 'اختبارات تحديد المستوى في نوفيرا أكاديمي — قيّم مستوى طالبك بدقة قبل اختيار البرنامج التعليمي أو مسار الدبلومة الأمريكية المناسب.', 'novira-academy' ),
		'services'         => __( 'خدمات نوفيرا أكاديمي — الدبلومة الأمريكية، الترجمة المعتمدة، وبرامج التعليم وتنمية المهارات، بمعايير معتمدة دولياً من Cognia.', 'novira-academy' ),
	);
	foreach ( $landing_desc as $landing_slug => $landing_text ) {
		if ( is_page( $landing_slug ) ) {
			$desc = wp_strip_all_tags( $landing_text );
			if ( function_exists( 'mb_strlen' ) && mb_strlen( $desc ) > 160 ) {
				$desc = rtrim( mb_substr( $desc, 0, 157 ) ) . '…';
			}
			return $desc;
		}
	}

	if ( is_front_page() ) {
		$desc = $default;
	} elseif ( is_singular() ) {
		$post = get_queried_object();
		if ( $post instanceof WP_Post && has_excerpt( $post ) ) {
			$desc = get_the_excerpt( $post );
		} elseif ( $post instanceof WP_Post && ! empty( $post->post_content ) ) {
			$desc = wp_trim_words( wp_strip_all_tags( strip_shortcodes( $post->post_content ) ), 35, '…' );
		} else {
			$desc = get_bloginfo( 'description' );
		}
	} elseif ( is_category() || is_tag() || is_tax() ) {
		$desc = term_description();
		$desc = $desc ? wp_strip_all_tags( $desc ) : single_term_title( '', false );
	} elseif ( is_post_type_archive() ) {
		$desc = post_type_archive_title( '', false );
	} else {
		$desc = get_bloginfo( 'description' );
	}

	$desc = trim( wp_strip_all_tags( (string) $desc ) );
	if ( '' === $desc ) {
		$desc = $default;
	}

	// Keep within a sensible SERP length (~160 chars), Unicode-safe.
	if ( function_exists( 'mb_strlen' ) && mb_strlen( $desc ) > 160 ) {
		$desc = rtrim( mb_substr( $desc, 0, 157 ) ) . '…';
	}

	return $desc;
}

/**
 * Two-letter content-language code for the active locale.
 *
 * Single source of truth for every `inLanguage` / lang-sensitive SEO surface.
 * Derives from the theme's locale registry (inc/locale.php) — the active locale
 * decides, not get_locale() — so SEO metadata always agrees with <html lang>.
 * The filter remains as a final override for bridge code.
 *
 * @return string e.g. 'ar', 'en'.
 */
function novira_content_language() {
	$config = novira_locale_config();
	$lang   = ! empty( $config['lang'] ) ? $config['lang'] : 'ar';

	/**
	 * Filter the two-letter content-language code used in SEO surfaces.
	 *
	 * @param string $lang   Two-letter language code.
	 * @param string $locale Full active locale.
	 */
	return apply_filters( 'novira_content_language', $lang, $config['locale'] );
}

/**
 * Open Graph locale (lang_TERRITORY) for the active locale.
 *
 * Reads the registry's og_locale for the active language (inc/locale.php), so
 * today's output stays exactly 'ar_EG' and English yields 'en_US' with no
 * mapping table here. Filter remains as a final override.
 *
 * @return string e.g. 'ar_EG', 'en_US'.
 */
function novira_og_locale() {
	$config = novira_locale_config();
	$og     = ! empty( $config['og_locale'] ) ? $config['og_locale'] : 'ar_EG';

	/**
	 * Filter the Open Graph locale.
	 *
	 * @param string $og     Open Graph locale (lang_TERRITORY).
	 * @param string $locale Full active locale.
	 */
	return apply_filters( 'novira_og_locale', $og, $config['locale'] );
}

/**
 * The document text direction, derived from the active locale.
 *
 * Reads the registry's dir for the active language (inc/locale.php). Any
 * template that hardcodes a directional wrapper (e.g. the premium-exam spokes)
 * MUST read this instead of a literal, so the whole site flips with the locale.
 * Filter remains as a final override.
 *
 * @return string 'rtl' | 'ltr'.
 */
function novira_document_direction() {
	$config = novira_locale_config();
	$dir    = ! empty( $config['dir'] ) ? $config['dir'] : 'rtl';

	/**
	 * Filter the document text direction.
	 *
	 * @param string $dir    'rtl' or 'ltr'.
	 * @param string $locale Full active locale.
	 */
	return apply_filters( 'novira_html_dir', $dir, $config['locale'] );
}

/**
 * The document language code, derived from the active locale.
 *
 * @return string e.g. 'ar', 'en'.
 */
function novira_document_lang() {
	$config = novira_locale_config();
	$lang   = ! empty( $config['lang'] ) ? $config['lang'] : 'ar';

	/**
	 * Filter the document language code.
	 *
	 * @param string $lang   Two-letter language code.
	 * @param string $locale Full active locale.
	 */
	return apply_filters( 'novira_html_lang', $lang, $config['locale'] );
}

/**
 * Root <html> language attributes (i18n foundation).
 *
 * The site is Arabic-only today, so this intentionally emits the exact
 * literal the theme has always shipped ('lang="ar" dir="rtl"') rather than
 * core's language_attributes(), which would silently follow the WP admin
 * locale setting. When a second language launches, a multilingual plugin or
 * bridge code overrides both values via the filters — no template change.
 */
function novira_language_attributes() {
	printf(
		'lang="%s" dir="%s"',
		esc_attr( novira_document_lang() ),
		esc_attr( novira_document_direction() )
	);
}

/**
 * hreflang alternates — FUTURE INSERTION POINT (dormant).
 *
 * Returns [ 'lang-code' => 'absolute-url' ] pairs for the current request.
 * Empty today (single-language site), so nothing is emitted. When a second
 * language launches, a multilingual plugin (Polylang/WPML) or bridge code
 * populates this via the filter and the <link rel="alternate" hreflang> tags
 * (including x-default) start emitting with zero further wiring.
 *
 * @return array<string,string> hreflang => URL map.
 */
function novira_hreflang_alternates() {
	/**
	 * Filter the hreflang alternates for the current request.
	 *
	 * Must include the current page itself (self-referencing hreflang) and
	 * SHOULD include an 'x-default' entry when populated.
	 *
	 * @param array  $alternates hreflang => absolute URL.
	 * @param string $canonical  Canonical URL of the current request.
	 */
	return apply_filters( 'novira_hreflang_alternates', array(), novira_canonical_url() );
}

/**
 * Resolve the canonical URL for the current request.
 *
 * @return string
 */
function novira_canonical_url() {
	if ( is_front_page() ) {
		return home_url( '/' );
	}
	if ( is_singular() ) {
		$permalink = get_permalink( get_queried_object_id() );
		if ( $permalink ) {
			return $permalink;
		}
	}
	if ( is_post_type_archive() ) {
		$link = get_post_type_archive_link( get_query_var( 'post_type' ) );
		if ( $link ) {
			return $link;
		}
	}
	if ( is_category() || is_tag() || is_tax() ) {
		$link = get_term_link( get_queried_object() );
		if ( ! is_wp_error( $link ) ) {
			return $link;
		}
	}

	global $wp;
	return home_url( add_query_arg( array(), $wp->request ) );
}

/**
 * Best-available share image (Open Graph / Twitter).
 *
 * @return string Absolute URL.
 */
function novira_share_image() {
	if ( is_singular() && has_post_thumbnail() ) {
		$img = get_the_post_thumbnail_url( get_queried_object_id(), 'full' );
		if ( $img ) {
			return $img;
		}
	}
	// Stable, real brand asset (PNG/JPG — OG-friendly, unlike AVIF).
	return get_template_directory_uri() . '/assets/images/logo.jpg';
}

/**
 * Output head meta: description, canonical, robots, Open Graph, Twitter.
 *
 * Replaces WordPress core's rel_canonical so exactly one canonical is emitted.
 */
function novira_head_meta() {
	$desc      = novira_meta_description();
	$canonical = novira_canonical_url();
	$image     = novira_share_image();
	$site_name = get_bloginfo( 'name' );

	echo "\n\t<!-- Novira SEO -->\n";
	printf( "\t<meta name=\"description\" content=\"%s\">\n", esc_attr( $desc ) );
	printf( "\t<link rel=\"canonical\" href=\"%s\">\n", esc_url( $canonical ) );

	// hreflang alternates — dormant until a second language populates the
	// filter. A lone self-reference is meaningless, so require 2+ entries.
	$alternates = novira_hreflang_alternates();
	if ( count( $alternates ) >= 2 ) {
		foreach ( $alternates as $hreflang => $url ) {
			printf( "\t<link rel=\"alternate\" hreflang=\"%s\" href=\"%s\">\n", esc_attr( $hreflang ), esc_url( $url ) );
		}
	}

	// Open Graph.
	printf( "\t<meta property=\"og:type\" content=\"%s\">\n", is_singular( array( 'post', 'blog_post' ) ) ? 'article' : 'website' );
	printf( "\t<meta property=\"og:site_name\" content=\"%s\">\n", esc_attr( $site_name ) );
	printf( "\t<meta property=\"og:locale\" content=\"%s\">\n", esc_attr( novira_og_locale() ) );
	printf( "\t<meta property=\"og:title\" content=\"%s\">\n", esc_attr( wp_get_document_title() ) );
	printf( "\t<meta property=\"og:description\" content=\"%s\">\n", esc_attr( $desc ) );
	printf( "\t<meta property=\"og:url\" content=\"%s\">\n", esc_url( $canonical ) );
	printf( "\t<meta property=\"og:image\" content=\"%s\">\n", esc_url( $image ) );

	// Twitter.
	printf( "\t<meta name=\"twitter:card\" content=\"%s\">\n", 'summary_large_image' );
	printf( "\t<meta name=\"twitter:title\" content=\"%s\">\n", esc_attr( wp_get_document_title() ) );
	printf( "\t<meta name=\"twitter:description\" content=\"%s\">\n", esc_attr( $desc ) );
	printf( "\t<meta name=\"twitter:image\" content=\"%s\">\n", esc_url( $image ) );
}
remove_action( 'wp_head', 'rel_canonical' );
add_action( 'wp_head', 'novira_head_meta', 1 );

/**
 * Improve <title> structure without changing brand tone.
 *
 * @param array $parts Document title parts.
 * @return array
 */
function novira_document_title_parts( $parts ) {
	if ( is_front_page() ) {
		$parts['title']   = __( 'نوفيرا أكاديمي', 'novira-academy' );
		$parts['tagline'] = __( 'تعليم أمريكي معتمد وترجمة معتمدة في بني مزار، المنيا', 'novira-academy' );
	}
	return $parts;
}
add_filter( 'document_title_parts', 'novira_document_title_parts' );

/**
 * FAQ items — single source of truth shared by the visible FAQ section
 * (template-parts/sections/faq.php) and the FAQPage JSON-LD.
 *
 * All answers are truthful and verifiable on-site. Items needing exact
 * internal policy carry 'confirm' => true and use a safe "contact us" answer.
 *
 * @return array
 */
function novira_faq_items() {
	return array(
		array(
			'q' => __( 'كيف أبدأ التسجيل؟', 'novira-academy' ),
			'a' => __( 'تواصل معنا عبر واتساب أو الهاتف أو بزيارة المقر، وسنوجّهك إلى خطوات التسجيل المناسبة لبرنامجك.', 'novira-academy' ),
		),
		array(
			'q' => __( 'ما البرامج المتاحة؟', 'novira-academy' ),
			'a' => __( 'الدبلومة الأمريكية (EST وSAT وACT)، والترجمة المعتمدة، وبرامج اللغات والمهارات (إنجليزي، ألماني، فرنسي، برمجة، ذكاء اصطناعي وغيرها).', 'novira-academy' ),
		),
		array(
			'q' => __( 'كيف يمكنني التواصل مع الأكاديمية؟', 'novira-academy' ),
			'a' => __( 'واتساب 01090600927 (الأسرع للرد)، أو البريد noviraacademy@gmail.com، أو صفحة فيسبوك Novira Academy، أو بزيارة المقر: المنيا – بني مزار – طريق الإبراهيمية – آخر شارع مستشفى أبو عوف.', 'novira-academy' ),
		),
		array(
			'q' => __( 'ما مواعيد العمل؟', 'novira-academy' ),
			'a' => __( 'من السبت إلى الخميس: 10 صباحًا – 10 مساءً، والجمعة: 1 ظهرًا – 10 مساءً. وتُحدَّد مواعيد المجموعات الدراسية حسب البرنامج.', 'novira-academy' ),
		),
		array(
			'q' => __( 'كم يستغرق الرد على استفساري؟', 'novira-academy' ),
			'a' => __( 'عادةً خلال دقائق على واتساب أثناء مواعيد العمل.', 'novira-academy' ),
		),
		array(
			'q' => __( 'هل الدبلومة الأمريكية معتمدة؟', 'novira-academy' ),
			'a' => __( 'نعم، برنامج الدبلومة الأمريكية معتمد من Cognia ويشمل اختبارات EST وSAT وACT. وننصح دائمًا بالتأكد من متطلبات الجامعة المستهدفة.', 'novira-academy' ),
		),
		array(
			'q'       => __( 'هل تختلف الرسوم حسب البرنامج؟', 'novira-academy' ),
			'a'       => __( 'نعم، تختلف الرسوم حسب البرنامج ومدته. للحصول على تفاصيل الرسوم الحالية تواصل معنا عبر واتساب.', 'novira-academy' ),
			'confirm' => true,
		),
		array(
			'q'       => __( 'ما المستندات المطلوبة للتسجيل؟', 'novira-academy' ),
			'a'       => __( 'تختلف المستندات حسب البرنامج. تواصل معنا لمعرفة المستندات المطلوبة لبرنامجك.', 'novira-academy' ),
			'confirm' => true,
		),
		array(
			'q'       => __( 'هل توجد مقابلة لتحديد المستوى؟', 'novira-academy' ),
			'a'       => __( 'نساعد في تحديد المستوى المناسب قبل البدء في البرامج اللغوية. تواصل معنا لمعرفة التفاصيل الخاصة ببرنامجك.', 'novira-academy' ),
			'confirm' => true,
		),
		array(
			'q'       => __( 'هل المجموعات محدودة العدد؟', 'novira-academy' ),
			'a'       => __( 'نحرص على متابعة مستمرة لكل طالب. لمعرفة عدد الطلاب في مجموعة برنامج معيّن تواصل معنا.', 'novira-academy' ),
			'confirm' => true,
		),
		array(
			'q'       => __( 'كيف يتم التواصل مع أولياء الأمور؟', 'novira-academy' ),
			'a'       => __( 'نوفّر متابعة أكاديمية مستمرة للطلاب. لمعرفة طريقة وتكرار التواصل مع أولياء الأمور تواصل معنا.', 'novira-academy' ),
			'confirm' => true,
		),
		array(
			'q'       => __( 'ماذا لو رغبت في الانسحاب من البرنامج؟', 'novira-academy' ),
			'a'       => __( 'تختلف سياسة الانسحاب حسب البرنامج. تواصل معنا لمعرفة التفاصيل قبل التسجيل.', 'novira-academy' ),
			'confirm' => true,
		),
	);
}

/**
 * The Organization node (EducationalOrganization + LocalBusiness).
 *
 * @return array
 */
function novira_org_node() {
	$nap     = novira_nap();
	$org_id  = home_url( '/#organization' );

	$node = array(
		'@type'       => array( 'EducationalOrganization', 'LocalBusiness' ),
		'@id'         => $org_id,
		'name'        => $nap['name_ar'],
		'alternateName' => $nap['name_en'],
		'url'         => home_url( '/' ),
		'email'       => $nap['email'],
		'telephone'   => $nap['phone_e164'],
		'image'       => get_template_directory_uri() . '/assets/images/logo.jpg',
		'logo'        => array(
			'@type' => 'ImageObject',
			'url'   => get_template_directory_uri() . '/assets/images/logo.jpg',
		),
		'description' => __( 'مؤسسة تعليمية في بني مزار، المنيا، معتمدة دولياً من Cognia. تقدّم الدبلومة الأمريكية (EST، SAT، ACT، AP)، والترجمة المعتمدة، وبرامج اللغات والمهارات.', 'novira-academy' ),
		'address'     => array(
			'@type'           => 'PostalAddress',
			'streetAddress'   => $nap['street'],
			'addressLocality' => $nap['locality'],
			'addressRegion'   => $nap['region'],
			'addressCountry'  => $nap['country'],
		),
		'geo'         => array(
			'@type'     => 'GeoCoordinates',
			'latitude'  => $nap['lat'],
			'longitude' => $nap['lng'],
		),
		'hasMap'             => $nap['maps_url'],
		'openingHoursSpecification' => novira_opening_hours(),
		'areaServed'         => array(
			array( '@type' => 'AdministrativeArea', 'name' => __( 'المنيا', 'novira-academy' ) ),
			array( '@type' => 'City', 'name' => __( 'بني مزار', 'novira-academy' ) ),
		),
		'knowsLanguage'      => array( 'ar', 'en', 'de', 'fr' ),
		// Verifiable, named accreditation — a real external entity.
		'hasCredential'      => array(
			'@type'           => 'EducationalOccupationalCredential',
			'credentialCategory' => 'Accreditation',
			'recognizedBy'    => array(
				'@type' => 'Organization',
				'name'  => 'Cognia',
				'url'   => 'https://www.cognia.org/',
			),
		),
	);

	// Optional E.164 second contact point (complaints line) if it differs.
	$node['contactPoint'] = array(
		array(
			'@type'             => 'ContactPoint',
			'telephone'         => $nap['phone_e164'],
			'contactType'       => 'customer service',
			'availableLanguage' => array( 'Arabic', 'English' ),
		),
	);

	$sameas = novira_social_profiles();
	if ( $sameas ) {
		$node['sameAs'] = $sameas;
	}

	// AggregateRating — ONLY if real Google Business values are configured.
	// No rating, count, or stars are ever invented.
	$rating = trim( (string) get_theme_mod( 'novira_google_rating', '' ) );
	$count  = preg_replace( '/\D+/', '', (string) get_theme_mod( 'novira_google_reviews_count', '' ) );
	if ( '' !== $rating && '' !== $count && (float) $rating > 0 && (int) $count > 0 ) {
		$node['aggregateRating'] = array(
			'@type'       => 'AggregateRating',
			'ratingValue' => $rating,
			'reviewCount' => (int) $count,
			'bestRating'  => '5',
			'worstRating' => '1',
		);
	}

	return $node;
}

/**
 * Build the breadcrumb trail for the current request (single source of truth).
 *
 * Returns an ordered list of crumbs, top → down, e.g.:
 *   [ ['name' => 'الرئيسية', 'url' => 'https://…/'],
 *     ['name' => 'البرنامج الأمريكي', 'url' => 'https://…/american-diploma/'],
 *     ['name' => 'EST', 'url' => 'https://…/american-diploma/est/'] ]
 *
 * Hierarchy is derived automatically from get_post_ancestors(), so future
 * child pages (/american-diploma/est, /digital-sat, /act) produce the correct
 * chain with no hardcoding. Both the visible component and the JSON-LD node
 * consume this — they can never drift apart.
 *
 * @return array[] List of [ 'name' => string, 'url' => string ] crumbs.
 */
function novira_breadcrumb_trail() {
	$home = array(
		'name' => __( 'الرئيسية', 'novira-academy' ),
		'url'  => home_url( '/' ),
	);

	// Front page: nothing beyond home.
	if ( is_front_page() ) {
		return array( $home );
	}

	$trail = array( $home );

	if ( is_singular() ) {
		$id = get_queried_object_id();

		// Hierarchical ancestors come parent-first; reverse to render top → down.
		$ancestors = array_reverse( get_post_ancestors( $id ) );
		foreach ( $ancestors as $ancestor_id ) {
			$trail[] = array(
				'name' => get_the_title( $ancestor_id ),
				'url'  => get_permalink( $ancestor_id ),
			);
		}

		// Current page (last crumb).
		$title   = get_the_title( $id );
		$trail[] = array(
			'name' => $title ? $title : wp_get_document_title(),
			'url'  => get_permalink( $id ),
		);

		/**
		 * Filter the breadcrumb trail (single source shared by the visible crumb
		 * and the BreadcrumbList JSON-LD). Feature layers may insert intermediate
		 * crumbs — e.g. the blog layer expands a post to Home › Blog › Category ›
		 * Article — so both surfaces can never drift.
		 *
		 * @param array[] $trail List of [ 'name', 'url' ] crumbs, top → down.
		 */
		return apply_filters( 'novira_breadcrumb_trail', $trail );
	}

	// Non-singular (archives, taxonomies, search, 404…): home + current context.
	$trail[] = array(
		'name' => wp_get_document_title(),
		'url'  => novira_canonical_url(),
	);

	/** This filter is documented above. */
	return apply_filters( 'novira_breadcrumb_trail', $trail );
}

/**
 * Build the BreadcrumbList JSON-LD node from the shared trail.
 *
 * Consumes novira_breadcrumb_trail() — no breadcrumb logic is duplicated here.
 * Returns null when the trail has no meaningful depth (e.g. the front page or a
 * top-level context), preserving the previous behavior.
 *
 * @return array|null
 */
function novira_breadcrumb_node() {
	$trail = novira_breadcrumb_trail();

	// Need at least Home + one level to be a meaningful breadcrumb.
	if ( count( $trail ) < 2 ) {
		return null;
	}

	$items    = array();
	$position = 1;
	foreach ( $trail as $crumb ) {
		$items[] = array(
			'@type'    => 'ListItem',
			'position' => $position,
			'name'     => $crumb['name'],
			'item'     => $crumb['url'],
		);
		$position++;
	}

	return array(
		'@type'           => 'BreadcrumbList',
		'@id'             => novira_canonical_url() . '#breadcrumb',
		'itemListElement' => $items,
	);
}

/**
 * Detect the American Diploma hub page (single detector reused by schema).
 *
 * @return bool
 */
function novira_is_diploma_hub() {
	return is_page( 'american-diploma' );
}

/**
 * FAQPage node — built from the SAME provider the visible FAQ uses on the
 * current page, so schema and the on-page partial never duplicate or drift:
 *   - American Diploma hub → novira_diploma_faq_items()
 *   - Contact page         → novira_faq_items()
 *
 * @return array|null
 */
function novira_faqpage_node() {
	$items = null;

	if ( novira_is_diploma_hub() && function_exists( 'novira_diploma_faq_items' ) ) {
		$items = novira_diploma_faq_items();
	} elseif ( is_page_template( 'page-contact.php' ) || is_page( 'contact' ) ) {
		$items = novira_faq_items();
	} elseif ( function_exists( 'novira_is_diploma_exam' ) && novira_is_diploma_exam()
		&& function_exists( 'novira_current_exam_faq' ) ) {
		// Premium exam spokes (EST, Digital SAT, ACT…). EST joined here at the
		// 4.3.1 consolidation. Map the exam FAQ shape to q/a; the SAME provider
		// feeds the on-page FAQ accordion, so schema and page never drift.
		$items = array();
		foreach ( novira_current_exam_faq() as $novira_exam_faq ) {
			if ( ! empty( $novira_exam_faq['question'] ) && ! empty( $novira_exam_faq['answer'] ) ) {
				$items[] = array( 'q' => $novira_exam_faq['question'], 'a' => $novira_exam_faq['answer'] );
			}
		}
	}

	if ( empty( $items ) ) {
		return null;
	}

	$entities = array();
	foreach ( $items as $item ) {
		if ( empty( $item['q'] ) || empty( $item['a'] ) ) {
			continue;
		}
		$entities[] = array(
			'@type'          => 'Question',
			'name'           => $item['q'],
			'acceptedAnswer' => array(
				'@type' => 'Answer',
				'text'  => $item['a'],
			),
		);
	}

	if ( empty( $entities ) ) {
		return null;
	}

	return array(
		'@type'      => 'FAQPage',
		'@id'        => novira_canonical_url() . '#faq',
		'mainEntity' => $entities,
	);
}

/**
 * Course node for a premium exam spoke (EST / Digital SAT / ACT …), built from
 * the current exam meta. Centralized here so page templates stay presentation-
 * only. EST joined here at the 4.3.1 consolidation (it is the reference spoke).
 * Only fields present in meta are emitted — unknown facts are never invented;
 * the description carries the single-source disclaimer.
 *
 * @return array|null
 */
function novira_exam_course_node() {
	if ( ! function_exists( 'novira_is_diploma_exam' ) || ! novira_is_diploma_exam() ) {
		return null;
	}
	$meta = function_exists( 'novira_current_exam_meta' ) ? novira_current_exam_meta() : null;
	if ( ! is_array( $meta ) || empty( $meta['name'] ) || empty( $meta['offered'] ) ) {
		return null;
	}

	$disclaimer  = function_exists( 'novira_admission_disclaimer' ) ? novira_admission_disclaimer() : '';
	$definition  = ! empty( $meta['definition'] ) ? $meta['definition'] : '';
	$description = trim( $definition . ( '' !== $disclaimer ? ' ' . $disclaimer : '' ) );

	$node = array(
		'@type'      => 'Course',
		'@id'        => ! empty( $meta['schema_id'] ) ? $meta['schema_id'] : ( novira_canonical_url() . '#course' ),
		'name'       => $meta['name'],
		'url'        => novira_canonical_url(),
		'inLanguage' => array( 'ar', 'en' ),
		'provider'   => array( '@id' => home_url( '/#organization' ) ),
		'isPartOf'   => array( '@id' => home_url( '/american-diploma/#program' ) ),
	);
	if ( '' !== $description ) {
		$node['description'] = $description;
	}

	/**
	 * Filter the premium exam-spoke Course node (data only).
	 *
	 * @param array $node The Course node.
	 * @param array $meta The current exam meta.
	 */
	return apply_filters( 'novira_exam_course_node', $node, $meta );
}

/**
 * Documented student-case VideoObject — FUTURE INSERTION POINT (dormant).
 *
 * Designed now, intentionally inert. Returns null until the case carries real,
 * verifiable metadata. It reads the SAME source the visible case uses (the
 * 'novira_student_case' filter), so it can never invent or duplicate data. When
 * real metadata is supplied, it begins emitting with zero further wiring.
 *
 * Required real fields (all must be present): video, video_name,
 * video_description, video_upload_date, video_thumbnail.
 *
 * @return array|null
 */
function novira_student_case_video_node() {
	// Same source of truth as template-parts/sections/student-case.php.
	$case = apply_filters( 'novira_student_case', array() );

	$required = array( 'video', 'video_name', 'video_description', 'video_upload_date', 'video_thumbnail' );
	foreach ( $required as $key ) {
		if ( empty( $case[ $key ] ) ) {
			return null; // Placeholder / incomplete → emit nothing.
		}
	}

	return array(
		'@type'        => 'VideoObject',
		'@id'          => novira_canonical_url() . '#student-case-video',
		'name'         => $case['video_name'],
		'description'  => $case['video_description'],
		'thumbnailUrl' => $case['video_thumbnail'],
		'uploadDate'   => $case['video_upload_date'],
		'contentUrl'   => 'https://www.youtube.com/watch?v=' . $case['video'],
		'embedUrl'     => 'https://www.youtube.com/embed/' . $case['video'],
		'publisher'    => array( '@id' => home_url( '/#organization' ) ),
	);
}

/**
 * Emit the consolidated JSON-LD @graph in <head>.
 */
function novira_jsonld() {
	$org_id = home_url( '/#organization' );

	$website = array(
		'@type'           => 'WebSite',
		'@id'             => home_url( '/#website' ),
		'url'             => home_url( '/' ),
		'name'            => get_bloginfo( 'name' ),
		'inLanguage'      => novira_content_language(),
		'publisher'       => array( '@id' => $org_id ),
		'potentialAction' => array(
			'@type'       => 'SearchAction',
			'target'      => array(
				'@type'       => 'EntryPoint',
				'urlTemplate' => home_url( '/?s={search_term_string}' ),
			),
			'query-input' => 'required name=search_term_string',
		),
	);

	$webpage = array(
		'@type'      => 'WebPage',
		'@id'        => novira_canonical_url() . '#webpage',
		'url'        => novira_canonical_url(),
		'name'       => wp_get_document_title(),
		'inLanguage' => novira_content_language(),
		'isPartOf'   => array( '@id' => home_url( '/#website' ) ),
		'about'      => array( '@id' => $org_id ),
		'description'=> novira_meta_description(),
	);

	$graph = array(
		novira_org_node(),
		$website,
		$webpage,
	);

	$breadcrumb = novira_breadcrumb_node();
	if ( $breadcrumb ) {
		$webpage['breadcrumb'] = array( '@id' => $breadcrumb['@id'] );
		$graph[2]              = $webpage; // keep the reference in sync.
		$graph[]               = $breadcrumb;
	}

	$faq = novira_faqpage_node();
	if ( $faq ) {
		$graph[] = $faq;
	}

	// American Diploma hub: attach the EducationalOccupationalProgram node and
	// mark it as the page's primary entity. The node (and its offered-only
	// hasPart spoke refs — AP excluded) is built in inc/diploma.php. The hub
	// references the spokes by @id; each spoke page OWNS its own Course node.
	if ( novira_is_diploma_hub() && function_exists( 'novira_diploma_program_node' ) ) {
		$program               = novira_diploma_program_node();
		$webpage['mainEntity'] = array( '@id' => $program['@id'] );
		$graph[2]              = $webpage; // keep the webpage reference in sync.
		$graph[]               = $program;
	}

	// Premium exam spoke (Digital SAT / ACT …): attach its Course node and mark
	// it the page's primary entity. Centralized so page templates emit no schema.
	// EST returns null here (locked), so its output is unaffected.
	$exam_course = function_exists( 'novira_exam_course_node' ) ? novira_exam_course_node() : null;
	if ( $exam_course ) {
		$webpage['mainEntity'] = array( '@id' => $exam_course['@id'] );
		$graph[2]              = $webpage; // keep the webpage reference in sync.
		$graph[]               = $exam_course;
	}

	// FUTURE: documented student-case VideoObject. Dormant until real metadata
	// exists (returns null today → nothing emitted).
	$video = novira_student_case_video_node();
	if ( $video ) {
		$graph[] = $video;
	}

	/**
	 * Filter the consolidated JSON-LD @graph before output. Feature layers attach
	 * context-specific nodes (e.g. the blog article's BlogPosting / Person /
	 * ImageObject) that REFERENCE the shared @ids — passed here — instead of
	 * redefining the Organization, WebSite, WebPage, or BreadcrumbList entities.
	 *
	 * @param array  $graph      The @graph node list.
	 * @param string $webpage_id The current WebPage @id (attach mainEntity to it).
	 * @param string $org_id     The Organization @id (use as publisher / worksFor).
	 */
	$graph = apply_filters( 'novira_jsonld_graph', $graph, $webpage['@id'], $org_id );

	$payload = array(
		'@context' => 'https://schema.org',
		'@graph'   => $graph,
	);

	echo "\n<script type=\"application/ld+json\">\n";
	echo wp_json_encode( $payload, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT );
	echo "\n</script>\n";
}
add_action( 'wp_head', 'novira_jsonld', 20 );
