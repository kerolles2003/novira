<?php
/**
 * Novira Academy – American Diploma Data Layer (Sprint 4.1.1)
 *
 * THE SPINE of the Academic Ecosystem.
 *
 * This file is the single source of truth for the American Diploma hub and
 * every future spoke (EST, Digital SAT, ACT, AP), supporting pages, FAQ, and
 * structured data. It returns DATA ONLY — no HTML, no echo, no rendering, no
 * schema emission, no database writes, no side effects.
 *
 * Consumers:
 *   - Hub + spoke template partials (render the returned arrays; escape there).
 *   - inc/seo.php (turns novira_diploma_program_node() into JSON-LD).
 *   - Future child pages (read novira_diploma_programs() — never re-declare it).
 *
 * TRUTH RULES (confirmed by the academy):
 *   - Grade range: Grade 10 → Grade 12.
 *   - Offered: EST, Digital SAT, ACT.  AP: NOT offered yet.
 *   - Novira provides: academic follow-up, specialized teachers, exam
 *     preparation, exam-logistics support, application guidance, and
 *     accompaniment toward university entry.
 *   - Novira does NOT guarantee: admission, scholarships, or acceptance into
 *     specific universities. Those decisions belong to universities and the
 *     competent authorities (see novira_admission_disclaimer()).
 *
 * @package Novira_Academy
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * HELPER 3 — The anti-guarantee statement (single source of truth).
 *
 * This is the ONLY place this string may exist. Any section, FAQ, page, or
 * schema description that needs anti-guarantee language MUST consume this
 * function. Never copy the wording elsewhere.
 *
 * @return string The exact, approved disclaimer (unescaped; escape on output).
 */
function novira_admission_disclaimer() {
	return __( 'تقدم نوفيرا أكاديمي المتابعة الأكاديمية، والاستعداد للاختبارات الدولية، والدعم والإرشاد خلال رحلة الطالب التعليمية، بينما تخضع قرارات القبول الجامعي والمنح الدراسية لمتطلبات وسياسات الجامعات والجهات المختصة، ولا يمكن ضمان نتائج أو قرارات القبول.', 'novira-academy' );
}

/**
 * HELPER 1 — The seven-stage academic journey (the secondary hub model).
 *
 * Ordered, data-driven. Renders Section 5 today and seeds the future
 * standalone pages (exam logistics, application guidance) tomorrow — one
 * source, no rewrite. The CLIMAX is stage 6, the official exam and the
 * highest possible score; post-exam university guidance (stage 7) is an
 * explicitly optional, disclaimer-bound support step, never the destination.
 *
 * Each stage:
 *   'id'           string  Stable slug (anchor / breadcrumb / future URL).
 *   'order'        int     1..7 (ascending).
 *   'label'        string  Stage name (Arabic).
 *   'student_need' string  What the student needs at this stage.
 *   'novira_role'  string  How Novira accompanies at this stage.
 *   'cluster'      string  Content-cluster key for future articles.
 *   'future_page'  string|false  Relative path of a future standalone page,
 *                                or false if it lives only inside the hub.
 *   'links'        string[]      Program slugs this stage routes to
 *                                (populated for the exams stage only).
 *   'schema'       string|null   Intended schema type for a future standalone
 *                                page ('Service'), or null. NOT emitted here —
 *                                inc/seo.php decides if/when to render it.
 *
 * @return array[] Ordered list of stage arrays.
 */
