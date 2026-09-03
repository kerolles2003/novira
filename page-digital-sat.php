<?php
/**
 * Template: Digital SAT Exam Page (premium, Sprint 5.0)
 *
 * Dedicated premium landing page for /american-diploma/digital-sat/. Routed here
 * by novira_force_diploma_exam_template() (functions.php) via the generic
 * page-{slug}.php check — EST keeps its own dedicated branch and is untouched.
 *
 * Reuses the EST premium look with ZERO EST edits: wrapped in `.est-page` and
 * composed from the shared components in template-parts/sections/premium-exam/*,
 * styled by est-page.css (read-only) plus a small scoped supplement below for the
 * longer "Digital SAT" wordmark and the FAQ accordion (a section EST lacks today).
 *
 * Copy is Digital-SAT-specific; verified facts come from novira_exam_meta('digital-sat')
 * (inc/exams.php). No EST wording, no invented dates/fees/scores.
 *
 * @package Novira_Academy
 */

get_header();

$meta     = function_exists( 'novira_current_exam_meta' ) ? novira_current_exam_meta() : null;
$faq      = function_exists( 'novira_current_exam_faq' ) ? novira_current_exam_faq() : array();
$whatsapp = get_theme_mod( 'novira_whatsapp', '201090600927' );
$wa_url   = 'https://wa.me/' . preg_replace( '/\D/', '', $whatsapp );
$tpl      = get_template_directory_uri();

if ( ! is_array( $meta ) ) {
	$meta = array();
}
$hero_desc = ! empty( $meta['hero_desc'] ) ? $meta['hero_desc'] : __( 'النسخة الرقمية من اختبار SAT جزء من مسار الدبلومة الأمريكية. يستعد لها طالبك داخل حصصه الأسبوعية طوال البرنامج — لا في أسابيع قليلة قبل الموعد.', 'novira-academy' );
$cta_desc  = ! empty( $meta['consultation_desc'] ) ? $meta['consultation_desc'] : __( 'أرسل بيانات طالبك وسيتواصل معك فريقنا لمناقشة مرحلته الدراسية والخطة المناسبة للـ Digital SAT — دون أي التزام.', 'novira-academy' );
$cognia    = $tpl . '/assets/images/accreditations/cognia.avif';
$diploma_url = home_url( '/american-diploma/' );
$est_url     = home_url( '/american-diploma/est/' );
$act_url     = home_url( '/american-diploma/act/' );
?>

