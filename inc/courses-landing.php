<?php
/**
 * Courses Catalog Landing — helpers, data, routing, schema and assets.
 *
 * Self-contained support for page-courses.php: the academy's course register,
 * organised as five fields of study. Mirrors the exams / education landing
 * pattern:
 *  - novira_crs_icon()       inline stroke-icon set (Lucide-style)
 *  - novira_crs_spec()       the shared study system, defined ONCE
 *  - novira_crs_catalog()    the register: fields -> courses (data only)
 *  - novira_crs_enrollment() the three real enrolment steps
 *  - novira_crs_course_schema() Course / ItemList JSON-LD for the register
 *  - novira_crs_ensure_page() creates the `courses` Page once
 *  - template_include route so the `courses` page uses page-courses.php
 *  - conditional CSS/JS enqueue for the landing only
 *
 * Every course follows the same study system, so that system is stated once
 * (novira_crs_spec) instead of being repeated per course. A field's specimen
 * plate is a WebP figure built from that field's own material — see
 * assets/images/courses/plate-*.webp.
 *
 * Additive only. Adding a future course is a one-line edit to
 * novira_crs_catalog(); the register, index and counts all follow.
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
function novira_crs_icon( $name, $size = 24 ) {
	$paths = array(
		// Study-system icons (the four facts in novira_crs_spec()).
		'calendar' => '<rect x="3.5" y="5" width="17" height="16" rx="2.5"/><path d="M3.5 10h17M8 3v4M16 3v4"/>',
		'stack'    => '<path d="M12 3 3 8l9 5 9-5-9-5z"/><path d="M3 13l9 5 9-5"/>',
		'repeat'   => '<path d="M17 2l4 4-4 4"/><path d="M3 11V9a4 4 0 0 1 4-4h14"/><path d="M7 22l-4-4 4-4"/><path d="M21 13v2a4 4 0 0 1-4 4H3"/>',
		'clock'    => '<circle cx="12" cy="12" r="9"/><path d="M12 7.5V12l3 2"/>',
		// UI.
		'list'     => '<path d="M8 6h13M8 12h13M8 18h13"/><path d="M3.5 6h.01M3.5 12h.01M3.5 18h.01"/>',
		'whatsapp' => '<path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"/>',
		'phone'    => '<path d="M22 16.9v3a2 2 0 0 1-2.2 2 19.8 19.8 0 0 1-8.6-3.1 19.5 19.5 0 0 1-6-6A19.8 19.8 0 0 1 2 4.2 2 2 0 0 1 4 2h3a2 2 0 0 1 2 1.7c.1 1 .4 1.9.7 2.8a2 2 0 0 1-.5 2.1L8 9.9a16 16 0 0 0 6 6l1.3-1.3a2 2 0 0 1 2.1-.4c.9.3 1.8.6 2.8.7A2 2 0 0 1 22 16.9z"/>',
		'arrow'    => '<path d="M11 6l-6 6 6 6"/><path d="M18 12H5"/>',
	);

	$solid  = array( 'whatsapp' );
	$fill   = in_array( $name, $solid, true ) ? 'currentColor' : 'none';
	$stroke = in_array( $name, $solid, true ) ? 'none' : 'currentColor';
	$body   = isset( $paths[ $name ] ) ? $paths[ $name ] : '';

	return sprintf(
		'<svg width="%1$d" height="%1$d" viewBox="0 0 24 24" fill="%2$s" stroke="%3$s" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">%4$s</svg>',
		(int) $size,
		esc_attr( $fill ),
		esc_attr( $stroke ),
		$body
	);
}

/**
 * The shared study system, defined ONCE. Every course follows this model, so it
 * is stated a single time on the page instead of being repeated per course.
 *
 * @return array List of [ 'icon', 'label' ] facts.
 */
function novira_crs_spec() {
	return array(
		array( 'icon' => 'calendar', 'label' => __( 'شهر لكل مستوى', 'novira-academy' ) ),
		array( 'icon' => 'stack',    'label' => __( '8 حصص شهرياً', 'novira-academy' ) ),
		array( 'icon' => 'repeat',   'label' => __( 'حصتان أسبوعياً', 'novira-academy' ) ),
		array( 'icon' => 'clock',    'label' => __( 'ساعة لكل حصة', 'novira-academy' ) ),
	);
}

