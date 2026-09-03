<?php
/**
 * Template: Contact ("تواصل معنا") Landing
 *
 * Dedicated, pixel-matched landing rebuilt from contact.png. Force-routed for
 * the `contact` page via novira_force_contact_template() (template_include,
 * inc/contact-landing.php). Uses the site's global header/footer so the navbar
 * and footer match every other page — no bespoke chrome.
 *
 * Section order (per contact.png):
 *   1. hero (agent + floating badges)     2. contact channels (5 cards)
 *   3. availability banner                4. map + location features
 *   5. trust strip                        6. CTA band
 * All markup is scoped under `.ct`.
 *
 * @package Novira_Academy
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$ct_whatsapp   = get_theme_mod( 'novira_whatsapp', '201090600927' );
$ct_wa         = 'https://wa.me/' . $ct_whatsapp;
$ct_phone      = get_theme_mod( 'novira_phone', '01090600927' );
$ct_tel        = preg_replace( '/[^0-9+]/', '', '+2' . ltrim( $ct_phone, '0' ) );
$ct_facebook   = get_theme_mod( 'novira_facebook', 'https://www.facebook.com/noviraacademy' );
$ct_ig_handle  = 'noviraacademy';
$ct_ig_url     = get_theme_mod( 'novira_instagram', 'https://www.instagram.com/noviraacademy?igsh=MXBlcnZ1b3o4NThraw==' );

// Google Maps: real place-id embed (same pin as the homepage map) + external
// "directions" deep link.
$ct_place      = 'Novira Academy, Bani Mazar, El Minya';
$ct_map_embed  = 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3506.3574745753367!2d30.802484900000007!3d28.4988907!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x145b078be7939ae5%3A0x5dde6c04c556b01!2sNovira%20Academy!5e0!3m2!1sar!2seg!4v1781613107625!5m2!1sar!2seg';
$ct_map_link   = 'https://www.google.com/maps/search/?api=1&query=' . rawurlencode( $ct_place );

/**
 * Brand support-agent illustration (flat SVG bust). Fills the hero's gradient
 * stage. Drop a real cut-out photo into assets/images and swap this for an
 * <img> when one is available — the stage styling is photo-ready.
 */
