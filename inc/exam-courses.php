<?php
/**
 * Novira Academy — Exam Course Catalog (Sprint 4.3.6)
 *
 * The single, reusable, slug-driven catalog of academic preparation courses that
 * powers the "Courses" section on every American-Diploma exam spoke: EST, Digital
 * SAT, ACT, and future AP. ONE dataset, many exams — a course declares which
 * exams it supports and novira_exam_courses($slug) filters automatically. No
 * per-exam duplication, no page-specific arrays, no EST-only cards.
 *
 * FUTURE AP: append 'ap' to a course's 'exams' (and it becomes available on the
 * AP spoke). No template changes, no new PHP sections, no duplicated code.
 *
 * TRUTH RULES: descriptions describe the real preparation courses in the approved
 * UX-writing voice — no invented scores, fees, dates, or guarantees. A course's
 * detail link stays null until a real course page exists; the section then falls
 * back to the exam's consultation link (passed in as `wa_url`).
 *
 * DATA ONLY. No HTML, no echo, no side effects (read-only filters for extension).
 *
 * @package Novira_Academy
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Human display label for an exam slug (used for card chips + contextual titles).
 *
 * @param string $slug Exam slug.
 * @return string
 */
function novira_exam_course_exam_label( $slug ) {
	$labels = array(
		'est'         => 'EST',
		'digital-sat' => 'Digital SAT',
		'act'         => 'ACT',
		'ap'          => 'AP',
	);

	/**
	 * Filter the exam display labels (data only).
	 *
	 * @param array $labels Slug => label.
	 */
	$labels = apply_filters( 'novira_exam_course_labels', $labels );

	return isset( $labels[ $slug ] ) ? $labels[ $slug ] : strtoupper( (string) $slug );
}

/**
 * Master course catalog (single source of truth; data only).
 *
 * Each course lists the exams it supports in `exams`. Shared subjects (English,
 * Biology, National Subjects, and both Math levels) carry every exam they prepare
 * for, so the same course surfaces on each of those exam pages WITHOUT being
 * duplicated in the data. `url` is null until a dedicated course page exists.
 *
 * @return array[] Each course: [ slug, title, name, desc, details, image, exams[], levels{}, url ].
 */