function novira_diploma_journey() {
	$journey = array(
		array(
			'id'           => 'foundation',
			'order'        => 1,
			'label'        => __( 'التأسيس', 'novira-academy' ),
			'student_need' => __( 'بناء أساس أكاديمي ولغوي متين قبل الدخول في متطلبات الدبلومة الأمريكية.', 'novira-academy' ),
			'novira_role'  => __( 'تحديد المستوى وبناء المهارات الأساسية في اللغة الإنجليزية والمواد الدراسية.', 'novira-academy' ),
			'cluster'      => 'foundation',
			'future_page'  => false,
			'links'        => array(),
			'schema'       => null,
		),
		array(
			'id'           => 'academic-follow-up',
			'order'        => 2,
			'label'        => __( 'المتابعة الأكاديمية', 'novira-academy' ),
			'student_need' => __( 'متابعة مستمرة عبر سنوات الدراسة بدلاً من التحضير لاختبار واحد.', 'novira-academy' ),
			'novira_role'  => __( 'متابعة دورية للتقدّم الأكاديمي مع معلمين متخصصين.', 'novira-academy' ),
			'cluster'      => 'academic-follow-up',
			'future_page'  => false,
			'links'        => array(),
			'schema'       => null,
		),
		array(
			'id'           => 'specialized-courses',
			'order'        => 3,
			'label'        => __( 'الكورسات المتخصصة', 'novira-academy' ),
			'student_need' => __( 'إتقان محتوى المواد ومهارات اللغة الإنجليزية المطلوبة للمنهج الأمريكي.', 'novira-academy' ),
			'novira_role'  => __( 'تدريس المواد المتخصصة من خلال معلمين متخصصين.', 'novira-academy' ),
			'cluster'      => 'specialized-courses',
			'future_page'  => false,
			'links'        => array(),
			'schema'       => null,
		),
		array(
			'id'           => 'standardized-tests',
			'order'        => 4,
			'label'        => __( 'الإعداد للاختبار الدولي والاختبارات التجريبية', 'novira-academy' ),
			'student_need' => __( 'قياس الجاهزية للاختبار الدولي المناسب (EST أو Digital SAT أو ACT).', 'novira-academy' ),
			'novira_role'  => __( 'إعداد موجّه لكل اختبار، واختبارات تجريبية تكشف نقاط الضعف وتحسّنها قبل الموعد.', 'novira-academy' ),
			'cluster'      => 'standardized-tests',
			'future_page'  => false,
			// Routes to the program spokes (single source: novira_diploma_programs()).
			'links'        => array( 'est', 'digital-sat', 'act' ),
			'schema'       => null, // The spokes carry Course schema, not the stage.
		),
		array(
			'id'           => 'exam-logistics',
			'order'        => 5,
			'label'        => __( 'دعم التسجيل', 'novira-academy' ),
			'student_need' => __( 'تنظيم التسجيل والمواعيد ومتطلبات يوم الاختبار.', 'novira-academy' ),
			'novira_role'  => __( 'ندعم إجراءات التسجيل والجدولة، والتنسيق اللوجستي عند الحاجة — لتخفيف العبء عن الأسرة.', 'novira-academy' ),
			'cluster'      => 'exam-logistics',
			'future_page'  => '/american-diploma/exam-logistics',
			'links'        => array(),
			'schema'       => 'Service',
		),
		array(
			'id'           => 'application-guidance',
			'order'        => 6,
			// STAGE 6 = the climax: the prepared student at the official exam.
			'label'        => __( 'الامتحان الرسمي وأفضل درجة ممكنة', 'novira-academy' ),
			'student_need' => __( 'دخول الاختبار مستعداً فعلاً وتحقيق أفضل درجة ممكنة.', 'novira-academy' ),
			'novira_role'  => __( 'يدخل طالبك الاختبار وقد تدرّب على بيئته في الاختبارات التجريبية، ونستمر معه لإعادته وتحسين درجته إن رغب.', 'novira-academy' ),
			'cluster'      => 'application-guidance',
			'future_page'  => '/american-diploma/application-guidance',
			'links'        => array(),
			'schema'       => 'Service',
		),
		array(
			'id'           => 'university-entry',
			'order'        => 7,
			// STAGE 7 = secondary, downstream, explicitly optional — never the climax.
			'label'        => __( 'بعد الاختبار: إرشاد التقديم الجامعي (اختياري)', 'novira-academy' ),
			'student_need' => __( 'فهم خطوات التقديم للجامعات بعد الحصول على الدرجة.', 'novira-academy' ),
			'novira_role'  => __( 'إرشاد اختياري خلال خطوات التقديم، مع خضوع قرارات ومتطلبات القبول لسياسات الجامعات والجهات المختصة.', 'novira-academy' ),
			'cluster'      => 'university-entry',
			'future_page'  => false,
			'links'        => array(),
			'schema'       => null,
		),
	);

	/**
	 * Filter the diploma journey stages (extension point; data only).
	 *
	 * @param array[] $journey Ordered stage arrays.
	 */
	return apply_filters( 'novira_diploma_journey', $journey );
}

