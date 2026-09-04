<?php
/**
 * Template: American Diploma Hub (flagship) — Pixel-Perfect Landing
 *
 * Self-contained marketing landing page for /american-diploma/. Renders the
 * full hero → what-is → why → founder → Cognia → journey → overview →
 * student case → steps → FAQ → CTA flow that matches the approved design.
 *
 * Loads automatically for the page with slug "american-diploma"
 * (see novira_force_diploma_hub_template() in functions.php). Styles live in
 * assets/css/american-diploma.css, enqueued conditionally for this page.
 *
 * @package Novira_Academy
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

$adp_uri      = get_template_directory_uri();
$adp_whatsapp = get_theme_mod( 'novira_whatsapp', '201090600927' );
$adp_wa_url   = 'https://wa.me/' . $adp_whatsapp;
$adp_contact  = home_url( '/contact' );

// Inline American-flag SVG, reused across the page.
$adp_flag = '<svg viewBox="0 0 76 50" width="100%" height="100%" preserveAspectRatio="none" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"><rect width="76" height="50" fill="#fff"/><g fill="#B22234"><rect width="76" height="3.85" y="0"/><rect width="76" height="3.85" y="7.7"/><rect width="76" height="3.85" y="15.4"/><rect width="76" height="3.85" y="23.1"/><rect width="76" height="3.85" y="30.8"/><rect width="76" height="3.85" y="38.5"/><rect width="76" height="3.85" y="46.2"/></g><rect width="32" height="27" fill="#3C3B6E"/></svg>';
?>

<div class="adp">

	<!-- =====================================================
	     1. HERO
	     ===================================================== -->
	<section class="adp-hero" aria-label="<?php esc_attr_e( 'الدبلومة الأمريكية', 'novira-academy' ); ?>">
		<div class="adp-container adp-hero__grid">
			<div class="adp-hero__copy reveal">
				<h1 class="adp-hero__title">
					<?php esc_html_e( 'الدبلومة الأمريكية', 'novira-academy' ); ?>
					<span class="hl"><?php esc_html_e( 'الاستعداد للامتحان الدولي يستغرق سنوات — ليس أسابيع', 'novira-academy' ); ?></span>
				</h1>
				<p class="adp-hero__desc">
					<?php esc_html_e( 'برنامج الدبلومة الأمريكية يُرافق طالبك من Grade 10 حتى يوم الامتحان. حصص أسبوعية مع معلمين متخصصين، متابعة أكاديمية دورية، واختبارات تجريبية لقياس التقدم — حتى تكون دائماً على اطلاع بمستواه.', 'novira-academy' ); ?>
				</p>

				<div class="adp-hero__chips">
					<span class="adp-chip">
						<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 10v6M2 10l10-5 10 5-10 5z"/><path d="M6 12v5c3 3 9 3 12 0v-5"/></svg>
						<?php esc_html_e( 'معلمون متخصصون', 'novira-academy' ); ?>
					</span>
					<span class="adp-chip">
						<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/></svg>
						<?php esc_html_e( 'متابعة شخصية', 'novira-academy' ); ?>
					</span>
					<span class="adp-chip">
						<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="8" r="6"/><path d="M9 13.5V22l3-1.5L15 22v-8.5"/></svg>
						<?php esc_html_e( 'اعتماد دولي', 'novira-academy' ); ?>
					</span>
				</div>

				<div class="adp-hero__actions">
					<a class="adp-btn adp-btn--primary" href="<?php echo esc_url( $adp_wa_url ); ?>" target="_blank" rel="noopener noreferrer">
						<?php esc_html_e( 'اكتشف البرنامج', 'novira-academy' ); ?>
					</a>
					<a class="adp-btn adp-btn--ghost" href="#adp-overview"><?php esc_html_e( 'تعرّف على البرنامج', 'novira-academy' ); ?></a>
				</div>
			</div>

			<div class="adp-hero__visual reveal">
				<span class="adp-hero__blob adp-hero__blob--a"></span>
				<span class="adp-hero__blob adp-hero__blob--b"></span>
				<div class="adp-hero__card">
					<img class="bg" src="<?php echo esc_url( $adp_uri . '/assets/images/services/university.webp' ); ?>" alt="" loading="eager" decoding="async">
					<span class="adp-hero__cap" aria-hidden="true"><svg viewBox="0 0 64 48" fill="currentColor" xmlns="http://www.w3.org/2000/svg"><path d="M32 2 1 16l31 14 24-10.84V34h5V16L32 2z"/><path d="M12 27.5V37c0 4.2 9 7 20 7s20-2.8 20-7v-9.5l-20 9-20-9z"/></svg></span>
					<span class="adp-hero__flag"><?php echo $adp_flag; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
					<span class="adp-hero__badge">
						<img src="<?php echo esc_url( $adp_uri . '/assets/images/accreditations/cognia.avif' ); ?>" alt="Cognia">
						<span><?php esc_html_e( 'معتمدة دولياً', 'novira-academy' ); ?></span>
					</span>
				</div>
			</div>
		</div>
		<div class="adp-hero__strip">
			<div class="adp-hero__stat">
				<span class="adp-hero__stat-num">Cognia</span>
				<span class="adp-hero__stat-label"><?php esc_html_e( 'اعتماد دولي', 'novira-academy' ); ?></span>
			</div>
			<div class="adp-hero__stat">
				<span class="adp-hero__stat-num"><?php esc_html_e( 'حصص أسبوعية', 'novira-academy' ); ?></span>
				<span class="adp-hero__stat-label"><?php esc_html_e( 'مع معلمين متخصصين', 'novira-academy' ); ?></span>
			</div>
			<div class="adp-hero__stat">
				<span class="adp-hero__stat-num">10 – 12</span>
				<span class="adp-hero__stat-label"><?php esc_html_e( 'المرحلة الدراسية', 'novira-academy' ); ?></span>
			</div>
		</div>
	</section>

	<!-- =====================================================
	     2. WHAT IS THE AMERICAN DIPLOMA
	     ===================================================== -->
	<section class="adp-whatis" aria-label="<?php esc_attr_e( 'ما هي الدبلومة الأمريكية؟', 'novira-academy' ); ?>">
		<div class="adp-container adp-whatis__grid">
			<div class="adp-whatis__media reveal">
				<img class="bg" src="<?php echo esc_url( $adp_uri . '/assets/images/services/university.webp' ); ?>" alt="<?php esc_attr_e( 'حرم جامعي', 'novira-academy' ); ?>" loading="lazy" decoding="async">
				<span class="adp-whatis__flag"><?php echo $adp_flag; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
				<span class="adp-whatis__cognia">
					<img src="<?php echo esc_url( $adp_uri . '/assets/images/accreditations/cognia.avif' ); ?>" alt="Cognia">
					<span><?php esc_html_e( 'اعتماد دولي للجودة', 'novira-academy' ); ?></span>
				</span>
			</div>

			<div class="adp-whatis__copy reveal">
				<span class="adp-eyebrow"><?php esc_html_e( 'تعريف', 'novira-academy' ); ?></span>
				<h2 class="adp-title"><?php esc_html_e( 'ما هي الدبلومة الأمريكية؟', 'novira-academy' ); ?></h2>
				<p><?php esc_html_e( 'برنامج تعليمي أكاديمي مدته ثلاث سنوات (Grade 10 – Grade 12)، يُدرَّس كاملاً باللغة الإنجليزية. يشمل دراسة المواد الأكاديمية وفق المنهج الأمريكي، مع تحضير موجَّه لاختبارات EST و Digital SAT و ACT. الشهادة معتمدة من Cognia وموثّقة لدى الجامعات الأمريكية والدولية وفق متطلبات كل جامعة.', 'novira-academy' ); ?></p>
				<ul class="adp-checklist">
					<?php
					$adp_points = array(
						__( 'تعليم معتمد أمريكياً', 'novira-academy' ),
						__( 'اعتماد دولي من Cognia', 'novira-academy' ),
						__( 'مرونة في طريقة الدراسة', 'novira-academy' ),
						__( 'تحضير لاختبارات EST و Digital SAT و ACT', 'novira-academy' ),
						__( 'إرشاد في خطوات التقديم الجامعي', 'novira-academy' ),
					);
					foreach ( $adp_points as $adp_point ) :
						?>
						<li>
							<span class="tick"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg></span>
							<?php echo esc_html( $adp_point ); ?>
						</li>
					<?php endforeach; ?>
				</ul>
			</div>
		</div>
	</section>

	<!-- =====================================================
	     3. WHY FAMILIES CHOOSE THIS PATH
	     ===================================================== -->
	<section class="adp-why" aria-label="<?php esc_attr_e( 'لماذا تختار بعض الأسر هذا المسار؟', 'novira-academy' ); ?>">
		<div class="adp-container">
			<div class="adp-head reveal">
				<span class="adp-eyebrow"><?php esc_html_e( 'المسار', 'novira-academy' ); ?></span>
				<h2 class="adp-title"><?php esc_html_e( 'لماذا تختار نوفيرا لإعداد طالبك؟', 'novira-academy' ); ?></h2>
				<p class="adp-sub"><?php esc_html_e( 'لأن كل سؤال يسأله الأهل — لدينا إجابة حقيقية عليه.', 'novira-academy' ); ?></p>
			</div>
			<div class="adp-cardrow reveal">
				<?php
				$adp_reasons = array(
					array( 'title' => __( 'إعداد أكاديمي يبني على نفسه', 'novira-academy' ), 'text' => __( 'منهج متدرج يُعزز المهارات من Grade 10 إلى Grade 12 — كل مرحلة تبني على التي سبقتها.', 'novira-academy' ),
						'icon' => '<path d="M22 10v6M2 10l10-5 10 5-10 5z"/><path d="M6 12v5c3 3 9 3 12 0v-5"/>' ),
					array( 'title' => __( 'شهادة Cognia معترف بها دولياً', 'novira-academy' ), 'text' => __( 'الشهادة معتمدة من Cognia وموثّقة لدى الجامعات الأمريكية والدولية وفق متطلبات كل جامعة.', 'novira-academy' ),
						'icon' => '<path d="M22 10v6M2 10l10-5 10 5-10 5z"/><path d="M6 12v5c3 3 9 3 12 0v-5"/>' ),
					array( 'title' => __( 'يدخل الامتحان وهو يعرف ما يتوقعه', 'novira-academy' ), 'text' => __( 'اختبارات تجريبية منتظمة تُقيّم الأداء وتُعرِّف الطالب على بيئة الامتحان — حتى لا يكون يوم الامتحان الرسمي هو المرة الأولى.', 'novira-academy' ),
						'icon' => '<circle cx="12" cy="7" r="4"/><path d="M5.5 21a6.5 6.5 0 0 1 13 0"/>' ),
					array( 'title' => __( 'متابعة دورية وأنت دائماً على اطلاع', 'novira-academy' ), 'text' => __( 'معلمون متخصصون يتابعون مستوى الطالب أسبوعياً — قبل أن تتراكم الثغرات وتصبح مشكلة.', 'novira-academy' ),
						'icon' => '<polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/>' ),
					array( 'title' => __( 'لا تحتاج لمعرفة الإجراءات — نحن نتولاها', 'novira-academy' ), 'text' => __( 'التسجيل للاختبار، ترتيب الموعد، والتنسيق اللوجستي — نُرافق الطالب حتى يجلس في قاعة الاختبار.', 'novira-academy' ),
						'icon' => '<path d="M3 17l6-6 4 4 8-8"/><path d="M21 7v5h-5"/>' ),
				);
				foreach ( $adp_reasons as $adp_reason ) :
					?>
					<article class="adp-vcard">
						<span class="adp-vcard__icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><?php echo $adp_reason['icon']; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></svg></span>
						<h3><?php echo esc_html( $adp_reason['title'] ); ?></h3>
						<p><?php echo esc_html( $adp_reason['text'] ); ?></p>
					</article>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

	<!-- =====================================================
	     3.5 - EXAM GATEWAY (Hub-and-Spoke navigation)
	     ===================================================== -->
	<section class="adp-exams" aria-label="<?php esc_attr_e( 'اختبارات الدبلومة الأمريكية', 'novira-academy' ); ?>">
		<div class="adp-container">
			<div class="adp-head reveal">
				<span class="adp-eyebrow"><?php esc_html_e( 'مسارات الإعداد', 'novira-academy' ); ?></span>
				<h2 class="adp-title"><?php esc_html_e( 'اختبارات الدبلومة الأمريكية', 'novira-academy' ); ?></h2>
				<p class="adp-sub"><?php esc_html_e( 'اختر الاختبار الذي يناسب مسار ابنك الأكاديمي', 'novira-academy' ); ?></p>
			</div>
			<div class="adp-exams__row">
				<?php
				$adp_exams = array(
					array(
						'name'     => 'EST',
						'desc'     => __( 'اختبار أساسي ضمن مسار الدبلومة الأمريكية يقيس الاستعداد الأكاديمي في القراءة والكتابة والرياضيات.', 'novira-academy' ),
						'icon'     => '<path d="M12 20h9"/><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"/>',
						'measures' => array( __( 'القراءة', 'novira-academy' ), __( 'الكتابة', 'novira-academy' ), __( 'الرياضيات', 'novira-academy' ) ),
						'href'     => home_url( '/american-diploma/est/' ),
					),
					array(
						'name'     => 'Digital SAT',
						'desc'     => __( 'النسخة الرقمية من اختبار SAT مع إعداد أكاديمي منظم ومتابعة شاملة حتى يوم الاختبار.', 'novira-academy' ),
						'icon'     => '<rect x="2" y="3" width="20" height="14" rx="2"/><line x1="8" y1="21" x2="16" y2="21"/><line x1="12" y1="17" x2="12" y2="21"/>',
						'measures' => array( __( 'اختبار رقمي', 'novira-academy' ), __( 'القراءة والكتابة', 'novira-academy' ), __( 'الرياضيات', 'novira-academy' ) ),
						'href'     => home_url( '/american-diploma/digital-sat/' ),
					),
					array(
						'name'     => 'ACT',
						'desc'     => __( 'اختبار دولي معتمد يقيس المهارات الأكاديمية في الإنجليزية والرياضيات والعلوم والكتابة.', 'novira-academy' ),
						'icon'     => '<path d="M12 2L2 7l10 5 10-5-10-5z"/><path d="M2 17l10 5 10-5"/><path d="M2 12l10 5 10-5"/>',
						'measures' => array( __( 'الإنجليزية', 'novira-academy' ), __( 'الرياضيات', 'novira-academy' ), __( 'العلوم', 'novira-academy' ), __( 'الكتابة', 'novira-academy' ) ),
						'href'     => home_url( '/american-diploma/act/' ),
					),
				);
				foreach ( $adp_exams as $adp_ex ) :
					?>
						<article class="adp-exam-card">
							<a href="<?php echo esc_url( $adp_ex['href'] ); ?>" class="adp-exam-card__overlay" aria-hidden="true" tabindex="-1"></a>
							<span class="adp-exam-card__icon" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><?php echo $adp_ex['icon']; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></svg></span>
							<h3 class="adp-exam-card__name"><?php echo esc_html( $adp_ex['name'] ); ?></h3>
							<span class="adp-exam-card__rule" aria-hidden="true"></span>
							<p class="adp-exam-card__desc"><?php echo esc_html( $adp_ex['desc'] ); ?></p>
							<ul class="adp-exam-card__measures" aria-label="<?php esc_attr_e( 'المهارات التي يقيسها الاختبار', 'novira-academy' ); ?>">
								<?php foreach ( $adp_ex['measures'] as $adp_m ) : ?>
									<li><?php echo esc_html( $adp_m ); ?></li>
								<?php endforeach; ?>
							</ul>
							<a href="<?php echo esc_url( $adp_ex['href'] ); ?>"
								class="adp-exam-card__cta"
								aria-label="<?php echo esc_attr( sprintf( __( 'اعرف المزيد عن %s', 'novira-academy' ), $adp_ex['name'] ) ); ?>">
								<?php esc_html_e( 'اعرف المزيد', 'novira-academy' ); ?>
								<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><line x1="19" y1="12" x2="5" y2="12"/><polyline points="11 6 5 12 11 18"/></svg>
							</a>
						</article>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

	<!-- =====================================================
	     4. FOUNDER BANNER
	     ===================================================== -->
	<section class="adp-founder" aria-label="<?php esc_attr_e( 'بقيادة الخبير يوسف زكي', 'novira-academy' ); ?>">
		<div class="adp-container">
			<div class="adp-founder__inner reveal">
				<div class="adp-founder__copy">
					<span class="adp-founder__label"><?php esc_html_e( 'بقيادة الخبير', 'novira-academy' ); ?></span>
					<h2 class="adp-founder__name"><?php esc_html_e( 'يوسف زكي', 'novira-academy' ); ?></h2>
					<p class="adp-founder__role"><?php esc_html_e( 'مؤسس نوفيرا أكاديمي وخبير الدبلومة الأمريكية', 'novira-academy' ); ?></p>
					<ul class="adp-founder__list">
						<?php
						$adp_founder_points = array(
							__( 'خبرة طويلة في تدريس وإعداد طلاب الدبلومة الأمريكية', 'novira-academy' ),
							__( 'متخصص في إعداد الطلاب للاختبارات الدولية', 'novira-academy' ),
							__( 'منهجية متابعة شخصية لكل طالب حتى تحقيق هدفه', 'novira-academy' ),
						);
						foreach ( $adp_founder_points as $adp_fp ) :
							?>
							<li>
								<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="16 9 11 15 8 12"/></svg>
								<?php echo esc_html( $adp_fp ); ?>
							</li>
						<?php endforeach; ?>
					</ul>
				</div>
				<div class="adp-founder__photo">
					<img src="<?php echo esc_url( $adp_uri . '/assets/images/founder/founder.webp' ); ?>" alt="<?php esc_attr_e( 'يوسف زكي', 'novira-academy' ); ?>" loading="lazy" decoding="async">
				</div>
			</div>
		</div>
	</section>

	<!-- =====================================================
	     5. COGNIA ACCREDITATION
	     ===================================================== -->
	<section class="adp-cognia" aria-label="<?php esc_attr_e( 'معتمد من Cognia', 'novira-academy' ); ?>">
		<div class="adp-container">
			<div class="adp-cognia__grid reveal">
				<div class="adp-seal" aria-hidden="true">
					<div>
						<div class="adp-seal__top">ACCREDITED</div>
						<div class="adp-seal__name">cognia</div>
						<div class="adp-seal__line"></div>
						<div class="adp-seal__sub">GLOBAL QUALITY</div>
					</div>
				</div>
				<div class="adp-cognia__copy">
					<span class="adp-eyebrow"><?php esc_html_e( 'اعتماد دولي', 'novira-academy' ); ?></span>
					<h2 class="adp-title"><?php esc_html_e( 'برنامج الدبلومة الأمريكية معتمد من ', 'novira-academy' ); ?><span class="hl">Cognia</span></h2>
					<p><?php esc_html_e( 'اعتماد دولي يُثبت أن البرنامج يلتزم بمعايير الجودة التعليمية الدولية. الشهادة موثّقة لدى الجامعات الأمريكية والدولية وفق متطلبات كل جامعة — وليس بديلاً عن شروط القبول.', 'novira-academy' ); ?></p>
				</div>
			</div>

			<div class="adp-cognia__feats reveal">
				<?php
				$adp_feats = array(
					array( 'l' => __( 'مقبولة في الجامعات الدولية', 'novira-academy' ), 'i' => '<path d="M22 10v6M2 10l10-5 10 5-10 5z"/><path d="M6 12v5c3 3 9 3 12 0v-5"/>' ),
					array( 'l' => __( 'منهج معتمد دولياً', 'novira-academy' ), 'i' => '<circle cx="12" cy="12" r="10"/><line x1="2" y1="12" x2="22" y2="12"/><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/>' ),
					array( 'l' => __( 'متابعة مستمرة', 'novira-academy' ), 'i' => '<polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/>' ),
					array( 'l' => __( 'إعداد للاختبارات', 'novira-academy' ), 'i' => '<path d="M12 20h9"/><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"/>' ),
					array( 'l' => __( 'شهادة معترف بها', 'novira-academy' ), 'i' => '<circle cx="12" cy="8" r="6"/><path d="M9 13.5V22l3-1.5L15 22v-8.5"/>' ),
					array( 'l' => __( 'جودة تعليمية عالية', 'novira-academy' ), 'i' => '<path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>' ),
				);
				foreach ( $adp_feats as $adp_f ) :
					?>
					<div class="adp-feat">
						<span class="adp-feat__icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><?php echo $adp_f['i']; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></svg></span>
						<span class="adp-feat__label"><?php echo esc_html( $adp_f['l'] ); ?></span>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

	<!-- =====================================================
	     6. JOURNEY (enhanced dark glass timeline)
	     ===================================================== -->
	<section class="adp-journey" aria-label="<?php esc_attr_e( 'يرافق الطالب خلال رحلته', 'novira-academy' ); ?>">
		<div class="adp-container">
			<div class="adp-head">
				<span class="adp-eyebrow"><?php esc_html_e( 'الرحلة الأكاديمية', 'novira-academy' ); ?></span>
				<h2 class="adp-title"><?php esc_html_e( 'كيف يسير البرنامج عملياً؟', 'novira-academy' ); ?></h2>
				<p class="adp-sub"><?php esc_html_e( 'ست مراحل من اليوم الأول حتى يوم الامتحان الرسمي.', 'novira-academy' ); ?></p>
			</div>
			<div class="adp-journey__row">
				<?php
				$adp_stages = array(
					array(
						'n'     => 1,
						'title' => __( 'تقييم المستوى', 'novira-academy' ),
						'desc'  => __( 'تحديد نقطة البداية وتصميم المسار المثالي', 'novira-academy' ),
						'icon'  => '<path d="M3 17l6-6 4 4 8-8"/><path d="M21 7v5h-5"/>',
						'delay' => '0s',
					),
					array(
						'n'     => 2,
						'title' => __( 'خطة تعليمية مصممة', 'novira-academy' ),
						'desc'  => __( 'منهج مخصص يناسب وتيرة الطالب وأهدافه', 'novira-academy' ),
						'icon'  => '<path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="8" y1="13" x2="16" y2="13"/><line x1="8" y1="17" x2="13" y2="17"/>',
						'delay' => '.1s',
					),
					array(
						'n'     => 3,
						'title' => __( 'دراسة تفاعلية ومتابعة دورية', 'novira-academy' ),
						'desc'  => __( 'جلسات مباشرة مع مدرسين متخصصين', 'novira-academy' ),
						'icon'  => '<path d="M2 3h20v14H2z"/><path d="M8 21h8M12 17v4"/>',
						'delay' => '.2s',
					),
					array(
						'n'     => 4,
						'title' => __( 'واجبات ومتابعة بين الحصص', 'novira-academy' ),
						'desc'  => __( 'تمارين تُثبّت ما يُدرَّس وتكشف الثغرات مبكراً — قبل أن تتراكم.', 'novira-academy' ),
						'icon'  => '<circle cx="12" cy="12" r="3"/><path d="M19 12a7 7 0 1 0-7 7"/><path d="M12 2v3M12 19v3M2 12h3M19 12h3"/>',
						'delay' => '.3s',
					),
					array(
						'n'     => 5,
						'title' => __( 'اختبارات تجريبية للتقييم المبكر', 'novira-academy' ),
						'desc'  => __( 'محاكاة ظروف الامتحان الحقيقي بوقت كافٍ — لتحديد ما يحتاج تحضيراً إضافياً.', 'novira-academy' ),
						'icon'  => '<path d="M22 10v6M2 10l10-5 10 5-10 5z"/><path d="M6 12v5c3 3 9 3 12 0v-5"/>',
						'delay' => '.4s',
					),
					array(
						'n'     => 6,
						'title' => __( 'دعم التسجيل والإجراءات', 'novira-academy' ),
						'desc'  => __( 'مساعدة في التسجيل للاختبار والتنسيق اللوجستي حتى يوم الامتحان.', 'novira-academy' ),
						'icon'  => '<path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>',
						'delay' => '.5s',
					),
				);
				foreach ( $adp_stages as $adp_s ) :
					?>
					<article class="adp-step" style="--j-delay:<?php echo esc_attr( $adp_s['delay'] ); ?>">
						<span class="adp-step__num"><?php echo esc_html( $adp_s['n'] ); ?></span>
						<span class="adp-step__icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><?php echo $adp_s['icon']; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></svg></span>
						<h3><?php echo esc_html( $adp_s['title'] ); ?></h3>
						<p><?php echo esc_html( $adp_s['desc'] ); ?></p>
					</article>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

	<!-- =====================================================
	     7. OVERVIEW STATS (Enhanced)
	     ===================================================== -->
	<section id="adp-overview" class="adp-overview" aria-label="<?php esc_attr_e( 'نظرة عامة على البرنامج', 'novira-academy' ); ?>">
		<div class="adp-container adp-overview__grid">

			<div class="adp-overview__media">
				<div class="adp-overview__media-inner">
					<img src="<?php echo esc_url( $adp_uri . '/assets/images/gallery/2.avif' ); ?>" alt="<?php esc_attr_e( 'طلاب نوفيرا أكاديمي', 'novira-academy' ); ?>" loading="lazy" decoding="async">
					<div class="adp-overview__media-badge">
						<img src="<?php echo esc_url( $adp_uri . '/assets/images/accreditations/cognia.avif' ); ?>" alt="Cognia" loading="lazy" decoding="async">
						<div>
							<b><?php esc_html_e( 'معتمد من Cognia', 'novira-academy' ); ?></b>
							<small><?php esc_html_e( 'اعتماد دولي للجودة', 'novira-academy' ); ?></small>
						</div>
					</div>
				</div>
			</div>

			<div class="adp-overview__copy">
				<div class="adp-head" style="text-align:start;margin:0 0 24px;max-width:none;">
					<span class="adp-eyebrow"><?php esc_html_e( 'نظرة عامة', 'novira-academy' ); ?></span>
					<h2 class="adp-title"><?php esc_html_e( 'نظرة عامة على البرنامج', 'novira-academy' ); ?></h2>
				</div>

				<!-- Featured +1200 stat with animated SVG ring -->
				<div class="adp-overview__featured">
					<div class="adp-overview__ring" aria-hidden="true">
						<svg class="adp-overview__ring-svg" viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg">
							<circle class="adp-overview__ring-track" cx="50" cy="50" r="44"/>
							<circle class="adp-overview__ring-fill" cx="50" cy="50" r="44" transform="rotate(-90 50 50)"/>
						</svg>
						<div class="adp-overview__ring-inner">
							<span class="adp-overview__big-num" data-count="3"><?php esc_html_e( '3', 'novira-academy' ); ?></span>
							<span class="adp-overview__ring-sub"><?php esc_html_e( 'سنوات', 'novira-academy' ); ?></span>
						</div>
					</div>
					<div class="adp-overview__feat-text">
						<p class="adp-overview__feat-title"><?php esc_html_e( 'ثلاث سنوات من الإعداد المتواصل', 'novira-academy' ); ?></p>
						<p class="adp-overview__feat-sub"><?php esc_html_e( 'من Grade 10 حتى يوم الاختبار: بناء أكاديمي متواصل بحصص أسبوعية، لا مراجعة في أسابيع.', 'novira-academy' ); ?></p>
					</div>
				</div>

				<!-- 3 secondary stats -->
				<div class="adp-stats">
					<?php
					$adp_stats = array(
						array(
							'num'   => __( 'متابعة', 'novira-academy' ),
							'label' => __( 'دورية · بعد كل حصة', 'novira-academy' ),
							'icon'  => '<rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/>',
							'delay' => '.45s',
						),
						array(
							'num'   => '9 → 12',
							'label' => __( 'Grade · المستوى', 'novira-academy' ),
							'icon'  => '<path d="M22 10v6M2 10l10-5 10 5-10 5z"/><path d="M6 12v5c3 3 9 3 12 0v-5"/>',
							'delay' => '.55s',
						),
						array(
							'num'   => '3',
							'label' => __( 'اختبارات دولية · EST و Digital SAT و ACT', 'novira-academy' ),
							'icon'  => '<rect x="2" y="3" width="20" height="14" rx="2"/><line x1="8" y1="21" x2="16" y2="21"/><line x1="12" y1="17" x2="12" y2="21"/>',
							'delay' => '.65s',
						),
					);
					foreach ( $adp_stats as $adp_st ) :
						?>
						<div class="adp-stat" style="--delay:<?php echo esc_attr( $adp_st['delay'] ); ?>">
							<span class="adp-stat__icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><?php echo $adp_st['icon']; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></svg></span>
							<div class="adp-stat__num"><?php echo esc_html( $adp_st['num'] ); ?></div>
							<div class="adp-stat__label"><?php echo esc_html( $adp_st['label'] ); ?></div>
						</div>
					<?php endforeach; ?>
				</div>
			</div>

		</div>
	</section>

	<!-- =====================================================
	     8. STUDY MATERIALS (Google Drive Folders)
	     ===================================================== -->
	<section id="adp-materials" class="adp-materials" aria-label="<?php esc_attr_e( 'مذكرات ومحاضرات الدبلومة الأمريكية', 'novira-academy' ); ?>">
		<div class="adp-container">
			<div class="adp-head reveal">
				<span class="adp-eyebrow"><?php esc_html_e( 'مصادر التعلم', 'novira-academy' ); ?></span>
				<h2 class="adp-title"><?php esc_html_e( 'مذكرات ومحاضرات الدبلومة الأمريكية', 'novira-academy' ); ?></h2>
				<p class="adp-sub"><?php esc_html_e( 'يا أبطالنا، جمعنالكُم مواد الدراسة في مكان واحد. اختار المادة وابدأ من الجزء الأول أو الثاني.', 'novira-academy' ); ?></p>
			</div>
			<div class="adp-materials__grid reveal">
				<?php
				$adp_study_materials = array(
					array(
						'key'       => 'biology',
						'title'     => 'Biology',
						'badge'     => __( 'الأحياء', 'novira-academy' ),
						'desc'      => __( 'شامل مذكرات وتلخيصات المنهج وأسئلة التدريب لمادة الأحياء، منظمة في مجلدين للمراجعة والدراسة.', 'novira-academy' ),
						'icon'      => '<path d="M10 2v7.31L4.12 20.25A2 2 0 0 0 5.82 23h12.36a2 2 0 0 0 1.7-2.75L14 9.31V2"/><path d="M8.5 2h7"/><path d="M14 9.3 6.8 19.5"/>',
						'part1_url' => 'https://drive.google.com/drive/folders/1f28sOx7Hs7vw9gh40bQNQs-wVyn-DL3y?usp=drive_link',
						'part2_url' => 'https://drive.google.com/drive/folders/1McmJ_5e52SrpQtgS6rjRno-SdFHUvUyy?usp=drive_link',
					),
					array(
						'key'       => 'english',
						'title'     => 'English',
						'badge'     => __( 'اللغة الإنجليزية', 'novira-academy' ),
						'desc'      => __( 'مذكرات القراءة والقواعد وبنك أسئلة التدريب لمادة اللغة الإنجليزية، مقسمة لتسهيل المذاكرة والمتابعة.', 'novira-academy' ),
						'icon'      => '<path d="M4 19.5v-15A2.5 2.5 0 0 1 6.5 2H20v20H6.5a2.5 2.5 0 0 1-2.5-2.5Z"/><path d="M6 6h10M6 10h10"/>',
						'part1_url' => 'https://drive.google.com/drive/folders/1pGyQyPIxwybv3gTmHPWR8-ZD_fYIuHxV?usp=drive_link',
						'part2_url' => 'https://drive.google.com/drive/folders/19wLwdbdPe5tlO0uU483njTpP6gzXeWME?usp=drive_link',
					),
					array(
						'key'       => 'math',
						'title'     => 'Mathematics',
						'badge'     => __( 'الرياضيات', 'novira-academy' ),
						'desc'      => __( 'شروحات ومذكرات التأسيس وحل التمارين لمادة الرياضيات، جاهزة للتحميل والدراسة خطوة بخطوة.', 'novira-academy' ),
						'icon'      => '<rect x="3" y="3" width="18" height="18" rx="2"/><line x1="8" y1="12" x2="16" y2="12"/><line x1="12" y1="8" x2="12" y2="16"/><line x1="8" y1="16" x2="8" y2="16.01"/><line x1="16" y1="16" x2="16" y2="16.01"/>',
						'part1_url' => 'https://drive.google.com/drive/folders/11cwOAsVn_NbDLb7gQpB1hH9cjwb8XSGR?usp=drive_link',
						'part2_url' => 'https://drive.google.com/drive/folders/1QbAgn5cpLZU-XuXzZZ8sYZEYrQj1gufi?usp=drive_link',
					),
				);
				foreach ( $adp_study_materials as $adp_mat ) :
					?>
					<article class="adp-material-card adp-material-card--<?php echo esc_attr( $adp_mat['key'] ); ?>">
						<div class="adp-material-card__header">
							<span class="adp-material-card__icon" aria-hidden="true">
								<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
									<?php echo $adp_mat['icon']; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
								</svg>
							</span>
							<div class="adp-material-card__tags">
								<span class="adp-material-card__badge"><?php echo esc_html( $adp_mat['badge'] ); ?></span>
								<span class="adp-material-card__drive-tag">
									<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M22 19a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5l2 3h9a2 2 0 0 1 2 2z"/></svg>
									Drive
								</span>
							</div>
						</div>
						<h3 class="adp-material-card__title" dir="ltr"><?php echo esc_html( $adp_mat['title'] ); ?></h3>
						<span class="adp-material-card__rule" aria-hidden="true"></span>
						<p class="adp-material-card__desc"><?php echo esc_html( $adp_mat['desc'] ); ?></p>
						<div class="adp-material-card__actions">
							<a href="<?php echo esc_url( $adp_mat['part1_url'] ); ?>"
								class="adp-mat-btn adp-mat-btn--part1"
								target="_blank"
								rel="noopener noreferrer"
								aria-label="<?php echo esc_attr( sprintf( __( '%s — الجزء الأول (Google Drive)', 'novira-academy' ), $adp_mat['title'] ) ); ?>">
								<svg class="adp-mat-btn__folder" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M22 19a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5l2 3h9a2 2 0 0 1 2 2z"/></svg>
								<span class="adp-mat-btn__text"><?php esc_html_e( 'الجزء الأول', 'novira-academy' ); ?></span>
								<svg class="adp-mat-btn__arrow" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="15 3 21 3 21 9"/><line x1="10" y1="14" x2="21" y2="3"/></svg>
							</a>
							<a href="<?php echo esc_url( $adp_mat['part2_url'] ); ?>"
								class="adp-mat-btn adp-mat-btn--part2"
								target="_blank"
								rel="noopener noreferrer"
								aria-label="<?php echo esc_attr( sprintf( __( '%s — الجزء الثاني (Google Drive)', 'novira-academy' ), $adp_mat['title'] ) ); ?>">
								<svg class="adp-mat-btn__folder" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M22 19a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5l2 3h9a2 2 0 0 1 2 2z"/></svg>
								<span class="adp-mat-btn__text"><?php esc_html_e( 'الجزء الثاني', 'novira-academy' ); ?></span>
								<svg class="adp-mat-btn__arrow" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="15 3 21 3 21 9"/><line x1="10" y1="14" x2="21" y2="3"/></svg>
							</a>
						</div>
					</article>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

	<!-- =====================================================
	     9. STEPS (what happens when you register)
	     ===================================================== -->
	<section class="adp-steps" aria-label="<?php esc_attr_e( 'ماذا يحدث إذا قررت التسجيل؟', 'novira-academy' ); ?>">
		<div class="adp-container">
			<div class="adp-head reveal">
				<span class="adp-eyebrow"><?php esc_html_e( 'خطوات بسيطة', 'novira-academy' ); ?></span>
				<h2 class="adp-title"><?php esc_html_e( 'ماذا يحدث إذا قررت التسجيل؟', 'novira-academy' ); ?></h2>
				<p class="adp-sub"><?php esc_html_e( 'أربع خطوات للبدء', 'novira-academy' ); ?></p>
			</div>
			<div class="adp-steps__row reveal">
				<?php
				$adp_steps = array(
					array( 'n' => 1, 'title' => __( 'حجز الاستشارة', 'novira-academy' ), 'text' => __( 'تواصل معنا واحجز استشارتك المجانية.', 'novira-academy' ), 'icon' => '<path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8z"/>' ),
					array( 'n' => 2, 'title' => __( 'التقييم المبدئي', 'novira-academy' ), 'text' => __( 'نحدّد مستوى الطالب الحالي ونقاط قوته.', 'novira-academy' ), 'icon' => '<path d="M12 20h9"/><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"/>' ),
					array( 'n' => 3, 'title' => __( 'خطة تعليمية', 'novira-academy' ), 'text' => __( 'نصمّم خطة دراسية مخصصة لاحتياجاته.', 'novira-academy' ), 'icon' => '<path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/>' ),
					array( 'n' => 4, 'title' => __( 'بدء الدراسة', 'novira-academy' ), 'text' => __( 'تبدأ الحصص الأسبوعية مع معلمك المتخصص ويُحدَّد جدولك الدراسي.', 'novira-academy' ), 'icon' => '<path d="M22 10v6M2 10l10-5 10 5-10 5z"/><path d="M6 12v5c3 3 9 3 12 0v-5"/>' ),
				);
				foreach ( $adp_steps as $adp_step ) :
					?>
					<div class="adp-stepc">
						<span class="adp-stepc__ring">
							<span class="adp-stepc__num"><?php echo esc_html( $adp_step['n'] ); ?></span>
							<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><?php echo $adp_step['icon']; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></svg>
						</span>
						<h3><?php echo esc_html( $adp_step['title'] ); ?></h3>
						<p><?php echo esc_html( $adp_step['text'] ); ?></p>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

	<!-- =====================================================
	     10. FAQ
	     ===================================================== -->
	<section class="adp-faq" aria-label="<?php esc_attr_e( 'الأسئلة الشائعة', 'novira-academy' ); ?>">
		<div class="adp-container">
			<div class="adp-head reveal">
				<span class="adp-eyebrow"><?php esc_html_e( 'الأسئلة الشائعة', 'novira-academy' ); ?></span>
				<h2 class="adp-title"><?php esc_html_e( 'أسئلة يطرحها أولياء الأمور', 'novira-academy' ); ?></h2>
			</div>
			<div class="adp-faq__list reveal">
				<?php
				$adp_faqs = array(
					array( 'q' => __( 'هل الشهادة معتمدة دولياً؟', 'novira-academy' ), 'a' => __( 'نعم، الدبلومة الأمريكية معتمدة من Cognia ومعترف بها لدى الجامعات الأمريكية والدولية.', 'novira-academy' ) ),
					array( 'q' => __( 'كم مدة البرنامج؟', 'novira-academy' ), 'a' => __( 'يرافق البرنامج الطالب من Grade 10 حتى Grade 12؛ وتُحدَّد وتيرة الدراسة حسب مستواه — تواصل معنا للتفاصيل.', 'novira-academy' ) ),
					array( 'q' => __( 'ماذا يحدث بعد الحصول على الشهادة؟', 'novira-academy' ), 'a' => __( 'نقدّم إرشاداً خلال خطوات التقديم، وتظل متطلبات وقرارات القبول خاضعة لسياسات الجامعات والجهات المختصة.', 'novira-academy' ) ),
					array( 'q' => __( 'هل الدراسة أونلاين أم يمكن حضورها؟', 'novira-academy' ), 'a' => __( 'الدراسة متاحة أونلاين بمرونة تناسب جدول الطالب، مع متابعة دورية من فريق متخصص.', 'novira-academy' ) ),
					array( 'q' => __( 'هل يوجد متابعة ودعم أكاديمي؟', 'novira-academy' ), 'a' => __( 'نعم، يتابع فريق نوفيرا تقدّم الطالب أكاديمياً خلال مراحل البرنامج من خلال معلمين متخصصين.', 'novira-academy' ) ),
					array( 'q' => __( 'هل يمكن تقسيم الرسوم؟', 'novira-academy' ), 'a' => __( 'تتوفّر خيارات مرنة للرسوم. تواصل معنا لمعرفة التفاصيل المناسبة لحالتك.', 'novira-academy' ) ),
					array( 'q' => __( 'ما هي الاختبارات الدولية المتاحة؟', 'novira-academy' ), 'a' => __( 'نُعِدّ الطلاب لاختبارات EST و Digital SAT و ACT وفق المسار المناسب لكل طالب.', 'novira-academy' ) ),
				);
				foreach ( $adp_faqs as $adp_i => $adp_faq ) :
					?>
					<details class="adp-faq__item"<?php echo 0 === $adp_i ? ' open' : ''; ?>>
						<summary class="adp-faq__q">
							<svg class="qmark" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>
							<span><?php echo esc_html( $adp_faq['q'] ); ?></span>
							<span class="chev" aria-hidden="true">+</span>
						</summary>
						<div class="adp-faq__a"><?php echo esc_html( $adp_faq['a'] ); ?></div>
					</details>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

	<!-- =====================================================
	     11. CTA
	     ===================================================== -->
	<section class="adp-cta" aria-label="<?php esc_attr_e( 'تحدّث مع فريقنا', 'novira-academy' ); ?>">
		<div class="adp-container">
			<div class="adp-cta__inner reveal">
				<span class="adp-cta__badge" aria-hidden="true">N</span>
				<div class="adp-cta__copy">
					<div class="adp-cta__eyebrow"><?php esc_html_e( 'استشارة مجانية', 'novira-academy' ); ?></div>
					<h2 class="adp-cta__title"><?php esc_html_e( 'تحدّث مع فريقنا', 'novira-academy' ); ?></h2>
					<p class="adp-cta__desc"><?php esc_html_e( 'لديك أسئلة عن البرنامج أو المرحلة المناسبة لطالبك؟ فريقنا يُجيب.', 'novira-academy' ); ?></p>
					<a class="adp-btn adp-btn--white" href="<?php echo esc_url( $adp_wa_url ); ?>" target="_blank" rel="noopener noreferrer">
						<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8z"/></svg>
						<?php esc_html_e( 'تواصل معنا الآن', 'novira-academy' ); ?>
					</a>
				</div>
				<div class="adp-cta__visual" aria-hidden="true">
					<span class="adp-cta__bubble"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg></span>
					<span class="adp-cta__phones"><svg viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M10 42v-9a22 22 0 0 1 44 0v9" stroke="currentColor" stroke-width="4" stroke-linecap="round"/><rect x="5" y="38" width="14" height="22" rx="6" fill="currentColor"/><rect x="45" y="38" width="14" height="22" rx="6" fill="currentColor"/></svg></span>
				</div>
			</div>
		</div>
	</section>

</div><!-- .adp -->

<script>
/* Journey section: staggered cards + connector line draw */
(function () {
	'use strict';
	var jSec    = document.querySelector('.adp-journey');
	if (!jSec) return;

	var noMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
	var jHead    = jSec.querySelector('.adp-head');
	var jRow     = jSec.querySelector('.adp-journey__row');
	var jCards   = Array.prototype.slice.call(jSec.querySelectorAll('.adp-step'));

	if (noMotion) {
		if (jHead) jHead.classList.add('adp-in');
		if (jRow)  jRow.classList.add('adp-in');
		jCards.forEach(function (c) { c.classList.add('adp-in'); });
		return;
	}

	var jFired = false;
	var jIo = new IntersectionObserver(function (entries) {
		if (!entries[0].isIntersecting || jFired) return;
		jFired = true;
		jIo.disconnect();

		if (jHead) jHead.classList.add('adp-in');

		/* Draw connector line after heading appears */
		setTimeout(function () {
			if (jRow) jRow.classList.add('adp-in');
		}, 200);

		/* Stagger cards: step 1 first (right side in RTL), step 6 last (left) */
		jCards.forEach(function (card, i) {
			setTimeout(function () { card.classList.add('adp-in'); }, 350 + i * 100);
		});
	}, { threshold: 0.15 });

	jIo.observe(jSec);
})();

