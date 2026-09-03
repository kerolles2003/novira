<?php
/**
 * Template: EST Exam Page (pixel-perfect redesign — Sprint 5.2.D)
 *
 * Dedicated landing page for /american-diploma/est/. EST is routed here by
 * novira_force_diploma_exam_template() in functions.php; Digital SAT and ACT
 * keep rendering through the generic page-diploma-exam.php.
 *
 * Copy is single-sourced from novira_exam_meta('est') (inc/exams.php) so the
 * approved UX writing stays in one place. Section microcopy that the data layer
 * does not model (stepper labels, checklist, feature labels) lives inline here.
 *
 * @package Novira_Academy
 */

get_header();

$meta     = function_exists( 'novira_current_exam_meta' ) ? novira_current_exam_meta() : null;
$faq      = function_exists( 'novira_current_exam_faq' ) ? novira_current_exam_faq() : array();
$whatsapp = get_theme_mod( 'novira_whatsapp', '201090600927' );
$wa_url   = 'https://wa.me/' . preg_replace( '/\D/', '', $whatsapp );
$tpl      = get_template_directory_uri();
$diploma_url = home_url( '/american-diploma/' );
$sat_url     = home_url( '/american-diploma/digital-sat/' );
$act_url     = home_url( '/american-diploma/act/' );

// Defensive fallback so the page never renders empty if data is unavailable.
if ( ! is_array( $meta ) ) {
	$meta = array();
}
$hero_desc         = isset( $meta['hero_desc'] ) && $meta['hero_desc'] ? $meta['hero_desc'] : 'درجة EST تعكس مهارات الإنجليزية والرياضيات التي يبنيها طالبك عبر سنوات الدبلومة. لهذا يبدأ الإعداد من أول حصة، ويستمر أسبوعياً مع معلمين متخصصين حتى يدخل الاختبار مستعداً فعلاً.';
$consultation_desc = isset( $meta['consultation_desc'] ) && $meta['consultation_desc'] ? $meta['consultation_desc'] : 'أرسل بيانات طالبك وسيتواصل معك فريقنا لمناقشة المرحلة المناسبة والخطة الدراسية — دون أي التزام.';