/**
 * The course register — the single source of truth for /courses.
 *
 * Grouped into fields of study. To add a future course, append one entry to a
 * field's `courses` array (the register, index and counts all update).
 *
 * Each field carries a `plate`: a WebP specimen figure built from that field's
 * own material (greetings, an answer sheet, source code, a worksheet, an
 * abacus). `plate_alt` describes it for assistive tech and image search.
 *
 * @return array Ordered fields, each: key, label, note, plate, plate_alt, courses[] (name, desc).
 */
function novira_crs_catalog() {
	return array(
		array(
			'key'       => 'languages',
			'label'     => __( 'اللغات', 'novira-academy' ),
			'note'      => __( 'سبع لغات ومسارات، من الأساسيات إلى المحادثة وبيئة العمل.', 'novira-academy' ),
			'plate'     => 'plate-languages.webp',
			'plate_alt' => __( 'لوح لغوي: كلمات ترحيب بالإنجليزية والفرنسية والألمانية والإيطالية.', 'novira-academy' ),
			'courses'   => array(
				array( 'name' => 'English',                       'desc' => __( 'إنجليزية شاملة تبني القراءة والكتابة والمحادثة خطوة بخطوة.', 'novira-academy' ) ),
				array( 'name' => 'English Conversation',          'desc' => __( 'تدرّب على المحادثة اليومية حتى تتكلّم بطلاقة وثقة.', 'novira-academy' ) ),
				array( 'name' => 'Business English',              'desc' => __( 'إنجليزية احترافية للاجتماعات والمراسلات وبيئة العمل.', 'novira-academy' ) ),
				array( 'name' => 'English Interview Preparation', 'desc' => __( 'استعد لمقابلات العمل بالإنجليزية بأسئلة وإجابات واقعية.', 'novira-academy' ) ),
				array( 'name' => 'German',                        'desc' => __( 'الألمانية من المستوى الأول بنُطق سليم وقواعد مبسّطة.', 'novira-academy' ) ),
				array( 'name' => 'French',                        'desc' => __( 'الفرنسية خطوة بخطوة مع تركيز على النطق والمحادثة.', 'novira-academy' ) ),
				array( 'name' => 'Italian',                       'desc' => __( 'الإيطالية للمبتدئين بأسلوب عملي وممتع.', 'novira-academy' ) ),
			),
		),
		array(
			'key'       => 'exams',
			'label'     => __( 'الاختبارات الدولية', 'novira-academy' ),
			'note'      => __( 'تحضير مبني على أقسام الاختبار الفعلية، مع اختبارات محاكية.', 'novira-academy' ),
			'plate'     => 'plate-exams.webp',
			'plate_alt' => __( 'ورقة إجابات نموذجية وأقسام الاختبار الأربعة: الاستماع والقراءة والكتابة والمحادثة.', 'novira-academy' ),
			'courses'   => array(
				array( 'name' => 'IELTS', 'desc' => __( 'تحضير مكثّف لأقسام الاختبار الأربعة مع اختبارات محاكية.', 'novira-academy' ) ),
				array( 'name' => 'TOEFL', 'desc' => __( 'استراتيجيات وتمارين لرفع درجتك في TOEFL بثقة.', 'novira-academy' ) ),
			),
		),
		array(
			'key'       => 'programming',
			'label'     => __( 'البرمجة', 'novira-academy' ),
			'note'      => __( 'ثلاثة مسارات: بايثون، وصفحات الويب، والبرمجة المرئية للأطفال.', 'novira-academy' ),
			'plate'     => 'plate-programming.webp',
			'plate_alt' => __( 'نموذج شيفرة بايثون، ووسم HTML، وبلوك برمجة مرئية.', 'novira-academy' ),
			'courses'   => array(
				array( 'name' => 'Python Programming',  'desc' => __( 'من أساسيات البرمجة حتى بناء مشاريع حقيقية بلغة بايثون.', 'novira-academy' ) ),
				array( 'name' => 'HTML & CSS',          'desc' => __( 'صمّم وابنِ صفحات ويب حقيقية من الصفر.', 'novira-academy' ) ),
				array( 'name' => 'Scratch Programming', 'desc' => __( 'برمجة مرئية ممتعة تُنمّي تفكير الأطفال المنطقي.', 'novira-academy' ) ),
			),
		),
		array(
			'key'       => 'computer',
			'label'     => __( 'مهارات الحاسب', 'novira-academy' ),
			'note'      => __( 'مهارات مكتبية وتقنية معتمدة، للدراسة وسوق العمل.', 'novira-academy' ),
			'plate'     => 'plate-computer.webp',
			'plate_alt' => __( 'ورقة عمل جدول بيانات فيها شريط معادلة ودالة جمع.', 'novira-academy' ),
			'courses'   => array(
				array( 'name' => 'ICDL', 'desc' => __( 'الرخصة الدولية لقيادة الحاسب: مهارات مكتبية معتمدة.', 'novira-academy' ) ),
				array( 'name' => 'ICT',  'desc' => __( 'أساسيات تقنية المعلومات للدراسة وسوق العمل.', 'novira-academy' ) ),
			),
		),
		array(
			'key'       => 'kids',
			'label'     => __( 'برامج الأطفال', 'novira-academy' ),
			'note'      => __( 'الحساب الذهني بالعدّاد لتنمية التركيز وسرعة البديهة.', 'novira-academy' ),
			'plate'     => 'plate-kids.webp',
			'plate_alt' => __( 'عدّاد حساب ذهني بخمسة قضبان تُمثّل رقماً.', 'novira-academy' ),
			'courses'   => array(
				array( 'name' => 'UCMAS', 'desc' => __( 'الحساب الذهني بالعدّاد لتنمية التركيز وسرعة البديهة.', 'novira-academy' ) ),
			),
		),
	);
}

