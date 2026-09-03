<?php
/**
 * Template: Exams ("امتحانات نوفيرا") Placement-Test Hub
 *
 * Dedicated, pixel-matched landing rebuilt from exams.png. Force-routed for the
 * `exams` page via novira_force_exams_template() (inc/exams-landing.php). Uses
 * the site's global header/footer so navbar + footer match every other page.
 *
 * Section order (per exams.png):
 *   1. hero (students + feature strip)   2. 7 numbered test cards
 *   3. "why test with us" strip          4. tips-before-test (brain mascot)
 *   5. trophy CTA band
 * All markup is scoped under `.exl`.
 *
 * @package Novira_Academy
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$exl_whatsapp = get_theme_mod( 'novira_whatsapp', '201090600927' );
$exl_wa       = 'https://wa.me/' . $exl_whatsapp;
$exl_phone    = get_theme_mod( 'novira_phone', '01090600927' );
$exl_tel      = preg_replace( '/[^0-9+]/', '', '+2' . ltrim( $exl_phone, '0' ) );

/**
 * Card artwork per test key (flat/dimensional SVG, brand-styled).
 *
 * @param string $key Test key.
 * @return string
 */
function novira_exl_card_art( $key ) {
	switch ( $key ) {
		case 'dip-en': // US flag + graduation cap.
			return '<svg viewBox="0 0 120 92" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
				<rect x="24" y="34" width="72" height="46" rx="5" fill="#eef1ff"/>
				<rect x="24" y="34" width="72" height="46" rx="5" fill="url(#exlStripe)"/>
				<rect x="24" y="34" width="34" height="22" rx="3" fill="#3b3fae"/>
				<g fill="#fff"><circle cx="31" cy="41" r="1.1"/><circle cx="38" cy="41" r="1.1"/><circle cx="45" cy="41" r="1.1"/><circle cx="51" cy="41" r="1.1"/><circle cx="34.5" cy="46" r="1.1"/><circle cx="41.5" cy="46" r="1.1"/><circle cx="48" cy="46" r="1.1"/><circle cx="31" cy="51" r="1.1"/><circle cx="38" cy="51" r="1.1"/><circle cx="45" cy="51" r="1.1"/></g>
				<path d="M60 8 24 22l36 14 36-14z" fill="#241046"/>
				<path d="M60 36 33 25.5v9c0 5 12 8.5 27 8.5s27-3.5 27-8.5v-9z" fill="#3a1170"/>
				<path d="M96 22v13" stroke="#ffb020" stroke-width="2.4" stroke-linecap="round"/>
				<circle cx="96" cy="37" r="3.4" fill="#ffb020"/>
				<defs><linearGradient id="exlStripe" x1="24" y1="34" x2="24" y2="80" gradientUnits="userSpaceOnUse"><stop stop-color="#ff6b7a" stop-opacity=".18"/><stop offset="1" stop-color="#ff6b7a" stop-opacity=".05"/></linearGradient></defs>
			</svg>';

		case 'dip-math': // Calculator with operator keys.
			return '<svg viewBox="0 0 120 92" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
				<rect x="34" y="14" width="52" height="66" rx="10" fill="#1f2a63"/>
				<rect x="40" y="20" width="40" height="14" rx="4" fill="#cdd6ff"/>
				<circle cx="48" cy="46" r="8" fill="#7b2cff"/><path d="M48 42.5v7M44.5 46h7" stroke="#fff" stroke-width="2.2" stroke-linecap="round"/>
				<circle cx="72" cy="46" r="8" fill="#2196ff"/><path d="m69 43 6 6M75 43l-6 6" stroke="#fff" stroke-width="2.2" stroke-linecap="round"/>
				<circle cx="48" cy="66" r="8" fill="#e0344a"/><path d="M44.5 66h7" stroke="#fff" stroke-width="2.2" stroke-linecap="round"/>
				<circle cx="72" cy="66" r="8" fill="#f59e0b"/><path d="M68.5 66h7" stroke="#fff" stroke-width="2.2" stroke-linecap="round"/><circle cx="72" cy="62.5" r="1.5" fill="#fff"/><circle cx="72" cy="69.5" r="1.5" fill="#fff"/>
			</svg>';

		case 'gen-en': // Chat bubbles.
			return '<svg viewBox="0 0 120 92" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
				<path d="M28 24h44a8 8 0 0 1 8 8v14a8 8 0 0 1-8 8H46l-12 9v-9h-6a8 8 0 0 1-8-8V32a8 8 0 0 1 8-8z" fill="#14b8a6"/>
				<circle cx="40" cy="39" r="2.6" fill="#fff"/><circle cx="50" cy="39" r="2.6" fill="#fff"/><circle cx="60" cy="39" r="2.6" fill="#fff"/>
				<path d="M66 46h30a7 7 0 0 1 7 7v10a7 7 0 0 1-7 7H84l6 7-14-7h-10a7 7 0 0 1-7-7V53a7 7 0 0 1 7-7z" fill="#0d9488"/>
				<path d="M74 55h16M74 61h10" stroke="#fff" stroke-width="2.4" stroke-linecap="round"/>
			</svg>';

		case 'ielts':
			return '<span class="exl-wordmark exl-wordmark--ielts">IELTS<sup>™</sup></span>';

		case 'toefl':
			return '<span class="exl-wordmark exl-wordmark--toefl">TOEFL<b>iBT</b><sup>®</sup></span>';

		case 'flag-de':
			return '<svg viewBox="0 0 120 92" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
				<rect x="30" y="16" width="3.4" height="66" rx="1.7" fill="#8a6b3a"/><circle cx="31.7" cy="16" r="3.2" fill="#ffb020"/>
				<path d="M35 20c16-6 30 6 46 0v14c-16 6-30-6-46 0z" fill="#1a1a1a"/>
				<path d="M35 34c16-6 30 6 46 0v14c-16 6-30-6-46 0z" fill="#e0344a"/>
				<path d="M35 48c16-6 30 6 46 0v14c-16 6-30-6-46 0z" fill="#ffce33"/>
			</svg>';

		case 'flag-fr':
			return '<svg viewBox="0 0 120 92" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
				<rect x="30" y="16" width="3.4" height="66" rx="1.7" fill="#8a6b3a"/><circle cx="31.7" cy="16" r="3.2" fill="#ffb020"/>
				<path d="M35 20c5-2 10-2 15.3 0v42c-5.3-2-10.3-2-15.3 0z" fill="#2453d6"/>
				<path d="M50.3 20c5.3 2 10.3 2 15.4 0v42c-5.1 2-10.1 2-15.4 0z" fill="#f4f6ff"/>
				<path d="M65.7 20c5.1 2 10.3-.5 15.3-2v42c-5 1.5-10.2 4-15.3 2z" fill="#e0344a"/>
			</svg>';
	}
	return '';
}