function novira_ct_agent_svg() {
	$svg_open = sprintf(
		'<svg class="ct-agent" viewBox="0 0 440 480" fill="none" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="%s">',
		esc_attr__( 'فريق دعم نوفيرا أكاديمي', 'novira-academy' )
	);

	return $svg_open . "\n" . <<<'SVG'
	<defs>
		<linearGradient id="ctPolo" x1="90" y1="300" x2="360" y2="480" gradientUnits="userSpaceOnUse">
			<stop stop-color="#7b2cff"/><stop offset="1" stop-color="#4c0fc4"/>
		</linearGradient>
		<linearGradient id="ctBand" x1="120" y1="70" x2="320" y2="120" gradientUnits="userSpaceOnUse">
			<stop stop-color="#3a1170"/><stop offset="1" stop-color="#241046"/>
		</linearGradient>
	</defs>
	<!-- polo / shoulders -->
	<path d="M70 480c0-84 61-150 150-150s150 66 150 150z" fill="url(#ctPolo)"/>
	<path d="M186 342c11 26 57 26 68 0l-6 42-56 0z" fill="#fff" fill-opacity=".14"/>
	<!-- collar -->
	<path d="M188 340l32 30 32-30-14-8-18 14-18-14z" fill="#fff" fill-opacity=".9"/>
	<!-- N badge on chest -->
	<circle cx="285" cy="430" r="20" fill="#fff" fill-opacity=".16"/>
	<path d="M276 440v-20l9 12v-12h1v20l-9-12v12z" fill="#fff"/>
	<!-- neck -->
	<path d="M198 300h44v46c0 12-44 12-44 0z" fill="#e8ac86"/>
	<path d="M198 322c14 12 30 12 44 0v-22h-44z" fill="#000" fill-opacity=".08"/>
	<!-- head -->
	<ellipse cx="220" cy="232" rx="86" ry="94" fill="#f2ba92"/>
	<path d="M134 232c0-8 2-15 5-22 10 40 152 40 162 0 3 7 5 14 5 22 0 52-38 94-86 94s-86-42-86-94z" fill="#f2ba92"/>
	<!-- ears -->
	<circle cx="136" cy="238" r="15" fill="#e8ac86"/>
	<circle cx="304" cy="238" r="15" fill="#e8ac86"/>
	<!-- hair -->
	<path d="M132 214c0-58 40-92 88-92s88 34 88 92c0 8-1 16-3 22-6-40-26-58-45-58-8 12-72 12-80 0-19 0-39 18-45 58-2-6-3-14-3-22z" fill="#2a1c3a"/>
	<!-- eyebrows -->
	<path d="M170 214c9-6 22-6 31 0" stroke="#2a1c3a" stroke-width="5" stroke-linecap="round"/>
	<path d="M239 214c9-6 22-6 31 0" stroke="#2a1c3a" stroke-width="5" stroke-linecap="round"/>
	<!-- eyes -->
	<circle cx="185" cy="234" r="6.5" fill="#2a1c3a"/>
	<circle cx="255" cy="234" r="6.5" fill="#2a1c3a"/>
	<!-- smile -->
	<path d="M196 272c14 16 34 16 48 0" stroke="#b46a44" stroke-width="6" stroke-linecap="round"/>
	<!-- headset band -->
	<path d="M118 244c0-64 46-116 102-116s102 52 102 116" stroke="url(#ctBand)" stroke-width="16" stroke-linecap="round"/>
	<!-- ear cups -->
	<rect x="104" y="230" width="34" height="52" rx="16" fill="#3a1170"/>
	<rect x="302" y="230" width="34" height="52" rx="16" fill="#3a1170"/>
	<rect x="110" y="238" width="22" height="36" rx="11" fill="#7b2cff"/>
	<rect x="308" y="238" width="22" height="36" rx="11" fill="#7b2cff"/>
	<!-- mic boom -->
	<path d="M121 282c0 34 12 58 44 66" stroke="#3a1170" stroke-width="10" stroke-linecap="round"/>
	<circle cx="168" cy="350" r="12" fill="#7b2cff"/>
	<circle cx="168" cy="350" r="5" fill="#fff" fill-opacity=".7"/>
</svg>
SVG;
}

get_header();
?>