function novira_exam_courses_catalog() {
	$img = get_template_directory_uri() . '/assets/images/courses/';

	// The three currently-offered American-Diploma exams. Add 'ap' here (and to a
	// course below) the day AP launches — nothing else changes.
	$all = array( 'est', 'digital-sat', 'act' );

	// 'desc'    = ONE concise line shown on the card (never overloaded).
	// 'details' = the full educational description shown inside the card's
	//             expandable details view. Same approved documentary voice as the
	//             rest of the site: describes the REAL preparation model (weekly
	//             classes, specialised teachers, cumulative building, mock exams,
	//             follow-up) — no invented scores, fees, dates, or guarantees.
	// 'levels'  = optional per-exam level label (e.g. EST is administered as two
	//             levels). Keyed by exam slug; only shown where applicable, so
	//             exams without a level split (SAT/ACT) simply omit it.
	$catalog = array(
		array(
			'slug'    => 'english',
			'title'   => __( 'كورس الإنجليزية', 'novira-academy' ),
			'name'    => __( 'الإنجليزية', 'novira-academy' ),
			'desc'    => __( 'بناء تراكمي لمهارات القراءة والاستيعاب والقواعد التي يقيسها الاختبار — أسبوعياً مع معلم متخصص، حتى يدخل طالبك قسم الإنجليزية واثقاً.', 'novira-academy' ),
			'details' => __( 'يبني هذا الكورس مهارات الإنجليزية التي يقيسها الاختبار خطوة بخطوة: القراءة والاستيعاب، والقواعد، واستخدام اللغة في سياقها. يدرس طالبك أسبوعياً مع معلم متخصص، فتُبنى المهارة تراكمياً على مدار البرنامج بدل مراجعة سريعة قبل الاختبار. تُتابَع الواجبات بعد كل حصة لتثبيت ما دُرِّس وكشف الثغرات مبكراً، ومع اقتراب الموعد تُضاف اختبارات تجريبية تُحاكي أسلوب الأسئلة وضغط الوقت.', 'novira-academy' ),
			'image'   => $img . 'english-course-placeholder.svg',
			'exams'   => $all,
			'levels'  => array(),
			'url'     => null,
		),
		array(
			'slug'    => 'math-1',
			'title'   => __( 'كورس الرياضيات — المستوى الأول', 'novira-academy' ),
			'name'    => __( 'الرياضيات — المستوى الأول', 'novira-academy' ),
			'desc'    => __( 'تأسيس متين للمفاهيم الأساسية في الرياضيات؛ خطوة أولى يبني عليها طالبك بقية المستويات ويستعد بها لأسئلة القسم الكمّي.', 'novira-academy' ),
			'details' => __( 'المستوى الأول يؤسّس المفاهيم الأساسية في الرياضيات التي يُبنى عليها كل ما بعدها. يدرس طالبك أسبوعياً مع معلم متخصص يشرح الفكرة ويطبّقها على نمط أسئلة الاختبار، فيترسّخ الفهم لا الحفظ. الواجبات المنتظمة تكشف نقاط الضعف مبكراً لتُعالَج قبل أن تتراكم، تمهيداً للمستوى الثاني وللقسم الكمّي في الاختبار.', 'novira-academy' ),
			'image'   => $img . 'math-course-placeholder.svg',
			'exams'   => $all,
			'levels'  => array( 'est' => __( 'EST 1', 'novira-academy' ) ),
			'url'     => null,
		),
		array(
			'slug'    => 'math-2',
			'title'   => __( 'كورس الرياضيات — المستوى الثاني', 'novira-academy' ),
			'name'    => __( 'الرياضيات — المستوى الثاني', 'novira-academy' ),
			'desc'    => __( 'مستوى متقدّم يرسّخ المهارات الكمّية وحل المسائل تحت ضغط الوقت، استعداداً لأصعب أسئلة الرياضيات في الاختبار.', 'novira-academy' ),
			'details' => __( 'المستوى الثاني يبني على تأسيس المستوى الأول ويرفع طالبك إلى المهارات الكمّية المتقدّمة وحل المسائل تحت ضغط الوقت. يتدرّب أسبوعياً مع معلم متخصص على أصعب أنماط أسئلة الرياضيات في الاختبار، وتُضاف اختبارات تجريبية تُحاكي ظروف يوم الامتحان لتحديد ما يحتاج تعزيزاً قبل الموعد.', 'novira-academy' ),
			'image'   => $img . 'math-course-placeholder.svg',
			'exams'   => $all,
			'levels'  => array( 'est' => __( 'EST 2', 'novira-academy' ) ),
			'url'     => null,
		),
		array(
			'slug'    => 'biology',
			'title'   => __( 'كورس الأحياء', 'novira-academy' ),
			'name'    => __( 'الأحياء', 'novira-academy' ),
			'desc'    => __( 'تغطية منهجية لمفاهيم الأحياء بلغة الاختبار، تربط الفهم العلمي بأسلوب الأسئلة حتى يجيب طالبك بثقة.', 'novira-academy' ),
			'details' => __( 'يغطّي هذا الكورس مفاهيم الأحياء تغطيةً منهجية بلغة الاختبار نفسها، فيربط الفهم العلمي بأسلوب الأسئلة التي سيواجهها طالبك. الدراسة أسبوعية مع معلم متخصص، والمتابعة بعد كل حصة تُثبّت المفاهيم أولاً بأول حتى يجيب طالبك بثقة في يوم الاختبار.', 'novira-academy' ),
			'image'   => $img . 'biology-course-placeholder.svg',
			'exams'   => $all,
			'levels'  => array(),
			'url'     => null,
		),
		array(
			'slug'    => 'national-subjects',
			'title'   => __( 'كورس المواد القومية', 'novira-academy' ),
			'name'    => __( 'المواد القومية', 'novira-academy' ),
			'desc'    => __( 'المواد القومية المقرّرة ضمن مسار الدبلومة، بمتابعة منتظمة تُرسّخ الفهم وتغطي متطلبات المرحلة الدراسية.', 'novira-academy' ),
			'details' => __( 'يغطّي الكورس المواد القومية المقرّرة ضمن مسار الدبلومة الأمريكية بمتابعة منتظمة تُرسّخ الفهم وتغطي متطلبات المرحلة الدراسية. يدرس طالبك مع معلمين متخصصين وفق خطة تسير بالتوازي مع بقية مكوّنات البرنامج، فلا تتعارض المواد القومية مع الإعداد للاختبار بل تكمّله.', 'novira-academy' ),
			'image'   => $img . 'national-subjects-placeholder.svg',
			'exams'   => $all,
			'levels'  => array(),
			'url'     => null,
		),
	);

	/**
	 * Filter the master course catalog (data only).
	 *
	 * @param array[] $catalog Course rows.
	 */
	return apply_filters( 'novira_exam_courses_catalog', $catalog );
}