/**
 * Two-student hero illustration (flat SVG). The stage is photo-ready — drop a
 * real cut-out into assets/images and swap this for an <img> later.
 */
function novira_exl_students_svg() {
	$exl_students_label = esc_attr__( 'طلاب نوفيرا يؤدون اختبار تحديد المستوى', 'novira-academy' );
	return <<<SVG
<svg class="exl-students" viewBox="0 0 440 400" preserveAspectRatio="xMidYMax slice" fill="none" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="{$exl_students_label}">
	<defs>
		<linearGradient id="exlHoodie" x1="60" y1="200" x2="200" y2="380" gradientUnits="userSpaceOnUse"><stop stop-color="#7b2cff"/><stop offset="1" stop-color="#4c0fc4"/></linearGradient>
		<linearGradient id="exlLaptop" x1="150" y1="300" x2="330" y2="380" gradientUnits="userSpaceOnUse"><stop stop-color="#d7d2ea"/><stop offset="1" stop-color="#b7b0d4"/></linearGradient>
	</defs>
	<!-- back student (boy, hoodie + backpack) -->
	<path d="M70 400c0-70 40-118 96-118 30 0 54 14 70 36l-30 82z" fill="url(#exlHoodie)"/>
	<rect x="70" y="250" width="30" height="80" rx="12" fill="#3a1170"/>
	<path d="M150 262c8 16 40 16 48 0l-4 30-40 0z" fill="#fff" fill-opacity=".14"/>
	<circle cx="130" cy="330" r="15" fill="#fff" fill-opacity=".14"/><path d="M123 338v-16l8 10v-10h1v16l-8-10v10z" fill="#fff"/>
	<path d="M158 236h38v40c0 10-38 10-38 0z" fill="#e8ac86"/>
	<ellipse cx="177" cy="176" rx="52" ry="56" fill="#f2ba92"/>
	<path d="M126 172c0-40 24-64 51-64s51 24 51 64c0 6-1 10-2 14-4-26-18-38-30-38-6 8-32 8-38 0-12 0-26 12-30 38-1-4-2-8-2-14z" fill="#241a12"/>
	<circle cx="160" cy="176" r="4.4" fill="#241a12"/><circle cx="196" cy="176" r="4.4" fill="#241a12"/>
	<path d="M164 200c8 8 22 8 30 0" stroke="#b46a44" stroke-width="4" stroke-linecap="round"/>
	<!-- front student (girl, headphones + laptop) -->
	<path d="M188 400c0-64 42-108 92-108s92 44 92 108z" fill="#f4f2fb"/>
	<path d="M258 300c9 14 40 14 49 0l-5 34-39 0z" fill="#efeaff"/>
	<path d="M262 276h44v40c0 10-44 10-44 0z" fill="#eeb892"/>
	<ellipse cx="284" cy="214" rx="50" ry="54" fill="#f7c39c"/>
	<path d="M235 214c0-42 22-66 49-66s49 22 49 62c0 8-2 16-5 22-2-16-6-26-12-32-6 30-72 30-78 0-4 4-6 12-6 24-2-4-3-8-3-10z" fill="#3a2a18"/>
	<path d="M231 206c-6 40 8 66 8 66l10-8c-6-14-8-34-6-52z" fill="#3a2a18"/>
	<path d="M337 206c6 40-8 66-8 66l-10-8c6-14 8-34 6-52z" fill="#3a2a18"/>
	<circle cx="268" cy="216" r="4.2" fill="#3a2a18"/><circle cx="302" cy="216" r="4.2" fill="#3a2a18"/>
	<path d="M272 236c8 8 20 8 28 0" stroke="#c9744c" stroke-width="4" stroke-linecap="round"/>
	<!-- headphones -->
	<path d="M243 214c0-30 18-52 41-52s41 22 41 52" stroke="#5b14e6" stroke-width="9" stroke-linecap="round"/>
	<rect x="233" y="206" width="18" height="30" rx="9" fill="#5b14e6"/><rect x="317" y="206" width="18" height="30" rx="9" fill="#5b14e6"/>
	<!-- laptop -->
	<path d="M300 356l60-26 26 12-60 28z" fill="url(#exlLaptop)"/>
	<path d="M300 356l26 12 60-28-26-12z" fill="#eceaf6"/>
	<rect x="322" y="330" width="44" height="30" rx="3" transform="rotate(-24 344 345)" fill="#241046"/>
	<path d="M334 342h18M334 348h12" stroke="#7b2cff" stroke-width="2" stroke-linecap="round"/>
</svg>
SVG;
}