/**
 * How enrolment actually works — three real steps, in order. Step one links to
 * the academy's existing placement tests (/exams), which is where a level is
 * decided; nothing here is aspirational.
 *
 * @return array List of [ 'title', 'body', 'link', 'link_label' ] steps.
 */
function novira_crs_enrollment() {
	return array(
		array(
			'title'      => __( 'حدّد مستواك', 'novira-academy' ),
			'body'       => __( 'اختبار تحديد المستوى يوضّح من أين تبدأ، فلا تعيد ما تعرفه ولا تقفز فوق ما تحتاجه.', 'novira-academy' ),
			'link'       => home_url( '/exams' ),
			'link_label' => __( 'اختبارات تحديد المستوى', 'novira-academy' ),
		),
		array(
			'title'      => __( 'اختر موعدك', 'novira-academy' ),
			'body'       => __( 'حصتان أسبوعياً وساعة لكل حصة — نرتّب المواعيد معك قبل بداية المستوى.', 'novira-academy' ),
			'link'       => '',
			'link_label' => '',
		),
		array(
			'title'      => __( 'ابدأ المستوى الأول', 'novira-academy' ),
			'body'       => __( 'شهر واحد وثماني حصص، ثم تقييم يحدّد جاهزيتك للانتقال إلى المستوى التالي.', 'novira-academy' ),
			'link'       => '',
			'link_label' => '',
		),
	);
}

/**
 * Build a WhatsApp deep link pre-filled with the course name (conversion aid).
 *
 * @param string $whatsapp Digits-only WhatsApp number.
 * @param string $course   Course name to reference in the message.
 * @return string
 */
function novira_crs_wa_url( $whatsapp, $course ) {
	$text = sprintf(
		/* translators: %s: course name. */
		__( 'أرغب في التسجيل بكورس %s في نوفيرا أكاديمي.', 'novira-academy' ),
		$course
	);
	return 'https://wa.me/' . rawurlencode( $whatsapp ) . '?text=' . rawurlencode( $text );
}

/**
 * Render the "level rail" — the progression indicator that visualises the
 * academy's level-based pedagogy (start at Level 1, climb one month at a time).
 *
 * Shared component: the education landing's Courses section renders it with the
 * `edu-rail` base. Decorative — an adjacent text label carries the meaning for
 * assistive tech. Five nodes; the first is the start. The class base is passed
 * in so each scoped stylesheet styles it locally.
 *
 * @param string $base BEM block, e.g. 'edu-rail'.
 * @return string SVG-free HTML markup.
 */
function novira_level_rail( $base = 'edu-rail' ) {
	$base = sanitize_html_class( $base );
	$out  = '<div class="' . $base . '" aria-hidden="true">';
	for ( $i = 0; $i < 5; $i++ ) {
		$cls  = $base . '__dot' . ( 0 === $i ? ' ' . $base . '__dot--start' : '' );
		$out .= '<span class="' . $cls . '" style="--n:' . $i . '"></span>';
		if ( $i < 4 ) {
			$out .= '<span class="' . $base . '__seg" style="--n:' . $i . '"></span>';
		}
	}
	$out .= '<span class="' . $base . '__more">›</span></div>';
	return $out;
}