/* Overview section: scroll-triggered entrance + SVG ring + number counter */
(function () {
	'use strict';
	var section = document.querySelector('.adp-overview');
	if (!section) return;

	var noMotion  = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
	var mediaInner = section.querySelector('.adp-overview__media-inner');
	var copyHead   = section.querySelector('.adp-overview__copy .adp-head');
	var featured   = section.querySelector('.adp-overview__featured');
	var ring       = section.querySelector('.adp-overview__ring');
	var stats      = Array.prototype.slice.call(section.querySelectorAll('.adp-stat'));
	var counters   = Array.prototype.slice.call(section.querySelectorAll('[data-count]'));

	/* Immediately reveal everything for reduced-motion users */
	if (noMotion) {
		[mediaInner, copyHead, featured].forEach(function (el) { if (el) el.classList.add('adp-in'); });
		stats.forEach(function (el) { el.classList.add('adp-in'); });
		if (ring) ring.classList.add('adp-ring-go');
		return;
	}

	/* Count-up animation for [data-count] elements */
	function animateCount(el) {
		var target = parseInt(el.getAttribute('data-count'), 10);
		var prefix = el.getAttribute('data-prefix') || '';
		var dur    = 1400;
		var start  = null;
		function tick(ts) {
			if (!start) start = ts;
			var p    = Math.min((ts - start) / dur, 1);
			var ease = 1 - Math.pow(1 - p, 3);
			/* Western numerals to match the rest of the page (9–12, 3, 4) */
			el.textContent = prefix + String(Math.round(ease * target));
			if (p < 1) requestAnimationFrame(tick);
			else el.textContent = prefix + String(target);
		}
		requestAnimationFrame(tick);
	}

	/* Single IntersectionObserver fires once when section reaches 20% in view */
	var fired = false;
	var io = new IntersectionObserver(function (entries) {
		if (!entries[0].isIntersecting || fired) return;
		fired = true;
		io.disconnect();

		if (mediaInner) mediaInner.classList.add('adp-in');
		if (copyHead)   copyHead.classList.add('adp-in');

		setTimeout(function () {
			if (featured) featured.classList.add('adp-in');
			if (ring)     ring.classList.add('adp-ring-go');
		}, 250);

		stats.forEach(function (el, i) {
			setTimeout(function () { el.classList.add('adp-in'); }, 420 + i * 110);
		});

		counters.forEach(function (el) {
			setTimeout(function () { animateCount(el); }, 320);
		});
	}, { threshold: 0.2 });

	io.observe(section);
})();

/* Exam Gateway: staggered card entrance on scroll */
(function () {
	'use strict';
	var exSec = document.querySelector('.adp-exams');
	if (!exSec) return;
	var noMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
	var exCards = Array.prototype.slice.call(exSec.querySelectorAll('.adp-exam-card'));
	if (noMotion) {
		exCards.forEach(function (c) { c.classList.add('adp-in'); });
		return;
	}
	var exFired = false;
	var exIo = new IntersectionObserver(function (entries) {
		if (!entries[0].isIntersecting || exFired) return;
		exFired = true; exIo.disconnect();
		exCards.forEach(function (card, i) {
			setTimeout(function () { card.classList.add('adp-in'); }, i * 130);
		});
	}, { threshold: 0.15 });
	exIo.observe(exSec);
})();
</script>

<?php
get_footer();
