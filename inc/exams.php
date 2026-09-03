<?php
/**
 * Novira Academy – Exam Data Layer (Sprint 4.2.1a)
 *
 * The reusable, slug-driven data contracts that power every American Diploma
 * exam spoke: EST, Digital SAT, ACT, and future AP. One architecture, many
 * exams — no page-specific datasets, no exam-specific functions.
 *
 * Design:
 *   - IDENTITY (slug/name/offered/future/schema_type/page_slug) is read from the
 *     single source of truth, novira_diploma_programs() (inc/diploma.php). Never
 *     duplicated here.
 *   - CONTENT is a generic base (Novira's confirmed accompaniment role, worded
 *     per exam name) layered with per-slug OVERRIDE datasets where the academy
 *     fills real exam facts. Today the overrides are empty, so every exam FACT
 *     (sections, timing, score, fees, requirements, reporting) is null/'contact'.
 *
 * TRUTH RULES (hard):
 *   - Unknown timing / score / sections / requirements  -> null
 *   - Unknown fees                                       -> 'contact'
 *   - Unknown FAQ policy answers                         -> status 'unknown' (answer null)
 *   - Never invent numbers, timings, fees, or policies. No marketing. No
 *     admission/scholarship guarantees (those belong to the hub + the
 *     novira_admission_disclaimer() primitive).
 *
 * This file returns DATA ONLY. No HTML, no echo, no schema emission, no
 * templates, no side effects (read-only filters for extensibility).
 *
 * @package Novira_Academy
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Per-slug CONTENT OVERRIDE datasets — the academy fills real exam facts here.
 *
 * Each key is an exam slug; the value is a partial of novira_exam_meta() fields
 * that should override the generic base. Anything omitted falls back to the
 * base (null / 'contact' for facts). This is the "three datasets" surface:
 * EST, Digital SAT, and ACT each get their own real facts here over time —
 * with zero changes to the template or functions.
 *
 * EXAMPLE (do NOT fill until verified against the official source):
 *   'est' => array(
 *       'definition'  => '…authoritative EST definition…',
 *       'sections'    => array( 'Literacy', 'Mathematics' ),
 *       'timing'      => '…real minutes…',
 *       'score_model' => '…real scale…',
 *       'fees'        => '…real fee…',
 *   ),
 *
 * @return array<string,array> Slug => partial override array.
 */