/**
 * Brain-with-dumbbell mascot for the tips band (flat SVG).
 */
function novira_exl_brain_svg() {
	return <<<'SVG'
<svg class="exl-brain" viewBox="0 0 160 150" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
	<ellipse cx="80" cy="140" rx="44" ry="7" fill="#5b14e6" fill-opacity=".12"/>
	<!-- brain body -->
	<path d="M56 44c-14 0-24 10-24 22 0 4 1 8 3 11-3 3-5 7-5 12 0 12 11 21 26 21h32c15 0 26-9 26-21 0-5-2-9-5-12 2-3 3-7 3-11 0-12-10-22-24-22-4-6-11-10-16-10s-12 4-16 10z" fill="#ffb6c8"/>
	<path d="M80 40v70M60 52c-6 4-8 12-4 18M100 52c6 4 8 12 4 18M54 78c-4 4-4 12 2 16M106 78c4 4 4 12-2 16M80 60c-8 2-12 8-10 16M80 74c8 2 12 8 10 16" stroke="#e78ba6" stroke-width="2.4" stroke-linecap="round"/>
	<!-- eyes -->
	<circle cx="70" cy="74" r="7" fill="#fff"/><circle cx="90" cy="74" r="7" fill="#fff"/><circle cx="71" cy="75" r="3" fill="#241046"/><circle cx="91" cy="75" r="3" fill="#241046"/>
	<path d="M74 88c4 3 8 3 12 0" stroke="#c0567a" stroke-width="2.4" stroke-linecap="round"/>
	<!-- arms + dumbbell -->
	<path d="M46 96c-8 0-14 6-14 14" stroke="#ffb6c8" stroke-width="8" stroke-linecap="round"/>
	<path d="M114 96c8 0 14 6 14 14" stroke="#ffb6c8" stroke-width="8" stroke-linecap="round"/>
	<rect x="20" y="104" width="10" height="20" rx="3" fill="#5b14e6"/><rect x="28" y="108" width="8" height="12" rx="2" fill="#7b2cff"/>
	<rect x="130" y="104" width="10" height="20" rx="3" fill="#5b14e6"/><rect x="124" y="108" width="8" height="12" rx="2" fill="#7b2cff"/>
	<rect x="34" y="112" width="92" height="5" rx="2.5" fill="#3a1170"/>
</svg>
SVG;
}