/**
 * HELPER 2 — The program registry (single source for all spokes).
 *
 * Every spoke page, internal link, and schema builder reads this. Adding a
 * future program = one entry here, nowhere else.
 *
 * Each program:
 *   'slug'        string  Stable identifier used across the ecosystem.
 *   'name'        string  Display name.
 *   'offered'     bool    TRUE only if Novira actually prepares for it.
 *                         GATES rendering AND Course schema — never claim an
 *                         exam we do not prepare.
 *   'page_slug'   string  Child-page slug under /american-diploma/.
 *   'future'      bool    TRUE = planned but not yet live.
 *   'schema_type' string  Intended schema type (e.g. 'Course'). Emission of
 *                         the schema is gated by 'offered' inside inc/seo.php.
 *
 * @return array[] List of program arrays (keyed by numeric index, ordered).
 */
function novira_diploma_programs() {
	$programs = array(
		array(
			'slug'        => 'est',
			'name'        => 'EST',
			'offered'     => true,
			'page_slug'   => 'est',
			'future'      => false,
			'schema_type' => 'Course',
		),
		array(
			'slug'        => 'digital-sat',
			'name'        => 'Digital SAT',
			'offered'     => true,
			'page_slug'   => 'digital-sat',
			'future'      => false,
			'schema_type' => 'Course',
		),
		array(
			'slug'        => 'act',
			'name'        => 'ACT',
			'offered'     => true,
			'page_slug'   => 'act',
			'future'      => false,
			'schema_type' => 'Course',
		),
		array(
			'slug'        => 'ap',
			'name'        => 'AP',
			'offered'     => false, // Not offered yet — must not render or schema-claim.
			'page_slug'   => 'ap',
			'future'      => true,
			'schema_type' => 'Course',
		),
	);

	/**
	 * Filter the diploma program registry (extension point; data only).
	 *
	 * @param array[] $programs Program arrays.
	 */
	return apply_filters( 'novira_diploma_programs', $programs );
}

/**
 * Convenience: only the programs Novira actually prepares for.
 *
 * Thin reader over novira_diploma_programs() so render/schema consumers cannot
 * accidentally surface a non-offered program. No new source of truth.
 *
 * @return array[] Offered programs only.
 */
function novira_diploma_offered_programs() {
	return array_values(
		array_filter(
			novira_diploma_programs(),
			static function ( $program ) {
				return ! empty( $program['offered'] );
			}
		)
	);
}

/**
 * HELPER 4 — Diploma-specific FAQ items (companion topics).
 *
 * Shares the shape of novira_faq_items() so the existing FAQ partial can
 * render it unchanged. Items whose exact answer is internal policy carry
 * 'confirm' => true and use a safe "contact us" answer — never an invented
 * policy. The admission-guarantee answer consumes novira_admission_disclaimer()
 * so the wording is never duplicated.
 *
 * Item shape: [ 'q' => string, 'a' => string, 'confirm' => bool (optional) ].
 *
 * @return array[]
 */