function novira_exam_content_overrides() {
	$overrides = array(
		'est'         => array(
			'hero_title'           => __( 'اختبار EST يقيس ما بناه طالبك معنا — لا ما راجعه في أسبوع', 'novira-academy' ),
			'hero_desc'            => __( 'في نوفيرا، الإعداد لاختبار EST لا يبدأ قبل الاختبار بأسابيع — هو جزء من كل حصة أسبوعية، وكل واجب، وكل متابعة طوال رحلة الدبلومة. يصل الطالب ليوم الاختبار وقد بنى مهاراته على أرضية صلبة.', 'novira-academy' ),
			'definition'           => __( 'اختبار EST (Egyptian Scholastic Test) اختبار موحّد يقيس المهارات الأكاديمية في اللغة الإنجليزية والرياضيات، تستخدمه الجامعات المصرية والعربية ضمن متطلبات القبول لطلاب الدبلومة الأمريكية.', 'novira-academy' ),
			'purpose'              => __( 'درجة الطالب في EST تعكس ما تعلّمه فعلاً خلال سنوات الدراسة — لا ما حفظه في أسابيع. لهذا يختلف نهج نوفيرا عن مراكز الإعداد للامتحانات: الإعداد يبدأ من اليوم الأول في البرنامج. والطلاب الذين يُعيدون الاختبار لتحسين درجتهم يجدون المتابعة والدعم مستمرَّين.', 'novira-academy' ),
			'sections'             => array(
				__( 'الإنجليزية — القراءة والاستيعاب', 'novira-academy' ),
				__( 'الإنجليزية — استخدام اللغة والقواعد', 'novira-academy' ),
				__( 'الرياضيات', 'novira-academy' ),
			),
			'comparison_note'      => __( 'اختبار EST أحد الاختبارات الدولية المعتمدة ضمن مسار الدبلومة الأمريكية، إلى جانب Digital SAT وACT.', 'novira-academy' ),
			'preparation_method'   => __( 'طالبك لن يواجه الـ EST وحده. طوال رحلة الدبلومة، يحضر حصصاً أسبوعية مع معلم متخصص تبني مهارات الإنجليزية والرياضيات تراكمياً — المهارات نفسها التي يقيسها الاختبار. بين الحصص يُتابَع تقدمه وتُكتشَف الثغرات مبكراً. ومع اقتراب موعد الاختبار تُضاف اختبارات تجريبية كاملة — حتى يدخل طالبك قاعة الاختبار وقد جلس فيها من قبل.', 'novira-academy' ),
			'mock_exam_policy'     => __( 'يجلس الطالب في الاختبار التجريبي بنفس ضغط الوقت وأسلوب الأسئلة التي سيواجهها يوم الاختبار الرسمي — فلا مفاجآت في اليوم الحقيقي. إذا كشف الاختبار التجريبي ثغرات، يُعالَج ما يحتاج تعزيزاً في الوقت المتبقي. وإذا أراد الطالب إعادة الاختبار الرسمي لتحسين درجته، فريق نوفيرا مستمر معه في هذه المرحلة أيضاً.', 'novira-academy' ),
			'progress_tracking'    => __( 'ولي الأمر لا ينتظر يوم الاختبار ليعرف أين يقف طالبه. المتابعة الدورية بعد كل حصة وكل اختبار تجريبي تُحدّد ما تحسّن وما يحتاج مزيداً من التدريب — والخطة الدراسية تُعدَّل وفق أولويات الطالب الفعلية.', 'novira-academy' ),
			'registration_support' => __( 'فريق نوفيرا يتولى إجراءات التسجيل للاختبار وتأكيد الموعد — والتحقق من استيفاء جميع المتطلبات قبل يوم الامتحان. طالبك يصل إلى قاعة الاختبار مركّزاً على الأداء، لا على الأوراق.', 'novira-academy' ),
			'requirements'         => __( 'بطاقة هوية سارية الصلاحية. تواصل معنا للتحقق من المتطلبات الكاملة والحالية.', 'novira-academy' ),
			'travel_support'       => __( 'إذا كان مركز الاختبار خارج مدينتك، يساعد فريق نوفيرا في التنسيق اللوجستي — حتى لا تكون المسافة عائقاً في يوم الاختبار. تواصل معنا للتفاصيل.', 'novira-academy' ),
			'reporting_method'     => __( 'ولي الأمر لا يُترك في الغموض. يتواصل فريق نوفيرا مع الأهل حول مستوى تقدّم الطالب خلال فترة الإعداد — تواصل معنا لمعرفة آلية التواصل ضمن البرنامج.', 'novira-academy' ),
			'consultation_title'   => __( 'هل طالبك في مسار الدبلومة الأمريكية؟', 'novira-academy' ),
			'consultation_desc'    => __( 'أرسل بيانات طالبك وسيتواصل معك فريقنا لمناقشة مرحلته الدراسية والخطة المناسبة للـ EST — دون أي التزام.', 'novira-academy' ),
			'faq_items'            => array(
				array(
					'question' => __( 'متى يتقدم طلاب الدبلومة الأمريكية لاختبار EST عادةً؟', 'novira-academy' ),
					'answer'   => __( 'يتفاوت التوقيت حسب المرحلة الدراسية للطالب وخطة البرنامج. فريقنا يحدد مع ولي الأمر الموعد الأنسب بناءً على مستوى الطالب الفعلي — تواصل معنا للتفاصيل.', 'novira-academy' ),
					'status'   => 'contact',
				),
				array(
					'question' => __( 'كيف يُعِدّ برنامج الدبلومة الطالبَ لاختبار EST؟', 'novira-academy' ),
					'answer'   => __( 'الحصص الأسبوعية المستمرة في برنامج الدبلومة هي الإعداد الفعلي — لا يوجد إعداد منفصل للـ EST. الطالب يبني مهارات الإنجليزية والرياضيات تدريجياً عبر السنوات، وتُضاف اختبارات تجريبية مع اقتراب موعد الاختبار. هذا هو الفرق بين نوفيرا ومراكز المراجعة السريعة.', 'novira-academy' ),
					'status'   => 'confirmed',
				),
				array(
					'question' => __( 'هل يمكن إعادة اختبار EST لتحسين الدرجة؟', 'novira-academy' ),
					'answer'   => __( 'نعم. كثير من الطلاب يُعيدون الاختبار لتحسين درجتهم — وهذا شيء طبيعي في مسار الدبلومة الأمريكية. فريق نوفيرا يدعم الطالب في هذه المرحلة.', 'novira-academy' ),
					'status'   => 'confirmed',
				),
				array(
					'question' => __( 'كيف تُستخدم نتيجة EST عند التقديم للجامعات؟', 'novira-academy' ),
					'answer'   => __( 'يستخدم الطالب الدرجة المحققة ضمن ملف تقديمه للجامعات — وفق متطلبات وسياسات القبول الخاصة بكل جامعة.', 'novira-academy' ),
					'status'   => 'confirmed',
				),
				array(
					'question' => __( 'هل الإعداد لاختبار EST منفصل عن الدراسة الأسبوعية في البرنامج؟', 'novira-academy' ),
					'answer'   => __( 'لا. الإعداد مُدمَج في البرنامج الأسبوعي — الدراسة المستمرة والمتابعة الدورية هي الأساس. الاختبار التجريبي يأتي تكملةً، لا بديلاً عن الدراسة المنتظمة.', 'novira-academy' ),
					'status'   => 'confirmed',
				),
				array(
					'question' => __( 'ماذا يحدث إذا لم تكن الدرجة الأولى كافية؟', 'novira-academy' ),
					'answer'   => __( 'إعادة الاختبار مسار طبيعي تماماً — الطالب يواصل حصصه الأسبوعية ويتقدم للاختبار مرة أخرى. فريق نوفيرا مستمر معه في هذه المرحلة، والإعداد لا يتوقف عند الاختبار الأول.', 'novira-academy' ),
					'status'   => 'confirmed',
				),
				array(
					'question' => __( 'ما المطلوب للتسجيل في الاختبار؟', 'novira-academy' ),
					'answer'   => __( 'بطاقة هوية سارية الصلاحية. يساعدك فريق نوفيرا في إجراءات التسجيل والتأكد من استيفاء جميع المتطلبات.', 'novira-academy' ),
					'status'   => 'confirmed',
				),
				array(
					'question' => __( 'كم تبلغ رسوم اختبار EST؟', 'novira-academy' ),
					'answer'   => __( 'تواصل معنا لمعرفة الرسوم الحالية.', 'novira-academy' ),
					'status'   => 'contact',
				),
			),
		), // END est
		'digital-sat' => array(
			// FRAMING/ROLE only — worded per exam. Every FACT (sections, timing,
			// score_model, fees, requirements) stays on the null/'contact' base.
			'hero_title'           => __( 'Digital SAT — نُعِدّ طالبك ليدخله قادراً على أعلى درجة', 'novira-academy' ),
			'hero_desc'            => __( 'النسخة الرقمية من اختبار SAT جزء من مسار الدبلومة الأمريكية. يستعد لها طالبك داخل حصصه الأسبوعية طوال البرنامج — لا في أسابيع قليلة قبل الموعد.', 'novira-academy' ),
			'purpose'              => __( 'درجة Digital SAT تعكس ما بناه الطالب من مهارات في الإنجليزية والرياضيات عبر سنوات الدراسة، لا ما راجعه في أسابيع. لهذا يبدأ الإعداد من اليوم الأول في البرنامج، ويستمر الدعم لمن يعيد الاختبار لتحسين درجته.', 'novira-academy' ),
			'preparation_method'   => __( 'يستعد طالبك للـ Digital SAT ضمن حصصه الأسبوعية مع معلم متخصص — بناء تراكمي لمهارات الإنجليزية والرياضيات التي يقيسها الاختبار. ومع اقتراب الموعد تُضاف اختبارات تجريبية على النسق الرقمي نفسه، فيألف بيئة الاختبار قبل يومه.', 'novira-academy' ),
			'mock_exam_policy'     => __( 'يجلس الطالب لاختبارات تجريبية رقمية بنفس ضغط الوقت وأسلوب الأسئلة — فتُكشف الثغرات وتُعالَج في الوقت المتبقي. وإذا رغب في إعادة الاختبار الرسمي لتحسين درجته، يستمر فريق نوفيرا معه.', 'novira-academy' ),
			'progress_tracking'    => __( 'متابعة دورية بعد كل حصة واختبار تجريبي تُحدّد ما تحسّن وما يحتاج تدريباً — وتُعدَّل الخطة وفق أولويات الطالب. ولي الأمر على اطلاع دائم.', 'novira-academy' ),
			'registration_support' => __( 'يتولّى فريق نوفيرا إجراءات التسجيل للـ Digital SAT وتأكيد الموعد والتحقق من المتطلبات قبل يوم الاختبار — ليركّز طالبك على أدائه لا على الأوراق.', 'novira-academy' ),
			'travel_support'       => __( 'إذا كان مركز الاختبار خارج مدينتك، يساعد فريق نوفيرا في التنسيق اللوجستي. تواصل معنا للتفاصيل.', 'novira-academy' ),
			'reporting_method'     => __( 'يتواصل فريق نوفيرا مع الأهل حول مستوى تقدّم الطالب خلال فترة الإعداد — تواصل معنا لمعرفة آلية التواصل ضمن البرنامج.', 'novira-academy' ),
			'consultation_title'   => __( 'هل طالبك في مسار الدبلومة الأمريكية؟', 'novira-academy' ),
			'consultation_desc'    => __( 'أرسل بيانات طالبك وسيتواصل معك فريقنا لمناقشة مرحلته الدراسية والخطة المناسبة للـ Digital SAT — دون أي التزام.', 'novira-academy' ),
			'comparison_note'      => __( 'Digital SAT أحد الاختبارات الدولية المعتمدة ضمن مسار الدبلومة الأمريكية، إلى جانب EST وACT.', 'novira-academy' ),
			// Officially-published Digital SAT facts (College Board). Operational
			// specifics (fees, dates, deadlines, registration requirements) stay on
			// the null/'contact' base — never invented.
			'definition'           => __( 'Digital SAT هو النسخة الرقمية من اختبار SAT — اختبار قبول جامعي دولي معتمد يُؤدّى على تطبيق Bluebook، وهو تكيّفي حسب أداء الطالب. تستخدمه الجامعات ضمن متطلبات القبول لطلاب الدبلومة الأمريكية.', 'novira-academy' ),
			'sections'             => array(
				__( 'القراءة والكتابة (Reading and Writing)', 'novira-academy' ),
				__( 'الرياضيات (Math)', 'novira-academy' ),
			),
			'timing'               => __( 'نحو ساعتين وربع (2 ساعة و14 دقيقة تقريباً).', 'novira-academy' ),
			'score_model'          => __( 'الدرجة الكلية من 400 إلى 1600 (قسمان، كل قسم من 200 إلى 800).', 'novira-academy' ),
			'faq_items'            => array(
				array( 'question' => __( 'ما الفرق بين Digital SAT والنسخة الورقية؟', 'novira-academy' ), 'answer' => __( 'يُؤدّى Digital SAT رقمياً على تطبيق Bluebook، وهو تكيّفي يتكيّف مع مستوى الطالب، وأقصر زمناً من النسخة الورقية.', 'novira-academy' ), 'status' => 'confirmed' ),
				array( 'question' => __( 'ما أقسام اختبار Digital SAT وكيف يُحسب مجموعه؟', 'novira-academy' ), 'answer' => __( 'قسمان: القراءة والكتابة، والرياضيات؛ والدرجة الكلية من 400 إلى 1600.', 'novira-academy' ), 'status' => 'confirmed' ),
				array( 'question' => __( 'كم مدة اختبار Digital SAT؟', 'novira-academy' ), 'answer' => __( 'نحو ساعتين وربع تقريباً. تُؤكَّد المواعيد والتفاصيل الرسمية مع فريق نوفيرا.', 'novira-academy' ), 'status' => 'confirmed' ),
				array( 'question' => __( 'هل يُسمح باستخدام الآلة الحاسبة؟', 'novira-academy' ), 'answer' => __( 'نعم، الآلة الحاسبة مسموحة في قسم الرياضيات بالكامل.', 'novira-academy' ), 'status' => 'confirmed' ),
				array( 'question' => __( 'كيف يُعِدّ برنامج الدبلومة الطالب للـ Digital SAT؟', 'novira-academy' ), 'answer' => __( 'الحصص الأسبوعية المستمرة هي الإعداد الفعلي — يبني الطالب مهاراته تدريجياً، وتُضاف اختبارات تجريبية على النسق الرقمي مع اقتراب الموعد.', 'novira-academy' ), 'status' => 'confirmed' ),
				array( 'question' => __( 'هل يمكن إعادة Digital SAT لتحسين الدرجة؟', 'novira-academy' ), 'answer' => __( 'نعم، كثير من الطلاب يعيدون الاختبار لتحسين درجتهم، وفريق نوفيرا يستمر معهم في هذه المرحلة.', 'novira-academy' ), 'status' => 'confirmed' ),
				array( 'question' => __( 'ما المطلوب للتسجيل وكم الرسوم؟', 'novira-academy' ), 'answer' => __( 'تواصل معنا لمعرفة متطلبات التسجيل والرسوم الحالية؛ ويتولّى فريق نوفيرا إجراءات التسجيل وتأكيد الموعد.', 'novira-academy' ), 'status' => 'contact' ),
				array( 'question' => __( 'كيف تُستخدم نتيجة Digital SAT عند التقديم للجامعات؟', 'novira-academy' ), 'answer' => __( 'يستخدم الطالب الدرجة ضمن ملف تقديمه وفق متطلبات وسياسات القبول الخاصة بكل جامعة.', 'novira-academy' ), 'status' => 'confirmed' ),
			),
		), // END digital-sat
		'act'         => array(
			// FRAMING/ROLE only — every FACT stays on the null/'contact' base.
			'hero_title'           => __( 'ACT — نُعِدّ طالبك للإنجليزية والرياضيات والعلوم حتى أعلى درجة', 'novira-academy' ),
			'hero_desc'            => __( 'اختبار ACT أحد اختبارات الدبلومة الأمريكية، ويشمل مهارات في الإنجليزية والرياضيات والعلوم. يستعد له طالبك داخل حصصه الأسبوعية طوال البرنامج — لا في أسابيع قليلة قبل الموعد.', 'novira-academy' ),
			'purpose'              => __( 'درجة ACT تعكس مهارات بناها الطالب عبر سنوات الدراسة، لا مراجعة سريعة. لهذا يبدأ الإعداد من اليوم الأول، ويستمر الدعم لمن يعيد الاختبار لتحسين درجته.', 'novira-academy' ),
			'preparation_method'   => __( 'يستعد طالبك للـ ACT ضمن حصصه الأسبوعية مع معلمين متخصصين يبنون مهارات الإنجليزية والرياضيات والعلوم تراكمياً. ومع اقتراب الموعد تُضاف اختبارات تجريبية كاملة تحاكي يوم الاختبار.', 'novira-academy' ),
			'mock_exam_policy'     => __( 'يجلس الطالب لاختبارات تجريبية بنفس ضغط الوقت وأسلوب الأسئلة — فتُكشف الثغرات وتُعالَج قبل الموعد الرسمي. ودعم إعادة الاختبار متاح لمن يريد تحسين درجته.', 'novira-academy' ),
			'progress_tracking'    => __( 'متابعة دورية بعد كل حصة واختبار تجريبي تُحدّد ما تحسّن وما يحتاج تدريباً، وتُعدَّل الخطة وفق أولويات الطالب. ولي الأمر على اطلاع دائم.', 'novira-academy' ),
			'registration_support' => __( 'يتولّى فريق نوفيرا إجراءات التسجيل للـ ACT وتأكيد الموعد والتحقق من المتطلبات قبل يوم الاختبار — ليركّز طالبك على أدائه.', 'novira-academy' ),
			'travel_support'       => __( 'إذا كان مركز الاختبار خارج مدينتك، يساعد فريق نوفيرا في التنسيق اللوجستي. تواصل معنا للتفاصيل.', 'novira-academy' ),
			'reporting_method'     => __( 'يتواصل فريق نوفيرا مع الأهل حول مستوى تقدّم الطالب خلال فترة الإعداد — تواصل معنا لمعرفة آلية التواصل ضمن البرنامج.', 'novira-academy' ),
			'consultation_title'   => __( 'هل طالبك في مسار الدبلومة الأمريكية؟', 'novira-academy' ),
			'consultation_desc'    => __( 'أرسل بيانات طالبك وسيتواصل معك فريقنا لمناقشة مرحلته الدراسية والخطة المناسبة للـ ACT — دون أي التزام.', 'novira-academy' ),
			'comparison_note'      => __( 'ACT أحد الاختبارات الدولية المعتمدة ضمن مسار الدبلومة الأمريكية، إلى جانب EST وDigital SAT، ويتميّز بإضافة قسم العلوم.', 'novira-academy' ),
			// Officially-published ACT facts. Operational specifics (fees, dates,
			// deadlines, registration) stay on the null/'contact' base — never
			// invented. Where the format may vary, answers defer to the team.
			'definition'           => __( 'ACT اختبار قبول جامعي دولي معتمد يقيس المهارات الأكاديمية في الإنجليزية والرياضيات والقراءة والعلوم، مع قسم كتابة (Writing) اختياري. تستخدمه الجامعات ضمن متطلبات القبول لطلاب الدبلومة الأمريكية.', 'novira-academy' ),
			'sections'             => array(
				__( 'الإنجليزية (English)', 'novira-academy' ),
				__( 'الرياضيات (Mathematics)', 'novira-academy' ),
				__( 'القراءة (Reading)', 'novira-academy' ),
				__( 'العلوم (Science)', 'novira-academy' ),
				__( 'الكتابة (Writing) — اختياري', 'novira-academy' ),
			),
			'score_model'          => __( 'يُصحَّح كل قسم من 1 إلى 36، والدرجة المركّبة (Composite) هي متوسط الأقسام من 1 إلى 36.', 'novira-academy' ),
			'faq_items'            => array(
				array( 'question' => __( 'ما أقسام اختبار ACT؟', 'novira-academy' ), 'answer' => __( 'يقيس ACT الإنجليزية والرياضيات والقراءة والعلوم، مع قسم كتابة (Writing) اختياري. تُؤكَّد الصيغة الحالية والتفاصيل الرسمية مع فريق نوفيرا.', 'novira-academy' ), 'status' => 'confirmed' ),
				array( 'question' => __( 'كيف تُحسب درجة ACT؟', 'novira-academy' ), 'answer' => __( 'يُصحَّح كل قسم من 1 إلى 36، والدرجة المركّبة (Composite) هي متوسط الأقسام من 1 إلى 36.', 'novira-academy' ), 'status' => 'confirmed' ),
				array( 'question' => __( 'ما الذي يميّز ACT عن EST و Digital SAT؟', 'novira-academy' ), 'answer' => __( 'يتميّز ACT بإضافة قسم العلوم إلى جانب الإنجليزية والرياضيات والقراءة. والاختبارات الثلاثة معتمدة ضمن مسار الدبلومة الأمريكية.', 'novira-academy' ), 'status' => 'confirmed' ),
				array( 'question' => __( 'كيف يُعِدّ برنامج الدبلومة الطالب للـ ACT؟', 'novira-academy' ), 'answer' => __( 'الحصص الأسبوعية المستمرة هي الإعداد الفعلي — يبني الطالب مهاراته تدريجياً، وتُضاف اختبارات تجريبية كاملة تحاكي يوم الاختبار مع اقتراب الموعد.', 'novira-academy' ), 'status' => 'confirmed' ),
				array( 'question' => __( 'هل يمكن إعادة ACT لتحسين الدرجة؟', 'novira-academy' ), 'answer' => __( 'نعم، كثير من الطلاب يعيدون الاختبار لتحسين درجتهم، وفريق نوفيرا يستمر معهم في هذه المرحلة.', 'novira-academy' ), 'status' => 'confirmed' ),
				array( 'question' => __( 'كم مدة اختبار ACT ورسومه؟', 'novira-academy' ), 'answer' => __( 'تختلف مدة الاختبار ورسومه حسب الصيغة والموعد؛ تواصل معنا لمعرفة التفاصيل الحالية، ويتولّى فريق نوفيرا إجراءات التسجيل.', 'novira-academy' ), 'status' => 'contact' ),
				array( 'question' => __( 'كيف تُستخدم نتيجة ACT عند التقديم للجامعات؟', 'novira-academy' ), 'answer' => __( 'يستخدم الطالب الدرجة المركّبة ضمن ملف تقديمه وفق متطلبات وسياسات القبول الخاصة بكل جامعة.', 'novira-academy' ), 'status' => 'confirmed' ),
			),
		), // END act
		'ap'          => array(), // Future — fill only once AP is offered.
	);

	/**
	 * Filter the per-exam content overrides (extension point; data only).
	 *
	 * @param array $overrides Slug => partial override array.
	 */
	return apply_filters( 'novira_exam_content_overrides', $overrides );
}