/**
 * Courses for one exam — filtered from the master catalog and augmented with
 * presentation-ready labels. Returns an empty array for an unknown/empty slug.
 *
 * Each returned course adds:
 *   - exam          the requested slug
 *   - exam_label    its display label (e.g. "EST")
 *   - title_display "{title} — {exam_label}" (matches the per-exam naming)
 *   - wa_name       "{name} — {exam_label}" for the WhatsApp prefill message
 *   - exam_labels   labels for every exam the course supports
 *   - also_for      labels for the OTHER exams (empty if exam-specific)
 *   - level_label   the level label for THIS exam (e.g. "EST 1"), or '' if none
 *   - details       the full educational description (for the card details view)
 *
 * @param string $exam_slug est | digital-sat | act | ap
 * @return array[]
 */
function novira_exam_courses( $exam_slug ) {
	$slug = is_string( $exam_slug ) ? trim( $exam_slug ) : '';
	if ( '' === $slug ) {
		return array();
	}

	$label = novira_exam_course_exam_label( $slug );
	$out   = array();

	foreach ( novira_exam_courses_catalog() as $course ) {
		$exams = isset( $course['exams'] ) && is_array( $course['exams'] ) ? $course['exams'] : array();
		if ( ! in_array( $slug, $exams, true ) ) {
			continue; // Not offered for this exam — filtered out automatically.
		}

		$also_for = array();
		foreach ( $exams as $e ) {
			if ( $e !== $slug ) {
				$also_for[] = novira_exam_course_exam_label( $e );
			}
		}

		// Short, exam-tagged name for the WhatsApp prefill (avoids "كورس (كورس …)").
		$wa_base = ! empty( $course['name'] ) ? $course['name'] : $course['title'];

		// Level label for THIS exam only (e.g. EST is split into EST 1 / EST 2).
		$levels      = isset( $course['levels'] ) && is_array( $course['levels'] ) ? $course['levels'] : array();
		$level_label = isset( $levels[ $slug ] ) ? $levels[ $slug ] : '';

		$out[] = array_merge(
			$course,
			array(
				'exam'          => $slug,
				'exam_label'    => $label,
				'title_display' => sprintf( '%s — %s', $course['title'], $label ),
				'wa_name'       => sprintf( '%s — %s', $wa_base, $label ),
				'exam_labels'   => array_map( 'novira_exam_course_exam_label', $exams ),
				'also_for'      => $also_for,
				'level_label'   => $level_label,
				'details'       => isset( $course['details'] ) ? $course['details'] : '',
				'url'           => isset( $course['url'] ) ? $course['url'] : null,
			)
		);
	}

	/**
	 * Filter the resolved courses for one exam (data only).
	 *
	 * @param array[] $out  Resolved course rows for this exam.
	 * @param string  $slug The exam slug.
	 */
	return apply_filters( 'novira_exam_courses', $out, $slug );
}

/**
 * "Which course is right for my child?" guidance — single, data-driven mapping
 * of a student situation to the course that fits it. DATA ONLY.
 *
 * Each row points at a real course by `course` slug, so the guidance can never
 * drift from the catalog: the section resolves the title (and level chip) from
 * novira_exam_courses($slug). No marketing, no invented facts — every row
 * describes a real academic situation and the course that addresses it. The
 * final matching call is always the level assessment (durations and the exact
 * plan are decided there, never guessed here). Reusable: add per-exam guidance
 * via the override map (SAT/ACT get their own the day they need it).
 *
 * @param string $exam_slug est | digital-sat | act | ap
 * @return array[] Each row: [ 'for' => situation, 'course' => course-slug ].
 */