/**
 * Attach the register to the page's JSON-LD @graph: one Course node per course,
 * collected in an ItemList that becomes the WebPage's mainEntity.
 *
 * Only facts the academy actually publishes are emitted. There is no price on
 * the site, so no `offers` node is invented; workload is the real one (eight
 * one-hour sessions per level) expressed as an ISO-8601 duration.
 *
 * @param array  $graph      The @graph node list.
 * @param string $webpage_id The current WebPage @id.
 * @param string $org_id     The Organization @id (the provider).
 * @return array
 */
function novira_crs_course_schema( $graph, $webpage_id, $org_id ) {
	if ( ! is_page( 'courses' ) ) {
		return $graph;
	}

	$base  = trailingslashit( home_url( '/courses' ) );
	$items = array();
	$nodes = array();

	foreach ( novira_crs_catalog() as $field ) {
		foreach ( $field['courses'] as $course ) {
			$course_id = $base . '#course-' . sanitize_title( $course['name'] );

			$nodes[] = array(
				'@type'             => 'Course',
				'@id'               => $course_id,
				'name'              => $course['name'],
				'description'       => $course['desc'],
				'inLanguage'        => 'ar',
				'about'             => $field['label'],
				'provider'          => array( '@id' => $org_id ),
				'hasCourseInstance' => array(
					array(
						'@type'          => 'CourseInstance',
						'courseMode'     => 'onsite',
						// One level = one month = 8 sessions x 1 hour.
						'courseWorkload' => 'PT8H',
					),
				),
			);

			$items[] = array(
				'@type'    => 'ListItem',
				'position' => count( $items ) + 1,
				'item'     => array( '@id' => $course_id ),
			);
		}
	}

	if ( ! $items ) {
		return $graph;
	}

	$list_id = $base . '#register';
	$graph[] = array(
		'@type'           => 'ItemList',
		'@id'             => $list_id,
		'name'            => __( 'كورسات نوفيرا أكاديمي', 'novira-academy' ),
		'numberOfItems'   => count( $items ),
		'itemListOrder'   => 'https://schema.org/ItemListOrderAscending',
		'itemListElement' => $items,
	);
	$graph = array_merge( $graph, $nodes );

	foreach ( $graph as $i => $node ) {
		if ( isset( $node['@id'] ) && $node['@id'] === $webpage_id ) {
			$graph[ $i ]['mainEntity'] = array( '@id' => $list_id );
			break;
		}
	}

	return $graph;
}
add_filter( 'novira_jsonld_graph', 'novira_crs_course_schema', 10, 3 );

/**
 * Ensure the `courses` Page exists (this is a brand-new route). Runs once — the
 * result is cached in an option so it is effectively free on later requests.
 */
function novira_crs_ensure_page() {
	if ( get_option( 'novira_courses_page_ready' ) ) {
		return;
	}
	$existing = get_page_by_path( 'courses' );
	if ( ! $existing ) {
		wp_insert_post( array(
			'post_title'     => __( 'الكورسات', 'novira-academy' ),
			'post_name'      => 'courses',
			'post_status'    => 'publish',
			'post_type'      => 'page',
			'post_content'   => '',
			'comment_status' => 'closed',
		) );
	}
	update_option( 'novira_courses_page_ready', 1 );
}
add_action( 'init', 'novira_crs_ensure_page' );

/**
 * Route the Courses page to its dedicated landing template.
 *
 * @param string $template Path WordPress resolved for the request.
 * @return string
 */
function novira_force_courses_template( $template ) {
	if ( is_page( 'courses' ) ) {
		$landing = locate_template( 'page-courses.php' );
		if ( $landing ) {
			return $landing;
		}
	}
	return $template;
}
add_filter( 'template_include', 'novira_force_courses_template', 99 );

/**
 * Enqueue the landing's stylesheet + behaviour, scoped to the Courses page.
 */
function novira_courses_landing_assets() {
	if ( ! is_page( 'courses' ) ) {
		return;
	}

	wp_enqueue_style(
		'novira-courses-landing',
		NOVIRA_URI . '/assets/css/courses-landing.css',
		array( 'novira-main' ),
		file_exists( NOVIRA_DIR . '/assets/css/courses-landing.css' ) ? filemtime( NOVIRA_DIR . '/assets/css/courses-landing.css' ) : NOVIRA_VERSION
	);

	wp_enqueue_script(
		'novira-courses-landing',
		NOVIRA_URI . '/assets/js/courses-landing.js',
		array(),
		file_exists( NOVIRA_DIR . '/assets/js/courses-landing.js' ) ? filemtime( NOVIRA_DIR . '/assets/js/courses-landing.js' ) : NOVIRA_VERSION,
		true
	);
}
add_action( 'wp_enqueue_scripts', 'novira_courses_landing_assets', 20 );