/**
 * FUNCTION 1 — novira_exam_meta( $slug )
 *
 * Single source of truth for one exam's facts + framing. Identity is pulled
 * from novira_diploma_programs(); content is the generic base merged with the
 * per-slug override. Returns null for an unknown slug.
 *
 * @param string $slug Exam slug (est | digital-sat | act | ap).
 * @return array|null
 */
function novira_exam_meta( $slug ) {
	$slug = is_string( $slug ) ? trim( $slug ) : '';
	if ( '' === $slug || ! function_exists( 'novira_diploma_programs' ) ) {
		return null;
	}

	// Identity from the registry (single source of truth).
	$registry = null;
	foreach ( novira_diploma_programs() as $program ) {
		if ( isset( $program['slug'] ) && $program['slug'] === $slug ) {
			$registry = $program;
			break;
		}
	}
	if ( null === $registry ) {
		return null; // Unknown exam.
	}

	$name      = $registry['name'];
	$offered   = ! empty( $registry['offered'] );
	$page_slug = $registry['page_slug'];

	// Generic CONTENT base. Novira-role fields are worded per exam name and
	// reflect the academy's confirmed accompaniment (preparation, logistics
	// support, follow-up). Every exam FACT stays null/'contact' until supplied.
	$base = array(
		/* translators: %s: exam name. */
		'hero_title'           => sprintf( __( '%s — أحد اختبارات الدبلومة الأمريكية', 'novira-academy' ), $name ),
		/* translators: %s: exam name. */
		'hero_desc'            => sprintf( __( 'نرافق الطالب في الاستعداد لاختبار %s كجزء من رحلة الدبلومة الأمريكية.', 'novira-academy' ), $name ),
		'definition'           => null,        // Authoritative — academy/official source.
		'purpose'              => null,        // Authoritative — academy.
		'sections'             => null,        // FACT — academy.
		'timing'               => null,        // FACT — academy.
		'score_model'          => null,        // FACT — academy.
		/* translators: %s: exam name. */
		'preparation_method'   => sprintf( __( 'إعداد موجّه لاختبار %s مع معلمين متخصصين.', 'novira-academy' ), $name ),
		'mock_exam_policy'     => null,        // Specifics — academy.
		'progress_tracking'    => __( 'نوفّر متابعة لمستوى الطالب أثناء الإعداد.', 'novira-academy' ),
		/* translators: %s: exam name. */
		'registration_support' => sprintf( __( 'ندعم إجراءات التسجيل والمواعيد لاختبار %s.', 'novira-academy' ), $name ),
		'travel_support'       => null,        // Confirm whether offered — academy.
		'requirements'         => null,        // FACT — academy.
		'fees'                 => 'contact',    // Unknown fees -> contact.
		'reporting_method'     => null,        // Specifics — academy.
		/* translators: %s: exam name. */
		'consultation_title'   => sprintf( __( 'تحدّث مع فريقنا عن %s', 'novira-academy' ), $name ),
		'consultation_desc'    => __( 'احجز استشارة لمناقشة استعداد طالبك. نجيب عن أسئلتك دون أي التزام.', 'novira-academy' ),
		'comparison_note'      => __( 'أحد خيارات الاختبارات الدولية ضمن الدبلومة الأمريكية إلى جانب الاختبارات الأخرى.', 'novira-academy' ),
		'video_placeholder'    => get_template_directory_uri() . '/assets/placeholders/video-thumbnail-placeholder.jpg',
		'certificate_placeholder' => get_template_directory_uri() . '/assets/placeholders/certificate-placeholder.webp',
	);

	// Per-slug overrides (academy-supplied real facts).
	$overrides = novira_exam_content_overrides();
	$content   = isset( $overrides[ $slug ] ) && is_array( $overrides[ $slug ] )
		? array_merge( $base, $overrides[ $slug ] )
		: $base;

	// Non-offered exams (AP): suppress role/CTA framing; future-state only.
	if ( ! $offered ) {
		/* translators: %s: exam name. */
		$content['hero_title']           = sprintf( __( '%s (غير متاح حالياً)', 'novira-academy' ), $name );
		$content['hero_desc']            = null;
		$content['preparation_method']   = null;
		$content['progress_tracking']    = null;
		$content['registration_support'] = null;
		$content['consultation_title']   = null;
		$content['consultation_desc']    = null;
		$content['comparison_note']      = null;
	}

	$meta = array_merge(
		array(
			'slug'        => $registry['slug'],
			'name'        => $name,
			'short_name'  => $name, // Academy may refine via override.
			'offered'     => $offered,
			'future'      => ! empty( $registry['future'] ),
			'page_slug'   => $page_slug,
			'schema_type' => isset( $registry['schema_type'] ) ? $registry['schema_type'] : 'Course',
			// Matches the @id contract the hub's hasPart already references.
			'schema_id'   => home_url( '/american-diploma/' . $page_slug . '/#course' ),
		),
		$content
	);

	/**
	 * Filter a single exam's resolved meta (extension point; data only).
	 *
	 * @param array  $meta The resolved exam meta.
	 * @param string $slug The exam slug.
	 */
	return apply_filters( 'novira_exam_meta', $meta, $slug );
}