<div class="ct">

	<?php // ===================== 1. HERO ===================== ?>
	<section class="ct-hero">
		<div class="ct-hero__bg" aria-hidden="true">
			<span class="ct-hero__glow ct-hero__glow--a"></span>
			<span class="ct-hero__glow ct-hero__glow--b"></span>
			<span class="ct-hero__grid"></span>
		</div>
		<div class="ct-container ct-hero__inner">

			<div class="ct-hero__copy">
				<span class="ct-eyebrow" data-reveal><?php esc_html_e( 'تواصل معنا', 'novira-academy' ); ?></span>
				<h1 class="ct-hero__title" data-reveal style="--i:1">
					<?php esc_html_e( 'نحن هنا لمساعدتك', 'novira-academy' ); ?>
					<span class="ct-hero__title-2"><?php esc_html_e( 'في كل خطوة من رحلتك التعليمية', 'novira-academy' ); ?></span>
				</h1>
				<p class="ct-hero__desc" data-reveal style="--i:2">
					<?php esc_html_e( 'فريق نوفيرا أكاديمي جاهز للرد على استفساراتك وتقديم أفضل دعم لك ولأسرتك.', 'novira-academy' ); ?>
				</p>

				<div class="ct-hero__actions" data-reveal style="--i:3">
					<a href="tel:<?php echo esc_attr( $ct_tel ); ?>" class="ct-btn ct-btn--primary">
						<span class="ct-btn__ico"><?php echo novira_ct_icon( 'phone', 20 ); // phpcs:ignore ?></span>
						<?php esc_html_e( 'اتصل بنا الآن', 'novira-academy' ); ?>
					</a>
					<a href="<?php echo esc_url( $ct_wa ); ?>" class="ct-btn ct-btn--wa" target="_blank" rel="noopener noreferrer">
						<span class="ct-btn__ico"><?php echo novira_ct_icon( 'whatsapp', 20 ); // phpcs:ignore ?></span>
						<?php esc_html_e( 'تواصل واتساب', 'novira-academy' ); ?>
					</a>
				</div>

				<div class="ct-hero__proof" data-reveal style="--i:4">
					<span class="ct-avatars" aria-hidden="true">
						<span class="ct-avatars__dot" style="--h:14"></span>
						<span class="ct-avatars__dot" style="--h:262"></span>
						<span class="ct-avatars__dot" style="--h:210"></span>
					</span>
					<p class="ct-hero__proof-text">
						<?php echo wp_kses( __( 'أكثر من <b>10,000</b> طالب وأولياء أمور يتواصلون معنا عبر واتساب !', 'novira-academy' ), array( 'b' => array() ) ); ?>
					</p>
					<span class="ct-hero__proof-heart"><?php echo novira_ct_icon( 'heart', 22 ); // phpcs:ignore ?></span>
				</div>
			</div>

			<div class="ct-hero__stage" data-reveal style="--i:2">
				<span class="ct-hero__blob" aria-hidden="true"></span>
				<span class="ct-hero__ring" aria-hidden="true"></span>
				<?php echo novira_ct_agent_svg(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>

				<div class="ct-float ct-float--top" style="--d:.9s">
					<span class="ct-float__ico ct-float__ico--wa"><?php echo novira_ct_icon( 'whatsapp', 20 ); // phpcs:ignore ?></span>
					<span class="ct-float__body">
						<b><?php esc_html_e( 'رد سريع', 'novira-academy' ); ?></b>
						<em><?php esc_html_e( 'فريق دعم متواجد دائماً', 'novira-academy' ); ?></em>
					</span>
				</div>
				<div class="ct-float ct-float--mid" style="--d:1.2s">
					<span class="ct-float__ico ct-float__ico--purple"><?php echo novira_ct_icon( 'headset', 20 ); // phpcs:ignore ?></span>
					<span class="ct-float__body">
						<b><?php esc_html_e( 'دعم حقيقي', 'novira-academy' ); ?></b>
						<em><?php esc_html_e( 'نحن معك حتى تحقق هدفك', 'novira-academy' ); ?></em>
					</span>
				</div>
				<span class="ct-float ct-float--bubble" style="--d:1.5s" aria-hidden="true">
					<?php echo novira_ct_icon( 'whatsapp', 26 ); // phpcs:ignore ?>
				</span>
			</div>

		</div>
	</section>

	<?php // ===================== 2. CONTACT CHANNELS ===================== ?>
	<section class="ct-section ct-channels">
		<div class="ct-container">
			<h2 class="ct-h2" data-reveal>
				<span class="ct-h2__mark" aria-hidden="true"><?php echo novira_ct_icon( 'sparkle', 18 ); // phpcs:ignore ?></span>
				<?php esc_html_e( 'اختر طريقة التواصل التي تناسبك', 'novira-academy' ); ?>
				<span class="ct-h2__mark" aria-hidden="true"><?php echo novira_ct_icon( 'sparkle', 18 ); // phpcs:ignore ?></span>
			</h2>

			<div class="ct-channels__grid">
				<?php
				$ct_channels = array(
					array(
						'key'   => 'whatsapp',
						'ico'   => 'whatsapp',
						'title' => __( 'واتساب', 'novira-academy' ),
						'desc'  => __( 'تواصل معنا على واتساب للحصول على رد سريع', 'novira-academy' ),
						'cta'   => __( 'تواصل واتساب الآن', 'novira-academy' ),
						'href'  => $ct_wa,
						'ext'   => true,
						'note'  => __( 'مفتوح طوال اليوم', 'novira-academy' ),
					),
					array(
						'key'   => 'phone',
						'ico'   => 'phone',
						'title' => __( 'اتصل بنا', 'novira-academy' ),
						'desc'  => __( 'تحدث مباشرة مع فريق الدعم في أوقات العمل', 'novira-academy' ),
						'cta'   => $ct_phone,
						'href'  => 'tel:' . $ct_tel,
						'ext'   => false,
						'note'  => __( 'من 9:00 ص إلى 10:00 م', 'novira-academy' ),
					),
					array(
						'key'   => 'instagram',
						'ico'   => 'instagram',
						'title' => __( 'انستجرام', 'novira-academy' ),
						'desc'  => __( 'تابعنا على انستجرام وتواصل عبر الرسائل', 'novira-academy' ),
						'cta'   => '@' . $ct_ig_handle,
						'href'  => $ct_ig_url,
						'ext'   => true,
						'note'  => __( 'نرد خلال وقت قصير', 'novira-academy' ),
					),
					array(
						'key'   => 'facebook',
						'ico'   => 'facebook',
						'title' => __( 'فيسبوك', 'novira-academy' ),
						'desc'  => __( 'راسلنا على صفحتنا الرسمية على فيسبوك', 'novira-academy' ),
						'cta'   => 'Novira Academy',
						'href'  => $ct_facebook,
						'ext'   => true,
						'note'  => __( 'نرد خلال وقت قصير', 'novira-academy' ),
					),
					array(
						'key'   => 'visit',
						'ico'   => 'pin',
						'title' => __( 'زيارتنا', 'novira-academy' ),
						'desc'  => __( 'زورنا في مقر الأكاديمية ونحن في خدمتك', 'novira-academy' ),
						'cta'   => __( 'اتجاهات جوجل ماب', 'novira-academy' ),
						'href'  => $ct_map_link,
						'ext'   => true,
						'note'  => __( 'في أوقات العمل', 'novira-academy' ),
					),
				);
				foreach ( $ct_channels as $ct_n => $ct_c ) :
					$ct_target = $ct_c['ext'] ? ' target="_blank" rel="noopener noreferrer"' : '';
					?>
					<article class="ct-channel ct-channel--<?php echo esc_attr( $ct_c['key'] ); ?>" data-reveal style="--i:<?php echo (int) $ct_n; ?>">
						<span class="ct-channel__ico"><?php echo novira_ct_icon( $ct_c['ico'], 30 ); // phpcs:ignore ?></span>
						<h3 class="ct-channel__title"><?php echo esc_html( $ct_c['title'] ); ?></h3>
						<p class="ct-channel__desc"><?php echo esc_html( $ct_c['desc'] ); ?></p>
						<a class="ct-channel__cta" href="<?php echo esc_url( $ct_c['href'] ); ?>"<?php echo $ct_target; // phpcs:ignore ?>>
							<?php echo esc_html( $ct_c['cta'] ); ?>
						</a>
						<span class="ct-channel__note"><?php echo esc_html( $ct_c['note'] ); ?></span>
					</article>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

	<?php // ===================== 3. AVAILABILITY BANNER ===================== ?>
	<section class="ct-section ct-avail-wrap">
		<div class="ct-container">
			<div class="ct-avail" data-reveal>
				<span class="ct-avail__spark ct-avail__spark--1" aria-hidden="true"></span>
				<span class="ct-avail__spark ct-avail__spark--2" aria-hidden="true"></span>

				<div class="ct-avail__col ct-avail__hours">
					<span class="ct-avail__ico"><?php echo novira_ct_icon( 'clock', 26 ); // phpcs:ignore ?></span>
					<div class="ct-avail__body">
						<h3><?php esc_html_e( 'أوقات العمل', 'novira-academy' ); ?></h3>
						<p><?php esc_html_e( 'من السبت إلى الخميس', 'novira-academy' ); ?></p>
						<p><?php esc_html_e( 'من 9:00 صباحاً إلى 10:00 مساءً', 'novira-academy' ); ?></p>
					</div>
				</div>

				<span class="ct-avail__divider" aria-hidden="true"></span>

				<div class="ct-avail__col ct-avail__support">
					<span class="ct-avail__ico"><?php echo novira_ct_icon( 'headset', 26 ); // phpcs:ignore ?></span>
					<div class="ct-avail__body">
						<h3><?php esc_html_e( 'نحن معك دائماً', 'novira-academy' ); ?></h3>
						<p><?php esc_html_e( 'فريق دعم متخصص للرد على جميع استفساراتك ومساعدتك في اختيار الأنسب لك.', 'novira-academy' ); ?></p>
					</div>
				</div>

				<span class="ct-avail__figure" aria-hidden="true">
					<?php echo novira_ct_icon( 'headset', 78 ); // phpcs:ignore ?>
				</span>
			</div>
		</div>
	</section>

	<?php // ===================== 4. MAP + LOCATION ===================== ?>
	<section class="ct-section ct-location">
		<div class="ct-container">
			<div class="ct-location__card" data-reveal>
				<div class="ct-location__map">
					<iframe
						src="<?php echo esc_url( $ct_map_embed ); ?>"
						title="<?php esc_attr_e( 'موقع نوفيرا أكاديمي على الخريطة', 'novira-academy' ); ?>"
						loading="lazy"
						referrerpolicy="no-referrer-when-downgrade"
						allowfullscreen></iframe>
					<span class="ct-location__pin" aria-hidden="true">
						<?php echo novira_ct_icon( 'pin', 22 ); // phpcs:ignore ?>
						<em>Novira Academy<br><span><?php esc_html_e( 'Beni Mazar, Minya', 'novira-academy' ); ?></span></em>
					</span>
				</div>

				<div class="ct-location__info">
					<span class="ct-eyebrow ct-eyebrow--center"><?php esc_html_e( 'موقعنا', 'novira-academy' ); ?></span>
					<h2 class="ct-location__addr">
						<?php esc_html_e( 'المنيا - بني مزار - بحري السنترال العام', 'novira-academy' ); ?>
						<span><?php esc_html_e( 'يجوار مدخل مكتبة الناظر', 'novira-academy' ); ?></span>
					</h2>

					<div class="ct-location__features">
						<?php
						$ct_features = array(
							array( 'ico' => 'building', 't' => __( 'سهل الوصول', 'novira-academy' ), 'd' => __( 'الموقع في قلب بني مزار', 'novira-academy' ) ),
							array( 'ico' => 'car',      't' => __( 'مواقف قريبة', 'novira-academy' ), 'd' => __( 'تتوفر مواقف للسيارات', 'novira-academy' ) ),
							array( 'ico' => 'landmark', 't' => __( 'معلم مميز', 'novira-academy' ), 'd' => __( 'بجوار مكتبة الناظر', 'novira-academy' ) ),
							array( 'ico' => 'shield',   't' => __( 'بيئة آمنة', 'novira-academy' ), 'd' => __( 'مكان هادي وآمن', 'novira-academy' ) ),
						);
						foreach ( $ct_features as $ct_fn => $ct_f ) : ?>
							<div class="ct-feature" data-reveal style="--i:<?php echo (int) $ct_fn; ?>">
								<span class="ct-feature__ico"><?php echo novira_ct_icon( $ct_f['ico'], 26 ); // phpcs:ignore ?></span>
								<h4><?php echo esc_html( $ct_f['t'] ); ?></h4>
								<p><?php echo esc_html( $ct_f['d'] ); ?></p>
							</div>
						<?php endforeach; ?>
					</div>
				</div>
			</div>
		</div>
	</section>

	<?php // ===================== 5. TRUST STRIP ===================== ?>
	<section class="ct-section ct-trust-wrap">
		<div class="ct-container">
			<div class="ct-trust" data-reveal>
				<?php
				$ct_trust = array(
					array( 'ico' => 'lifebuoy',  't' => __( 'استشارة مجانية', 'novira-academy' ), 'd' => __( 'نساعدك في اختيار الأنسب لك', 'novira-academy' ) ),
					array( 'ico' => 'pulse',     't' => __( 'متابعة مستمرة', 'novira-academy' ), 'd' => __( 'نحن معك حتى تحقق هدفك', 'novira-academy' ) ),
					array( 'ico' => 'users',     't' => __( 'مدربون محترفون', 'novira-academy' ), 'd' => __( 'ذوي خبرة وكفاءة عالية', 'novira-academy' ) ),
					array( 'ico' => 'bookcheck', 't' => __( 'مناهج حديثة', 'novira-academy' ), 'd' => __( 'مواكبة لأحدث المعايير الدولية', 'novira-academy' ) ),
					array( 'ico' => 'award',     't' => __( 'نتائج مضمونة', 'novira-academy' ), 'd' => __( 'نركز على تحقيق أفضل النتائج', 'novira-academy' ) ),
				);
				foreach ( $ct_trust as $ct_tn => $ct_t ) : ?>
					<div class="ct-trust__item" data-reveal style="--i:<?php echo (int) $ct_tn; ?>">
						<span class="ct-trust__ico"><?php echo novira_ct_icon( $ct_t['ico'], 24 ); // phpcs:ignore ?></span>
						<div class="ct-trust__body">
							<h4><?php echo esc_html( $ct_t['t'] ); ?></h4>
							<p><?php echo esc_html( $ct_t['d'] ); ?></p>
						</div>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

	<?php // ===================== 6. CTA BAND ===================== ?>
	<section class="ct-cta">
		<div class="ct-container ct-cta__inner">
			<span class="ct-cta__art" aria-hidden="true">
				<span class="ct-cta__bubble ct-cta__bubble--a"></span>
				<span class="ct-cta__bubble ct-cta__bubble--b"></span>
				<span class="ct-cta__headset"><?php echo novira_ct_icon( 'headset', 62 ); // phpcs:ignore ?></span>
			</span>

			<div class="ct-cta__copy">
				<h2 class="ct-cta__t"><?php esc_html_e( 'لا تتردد في التواصل معنا الان!', 'novira-academy' ); ?></h2>
				<p class="ct-cta__s"><?php esc_html_e( 'نحن هنا لنساعدك ونكون جزء من رحلتك نحو التميز و النجاح.', 'novira-academy' ); ?></p>
			</div>

			<div class="ct-cta__actions">
				<a href="<?php echo esc_url( $ct_wa ); ?>" class="ct-cta__btn ct-cta__btn--white" target="_blank" rel="noopener noreferrer">
					<?php esc_html_e( 'تواصل واتساب الآن', 'novira-academy' ); ?>
					<span class="ct-cta__btn-ico ct-cta__btn-ico--wa"><?php echo novira_ct_icon( 'whatsapp', 18 ); // phpcs:ignore ?></span>
				</a>
				<a href="tel:<?php echo esc_attr( $ct_tel ); ?>" class="ct-cta__btn ct-cta__btn--ghost">
					<?php echo esc_html( $ct_phone ); ?>
					<span class="ct-cta__btn-ico"><?php echo novira_ct_icon( 'phone', 18 ); // phpcs:ignore ?></span>
				</a>
			</div>
		</div>
	</section>

</div><!-- .ct -->

<?php get_footer(); ?>
