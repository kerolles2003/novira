<?php
/**
 * Template: Education & Skills Landing
 *
 * Dedicated, pixel-matched landing page for the education / skills & languages
 * department (rebuilt from education.png). Force-routed for the `education`
 * page via novira_force_education_template() (template_include, functions.php).
 * Uses the site's global header/footer (get_header()/get_footer()) so the navbar
 * and footer match every other page.
 *
 * All markup is scoped under `.edu`; styles live in assets/css/education-landing.css
 * and behaviour in assets/js/education-landing.js — both enqueued only here.
 *
 * @package Novira_Academy
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$edu_whatsapp = get_theme_mod( 'novira_whatsapp', '201090600927' );
$edu_wa       = 'https://wa.me/' . $edu_whatsapp;
$edu_img      = get_template_directory_uri() . '/assets/images';

get_header();
?>

<div class="edu">

	<?php // ===================== 1. HERO ===================== ?>
	<section class="edu-hero" aria-label="<?php esc_attr_e( 'التعليم والتطوير المهني', 'novira-academy' ); ?>">
		<div class="edu-hero__bg" aria-hidden="true">
			<span class="edu-hero__glow edu-hero__glow--a"></span>
			<span class="edu-hero__glow edu-hero__glow--b"></span>
			<span class="edu-hero__grid"></span>
		</div>

		<div class="edu-container edu-hero__wrap">
			<div class="edu-hero__copy">
				<h1 class="edu-hero__title" data-reveal>
					<span class="edu-hero__title-a"><?php esc_html_e( 'استثمر في نفسك..', 'novira-academy' ); ?></span>
					<span class="edu-hero__title-b"><?php esc_html_e( 'أو ارسم طريق النجاح لأولادك!', 'novira-academy' ); ?></span>
				</h1>
				<p class="edu-hero__desc" data-reveal style="--i:1">
					<?php esc_html_e( 'كورسات عملية .. مدربين متخصصين .. نتائج حقيقية', 'novira-academy' ); ?><br>
					<?php esc_html_e( 'للصغار والكبار في مكان واحد', 'novira-academy' ); ?>
				</p>
				<div class="edu-hero__cta" data-reveal style="--i:2">
					<a href="#edu-courses" class="edu-btn edu-btn--primary edu-btn--lg">
						<?php echo novira_edu_icon( 'book-open', 20 ); // phpcs:ignore ?>
						<?php esc_html_e( 'استكشف الكورسات', 'novira-academy' ); ?>
					</a>
					<a href="<?php echo esc_url( $edu_wa ); ?>" class="edu-btn edu-btn--white edu-btn--lg" target="_blank" rel="noopener noreferrer">
						<?php echo novira_edu_icon( 'whatsapp', 20 ); // phpcs:ignore ?>
						<?php esc_html_e( 'تواصل واتساب', 'novira-academy' ); ?>
					</a>
				</div>
			</div>

			<div class="edu-hero__visual" data-reveal style="--i:1">
				<span class="edu-hero__orbit edu-hero__orbit--1" aria-hidden="true"></span>
				<span class="edu-hero__orbit edu-hero__orbit--2" aria-hidden="true"></span>
				<span class="edu-hero__blob" aria-hidden="true"></span>

				<figure class="edu-hero__photo">
					<img src="<?php echo esc_url( $edu_img . '/hero.jpg' ); ?>"
						srcset="<?php echo esc_url( $edu_img . '/hero.jpg' ); ?> 880w, <?php echo esc_url( $edu_img . '/hero@2x.jpg' ); ?> 1760w"
						sizes="(max-width: 900px) 90vw, 880px"
						alt="<?php esc_attr_e( 'طالب في نوفيرا أكاديمي', 'novira-academy' ); ?>" width="880" height="464" fetchpriority="high" decoding="async">
				</figure>

				<span class="edu-badge edu-badge--code" style="--d:.1s" aria-hidden="true"><?php echo novira_edu_icon( 'code', 22 ); // phpcs:ignore ?></span>
				<span class="edu-badge edu-badge--aa" style="--d:.5s" aria-hidden="true">Aa</span>
				<span class="edu-badge edu-badge--globe" style="--d:.9s" aria-hidden="true"><?php echo novira_edu_icon( 'globe-exam', 22 ); // phpcs:ignore ?></span>
			</div>
		</div>
	</section>

	<?php // ===================== 2. CHOOSE FIELD ===================== ?>
	<section class="edu-section edu-fields">
		<div class="edu-container">
			<h2 class="edu-h2" data-reveal><span class="edu-h2__deco">✦</span> <?php esc_html_e( 'اختر المجال اللي يناسبك', 'novira-academy' ); ?> <span class="edu-h2__deco">✦</span></h2>
			<div class="edu-fields__grid">
				<?php
				$edu_fields = array(
					array( 'i' => 'chat',       't' => __( 'اللغات', 'novira-academy' ),             's' => __( 'إنجليزي · ألماني · فرنسي · إيطالي', 'novira-academy' ) ),
					array( 'i' => 'code',       't' => __( 'البرمجة والتطوير', 'novira-academy' ),   's' => 'Python · HTML & CSS · Scratch' ),
					array( 'i' => 'chart',      't' => __( 'المهارات الرقمية', 'novira-academy' ),   's' => 'ICDL · ICT' ),
					array( 'i' => 'rocket',     't' => __( 'الحساب الذهني', 'novira-academy' ),      's' => __( 'UCMAS للأطفال', 'novira-academy' ) ),
					array( 'i' => 'briefcase',  't' => __( 'الإنجليزية المتخصصة', 'novira-academy' ), 's' => __( 'محادثة · بيزنس · مقابلات', 'novira-academy' ) ),
					array( 'i' => 'globe-exam', 't' => __( 'الاختبارات الدولية', 'novira-academy' ),  's' => 'IELTS · TOEFL' ),
				);
				foreach ( $edu_fields as $edu_n => $edu_f ) : ?>
					<article class="edu-field" data-reveal style="--i:<?php echo (int) $edu_n; ?>">
						<span class="edu-field__ico"><?php echo novira_edu_icon( $edu_f['i'], 30 ); // phpcs:ignore ?></span>
						<h3 class="edu-field__t"><?php echo esc_html( $edu_f['t'] ); ?></h3>
						<p class="edu-field__s"><?php echo esc_html( $edu_f['s'] ); ?></p>
					</article>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

	<?php // ===================== 3. WHY NOVIRA (dark band) ===================== ?>
	<section class="edu-section edu-why">
		<div class="edu-container">
			<h2 class="edu-h2 edu-h2--light" data-reveal><span class="edu-h2__deco">✦</span> <?php esc_html_e( 'ليه تختار نوفيرا أكاديمي؟', 'novira-academy' ); ?> <span class="edu-h2__deco">✦</span></h2>
			<div class="edu-why__grid">
				<?php
				$edu_why = array(
					array( 'i' => 'shield',     't' => __( 'نتائج ملموسة', 'novira-academy' ),    's' => __( 'تطبيق عملي وتجارب', 'novira-academy' ) ),
					array( 'i' => 'doc',        't' => __( 'مناهج حديثة', 'novira-academy' ),     's' => __( 'محدثة باستمرار', 'novira-academy' ) ),
					array( 'i' => 'user-check', 't' => __( 'متابعة شخصية', 'novira-academy' ),    's' => __( 'دعم طوال رحلتك', 'novira-academy' ) ),
					array( 'i' => 'award',      't' => __( 'شهادات معتمدة', 'novira-academy' ),   's' => __( 'تعزز سيرتك الذاتية', 'novira-academy' ) ),
					array( 'i' => 'flex',       't' => __( 'مرونة في التعلم', 'novira-academy' ), 's' => __( 'أونلاين أو حضوري', 'novira-academy' ) ),
					array( 'i' => 'teacher',    't' => __( 'مدربين متخصصين', 'novira-academy' ),  's' => __( 'خبرة عملية طويلة', 'novira-academy' ) ),
				);
				foreach ( $edu_why as $edu_n => $edu_w ) : ?>
					<div class="edu-why__item" data-reveal style="--i:<?php echo (int) $edu_n; ?>">
						<span class="edu-why__ico"><?php echo novira_edu_icon( $edu_w['i'], 26 ); // phpcs:ignore ?></span>
						<h3 class="edu-why__t"><?php echo esc_html( $edu_w['t'] ); ?></h3>
						<p class="edu-why__s"><?php echo esc_html( $edu_w['s'] ); ?></p>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

	<?php // ===================== 4. LEARN MODES ===================== ?>
	<section class="edu-section edu-modes">
		<div class="edu-container">
			<h2 class="edu-h2" data-reveal><?php esc_html_e( 'تعلم بالطريقة اللي تناسبك', 'novira-academy' ); ?></h2>
			<div class="edu-modes__wrap">
				<div class="edu-modes__list">
					<?php
					$edu_modes = array(
						array( 'i' => 'monitor', 't' => __( 'أونلاين مباشر', 'novira-academy' ), 's' => __( 'فصول تفاعلية مباشرة مع مدرسك ومن أي مكان', 'novira-academy' ), 'tag' => 'LIVE' ),
						array( 'i' => 'play',    't' => __( 'أونلاين مسجل', 'novira-academy' ),  's' => __( 'تتعلم وقت ما يناسبك وتكرر الدروس', 'novira-academy' ),        'tag' => '' ),
						array( 'i' => 'pin',     't' => __( 'حضوري', 'novira-academy' ),         's' => __( 'تجربة تعليمية تفاعلية داخل قاعتنا', 'novira-academy' ),        'tag' => '' ),
					);
					foreach ( $edu_modes as $edu_n => $edu_m ) : ?>
						<article class="edu-mode" data-reveal style="--i:<?php echo (int) $edu_n; ?>">
							<div class="edu-mode__body">
								<h3 class="edu-mode__t">
									<?php echo esc_html( $edu_m['t'] ); ?>
									<?php if ( $edu_m['tag'] ) : ?><span class="edu-mode__live"><span class="edu-mode__live-dot"></span><?php echo esc_html( $edu_m['tag'] ); ?></span><?php endif; ?>
								</h3>
								<p class="edu-mode__s"><?php echo esc_html( $edu_m['s'] ); ?></p>
							</div>
							<span class="edu-mode__ico"><?php echo novira_edu_icon( $edu_m['i'], 30 ); // phpcs:ignore ?></span>
						</article>
					<?php endforeach; ?>
				</div>

				<div class="edu-modes__media" data-reveal style="--i:1">
					<figure class="edu-classroom">
						<img src="<?php echo esc_url( $edu_img . '/hero/slide-3.webp' ); ?>" alt="<?php esc_attr_e( 'قاعة نوفيرا أكاديمي التعليمية', 'novira-academy' ); ?>" width="680" height="600" loading="lazy" decoding="async">
						<span class="edu-classroom__logo" aria-hidden="true">NOVIRA<em>ACADEMY</em></span>
					</figure>
				</div>
			</div>
		</div>
	</section>

	<?php // ===================== 5. STATS BAND ===================== ?>
	<section class="edu-stats">
		<div class="edu-container">
			<ul class="edu-stats__grid" role="list">
				<?php
				$edu_stats = array(
					array( 'i' => 'cap',      'n' => 5000, 'pre' => '+', 'suf' => '', 'l' => __( 'طالب ومتدرب', 'novira-academy' ) ),
					array( 'i' => 'book',     'n' => 150,  'pre' => '+', 'suf' => '', 'l' => __( 'كورسات متنوعة', 'novira-academy' ) ),
					array( 'i' => 'user',     'n' => 50,   'pre' => '+', 'suf' => '', 'l' => __( 'مدرب متخصص', 'novira-academy' ) ),
					array( 'i' => 'star',     'n' => 98,   'pre' => '+', 'suf' => '%', 'l' => __( 'رضا الطلاب', 'novira-academy' ) ),
					array( 'i' => 'calendar', 'n' => 5,    'pre' => '+', 'suf' => '', 'l' => __( 'سنوات من النجاح', 'novira-academy' ) ),
				);
				foreach ( $edu_stats as $edu_n => $edu_s ) : ?>
					<li class="edu-stat" data-reveal style="--i:<?php echo (int) $edu_n; ?>">
						<span class="edu-stat__ico"><?php echo novira_edu_icon( $edu_s['i'], 26 ); // phpcs:ignore ?></span>
						<span class="edu-stat__txt">
							<span class="edu-stat__n" data-count="<?php echo (int) $edu_s['n']; ?>" data-pre="<?php echo esc_attr( $edu_s['pre'] ); ?>" data-suf="<?php echo esc_attr( $edu_s['suf'] ); ?>"><?php echo esc_html( $edu_s['pre'] . $edu_s['n'] . $edu_s['suf'] ); ?></span>
							<span class="edu-stat__l"><?php echo esc_html( $edu_s['l'] ); ?></span>
						</span>
					</li>
				<?php endforeach; ?>
			</ul>
		</div>
	</section>

	<?php // ===================== 6. TWO PROGRAMS ===================== ?>
	<section class="edu-section edu-programs">
		<div class="edu-container edu-programs__grid">

			<?php // Adults (right in RTL). ?>
			<article class="edu-prog edu-prog--adults" data-reveal>
				<div class="edu-prog__head">
					<span class="edu-prog__badge"><?php echo novira_edu_icon( 'star', 20 ); // phpcs:ignore ?></span>
					<div>
						<h3 class="edu-prog__t"><?php esc_html_e( 'برامج متخصصة للكبار', 'novira-academy' ); ?></h3>
						<p class="edu-prog__sub"><?php esc_html_e( 'طور مهاراتك وارتقي في حياتك العملية', 'novira-academy' ); ?></p>
					</div>
				</div>
				<ul class="edu-prog__list" role="list">
					<li><?php echo novira_edu_icon( 'check', 20 ); // phpcs:ignore ?> <?php esc_html_e( 'تطوير مهني وشهادات معتمدة', 'novira-academy' ); ?></li>
					<li><?php echo novira_edu_icon( 'check', 20 ); // phpcs:ignore ?> <?php esc_html_e( 'كورسات لغات مكثفة', 'novira-academy' ); ?></li>
					<li><?php echo novira_edu_icon( 'check', 20 ); // phpcs:ignore ?> <?php esc_html_e( 'مهارات سوق العمل التكنولوجية', 'novira-academy' ); ?></li>
					<li><?php echo novira_edu_icon( 'check', 20 ); // phpcs:ignore ?> <?php esc_html_e( 'مشاريع عملية وبناء بورتفوليو', 'novira-academy' ); ?></li>
						<li><?php echo novira_edu_icon( 'check', 20 ); // phpcs:ignore ?> <?php esc_html_e( 'نظام مستويات شهرية · 8 حصص في الشهر · حصتان أسبوعياً · ساعة للحصة', 'novira-academy' ); ?></li>
				</ul>
				<a href="<?php echo esc_url( $edu_wa ); ?>" class="edu-btn edu-btn--primary edu-prog__cta" target="_blank" rel="noopener noreferrer"><?php esc_html_e( 'استكشف برامج الكبار', 'novira-academy' ); ?></a>
				<span class="edu-prog__art edu-prog__art--adult" aria-hidden="true">
					<img src="<?php echo esc_url( $edu_img . '/hero/slide-1.webp' ); ?>" alt="" width="260" height="260" loading="lazy" decoding="async">
				</span>
			</article>

			<?php // Kids (left in RTL). ?>
			<article class="edu-prog edu-prog--kids" data-reveal style="--i:1">
				<div class="edu-prog__head">
					<span class="edu-prog__badge edu-prog__badge--kids"><?php echo novira_edu_icon( 'rocket', 20 ); // phpcs:ignore ?></span>
					<div>
						<h3 class="edu-prog__t"><?php esc_html_e( 'برامج مميزة للصغار', 'novira-academy' ); ?></h3>
						<p class="edu-prog__sub"><?php esc_html_e( 'تساعد أطفالك بكتشفوا قدراتهم وبيبنوا مستقبلهم', 'novira-academy' ); ?></p>
					</div>
				</div>
				<ul class="edu-prog__list edu-prog__list--kids" role="list">
					<li><?php echo novira_edu_icon( 'check', 20 ); // phpcs:ignore ?> <?php esc_html_e( 'تنمية المهارات والذكاء', 'novira-academy' ); ?></li>
					<li><?php echo novira_edu_icon( 'check', 20 ); // phpcs:ignore ?> <?php esc_html_e( 'لغات مطبقة ممتعة', 'novira-academy' ); ?></li>
					<li><?php echo novira_edu_icon( 'check', 20 ); // phpcs:ignore ?> <?php esc_html_e( 'برمجة وألعاب تعليمية', 'novira-academy' ); ?></li>
					<li><?php echo novira_edu_icon( 'check', 20 ); // phpcs:ignore ?> <?php esc_html_e( 'مشاريع وأنشطة عملية', 'novira-academy' ); ?></li>
						<li><?php echo novira_edu_icon( 'check', 20 ); // phpcs:ignore ?> <?php esc_html_e( 'نظام مستويات شهرية · 8 حصص في الشهر · حصتان أسبوعياً · ساعة للحصة', 'novira-academy' ); ?></li>
				</ul>
				<a href="<?php echo esc_url( $edu_wa ); ?>" class="edu-btn edu-btn--primary edu-prog__cta" target="_blank" rel="noopener noreferrer"><?php esc_html_e( 'استكشف برامج الأطفال', 'novira-academy' ); ?></a>
				<span class="edu-prog__art edu-prog__art--kid" aria-hidden="true">
					<img src="<?php echo esc_url( $edu_img . '/hero/slide-3.webp' ); ?>" alt="" width="260" height="260" loading="lazy" decoding="async">
				</span>
			</article>

		</div>
	</section>

	<?php // ===================== 7. COURSES CAROUSEL ===================== ?>
	<section class="edu-section edu-courses" id="edu-courses">
		<div class="edu-container">
			<h2 class="edu-h2" data-reveal><span class="edu-h2__deco">✦</span> <?php esc_html_e( 'أكثر الكورسات طلباً', 'novira-academy' ); ?> <span class="edu-h2__deco">✦</span></h2>

			<div class="edu-carousel" data-reveal>
				<button class="edu-carousel__nav edu-carousel__nav--prev" type="button" aria-label="<?php esc_attr_e( 'السابق', 'novira-academy' ); ?>"><?php echo novira_edu_icon( 'arrow-r', 22 ); // phpcs:ignore ?></button>
				<div class="edu-carousel__viewport">
					<div class="edu-carousel__track">
						<?php
						$edu_courses = array(
							array( 't' => 'English',                      's' => __( 'من المستوى الأول حتى الطلاقة', 'novira-academy' ),  'r' => '4.9', 'c' => '412', 'cat' => __( 'لغات', 'novira-academy' ),        'g' => 'en' ),
							array( 't' => 'English Conversation',         's' => __( 'محادثة بطلاقة وثقة', 'novira-academy' ),           'r' => '4.8', 'c' => '254', 'cat' => __( 'لغات', 'novira-academy' ),        'g' => 'en' ),
							array( 't' => 'Business English',             's' => __( 'إنجليزية بيئة العمل', 'novira-academy' ),          'r' => '4.8', 'c' => '176', 'cat' => __( 'لغات', 'novira-academy' ),        'g' => 'mkt' ),
							array( 't' => 'English Interview Preparation', 's' => __( 'استعد لمقابلة العمل بثقة', 'novira-academy' ),      'r' => '4.9', 'c' => '132', 'cat' => __( 'لغات', 'novira-academy' ),        'g' => 'mkt' ),
							array( 't' => 'German',                       's' => __( 'الألمانية من المستوى الأول', 'novira-academy' ),    'r' => '4.7', 'c' => '148', 'cat' => __( 'لغات', 'novira-academy' ),        'g' => 'en' ),
							array( 't' => 'French',                       's' => __( 'الفرنسية من المستوى الأول', 'novira-academy' ),     'r' => '4.8', 'c' => '139', 'cat' => __( 'لغات', 'novira-academy' ),        'g' => 'en' ),
							array( 't' => 'IELTS',                        's' => __( 'تحضير شامل لاختبار IELTS', 'novira-academy' ),      'r' => '4.9', 'c' => '287', 'cat' => __( 'اختبارات', 'novira-academy' ),    'g' => 'ielts' ),
							array( 't' => 'TOEFL',                        's' => __( 'تحضير شامل لاختبار TOEFL', 'novira-academy' ),      'r' => '4.8', 'c' => '203', 'cat' => __( 'اختبارات', 'novira-academy' ),    'g' => 'en' ),
							array( 't' => 'Italian',                      's' => __( 'الإيطالية من المستوى الأول', 'novira-academy' ),    'r' => '4.7', 'c' => '96',  'cat' => __( 'لغات', 'novira-academy' ),        'g' => 'en' ),
							array( 't' => 'UCMAS',                        's' => __( 'الحساب الذهني وتنمية التركيز', 'novira-academy' ),  'r' => '4.9', 'c' => '231', 'cat' => __( 'حساب ذهني', 'novira-academy' ),   'g' => 'mkt' ),
							array( 't' => 'Python Programming',           's' => __( 'من المستوى الأول للاحتراف', 'novira-academy' ),     'r' => '4.9', 'c' => '268', 'cat' => __( 'برمجة', 'novira-academy' ),       'g' => 'py' ),
							array( 't' => 'HTML & CSS',                   's' => __( 'تصميم وبناء صفحات الويب', 'novira-academy' ),       'r' => '4.8', 'c' => '214', 'cat' => __( 'برمجة', 'novira-academy' ),       'g' => 'ux' ),
							array( 't' => 'Scratch Programming',          's' => __( 'برمجة ممتعة للأطفال', 'novira-academy' ),          'r' => '4.9', 'c' => '187', 'cat' => __( 'برمجة', 'novira-academy' ),       'g' => 'ux' ),
							array( 't' => 'ICDL',                         's' => __( 'الرخصة الدولية لقيادة الحاسوب', 'novira-academy' ), 'r' => '4.8', 'c' => '305', 'cat' => __( 'مهارات رقمية', 'novira-academy' ), 'g' => 'mkt' ),
							array( 't' => 'ICT',                          's' => __( 'مهارات تقنية المعلومات', 'novira-academy' ),        'r' => '4.7', 'c' => '158', 'cat' => __( 'مهارات رقمية', 'novira-academy' ), 'g' => 'mkt' ),
						);
						foreach ( $edu_courses as $edu_c ) : ?>
							<article class="edu-course">
								<div class="edu-course__thumb edu-course__thumb--<?php echo esc_attr( $edu_c['g'] ); ?>">
									<?php
									switch ( $edu_c['g'] ) {
										case 'py':
											echo '<svg viewBox="0 0 120 80" fill="none"><path d="M60 16c-14 0-13 6-13 6v6h13v2H40s-9-1-9 14 8 14 8 14h5v-7s-.3-8 8-8h13s8 .2 8-8v-13s1.3-6-13-6zm-7 4a2.4 2.4 0 1 1 0 4.9 2.4 2.4 0 0 1 0-4.9z" fill="#3b74a8"/><path d="M60 64c14 0 13-6 13-6v-6H60v-2h20s9 1 9-14-8-14-8-14h-5v7s.3 8-8 8H55s-8-.2-8 8v13s-1.3 6 13 6zm7-4a2.4 2.4 0 1 1 0-4.9 2.4 2.4 0 0 1 0 4.9z" fill="#f6c445"/></svg>';
											break;
										case 'en':
											echo '<svg viewBox="0 0 120 80" fill="none"><rect width="120" height="80" fill="#7fb2e0"/><rect x="46" y="20" width="14" height="46" fill="#e6ecef"/><path d="M42 66l11-42 4 42z" fill="#c9d3d8"/><rect x="52" y="18" width="4" height="10" fill="#8a97a0"/><circle cx="54" cy="16" r="3" fill="#f4c542"/><rect y="60" width="120" height="20" fill="#5f97cf"/></svg>';
											break;
										case 'ux':
											echo '<svg viewBox="0 0 120 80" fill="none"><rect width="120" height="80" fill="#161a24"/><rect x="30" y="18" width="26" height="26" rx="4" fill="#ff6d3f"/><rect x="64" y="18" width="26" height="26" rx="13" fill="#a259ff"/><rect x="30" y="50" width="26" height="14" rx="7" fill="#1abcfe"/><rect x="64" y="50" width="26" height="14" rx="4" fill="#0acf83"/></svg>';
											break;
										case 'mkt':
											echo '<svg viewBox="0 0 120 80" fill="none"><rect width="120" height="80" fill="#efe7ff"/><path d="M34 34l24-10v32l-24-10z" fill="#7b2cff"/><rect x="30" y="30" width="6" height="20" rx="3" fill="#5b14e6"/><path d="M58 24l22-8v48l-22-8z" fill="#ffb020"/><circle cx="86" cy="40" r="8" fill="#ff5c8a"/><path d="M70 58c6 6 14 8 22 6" stroke="#5b14e6" stroke-width="3" fill="none" stroke-linecap="round"/></svg>';
											break;
										default:
											echo '<svg viewBox="0 0 120 80" fill="none"><rect width="120" height="80" fill="#fff"/><rect x="30" y="26" width="60" height="12" rx="2" fill="#e11d48"/><text x="60" y="36" text-anchor="middle" font-family="Arial" font-size="12" font-weight="800" fill="#fff">IELTS</text><rect x="30" y="46" width="60" height="4" rx="2" fill="#cbd5e1"/><rect x="30" y="54" width="42" height="4" rx="2" fill="#cbd5e1"/></svg>';
									}
									?>
								</div>
								<div class="edu-course__body">
									<h3 class="edu-course__t"><?php echo esc_html( $edu_c['t'] ); ?></h3>
									<p class="edu-course__s"><?php echo esc_html( $edu_c['s'] ); ?></p>

									<span class="edu-course__levels">
										<?php echo novira_edu_icon( 'award', 14 ); // phpcs:ignore ?>
										<?php esc_html_e( 'يبدأ من المستوى 1', 'novira-academy' ); ?>
									</span>
									<?php echo function_exists( 'novira_level_rail' ) ? novira_level_rail( 'edu-rail' ) : ''; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>

									<div class="edu-course__meta">
										<span class="edu-course__rate">
											<?php echo novira_edu_icon( 'star', 14 ); // phpcs:ignore ?>
											<strong><?php echo esc_html( $edu_c['r'] ); ?></strong>
											<em>(<?php echo esc_html( $edu_c['c'] ); ?>)</em>
										</span>
										<span class="edu-course__cat"><?php echo esc_html( $edu_c['cat'] ); ?></span>
									</div>

									<a class="edu-course__cta"
										href="<?php echo esc_url( novira_crs_wa_url( $edu_whatsapp, $edu_c['t'] ) ); ?>"
										target="_blank" rel="noopener noreferrer"
										aria-label="<?php echo esc_attr( sprintf( __( 'سجّل الآن في كورس %s عبر واتساب', 'novira-academy' ), $edu_c['t'] ) ); ?>">
										<?php echo novira_edu_icon( 'whatsapp', 16 ); // phpcs:ignore ?>
										<?php esc_html_e( 'سجّل الآن', 'novira-academy' ); ?>
										<?php echo novira_edu_icon( 'arrow-l', 16 ); // phpcs:ignore ?>
									</a>
								</div>
							</article>
						<?php endforeach; ?>
					</div>
				</div>
				<button class="edu-carousel__nav edu-carousel__nav--next" type="button" aria-label="<?php esc_attr_e( 'التالي', 'novira-academy' ); ?>"><?php echo novira_edu_icon( 'arrow-l', 22 ); // phpcs:ignore ?></button>
			</div>

			<div class="edu-courses__cta" data-reveal>
				<a href="<?php echo esc_url( home_url( '/courses/' ) ); ?>" class="edu-btn edu-btn--primary edu-btn--lg">
					<?php echo novira_edu_icon( 'grid', 20 ); // phpcs:ignore ?>
					<?php esc_html_e( 'عرض جميع الكورسات', 'novira-academy' ); ?>
				</a>
			</div>
		</div>
	</section>

	<?php // ===================== 8. TESTIMONIALS ===================== ?>
	<section class="edu-section edu-quotes">
		<div class="edu-container">
			<h2 class="edu-h2" data-reveal><span class="edu-h2__deco">✦</span> <?php esc_html_e( 'ماذا يقول طلابنا', 'novira-academy' ); ?> <span class="edu-h2__deco">✦</span></h2>
			<div class="edu-quotes__grid" data-reveal>
				<?php
				$edu_quotes = array(
					array( 'q' => __( 'كورسات البرمجة غيرت حياتي بالكامل. دلوقتي بقدر أشتغل في أحلامي من البيت.', 'novira-academy' ), 'n' => __( 'أحمد محمد', 'novira-academy' ), 'r' => __( 'متدرب في Python', 'novira-academy' ), 'h' => '#5b14e6' ),
					array( 'q' => __( 'ابني كان بيكره الإنجليزي. دلوقتي بيتكلم بثقة وبيستنى بكل حصة.', 'novira-academy' ),              'n' => __( 'أ/ منى خالد', 'novira-academy' ), 'r' => __( 'ولي أمر', 'novira-academy' ), 'h' => '#7b2cff' ),
					array( 'q' => __( 'الدعم من البداية للنهاية كان ممتاز، والمدرب في منتهى الاحترافية.', 'novira-academy' ),            'n' => __( 'محمد سامي', 'novira-academy' ), 'r' => __( 'متدرب في ICDL', 'novira-academy' ), 'h' => '#2196ff' ),
				);
				foreach ( $edu_quotes as $edu_n => $edu_q ) : ?>
					<figure class="edu-quote" data-quote="<?php echo (int) $edu_n; ?>">
						<span class="edu-quote__mark"><?php echo novira_edu_icon( 'quote', 30 ); // phpcs:ignore ?></span>
						<blockquote class="edu-quote__text"><?php echo esc_html( $edu_q['q'] ); ?></blockquote>
						<figcaption class="edu-quote__foot">
							<span class="edu-quote__avatar" style="background:<?php echo esc_attr( $edu_q['h'] ); ?>"><?php echo esc_html( mb_substr( $edu_q['n'], 0, 1 ) ); ?></span>
							<span class="edu-quote__who">
								<strong><?php echo esc_html( $edu_q['n'] ); ?></strong>
								<em><?php echo esc_html( $edu_q['r'] ); ?></em>
							</span>
							<span class="edu-quote__stars">
								<?php for ( $edu_i = 0; $edu_i < 5; $edu_i++ ) {
									echo novira_edu_icon( 'star', 13 ); // phpcs:ignore
								} ?>
							</span>
						</figcaption>
					</figure>
				<?php endforeach; ?>
			</div>
			<div class="edu-quotes__dots" role="tablist" aria-label="<?php esc_attr_e( 'آراء الطلاب', 'novira-academy' ); ?>">
				<button class="edu-dot is-active" type="button" data-dot="0" aria-label="1"></button>
				<button class="edu-dot" type="button" data-dot="1" aria-label="2"></button>
				<button class="edu-dot" type="button" data-dot="2" aria-label="3"></button>
			</div>
		</div>
	</section>

	<?php // ===================== 9. CTA BAND ===================== ?>
	<section class="edu-cta">
		<div class="edu-container edu-cta__inner">
			<span class="edu-cta__gift" aria-hidden="true">
				<svg viewBox="0 0 130 130" fill="none" xmlns="http://www.w3.org/2000/svg">
					<rect x="26" y="58" width="78" height="54" rx="7" fill="#7b2cff"/>
					<rect x="26" y="58" width="78" height="17" rx="4" fill="#a06bff"/>
					<rect x="58" y="58" width="14" height="54" fill="#ffd24a"/>
					<path d="M65 56c-7-2-17-7-17-15a8 8 0 0 1 17 3 8 8 0 0 1 17-3c0 8-10 13-17 15z" fill="#ffd24a"/>
					<circle cx="65" cy="39" r="4.5" fill="#fff0b8"/>
				</svg>
			</span>
			<div class="edu-cta__copy">
				<h2 class="edu-cta__t"><?php esc_html_e( 'جاهز تبدأ رحلتك أو تبدأ رحلة نجاح أولادك؟', 'novira-academy' ); ?></h2>
				<p class="edu-cta__s"><?php esc_html_e( 'إنضم لآلاف الطلاب اللي حققوا أهدافهم مع نوفيرا أكاديمي', 'novira-academy' ); ?></p>
			</div>
			<div class="edu-cta__actions">
				<a href="<?php echo esc_url( $edu_wa ); ?>" class="edu-btn edu-btn--white edu-btn--lg" target="_blank" rel="noopener noreferrer">
					<?php echo novira_edu_icon( 'calendar', 20 ); // phpcs:ignore ?>
					<?php esc_html_e( 'احجز استشارتك المجانية', 'novira-academy' ); ?>
				</a>
				<a href="<?php echo esc_url( $edu_wa ); ?>" class="edu-btn edu-btn--ghost-white edu-btn--lg" target="_blank" rel="noopener noreferrer">
					<?php echo novira_edu_icon( 'whatsapp', 20 ); // phpcs:ignore ?>
					<?php esc_html_e( 'تواصل واتساب', 'novira-academy' ); ?>
				</a>
			</div>
		</div>
	</section>

</div><!-- .edu -->

<?php get_footer(); ?>