/**
 * FUNCTION 2 — novira_exam_faq_items( $slug )
 *
 * One FAQ provider for ALL exams. Questions are templated by exam name so there
 * is no per-exam duplication and no drift. EST-/SAT-/ACT-specific only — never
 * duplicates the hub FAQ and never asks/answers an admission-guarantee question.
 *
 * Item shape: [ 'question' => string, 'answer' => string|null, 'status' => 'confirmed'|'contact'|'unknown' ].
 * Unknown answers remain clearly unknown (answer null, status 'unknown').
 *
 * @param string $slug Exam slug.
 * @return array[] Empty array for unknown or non-offered exams.
 */
function novira_exam_faq_items( $slug ) {
	$meta = novira_exam_meta( $slug );
	if ( null === $meta || empty( $meta['offered'] ) ) {
		return array(); // No exam FAQ for unknown or not-yet-offered exams.
	}

	// Use custom FAQ items from overrides when supplied.
	$overrides = novira_exam_content_overrides();
	if ( isset( $overrides[ $slug ]['faq_items'] ) && is_array( $overrides[ $slug ]['faq_items'] ) ) {
		return apply_filters( 'novira_exam_faq_items', $overrides[ $slug ]['faq_items'], $slug );
	}

	$name = $meta['short_name'];

	$items = array(
		array(
			/* translators: %s: exam name. */
			'question' => sprintf( __( 'هل تُعِدّ نوفيرا لاختبار %s؟', 'novira-academy' ), $name ),
			/* translators: %s: exam name. */
			'answer'   => sprintf( __( 'نعم، إعداد %s جزء من برامج الدبلومة الأمريكية لدينا.', 'novira-academy' ), $name ),
			'status'   => 'confirmed',
		),
		array(
			/* translators: %s: exam name. */
			'question' => sprintf( __( 'ما الأقسام التي يشملها اختبار %s؟', 'novira-academy' ), $name ),
			'answer'   => null, // Unknown until supplied from the official source.
			'status'   => 'unknown',
		),
		array(
			/* translators: %s: exam name. */
			'question' => sprintf( __( 'كيف يمكنني التسجيل في اختبار %s؟', 'novira-academy' ), $name ),
			'answer'   => __( 'ندعمك في إجراءات التسجيل والمواعيد. تواصل معنا للتفاصيل.', 'novira-academy' ),
			'status'   => 'contact',
		),
		array(
			/* translators: %s: exam name. */
			'question' => sprintf( __( 'كم تبلغ رسوم اختبار %s؟', 'novira-academy' ), $name ),
			'answer'   => __( 'تواصل معنا لمعرفة الرسوم الحالية.', 'novira-academy' ),
			'status'   => 'contact',
		),
		array(
			/* translators: %s: exam name. */
			'question' => sprintf( __( 'كيف تتابعون مستوى الطالب أثناء الإعداد لـ %s؟', 'novira-academy' ), $name ),
			'answer'   => __( 'نوفّر متابعة لمستوى الطالب؛ تُحدَّد طريقة التقارير حسب البرنامج — تواصل معنا.', 'novira-academy' ),
			'status'   => 'contact',
		),
	);

	/**
	 * Filter an exam's FAQ items (extension point; data only).
	 *
	 * @param array  $items FAQ item arrays.
	 * @param string $slug  The exam slug.
	 */
	return apply_filters( 'novira_exam_faq_items', $items, $slug );
}