/**
 * Trophy for the CTA band (flat SVG with an N badge).
 */
function novira_exl_trophy_svg() {
	return <<<'SVG'
<svg class="exl-trophy" viewBox="0 0 150 140" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
	<ellipse cx="75" cy="132" rx="46" ry="7" fill="#000" fill-opacity=".18"/>
	<rect x="52" y="112" width="46" height="12" rx="3" fill="#c9a227"/>
	<rect x="60" y="100" width="30" height="14" rx="2" fill="#e0b83a"/>
	<path d="M45 30h60v18c0 20-13 34-30 34S45 68 45 48z" fill="url(#exlCup)"/>
	<path d="M45 34H32c0 14 7 22 20 24" stroke="#ffd24a" stroke-width="6" fill="none" stroke-linecap="round"/>
	<path d="M105 34h13c0 14-7 22-20 24" stroke="#ffd24a" stroke-width="6" fill="none" stroke-linecap="round"/>
	<circle cx="75" cy="48" r="16" fill="#fff" fill-opacity=".22"/>
	<path d="M68 58V38l14 20V38h1.5v20L69.5 38v20z" fill="#fff"/>
	<defs><linearGradient id="exlCup" x1="45" y1="30" x2="105" y2="82" gradientUnits="userSpaceOnUse"><stop stop-color="#ffe27a"/><stop offset="1" stop-color="#e0a92a"/></linearGradient></defs>
</svg>
SVG;
}

get_header();
?>