<div class="est-page is-sat" dir="<?php echo esc_attr( novira_document_direction() ); ?>">
	<script>document.currentScript.parentNode.classList.add('is-js');</script>
	<div class="est-progress" role="presentation" aria-hidden="true"></div>

	<?php
	get_template_part( 'template-parts/sections/premium-exam/hero', null, array(
		'badge'         => __( 'الدبلومة الأمريكية', 'novira-academy' ),
		'mark'          => 'Digital SAT',
		'sub'           => __( 'نُعِدّ طالبك ليدخله قادراً على أعلى درجة', 'novira-academy' ),
		'desc'          => $hero_desc,
		'wa_url'        => $wa_url,
		'primary_label' => __( 'ابدأ الآن', 'novira-academy' ),
		'ghost_href'    => '#prep',
		'ghost_label'   => __( 'تعرّف على طريقة الإعداد', 'novira-academy' ),
		'cognia_text'   => __( 'برنامج معتمد من Cognia', 'novira-academy' ),
		'cognia_logo'   => $cognia,
		'image'         => $tpl . '/assets/images/hero/slide-1.webp',
		'image_alt'     => __( 'طالب من نوفيرا أكاديمي أمام لوحة اعتماد Cognia', 'novira-academy' ),
		'stats_title'   => __( 'تأهيل لـ Digital SAT', 'novira-academy' ),
		'stats_sub'     => __( 'تأسيس متين واختبارات تجريبية مستمرة', 'novira-academy' ),
	) );

	get_template_part( 'template-parts/sections/premium-exam/definition', null, array(
		'anchor'         => 'about',
		'eyebrow'        => __( 'ما هو الاختبار', 'novira-academy' ),
		'title'          => __( 'ما هو اختبار Digital SAT؟', 'novira-academy' ),
		'definition'     => isset( $meta['definition'] ) ? $meta['definition'] : '',
		'purpose'        => isset( $meta['purpose'] ) ? $meta['purpose'] : '',
		'measures_label' => __( 'يقيس الاختبار', 'novira-academy' ),
		'sections'       => isset( $meta['sections'] ) && is_array( $meta['sections'] ) ? $meta['sections'] : array(),
	) );

	get_template_part( 'template-parts/sections/premium-exam/stepper', null, array(
		'anchor'  => 'prep',
		'eyebrow' => __( 'رحلة الإعداد', 'novira-academy' ),
		'title'   => __( 'من أين يبدأ طالبك؟', 'novira-academy' ),
		'desc'    => __( 'نبني معه خطة خطوة بخطوة — من التقييم المبدئي حتى يوم الاختبار.', 'novira-academy' ),
		'steps'   => array(
			array( 't' => __( 'تقييم مبدئي', 'novira-academy' ), 'd' => __( 'نحدّد مستوى طالبك الفعلي في الإنجليزية والرياضيات.', 'novira-academy' ) ),
			array( 't' => __( 'خطة دراسية', 'novira-academy' ), 'd' => __( 'خطة مخصصة مبنية على نتيجة التقييم وأهداف الطالب.', 'novira-academy' ) ),
			array( 't' => __( 'حصص أسبوعية', 'novira-academy' ), 'd' => __( 'دراسة منتظمة مع معلم متخصص طوال البرنامج.', 'novira-academy' ) ),
			array( 't' => __( 'واجبات ومتابعة', 'novira-academy' ), 'd' => __( 'تمارين تُثبّت ما يُدرَّس وتكشف الثغرات مبكراً.', 'novira-academy' ) ),
			array( 't' => __( 'اختبارات تجريبية رقمية', 'novira-academy' ), 'd' => __( 'محاكاة على النسق الرقمي نفسه ليوم الاختبار لتحديد ما يحتاج تعزيزاً.', 'novira-academy' ) ),
			array( 't' => __( 'الامتحان الرسمي وأفضل درجة', 'novira-academy' ), 'd' => __( 'يتقدّم طالبك للاختبار الرسمي، ونستمر معه لإعادته وتحسين درجته إن رغب.', 'novira-academy' ) ),
		),
	) );

	get_template_part( 'template-parts/sections/premium-exam/courses', null, array(
		'exam'      => 'digital-sat',
		'eyebrow'   => __( 'الكورسات الدراسية', 'novira-academy' ),
		'title'     => __( 'كورسات الإعداد للـ Digital SAT', 'novira-academy' ),
		'desc'      => __( 'كل كورس يبني المهارات التي يقيسها Digital SAT ضمن حصص أسبوعية منتظمة مع معلمين متخصصين — اختر ما يناسب مرحلة طالبك.', 'novira-academy' ),
		'cta_label' => __( 'اطلب الكورس', 'novira-academy' ),
		'wa_url'    => $wa_url,
	) );

	$sat_assess_msg = __( 'عايز احجز تقييم مستوى لطالبي للاستعداد لاختبار Digital SAT', 'novira-academy' );
	get_template_part( 'template-parts/sections/premium-exam/inline-cta', null, array(
		'title'         => __( 'لست متأكداً من الكورس المناسب لطالبك؟', 'novira-academy' ),
		'desc'          => __( 'يحدّد التقييم المبدئي مستوى طالبك والكورس والخطة الأنسب له.', 'novira-academy' ),
		'primary_label' => __( 'احجز تقييم مستوى', 'novira-academy' ),
		'primary_href'  => $wa_url . '?text=' . rawurlencode( $sat_assess_msg ),
	) );

	get_template_part( 'template-parts/sections/premium-exam/course-guide', null, array(
		'exam'    => 'digital-sat',
		'eyebrow' => __( 'اختيار الكورس', 'novira-academy' ),
		'title'   => __( 'أي كورس يناسب طالبك؟', 'novira-academy' ),
		'desc'    => __( 'لكل مرحلة ما يناسبها. إليك دليلاً سريعاً يربط وضع طالبك بالكورس الأنسب له.', 'novira-academy' ),
	) );

	get_template_part( 'template-parts/sections/premium-exam/why', null, array(
		'eyebrow'      => __( 'الفرق مع نوفيرا', 'novira-academy' ),
		'title'        => __( 'لماذا تختار Digital SAT مع نوفيرا؟', 'novira-academy' ),
		'desc'         => __( 'لأن درجة Digital SAT تعكس ما بناه الطالب على مدار السنوات — لا ما راجعه في أسبوع. هنا يكون الإعداد جزءاً من كل حصة.', 'novira-academy' ),
		'list'         => array(
			__( 'حصص أسبوعية مع معلمين متخصصين طوال رحلة الدبلومة', 'novira-academy' ),
			__( 'إعداد مُدمَج في البرنامج — لا مراجعة في اللحظة الأخيرة', 'novira-academy' ),
			__( 'اختبارات تجريبية على النسق الرقمي نفسه للـ Digital SAT', 'novira-academy' ),
			__( 'متابعة دورية بعد كل حصة وكل اختبار تجريبي', 'novira-academy' ),
			__( 'تواصل مستمر مع ولي الأمر حول مستوى التقدّم', 'novira-academy' ),
			__( 'دعم في التسجيل وفي إعادة الاختبار حتى أفضل نتيجة', 'novira-academy' ),
		),
		'cognia_title' => __( 'معتمدون من Cognia', 'novira-academy' ),
		'cognia_desc'  => __( 'اعتماد دولي يُثبت أن البرنامج يلتزم بمعايير الجودة التعليمية الدولية — والإعداد لاختبار Digital SAT جزء من هذا البرنامج المعتمد.', 'novira-academy' ),
		'cognia_bg'    => $tpl . '/assets/images/services/university.webp',
		'cognia_logo'  => $cognia,
	) );

	get_template_part( 'template-parts/sections/premium-exam/compare', null, array(
		'eyebrow'      => __( 'ضمن اختبارات الدبلومة', 'novira-academy' ),
		'title'        => __( 'Digital SAT بين اختبارات الدبلومة الأمريكية', 'novira-academy' ),
		'desc'         => __( 'الاختبارات الثلاثة معتمدة ضمن مسار الدبلومة، ونُعِدّ طلابنا لها جميعاً. إليك مقارنة عامة سريعة.', 'novira-academy' ),
		'trophy_title' => __( 'نتيجة أعلى، فرص أوسع', 'novira-academy' ),
		'trophy_desc'  => __( 'مهما كان الاختبار، الإعداد مستمر معك حتى أفضل نتيجة ممكنة — مع دعم إعادة الاختبار عند الحاجة.', 'novira-academy' ),
		'highlight'    => 'sat',
		'rows'         => array(
			array( 'label' => __( 'المهارات المقاسة', 'novira-academy' ), 'est' => __( 'إنجليزي + رياضيات', 'novira-academy' ), 'sat' => __( 'إنجليزي + رياضيات', 'novira-academy' ), 'act' => __( 'إنجليزي + رياضيات + علوم', 'novira-academy' ) ),
			array( 'label' => __( 'يُؤدّى رقمياً', 'novira-academy' ), 'est' => __( 'حسب الاختبار', 'novira-academy' ), 'sat' => true, 'act' => __( 'حسب الاختبار', 'novira-academy' ) ),
			array( 'label' => __( 'معتمد ضمن الدبلومة الأمريكية', 'novira-academy' ), 'est' => true, 'sat' => true, 'act' => true ),
			array( 'label' => __( 'إمكانية إعادة الاختبار لتحسين الدرجة', 'novira-academy' ), 'est' => true, 'sat' => true, 'act' => true ),
			array( 'label' => __( 'الإعداد ضمن برنامج نوفيرا', 'novira-academy' ), 'est' => true, 'sat' => true, 'act' => true ),
		),
		'note'         => __( 'للمعلومة العامة؛ تُؤكَّد التفاصيل الرسمية لكل اختبار مع فريق نوفيرا.', 'novira-academy' ),
		'links_lead'   => __( 'تعرّف أيضاً على', 'novira-academy' ),
		'links'        => array(
			array( 'label' => __( 'EST', 'novira-academy' ),               'url' => $est_url ),
			array( 'label' => __( 'ACT', 'novira-academy' ),               'url' => $act_url ),
			array( 'label' => __( 'البرنامج الأمريكي', 'novira-academy' ), 'url' => $diploma_url ),
		),
	) );

	get_template_part( 'template-parts/sections/premium-exam/parents', null, array(
		'eyebrow'   => __( 'متابعة ولي الأمر', 'novira-academy' ),
		'title'     => __( 'متابعة طالبك في صميم أولوياتنا', 'novira-academy' ),
		'desc'      => __( 'نظام متابعة مخصص لكل أب وأم — تعرف دائماً أين يقف طالبك وما الخطوة التالية.', 'novira-academy' ),
		'items'     => array(
			array( 'i' => 'pulse',   't' => __( 'متابعة دورية لمستوى الطالب', 'novira-academy' ), 'd' => __( 'يرصد المعلم ما تحسّن وما يحتاج تدريباً بعد كل حصة واختبار تجريبي.', 'novira-academy' ) ),
			array( 'i' => 'message', 't' => __( 'تواصل مستمر مع ولي الأمر', 'novira-academy' ), 'd' => __( 'لا تنتظر يوم الامتحان لتعرف أين يقف طالبك — نُبقيك على اطلاع.', 'novira-academy' ) ),
			array( 'i' => 'refresh', 't' => __( 'خطة تتكيّف مع الطالب', 'novira-academy' ), 'd' => __( 'تُعدَّل الخطة الدراسية وفق أولويات الطالب الفعلية أولاً بأول.', 'novira-academy' ) ),
		),
		'image'     => $tpl . '/assets/images/hero/slide-3.webp',
		'image_alt' => __( 'معلم نوفيرا يتابع الطلاب أثناء الدراسة', 'novira-academy' ),
	) );

	get_template_part( 'template-parts/sections/premium-exam/facts', null, array(
		'eyebrow'    => __( 'البرنامج بالأرقام', 'novira-academy' ),
		'title'      => __( 'إعداد متواصل يصنع الفرق الأكاديمي', 'novira-academy' ),
		'desc'       => __( 'ليست وعوداً بنتائج، بل طريقة عمل حقيقية يلتزم بها برنامج الدبلومة في نوفيرا.', 'novira-academy' ),
		'big_num'    => '3',
		'big_unit'   => __( 'سنوات', 'novira-academy' ),
		'big_sub'    => __( 'إعداد متواصل', 'novira-academy' ),
		'span_from'  => 'Grade 10',
		'span_to'    => 'Grade 12',
		'note'       => __( 'ثلاث سنوات من البناء الأكاديمي المتواصل — من الصف العاشر حتى يوم الامتحان، لا مراجعة في أسابيع.', 'novira-academy' ),
		'side_facts' => array(
			array( 'mark_type' => 'num',  'mark' => '3', 'title' => __( 'اختبارات دولية معتمدة', 'novira-academy' ), 'sub' => __( 'EST و Digital SAT و ACT', 'novira-academy' ) ),
			array( 'mark_type' => 'num',  'mark' => '2', 'title' => __( 'قسمان في الاختبار', 'novira-academy' ), 'sub' => __( 'القراءة والكتابة، والرياضيات', 'novira-academy' ) ),
			array( 'mark_type' => 'icon', 'mark' => 'calendar', 'title' => __( 'حصص أسبوعية', 'novira-academy' ), 'sub' => __( 'دراسة منتظمة مع معلمين متخصصين', 'novira-academy' ) ),
		),
		'rule_label' => __( 'ما يشمله الإعداد', 'novira-academy' ),
		'feats'      => array(
			array( 'i' => 'pulse',   't' => __( 'متابعة دورية لمستوى الطالب', 'novira-academy' ) ),
			array( 'i' => 'message', 't' => __( 'تواصل مستمر مع ولي الأمر', 'novira-academy' ) ),
			array( 'i' => 'target',  't' => __( 'اختبارات تجريبية قبل الامتحان', 'novira-academy' ) ),
			array( 'i' => 'file',    't' => __( 'دعم إجراءات التسجيل', 'novira-academy' ) ),
			array( 'i' => 'pin',     't' => __( 'تنسيق لوجستي عند الحاجة', 'novira-academy' ) ),
			array( 'i' => 'refresh', 't' => __( 'دعم إعادة الاختبار لتحسين الدرجة', 'novira-academy' ) ),
		),
	) );

	// Reusable learning journey — educational stages (default set; no timings).
	get_template_part( 'template-parts/sections/premium-exam/journey' );

	get_template_part( 'template-parts/sections/premium-exam/faq', null, array(
		'anchor'  => 'faq',
		'eyebrow' => __( 'أسئلة شائعة', 'novira-academy' ),
		'title'   => __( 'أسئلة يطرحها أولياء الأمور عن Digital SAT', 'novira-academy' ),
		'items'   => $faq,
	) );

	get_template_part( 'template-parts/sections/premium-exam/cta', null, array(
		'title'           => __( 'ابدأ بتقييم مستوى طالبك', 'novira-academy' ),
		'desc'            => $cta_desc,
		'wa_url'          => $wa_url,
		'primary_label'   => __( 'احجز استشارتك المجانية', 'novira-academy' ),
		'secondary_href'  => home_url( '/contact' ),
		'secondary_label' => __( 'تواصل مع الفريق', 'novira-academy' ),
	) );
	?>

</div><!-- .est-page -->

<?php get_template_part( 'template-parts/sections/premium-exam/behavior' ); ?>

<?php
get_footer();