/**
 * FUNCTION 3 — novira_is_diploma_exam()
 *
 * True only when the current page is a valid, OFFERED exam spoke: a child of the
 * `american-diploma` page whose slug exists in novira_diploma_offered_programs().
 * No hardcoded EST/SAT/ACT checks.
 *
 * @return bool
 */
function novira_is_diploma_exam() {
	if ( ! is_page() || ! function_exists( 'novira_diploma_offered_programs' ) ) {
		return false;
	}

	$post = get_queried_object();
	if ( ! ( $post instanceof WP_Post ) ) {
		return false;
	}

	$parent_id = wp_get_post_parent_id( $post->ID );
	if ( ! $parent_id ) {
		return false;
	}
	$parent = get_post( $parent_id );
	if ( ! $parent || 'american-diploma' !== $parent->post_name ) {
		return false;
	}

	foreach ( novira_diploma_offered_programs() as $program ) {
		if ( isset( $program['page_slug'] ) && $program['page_slug'] === $post->post_name ) {
			return true;
		}
	}
	return false;
}

/**
 * FUNCTION 4 — novira_current_exam_slug()
 *
 * The current page's slug, derived directly from the page (no manual mappings).
 * Returns null when not on a singular page.
 *
 * @return string|null
 */
function novira_current_exam_slug() {
	if ( ! is_page() ) {
		return null;
	}
	$post = get_queried_object();
	return ( $post instanceof WP_Post ) ? $post->post_name : null;
}