<div class="exl">

	<?php // ===================== 1. HERO ===================== ?>
	<section class="exl-hero">
		<div class="exl-hero__bg" aria-hidden="true">
			<span class="exl-hero__glow exl-hero__glow--a"></span>
			<span class="exl-hero__glow exl-hero__glow--b"></span>
			<span class="exl-hero__grid"></span>
		</div>
		<div class="exl-container exl-hero__inner">

			<div class="exl-hero__copy">
				<h1 class="exl-hero__title" data-reveal>
					<?php esc_html_e( 'امتحانات نوفيرا', 'novira-academy' ); ?>
					<span class="exl-hero__title-2"><?php esc_html_e( 'اضغط لاختبارك المناسب', 'novira-academy' ); ?></span>
				</h1>
				<p class="exl-hero__desc" data-reveal style="--i:1">
					<?php esc_html_e( 'اختر الاختبار الذي تريد تحديد مستواك فيه بدقة واستعد بثقة لتحقيق أعلى النتائج.', 'novira-academy' ); ?>
				</p>

				<div class="exl-hero__features" data-reveal style="--i:2">
					<?php
					$exl_hero_feats = array(
						array( 'i' => 'gauge',   't' => __( 'نتائج دقيقة وفورية', 'novira-academy' ) ),
						array( 'i' => 'globe',   't' => __( 'اختبارات معتمدة عالمياً', 'novira-academy' ) ),
						array( 'i' => 'bolt',    't' => __( 'تجربة سهلة وسريعة', 'novira-academy' ) ),
						array( 'i' => 'chartup', 't' => __( 'متابعة وتطوير مستواك', 'novira-academy' ) ),
					);
					foreach ( $exl_hero_feats as $exl_hf ) : ?>
						<div class="exl-feat">
							<span class="exl-feat__ico"><?php echo novira_exl_icon( $exl_hf['i'], 24 ); // phpcs:ignore ?></span>
							<span class="exl-feat__t"><?php echo esc_html( $exl_hf['t'] ); ?></span>
						</div>
					<?php endforeach; ?>
				</div>
			</div>

			<div class="exl-hero__stage" data-reveal>
				<span class="exl-hero__blob" aria-hidden="true"></span>
				<span class="exl-hero__ring" aria-hidden="true"></span>
				<?php echo novira_exl_students_svg(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
				<span class="exl-chip exl-chip--1" style="--d:.6s"><?php echo novira_exl_icon( 'shieldcheck', 18 ); // phpcs:ignore ?></span>
				<span class="exl-chip exl-chip--2" style="--d:1s"><?php echo novira_exl_icon( 'chartup', 18 ); // phpcs:ignore ?></span>
				<span class="exl-chip exl-chip--3" style="--d:1.4s"><?php echo novira_exl_icon( 'sparkle', 18 ); // phpcs:ignore ?></span>
			</div>

		</div>
	</section>

	<?php // ===================== 2. TEST CARDS ===================== ?>
	<section class="exl-section exl-tests">
		<div class="exl-container">
			<h2 class="exl-h2" data-reveal>
				<span class="exl-h2__mark" aria-hidden="true"><?php echo novira_exl_icon( 'sparkle', 18 ); // phpcs:ignore ?></span>
				<?php esc_html_e( 'اختر الاختبار المناسب لك', 'novira-academy' ); ?>
				<span class="exl-h2__mark" aria-hidden="true"><?php echo novira_exl_icon( 'sparkle', 18 ); // phpcs:ignore ?></span>
			</h2>
			<p class="exl-sub" data-reveal><?php esc_html_e( 'اختر نوع الامتحان الذي ترغب في تحديد مستواك فيه الآن', 'novira-academy' ); ?></p>

			<div class="exl-tests__grid">
				<?php
				/*
				 * TODO: replace every `form` URL below with the real exam form link for
				 * that test. They are placeholders on example.com right now — one per
				 * card, so each is a single find-and-replace. Leave a `form` empty ('')
				 * and that card falls back to the WhatsApp link.
				 */
				$exl_tests = array(
					array( 'n' => '01', 'key' => 'dip-en',   'c' => 'purple', 'title' => __( 'تحديد انجلش الدبلومة الامريكية', 'novira-academy' ), 'desc' => __( 'اختبار تحديد مستوى اللغة الانجليزية لدبلومة الأمريكية', 'novira-academy' ), 'form' => 'https://forms.gle/dBMLvrHAkNioZZTi7' ),
					array( 'n' => '02', 'key' => 'dip-math', 'c' => 'blue',   'title' => __( 'تحديد ماث الدبلومة الامريكية', 'novira-academy' ),   'desc' => __( 'اختبار تحديد مستوى مادة الرياضيات لدبلومة الأمريكية', 'novira-academy' ), 'form' => 'https://forms.gle/nZURWHdcqehhrF6WA' ),
					array( 'n' => '03', 'key' => 'gen-en',   'c' => 'teal',   'title' => __( 'تحديد انجلش جينرال - محادثات', 'novira-academy' ),   'desc' => __( 'اختبار تحديد مستوى اللغة الإنجليزية (محادثة عامة)', 'novira-academy' ), 'form' => 'https://docs.google.com/forms/d/e/1FAIpQLSdgWl-0TlKLZi038gpPBV-A17Ef3AMD9T3RrSzFHBpbNY67xg/viewform' ),
					array( 'n' => '04', 'key' => 'ielts',    'c' => 'pink',   'title' => __( 'تحديد مستوي ايلتس', 'novira-academy' ),              'desc' => __( 'اختبار تحديد مستوى IELTS', 'novira-academy' ), 'form' => 'https://forms.gle/X1HDVvVnQAoYf3Vo8' ),
					array( 'n' => '05', 'key' => 'toefl',    'c' => 'blue2',  'title' => __( 'تحديد مستوي تويفل', 'novira-academy' ),              'desc' => __( 'اختبار تحديد مستوى TOEFL', 'novira-academy' ), 'form' => 'https://forms.gle/zuNNtfXL898GRr3w7' ),
					array( 'n' => '06', 'key' => 'flag-de',  'c' => 'gold',   'title' => __( 'تحديد الماني عام - محادثات', 'novira-academy' ),     'desc' => __( 'اختبار تحديد مستوى اللغة الألمانية (محادثة عامة)', 'novira-academy' ), 'form' => 'https://docs.google.com/forms/d/e/1FAIpQLSe2-g-Zfm-CAHV3ZwCeeTfdxAHQ0ubwZTBxaGXdV8jkqEVm8g/viewform' ),
					array( 'n' => '07', 'key' => 'flag-fr',  'c' => 'violet', 'title' => __( 'تحديد فرنش عام - محادثات', 'novira-academy' ),       'desc' => __( 'اختبار تحديد مستوى اللغة الفرنسية (محادثة عامة)', 'novira-academy' ), 'form' => 'https://forms.gle/J2y2xeCoqRhjVkTJ8' ),
				);
				foreach ( $exl_tests as $exl_ti => $exl_t ) :
					$exl_form = ! empty( $exl_t['form'] ) ? $exl_t['form'] : $exl_wa;
					?>
					<article class="exl-test exl-test--<?php echo esc_attr( $exl_t['c'] ); ?>" data-reveal style="--i:<?php echo (int) ( $exl_ti % 4 ); ?>">
						<span class="exl-test__num"><?php echo esc_html( $exl_t['n'] ); ?></span>
						<div class="exl-test__art"><?php echo novira_exl_card_art( $exl_t['key'] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></div>
						<h3 class="exl-test__title"><?php echo esc_html( $exl_t['title'] ); ?></h3>
						<p class="exl-test__desc"><?php echo esc_html( $exl_t['desc'] ); ?></p>
						<a class="exl-test__btn" href="<?php echo esc_url( $exl_form ); ?>" target="_blank" rel="noopener noreferrer">
							<span class="exl-test__btn-txt"><?php esc_html_e( 'ابدأ الاختبار الآن', 'novira-academy' ); ?></span>
							<span class="exl-test__btn-ico"><?php echo novira_exl_icon( 'arrow', 18 ); // phpcs:ignore ?></span>
						</a>
					</article>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

	<?php // ===================== 3. WHY TEST WITH US ===================== ?>
	<section class="exl-section exl-why-wrap">
		<div class="exl-container">
			<h2 class="exl-h2 exl-h2--plain" data-reveal><?php esc_html_e( 'لماذا تحدد مستواك معنا؟', 'novira-academy' ); ?></h2>
			<div class="exl-why" data-reveal>
				<?php
				$exl_why = array(
					array( 'i' => 'target',      't' => __( 'تحديد دقيق لمستواك', 'novira-academy' ), 'd' => __( 'تقنيات اختبار متقدمة لنتائج دقيقة 100%', 'novira-academy' ) ),
					array( 'i' => 'route',       't' => __( 'تحديد مسارك التعليمي', 'novira-academy' ), 'd' => __( 'نضع لك خطة مناسبة لمستواك وأهدافك', 'novira-academy' ) ),
					array( 'i' => 'chartup',     't' => __( 'متابعة تطورك', 'novira-academy' ), 'd' => __( 'اختبارات دورية لقياس تحسن مستواك', 'novira-academy' ) ),
					array( 'i' => 'award',       't' => __( 'معتمد ومعترف به', 'novira-academy' ), 'd' => __( 'نتائج معتمدة تساعدك في اتخاذ قرارك بثقة', 'novira-academy' ) ),
					array( 'i' => 'clock',       't' => __( 'سريع وسهل', 'novira-academy' ), 'd' => __( 'اختبار تفاعلي سريع ونتائج فورية', 'novira-academy' ) ),
				);
				foreach ( $exl_why as $exl_wi => $exl_w ) : ?>
					<div class="exl-why__item" data-reveal style="--i:<?php echo (int) $exl_wi; ?>">
						<span class="exl-why__ico"><?php echo novira_exl_icon( $exl_w['i'], 28 ); // phpcs:ignore ?></span>
						<h4><?php echo esc_html( $exl_w['t'] ); ?></h4>
						<p><?php echo esc_html( $exl_w['d'] ); ?></p>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

	<?php // ===================== 4. TIPS BEFORE THE TEST ===================== ?>
	<section class="exl-section exl-tips-wrap">
		<div class="exl-container">
			<div class="exl-tips" data-reveal>
				<span class="exl-tips__mascot" aria-hidden="true"><?php echo novira_exl_brain_svg(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
				<h2 class="exl-tips__title"><?php esc_html_e( 'نصائح قبل الاختبار', 'novira-academy' ); ?></h2>
				<div class="exl-tips__grid">
					<?php
					$exl_tips = array(
						array( 'i' => 'quiet',       't' => __( 'اختر وقتاً هادئاً', 'novira-academy' ), 'd' => __( 'لتركيز أفضل', 'novira-academy' ) ),
						array( 'i' => 'wifi',        't' => __( 'تأكد من اتصال الإنترنت', 'novira-academy' ), 'd' => __( 'قبل بدء الاختبار', 'novira-academy' ) ),
						array( 'i' => 'shieldcheck', 't' => __( 'أجب بصدق', 'novira-academy' ), 'd' => __( 'للحصول على نتيجة دقيقة', 'novira-academy' ) ),
						array( 'i' => 'clock',       't' => __( 'لا تقلق', 'novira-academy' ), 'd' => __( 'الاختبار لتحديد مستواك وليس للنجاح أو الرسوب', 'novira-academy' ) ),
					);
					foreach ( $exl_tips as $exl_pi => $exl_p ) : ?>
						<div class="exl-tip" data-reveal style="--i:<?php echo (int) $exl_pi; ?>">
							<span class="exl-tip__ico"><?php echo novira_exl_icon( $exl_p['i'], 24 ); // phpcs:ignore ?></span>
							<div class="exl-tip__body">
								<h4><?php echo esc_html( $exl_p['t'] ); ?></h4>
								<p><?php echo esc_html( $exl_p['d'] ); ?></p>
							</div>
						</div>
					<?php endforeach; ?>
				</div>
			</div>
		</div>
	</section>

	<?php // ===================== 5. CTA BAND ===================== ?>
	<section class="exl-cta">
		<div class="exl-container exl-cta__inner">
			<span class="exl-cta__art" aria-hidden="true"><?php echo novira_exl_trophy_svg(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
			<div class="exl-cta__copy">
				<h2 class="exl-cta__t"><?php esc_html_e( 'ابدأ رحلتك نحو التميز الآن!', 'novira-academy' ); ?></h2>
				<p class="exl-cta__s"><?php esc_html_e( 'حدد مستواك الآن واتخذ الخطوة الأولى نحو تحقيق أهدافك الأكاديمية والمهنية', 'novira-academy' ); ?></p>
			</div>
			<div class="exl-cta__actions">
				<a href="<?php echo esc_url( $exl_wa ); ?>" class="exl-cta__btn exl-cta__btn--white" target="_blank" rel="noopener noreferrer">
					<span class="exl-cta__btn-ico exl-cta__btn-ico--wa"><?php echo novira_exl_icon( 'whatsapp', 18 ); // phpcs:ignore ?></span>
					<?php esc_html_e( 'تواصل معنا على واتساب', 'novira-academy' ); ?>
				</a>
				<a href="tel:<?php echo esc_attr( $exl_tel ); ?>" class="exl-cta__btn exl-cta__btn--ghost">
					<?php echo esc_html( $exl_phone ); ?>
					<span class="exl-cta__btn-ico"><?php echo novira_exl_icon( 'phone', 18 ); // phpcs:ignore ?></span>
				</a>
			</div>
		</div>
	</section>

</div><!-- .exl -->

<?php get_footer(); ?>