// --- Inline SVG icon library (Lucide-style line icons) ------------------------
$icon = array(
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

// Simple, recognizable US-flag accent (decorative).
$flag = '<svg class="est-hero__flag" viewBox="0 0 38 26" aria-hidden="true" xmlns="http://www.w3.org/2000/svg">'
	. '<rect width="38" height="26" fill="#fff"/>'
	. '<g fill="#B22234"><rect width="38" height="2" y="0"/><rect width="38" height="2" y="4"/><rect width="38" height="2" y="8"/><rect width="38" height="2" y="12"/><rect width="38" height="2" y="16"/><rect width="38" height="2" y="20"/><rect width="38" height="2" y="24"/></g>'
	. '<rect width="16" height="14" fill="#3C3B6E"/>'
	. '<g fill="#fff"><circle cx="3" cy="3" r="1"/><circle cx="8" cy="3" r="1"/><circle cx="13" cy="3" r="1"/><circle cx="5.5" cy="7" r="1"/><circle cx="10.5" cy="7" r="1"/><circle cx="3" cy="11" r="1"/><circle cx="8" cy="11" r="1"/><circle cx="13" cy="11" r="1"/></g>'
	. '</svg>';

// --- Section content arrays ---------------------------------------------------
$steps = array(
	array( 'i' => 'clipboard', 't' => 'تقييم مبدئي', 'd' => 'نحدّد مستوى طالبك الفعلي في الإنجليزية والرياضيات.' ),
	array( 'i' => 'route',     't' => 'خطة دراسية', 'd' => 'خطة مخصصة مبنية على نتيجة التقييم وأهداف الطالب.' ),
	array( 'i' => 'calendar',  't' => 'حصص أسبوعية', 'd' => 'دراسة منتظمة مع معلم متخصص طوال البرنامج.' ),
	array( 'i' => 'pen',       't' => 'واجبات ومتابعة', 'd' => 'تمارين تُثبّت ما يُدرَّس وتكشف الثغرات مبكراً.' ),
	array( 'i' => 'target',    't' => 'اختبارات تجريبية', 'd' => 'محاكاة ليوم الامتحان لتحديد ما يحتاج تعزيزاً.' ),
	array( 'i' => 'cap',       't' => 'الامتحان الرسمي وأفضل درجة', 'd' => 'يتقدّم طالبك للاختبار الرسمي، ونستمر معه لإعادته وتحسين درجته إن رغب.' ),
);

// WHY — the VALUE/philosophy that sets Novira apart. Progress follow-up lives
// in the Parents section and concrete prep inclusions in the Facts section, so
// no benefit is repeated across the page.
$why = array(
	'درجة EST تعكس ما بناه الطالب على مدار السنوات — لا ما راجعه في أسبوع',
	'الإعداد مُدمَج في كل حصة أسبوعية — لا مراجعة في اللحظة الأخيرة',
	'معلمون متخصصون في الإنجليزية والرياضيات طوال رحلة الدبلومة',
	'برنامج معتمد من Cognia ضمن مسار الدبلومة الأمريكية',
	'دعم مستمر لإعادة الاختبار حتى أفضل نتيجة ممكنة',
);

$parent_items = array(
	array( 'i' => 'pulse',   't' => 'متابعة دورية لمستوى الطالب', 'd' => 'يرصد المعلم ما تحسّن وما يحتاج تدريباً بعد كل حصة واختبار تجريبي.' ),
	array( 'i' => 'message', 't' => 'تواصل مستمر مع ولي الأمر', 'd' => 'لا تنتظر يوم الامتحان لتعرف أين يقف طالبك — نُبقيك على اطلاع.' ),
	array( 'i' => 'refresh', 't' => 'خطة تتكيّف مع الطالب', 'd' => 'تُعدَّل الخطة الدراسية وفق أولويات الطالب الفعلية أولاً بأول.' ),
);

$stats = array(
	array( 'n' => '3', 'l' => 'سنوات إعداد متواصل من Grade 10 إلى Grade 12' ),
	array( 'n' => '3', 'l' => 'اختبارات دولية معتمدة: EST و Digital SAT و ACT' ),
	array( 'n' => 'أسبوعية', 'l' => 'حصص منتظمة مع معلمين متخصصين' ),
	array( 'n' => 'مستمرة', 'l' => 'متابعة ودعم لإعادة الاختبار حتى أفضل نتيجة' ),
);

// FACTS/FEATURES — the concrete inclusions of the preparation itself. Parent
// follow-up (monitoring + communication) is intentionally NOT repeated here; it
// owns its own section, so this list stays about what the program delivers.
$feats = array(
	array( 'i' => 'clipboard', 't' => 'تقييم مبدئي وخطة دراسية مخصصة' ),
	array( 'i' => 'calendar',  't' => 'حصص أسبوعية مع معلمين متخصصين' ),
	array( 'i' => 'pen',       't' => 'واجبات أسبوعية تكشف الثغرات مبكراً' ),
	array( 'i' => 'target',    't' => 'اختبارات تجريبية تُحاكي يوم الامتحان' ),
	array( 'i' => 'file',      't' => 'دعم إجراءات التسجيل والمواعيد' ),
	array( 'i' => 'refresh',   't' => 'دعم إعادة الاختبار لتحسين الدرجة' ),
);

$compare = array(
	array( 'label' => 'المهارات المقاسة', 'est' => 'إنجليزي + رياضيات', 'sat' => 'إنجليزي + رياضيات', 'act' => 'إنجليزي + رياضيات + علوم' ),
	array( 'label' => 'معتمد ضمن الدبلومة الأمريكية', 'est' => true, 'sat' => true, 'act' => true ),
	array( 'label' => 'إمكانية إعادة الاختبار لتحسين الدرجة', 'est' => true, 'sat' => true, 'act' => true ),
	array( 'label' => 'الإعداد ضمن برنامج نوفيرا', 'est' => true, 'sat' => true, 'act' => true ),
	array( 'label' => 'يُقبل في الجامعات المصرية والعربية', 'est' => true, 'sat' => true, 'act' => true ),
);
$yes = '<span class="est-yes" aria-label="نعم">' . $icon['check'] . '</span>';
?>

<div class="est-page" dir="rtl">
	<script>document.currentScript.parentNode.classList.add('is-js');</script>
	<div class="est-progress" role="presentation" aria-hidden="true"></div>

	<!-- ============ S1 — HERO ============ -->
	<section class="est-hero" aria-labelledby="est-hero-title">
		<div class="est-hero__grid-overlay" aria-hidden="true"></div>
		<div class="est-wrap est-hero__grid">
			<div class="est-hero__text">
				<span class="est-hero__badge"><?php echo $icon['cap']; // phpcs:ignore ?> <?php esc_html_e( 'الدبلومة الأمريكية', 'novira-academy' ); ?></span>
				<h1 class="est-hero__title" id="est-hero-title">
					<span class="est-hero__mark">EST<i class="est-hero__stroke" aria-hidden="true"></i></span>
					<span class="est-hero__sub"><?php esc_html_e( 'نُعِدّ طالبك ليدخله قادراً على أعلى درجة', 'novira-academy' ); ?></span>
				</h1>
				<p class="est-hero__desc"><?php echo esc_html( $hero_desc ); ?></p>
				<div class="est-hero__cognia">
					<img src="<?php echo esc_url( $tpl . '/assets/images/accreditations/cognia.avif' ); ?>" alt="<?php esc_attr_e( 'اعتماد Cognia', 'novira-academy' ); ?>" width="34" height="34" loading="eager" decoding="async">
					<span><?php esc_html_e( 'برنامج معتمد من Cognia', 'novira-academy' ); ?></span>
				</div>
				<div class="est-hero__actions">
					<a class="est-btn est-btn--primary" href="<?php echo esc_url( $wa_url ); ?>" target="_blank" rel="noopener noreferrer"><?php echo $icon['whatsapp']; // phpcs:ignore ?> <?php esc_html_e( 'ابدأ الآن', 'novira-academy' ); ?></a>
					<a class="est-btn est-btn--ghost" href="#est-prep"><?php esc_html_e( 'تعرّف على طريقة الإعداد', 'novira-academy' ); ?></a>
				</div>
			</div>

			<div class="est-hero__visual">
				<div class="est-hero__visual-inner">
					<div class="est-hero__card">
						<img src="<?php echo esc_url( $tpl . '/assets/images/hero/slide-1.webp' ); ?>" alt="<?php esc_attr_e( 'طالبة من نوفيرا أكاديمي أمام لوحة اعتماد Cognia', 'novira-academy' ); ?>" width="640" height="800" loading="eager" decoding="async" fetchpriority="high">
						<span class="est-hero__card-flag" aria-hidden="true"><?php echo $flag; // phpcs:ignore ?></span>
					</div>

					<div class="est-hero__stats-card">
						<span class="est-hero__stats-icon"><?php echo $icon['target']; // phpcs:ignore ?></span>
						<div class="est-hero__stats-text">
							<b><?php esc_html_e( 'تأهيل لـ EST I & II', 'novira-academy' ); ?></b>
							<small><?php esc_html_e( 'تأسيس متين واختبارات تجريبية مستمرة', 'novira-academy' ); ?></small>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- ============ S1.5 — WHAT IS EST? (shared definition component) ============ -->
	<?php
	get_template_part( 'template-parts/sections/premium-exam/definition', null, array(
		'anchor'         => 'est-about',
		'eyebrow'        => __( 'ما هو الاختبار', 'novira-academy' ),
		'title'          => __( 'ما هو اختبار EST؟', 'novira-academy' ),
		'definition'     => isset( $meta['definition'] ) ? $meta['definition'] : '',
		'purpose'        => isset( $meta['purpose'] ) ? $meta['purpose'] : '',
		'measures_label' => __( 'يقيس الاختبار', 'novira-academy' ),
		'sections'       => isset( $meta['sections'] ) && is_array( $meta['sections'] ) ? $meta['sections'] : array(),
	) );
	?>

	<!-- ============ S2 — PROCESS STEPPER ============ -->
	<section class="est-steps" id="est-prep" aria-labelledby="est-steps-title">
		<div class="est-wrap">
			<div class="est-section-head est-reveal">
				<span class="est-eyebrow"><?php echo $icon['route']; // phpcs:ignore ?> <?php esc_html_e( 'رحلة الإعداد', 'novira-academy' ); ?></span>
				<h2 id="est-steps-title"><?php esc_html_e( 'من أين يبدأ طالبك؟', 'novira-academy' ); ?></h2>
				<p><?php esc_html_e( 'نبني معه خطة خطوة بخطوة — من التقييم المبدئي حتى يوم الاختبار.', 'novira-academy' ); ?></p>
			</div>
			<ol class="est-steps__track">
				<?php foreach ( $steps as $n => $s ) : ?>
					<li class="est-step est-reveal">
						<span class="est-step__node"><b><?php echo esc_html( $n + 1 ); ?></b></span>
						<div class="est-step__card">
							<h4><?php echo esc_html( $s['t'] ); ?></h4>
							<p><?php echo esc_html( $s['d'] ); ?></p>
						</div>
					</li>
				<?php endforeach; ?>
			</ol>
		</div>
	</section>

	<!-- ============ S2.5 — COURSES CATALOG ============ -->
	<?php
	get_template_part( 'template-parts/sections/premium-exam/courses', null, array(
		'exam'      => 'est',
		'eyebrow'   => __( 'الكورسات الدراسية', 'novira-academy' ),
		'title'     => __( 'كورسات الإعداد لاختبار EST', 'novira-academy' ),
		'desc'      => __( 'كل كورس يبني المهارات التي يقيسها EST ضمن حصص أسبوعية منتظمة مع معلمين متخصصين — اختر ما يناسب مرحلة طالبك.', 'novira-academy' ),
		'cta_label' => __( 'اطلب الكورس', 'novira-academy' ),
		'wa_url'    => $wa_url,
	) );

	// Contextual CTA immediately after the catalog — catches the parent who
	// isn't sure which course fits, before the guidance section.
	$assess_msg = __( 'عايز احجز تقييم مستوى لطالبي للاستعداد لاختبار EST', 'novira-academy' );
	get_template_part( 'template-parts/sections/premium-exam/inline-cta', null, array(
		'title'         => __( 'لست متأكداً من الكورس المناسب لطالبك؟', 'novira-academy' ),
		'desc'          => __( 'يحدّد التقييم المبدئي مستوى طالبك والكورس والخطة الأنسب له.', 'novira-academy' ),
		'primary_label' => __( 'احجز تقييم مستوى', 'novira-academy' ),
		'primary_href'  => $wa_url . '?text=' . rawurlencode( $assess_msg ),
	) );

	// "Which course is right for my child?" — data-driven matcher (item 1) with
	// the duration-depends-on-assessment clarification (item 4).
	get_template_part( 'template-parts/sections/premium-exam/course-guide', null, array(
		'exam'    => 'est',
		'eyebrow' => __( 'اختيار الكورس', 'novira-academy' ),
		'title'   => __( 'أي كورس يناسب طالبك؟', 'novira-academy' ),
		'desc'    => __( 'لكل مرحلة ما يناسبها. إليك دليلاً سريعاً يربط وضع طالبك بالكورس الأنسب له.', 'novira-academy' ),
	) );
	?>

	<!-- ============ S3 — WHY EST WITH NOVIRA ============ -->
	<section class="est-why" aria-labelledby="est-why-title">
		<div class="est-wrap est-why__grid">
			<div class="est-why__head est-reveal">
				<span class="est-eyebrow"><?php echo $icon['star']; // phpcs:ignore ?> <?php esc_html_e( 'الفرق مع نوفيرا', 'novira-academy' ); ?></span>
				<h2 id="est-why-title"><?php esc_html_e( 'لماذا تختار EST مع نوفيرا؟', 'novira-academy' ); ?></h2>
				<p><?php esc_html_e( 'لأن درجة EST تعكس ما بناه الطالب على مدار السنوات — لا ما راجعه في أسبوع. هنا يكون الإعداد جزءاً من كل حصة.', 'novira-academy' ); ?></p>
				<ul class="est-why__list">
					<?php foreach ( $why as $item ) : ?>
						<li><span class="est-check"><?php echo $icon['check']; // phpcs:ignore ?></span><?php echo esc_html( $item ); ?></li>
					<?php endforeach; ?>
				</ul>
			</div>

			<div class="est-cognia est-reveal est-reveal--scale">
				<img class="est-cognia__bg" src="<?php echo esc_url( $tpl . '/assets/images/services/university.webp' ); ?>" alt="" aria-hidden="true" width="700" height="360" loading="lazy" decoding="async">
				<?php echo str_replace( 'est-hero__flag', 'est-cognia__flag', $flag ); // phpcs:ignore ?>
				<div class="est-cognia__body">
					<span class="est-cognia__seal">
						<img src="<?php echo esc_url( $tpl . '/assets/images/accreditations/cognia.avif' ); ?>" alt="<?php esc_attr_e( 'اعتماد Cognia', 'novira-academy' ); ?>" width="44" height="44" loading="lazy" decoding="async">
					</span>
					<h3><?php esc_html_e( 'معتمدون من Cognia', 'novira-academy' ); ?></h3>
					<p><?php esc_html_e( 'اعتماد دولي يُثبت أن البرنامج يلتزم بمعايير الجودة التعليمية الدولية — والإعداد لاختبار EST جزء من هذا البرنامج المعتمد.', 'novira-academy' ); ?></p>
				</div>
			</div>
		</div>
	</section>

	<!-- ============ S4 — COMPARISON TABLE ============ -->
	<section class="est-compare" aria-labelledby="est-compare-title">
		<div class="est-wrap">
			<div class="est-section-head est-reveal">
				<span class="est-eyebrow"><?php echo $icon['target']; // phpcs:ignore ?> <?php esc_html_e( 'ضمن اختبارات الدبلومة', 'novira-academy' ); ?></span>
				<h2 id="est-compare-title"><?php esc_html_e( 'EST بين اختبارات الدبلومة الأمريكية', 'novira-academy' ); ?></h2>
				<p><?php esc_html_e( 'الاختبارات الثلاثة معتمدة ضمن مسار الدبلومة، ونُعِدّ طلابنا لها جميعاً. إليك مقارنة عامة سريعة.', 'novira-academy' ); ?></p>
			</div>

			<div class="est-compare__layout">
				<div class="est-trophy est-reveal">
					<div class="est-trophy__icon"><?php echo $icon['trophy']; // phpcs:ignore ?></div>
					<h3><?php esc_html_e( 'نتيجة أعلى، فرص أوسع', 'novira-academy' ); ?></h3>
					<p><?php esc_html_e( 'مهما كان الاختبار، الإعداد مستمر معك حتى أفضل نتيجة ممكنة — مع دعم إعادة الاختبار عند الحاجة.', 'novira-academy' ); ?></p>
				</div>

				<div class="est-table est-reveal est-reveal--scale">
					<div class="est-table__inner">
						<div class="est-table__row est-table__head">
							<div class="est-table__cell est-table__cell--label"><?php esc_html_e( 'المعيار', 'novira-academy' ); ?></div>
							<div class="est-table__cell est-table__col-est">EST</div>
							<div class="est-table__cell">Digital SAT</div>
							<div class="est-table__cell">ACT</div>
						</div>
						<?php foreach ( $compare as $row ) : ?>
							<div class="est-table__row">
								<div class="est-table__cell est-table__cell--label"><?php echo esc_html( $row['label'] ); ?></div>
								<div class="est-table__cell est-table__col-est"><?php echo ( true === $row['est'] ) ? $yes : esc_html( $row['est'] ); // phpcs:ignore ?></div>
								<div class="est-table__cell"><?php echo ( true === $row['sat'] ) ? $yes : esc_html( $row['sat'] ); // phpcs:ignore ?></div>
								<div class="est-table__cell"><?php echo ( true === $row['act'] ) ? $yes : esc_html( $row['act'] ); // phpcs:ignore ?></div>
							</div>
						<?php endforeach; ?>
					</div>
				</div>
			</div>
			<p class="est-table__note"><?php esc_html_e( 'للمعلومة العامة؛ تُؤكَّد التفاصيل الرسمية لكل اختبار مع فريق نوفيرا.', 'novira-academy' ); ?></p>
			<p class="est-related-links est-reveal">
				<?php
				// Same lead + separated format the shared compare component emits on
				// the SAT/ACT spokes, so the cross-exam links read identically cluster-wide.
				esc_html_e( 'تعرّف أيضاً على', 'novira-academy' );
				echo ' ';
				$est_links = array(
					'<a href="' . esc_url( $sat_url ) . '">' . esc_html__( 'Digital SAT', 'novira-academy' ) . '</a>',
					'<a href="' . esc_url( $act_url ) . '">' . esc_html__( 'ACT', 'novira-academy' ) . '</a>',
					'<a href="' . esc_url( $diploma_url ) . '">' . esc_html__( 'البرنامج الأمريكي', 'novira-academy' ) . '</a>',
				);
				echo implode( '<span class="est-related-links__sep"> · </span>', $est_links ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- links pre-escaped above.
				?>
			</p>
		</div>
	</section>

	<!-- ============ S5 — PARENT FOLLOW-UP ============ -->
	<section class="est-parents" aria-labelledby="est-parents-title">
		<div class="est-wrap est-parents__grid">
			<div class="est-parents__head est-reveal">
				<span class="est-eyebrow"><?php echo $icon['message']; // phpcs:ignore ?> <?php esc_html_e( 'متابعة ولي الأمر', 'novira-academy' ); ?></span>
				<h2 id="est-parents-title"><?php esc_html_e( 'متابعة طالبك في صميم أولوياتنا', 'novira-academy' ); ?></h2>
				<p><?php esc_html_e( 'نظام متابعة مخصص لكل أب وأم — تعرف دائماً أين يقف طالبك وما الخطوة التالية.', 'novira-academy' ); ?></p>
				<ul class="est-parents__list">
					<?php foreach ( $parent_items as $p ) : ?>
						<li class="est-feature-row">
							<span class="est-feature-row__icon"><?php echo $icon[ $p['i'] ]; // phpcs:ignore ?></span>
							<div>
								<h4><?php echo esc_html( $p['t'] ); ?></h4>
								<p><?php echo esc_html( $p['d'] ); ?></p>
							</div>
						</li>
					<?php endforeach; ?>
				</ul>
			</div>

			<div class="est-parents__visual est-reveal est-reveal--scale">
				<img src="<?php echo esc_url( $tpl . '/assets/images/hero/slide-3.webp' ); ?>" alt="<?php esc_attr_e( 'معلم نوفيرا يتابع الطلاب أثناء الدراسة', 'novira-academy' ); ?>" width="640" height="512" loading="lazy" decoding="async">
			</div>
		</div>
	</section>

	<!-- ============ S6 — PROGRAM FACTS + FEATURES ============ -->
	<section class="est-results" aria-labelledby="est-results-title">
		<div class="est-wrap">
			<div class="est-section-head est-reveal">
				<span class="est-eyebrow"><?php echo $icon['cap']; // phpcs:ignore ?> <?php esc_html_e( 'البرنامج بالأرقام', 'novira-academy' ); ?></span>
				<h2 id="est-results-title"><?php esc_html_e( 'إعداد متواصل يصنع الفرق الأكاديمي', 'novira-academy' ); ?></h2>
				<p><?php esc_html_e( 'ليست وعوداً بنتائج، بل طريقة عمل حقيقية يلتزم بها برنامج الدبلومة في نوفيرا.', 'novira-academy' ); ?></p>
			</div>

				<div class="est-ledger">
					<article class="est-ledger__hero est-reveal est-reveal--scale">
						<div class="est-ledger__headline">
							<span class="est-stat__num est-ledger__big" data-count="3">3</span>
							<span class="est-ledger__unit"><?php esc_html_e( 'سنوات', 'novira-academy' ); ?><small><?php esc_html_e( 'إعداد متواصل', 'novira-academy' ); ?></small></span>
						</div>
						<div class="est-span" aria-hidden="true">
							<span class="est-span__cap">Grade 10</span>
							<span class="est-span__track"><span class="est-span__fill"><span class="est-span__dot"></span></span></span>
							<span class="est-span__cap">Grade 12</span>
						</div>
						<p class="est-ledger__note"><?php esc_html_e( 'ثلاث سنوات من البناء الأكاديمي المتواصل — من الصف العاشر حتى يوم الامتحان، لا مراجعة في أسابيع.', 'novira-academy' ); ?></p>
					</article>
					<div class="est-ledger__side">
						<article class="est-fact est-reveal">
							<span class="est-fact__mark"><span class="est-stat__num" data-count="3">3</span></span>
							<span class="est-fact__body">
								<b><?php esc_html_e( 'اختبارات دولية معتمدة', 'novira-academy' ); ?></b>
								<span><?php esc_html_e( 'EST و Digital SAT و ACT', 'novira-academy' ); ?></span>
							</span>
						</article>
						<article class="est-fact est-reveal">
							<span class="est-fact__mark est-fact__mark--icon"><?php echo $icon['calendar']; // phpcs:ignore ?></span>
							<span class="est-fact__body">
								<b><?php esc_html_e( 'حصص أسبوعية', 'novira-academy' ); ?></b>
								<span><?php esc_html_e( 'دراسة منتظمة مع معلمين متخصصين', 'novira-academy' ); ?></span>
							</span>
						</article>
						<article class="est-fact est-reveal">
							<span class="est-fact__mark est-fact__mark--icon"><?php echo $icon['pulse']; // phpcs:ignore ?></span>
							<span class="est-fact__body">
								<b><?php esc_html_e( 'متابعة مستمرة', 'novira-academy' ); ?></b>
								<span><?php esc_html_e( 'دعم وإعادة اختبار حتى أفضل نتيجة', 'novira-academy' ); ?></span>
							</span>
						</article>
					</div>
				</div>

				<div class="est-results__rule est-reveal"><span><?php esc_html_e( 'ما يشمله الإعداد', 'novira-academy' ); ?></span></div>

			<div class="est-feats">
				<?php foreach ( $feats as $f ) : ?>
					<div class="est-feat est-reveal">
						<span class="est-feat__icon"><?php echo $icon[ $f['i'] ]; // phpcs:ignore ?></span>
						<span><?php echo esc_html( $f['t'] ); ?></span>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

	<!-- ============ S6.3 — LEARNING JOURNEY (shared component; educational stages) ============ -->
	<?php
	// Reusable learning journey — the student's educational arc from assessment
	// to the official exam (default stages; educational only, no timings).
	get_template_part( 'template-parts/sections/premium-exam/journey' );
	?>

	<!-- ============ S6.5 — FAQ (shared component; back-ported to EST) ============ -->
	<?php
	get_template_part( 'template-parts/sections/premium-exam/faq', null, array(
		'anchor'  => 'est-faq',
		'eyebrow' => __( 'أسئلة شائعة', 'novira-academy' ),
		'title'   => __( 'أسئلة يطرحها أولياء الأمور عن EST', 'novira-academy' ),
		'items'   => $faq,
	) );
	?>

	<!-- ============ S7 — CTA ============ -->
	<section class="est-cta" aria-labelledby="est-cta-title">
		<div class="est-wrap">
			<div class="est-cta__panel est-reveal est-reveal--scale">
				<h2 id="est-cta-title"><?php esc_html_e( 'ابدأ بتقييم مستوى طالبك', 'novira-academy' ); ?></h2>
				<p><?php echo esc_html( $consultation_desc ); ?></p>
				<div class="est-cta__actions">
					<a class="est-btn est-btn--light" href="<?php echo esc_url( $wa_url ); ?>" target="_blank" rel="noopener noreferrer"><?php echo $icon['whatsapp']; // phpcs:ignore ?> <?php esc_html_e( 'احجز استشارتك المجانية', 'novira-academy' ); ?></a>
					<a class="est-btn est-btn--outline-light" href="<?php echo esc_url( home_url( '/contact' ) ); ?>"><?php esc_html_e( 'تواصل مع الفريق', 'novira-academy' ); ?></a>
				</div>
			</div>
		</div>
	</section>

</div><!-- .est-page -->

<script>
( function () {
	var page = document.querySelector( '.est-page' );
	if ( ! page ) { return; }
	var reduce = window.matchMedia && window.matchMedia( '(prefers-reduced-motion: reduce)' ).matches;

	// Scroll progress bar.
	var bar = page.querySelector( '.est-progress' );
	if ( bar && ! reduce ) {
		var ticking = false;
		var update = function () {
			var doc = document.documentElement;
			var max = ( doc.scrollHeight - doc.clientHeight ) || 1;
			var p = Math.min( 1, Math.max( 0, ( window.scrollY || doc.scrollTop ) / max ) );
			bar.style.transform = 'scaleX(' + p + ')';
			ticking = false;
		};
		window.addEventListener( 'scroll', function () {
			if ( ! ticking ) { ticking = true; requestAnimationFrame( update ); }
		}, { passive: true } );
		update();
	}

	// Count-up for real numeric facts.
	var countUp = function ( el ) {
		var target = parseFloat( el.getAttribute( 'data-count' ) );
		if ( isNaN( target ) ) { return; }
		if ( reduce ) { el.textContent = String( target ); return; }
		var dur = 1100, start = null;
		el.textContent = '0';
		var step = function ( ts ) {
			if ( ! start ) { start = ts; }
			var t = Math.min( 1, ( ts - start ) / dur );
			var eased = 1 - Math.pow( 1 - t, 3 );
			el.textContent = String( Math.round( target * eased ) );
			if ( t < 1 ) { requestAnimationFrame( step ); } else { el.textContent = String( target ); }
		};
		requestAnimationFrame( step );
	};

	var reveals = page.querySelectorAll( '.est-reveal' );
	var track = page.querySelector( '.est-steps__track' );

	if ( reduce || ! ( 'IntersectionObserver' in window ) ) {
		reveals.forEach( function ( el ) { el.classList.add( 'is-in' ); } );
		if ( track ) { track.classList.add( 'is-in' ); }
		page.querySelectorAll( '.est-stat__num[data-count]' ).forEach( function ( el ) {
			el.textContent = el.getAttribute( 'data-count' );
		} );
		return;
	}

	// Stagger indices within sequence groups (steps, stats, features).
	page.querySelectorAll( '.est-steps__track, .est-stats, .est-feats' ).forEach( function ( group ) {
		Array.prototype.forEach.call( group.children, function ( child, idx ) {
			if ( child.classList.contains( 'est-reveal' ) ) { child.dataset.i = idx; }
		} );
	} );

	var io = new IntersectionObserver( function ( entries ) {
		entries.forEach( function ( e ) {
			if ( ! e.isIntersecting ) { return; }
			var el = e.target;
			el.style.transitionDelay = ( Math.min( el.dataset.i || 0, 5 ) * 80 ) + 'ms';
			el.classList.add( 'is-in' );
			var num = el.querySelector ? el.querySelector( '.est-stat__num[data-count]' ) : null;
			if ( num ) { countUp( num ); }
			io.unobserve( el );
		} );
	}, { threshold: 0.12, rootMargin: '0px 0px -40px 0px' } );
	reveals.forEach( function ( el ) { io.observe( el ); } );

	// Signature: draw the journey rail when the stepper enters view.
	if ( track ) {
		var tio = new IntersectionObserver( function ( entries ) {
			entries.forEach( function ( e ) {
				if ( e.isIntersecting ) { track.classList.add( 'is-in' ); tio.unobserve( track ); }
			} );
		}, { threshold: 0.3 } );
		tio.observe( track );
	}
} )();
</script>

<?php
get_footer();