/**
 * FUNCTION 5 — novira_current_exam_meta()
 *
 * Convenience wrapper: meta for the current exam page (null off-spoke).
 *
 * @return array|null
 */
function novira_current_exam_meta() {
	return novira_exam_meta( novira_current_exam_slug() );
}

/**
 * FUNCTION 6 — novira_current_exam_faq()
 *
 * Convenience wrapper: FAQ for the current exam page (empty off-spoke).
 *
 * @return array[]
 */
function novira_current_exam_faq() {
	return novira_exam_faq_items( novira_current_exam_slug() );
}

/**
 * Null-safe display fallback for an exam fact (presentation support).
 *
 * Returns a human string for rendering so sections never collapse in
 * Development Mode: 'contact' -> a contact prompt; null/'' -> a pending marker;
 * otherwise the value itself. Returns a string only (escape at the call site).
 *
 * @param mixed       $value   The meta value.
 * @param string|null $pending Optional custom pending message.
 * @return string
 */
function novira_exam_text( $value, $pending = null ) {
	if ( 'contact' === $value ) {
		return __( 'تواصل معنا للتفاصيل.', 'novira-academy' );
	}
	if ( null === $value || '' === $value || ( is_array( $value ) && empty( $value ) ) ) {
		return null !== $pending ? $pending : __( 'سيتم تحديثه من المصدر الرسمي.', 'novira-academy' );
	}
	return (string) $value;
}