function novira_exam_course_guidance( $exam_slug ) {
	$slug = is_string( $exam_slug ) ? trim( $exam_slug ) : '';
	if ( '' === $slug ) {
		return array();
	}

	// Per-exam guidance. Keyed by exam slug; rows reference courses by slug.
	$by_exam = array(
		'est' => array(
			array( 'for' => __( 'طالب يحتاج تقوية الإنجليزية — قراءة واستيعاب وقواعد — لقسم اللغة في الاختبار', 'novira-academy' ), 'course' => 'english' ),
			array( 'for' => __( 'طالب في مرحلة مبكرة من المسار أو يحتاج تثبيت أساسيات الرياضيات أولاً', 'novira-academy' ), 'course' => 'math-1' ),
			array( 'for' => __( 'طالب أتقن الأساسيات وجاهز للمهارات الكمّية المتقدّمة وحل المسائل تحت ضغط الوقت', 'novira-academy' ), 'course' => 'math-2' ),
			array( 'for' => __( 'طالب مساره الدراسي يتضمّن الأحياء ويحتاج تغطيتها بلغة الاختبار', 'novira-academy' ), 'course' => 'biology' ),
			array( 'for' => __( 'طالب يحتاج تغطية المواد القومية المقرّرة ضمن متطلبات الدبلومة', 'novira-academy' ), 'course' => 'national-subjects' ),
		),
		'digital-sat' => array(
			array( 'for' => __( 'طالب يحتاج تقوية الإنجليزية — قراءة وكتابة وقواعد — لقسم القراءة والكتابة في الاختبار', 'novira-academy' ), 'course' => 'english' ),
			array( 'for' => __( 'طالب يحتاج تثبيت أساسيات الرياضيات قبل الانتقال إلى المستوى المتقدّم', 'novira-academy' ), 'course' => 'math-1' ),
			array( 'for' => __( 'طالب أتقن الأساسيات وجاهز للمهارات الكمّية المتقدّمة في قسم الرياضيات', 'novira-academy' ), 'course' => 'math-2' ),
			array( 'for' => __( 'طالب مساره الدراسي يتضمّن الأحياء ويحتاج تغطيتها بلغة الاختبار', 'novira-academy' ), 'course' => 'biology' ),
			array( 'for' => __( 'طالب يحتاج تغطية المواد القومية المقرّرة ضمن متطلبات الدبلومة', 'novira-academy' ), 'course' => 'national-subjects' ),
		),
		'act' => array(
			array( 'for' => __( 'طالب يحتاج تقوية الإنجليزية لقسمَي الإنجليزية والقراءة في الاختبار', 'novira-academy' ), 'course' => 'english' ),
			array( 'for' => __( 'طالب يحتاج تثبيت أساسيات الرياضيات قبل الانتقال إلى المستوى المتقدّم', 'novira-academy' ), 'course' => 'math-1' ),
			array( 'for' => __( 'طالب أتقن الأساسيات وجاهز للمهارات الكمّية المتقدّمة في قسم الرياضيات', 'novira-academy' ), 'course' => 'math-2' ),
			array( 'for' => __( 'طالب يستعد لقسم العلوم ويحتاج تقوية الأحياء بلغة الاختبار', 'novira-academy' ), 'course' => 'biology' ),
			array( 'for' => __( 'طالب يحتاج تغطية المواد القومية المقرّرة ضمن متطلبات الدبلومة', 'novira-academy' ), 'course' => 'national-subjects' ),
		),
	);

	$rows = isset( $by_exam[ $slug ] ) ? $by_exam[ $slug ] : array();

	/**
	 * Filter the course-guidance rows for one exam (data only).
	 *
	 * @param array[] $rows Guidance rows [ 'for' => string, 'course' => slug ].
	 * @param string  $slug The exam slug.
	 */
	return apply_filters( 'novira_exam_course_guidance', $rows, $slug );
}