function novira_diploma_faq_items() {
	$faqs = array(
		array(
			'q' => __( 'ما المرحلة الدراسية التي يرافق فيها البرنامج الطالب؟', 'novira-academy' ),
			'a' => __( 'يرافق برنامج الدبلومة الأمريكية الطالب من الصف العاشر حتى الصف الثاني عشر (Grade 10 – Grade 12).', 'novira-academy' ),
		),
		array(
			'q' => __( 'ما الاختبارات الدولية التي تُعِدّون لها؟', 'novira-academy' ),
			'a' => __( 'نُعِدّ الطلاب لاختبارات EST و Digital SAT و ACT. (برنامج AP غير متاح حالياً.)', 'novira-academy' ),
		),
		array(
			'q'       => __( 'كيف تتم المتابعة الأكاديمية للطالب؟', 'novira-academy' ),
			'a'       => __( 'يتابع فريق نوفيرا تقدّم الطالب أكاديمياً خلال مراحل الدبلومة الأمريكية من خلال معلمين متخصصين. تُحدَّد آلية المتابعة الدقيقة حسب البرنامج — تواصل معنا للتفاصيل.', 'novira-academy' ),
			'confirm' => true,
		),
		array(
			'q' => __( 'هل تساعدون في إجراءات التسجيل للاختبارات؟', 'novira-academy' ),
			'a' => __( 'نعم، نقدّم الدعم في إجراءات التسجيل والجدولة ومتطلبات يوم الاختبار لاختبارات EST و Digital SAT و ACT.', 'novira-academy' ),
		),
		array(
			'q' => __( 'هل تقدّمون إرشاداً للتقديم الجامعي؟', 'novira-academy' ),
			'a' => __( 'نعم، نقدّم إرشاداً خلال خطوات التقديم الجامعي. وتظل متطلبات وقرارات القبول خاضعة لسياسات الجامعات والجهات المختصة.', 'novira-academy' ),
		),
		array(
			// Anti-guarantee — consumes the single-source disclaimer (no duplication).
			'q' => __( 'هل تضمنون القبول الجامعي أو المنح الدراسية؟', 'novira-academy' ),
			'a' => novira_admission_disclaimer(),
		),
		array(
			'q'       => __( 'كيف يمكن متابعة مستوى تقدّم الطالب؟', 'novira-academy' ),
			'a'       => __( 'يوفّر فريق نوفيرا متابعة لمستوى الطالب أثناء البرنامج. لمعرفة طريقة وتكرار مشاركة تقارير التقدّم تواصل معنا.', 'novira-academy' ),
			'confirm' => true,
		),
		array(
			'q'       => __( 'كيف تتواصلون مع أولياء الأمور؟', 'novira-academy' ),
			'a'       => __( 'نوفّر تواصلاً مع أولياء الأمور حول مسار الطالب. تُحدَّد طريقة وتكرار التواصل حسب البرنامج — تواصل معنا للتفاصيل.', 'novira-academy' ),
			'confirm' => true,
		),
	);

	/**
	 * Filter the diploma FAQ items (extension point; data only).
	 *
	 * @param array[] $faqs FAQ item arrays.
	 */
	return apply_filters( 'novira_diploma_faq_items', $faqs );
}

/**
 * HELPER 5 — JSON-LD DATA for the American Diploma program.
 *
 * Returns a plain associative array shaped as an EducationalOccupationalProgram
 * node. It does NOT emit schema and does NOT echo — inc/seo.php is responsible
 * for placing this into the @graph and rendering it.
 *
 * Truth guardrails baked in:
 *   - description includes the anti-guarantee disclaimer.
 *   - NO occupationalCredentialAwarded / awarded-credential implying admission.
 *   - hasPart references ONLY offered programs (gated via offered programs).
 *
 * @return array Associative array (JSON-LD node, unencoded).
 */
function novira_diploma_program_node() {
	$hub_url = home_url( '/american-diploma/' );
	$org_id  = home_url( '/#organization' );

	// Reference offered spokes by a stable @id convention (matches the @ids
	// inc/seo.php will assign when it emits each Course).
	$parts = array();
	foreach ( novira_diploma_offered_programs() as $program ) {
		$parts[] = array(
			'@id' => home_url( '/american-diploma/' . $program['page_slug'] . '/#course' ),
		);
	}

	$node = array(
		'@type'         => 'EducationalOccupationalProgram',
		'@id'           => $hub_url . '#program',
		'name'          => __( 'برنامج الدبلومة الأمريكية', 'novira-academy' ),
		'alternateName' => 'American Diploma Program',
		'url'           => $hub_url,
		'provider'      => array( '@id' => $org_id ),
		'educationalProgramMode' => 'onsite',
		'inLanguage'    => array( 'ar', 'en' ),
		// Grade 10 → Grade 12 (confirmed truth).
		'educationalLevel' => 'Grade 10 – Grade 12',
		'description'   => __( 'برنامج يرافق الطالب خلال مسار الدبلومة الأمريكية من الصف العاشر حتى الصف الثاني عشر، ويشمل المتابعة الأكاديمية والكورسات المتخصصة والاستعداد لاختبارات EST و Digital SAT و ACT والدعم اللوجستي للاختبارات وإرشاد التقديم الجامعي. ', 'novira-academy' ) . novira_admission_disclaimer(),
	);

	if ( ! empty( $parts ) ) {
		$node['hasPart'] = $parts;
	}

	/**
	 * Filter the diploma program JSON-LD data (extension point; data only).
	 *
	 * @param array $node The EducationalOccupationalProgram node array.
	 */
	return apply_filters( 'novira_diploma_program_node', $node );
}
