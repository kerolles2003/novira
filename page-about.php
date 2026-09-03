<?php
/**
 * Template: About ("من نحن") Landing
 *
 * Dedicated, pixel-matched landing page for the About page (rebuilt from
 * template-parts/sections/about-us.png). Force-routed for the `about` page via
 * novira_force_about_template() (template_include, functions.php). Uses the
 * site's global header/footer so the navbar and footer match every other page.
 *
 * Section order (per request): hero → founder → mission/vision/plan →
 * course cards (YouTube iframes) → location (map iframe) → CTA.
 * All markup is scoped under `.abt`.
 *
 * @package Novira_Academy
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$abt_whatsapp = get_theme_mod( 'novira_whatsapp', '201090600927' );
$abt_wa       = 'https://wa.me/' . $abt_whatsapp;
$abt_phone    = get_theme_mod( 'novira_phone', '01090600927' );
$abt_img      = get_template_directory_uri() . '/assets/images';

// Real Google Maps place embed for Novira Academy (same pin as the homepage
// map section). Kept as a place-id embed so it resolves to the exact location.
$abt_map_src  = 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3506.3574745753367!2d30.802484900000007!3d28.4988907!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x145b078be7939ae5%3A0x5dde6c04c556b01!2sNovira%20Academy!5e0!3m2!1sar!2seg!4v1781613107625!5m2!1sar!2seg';

get_header();
?>

<div class="abt">

	<?php // ===================== 1. HERO ===================== ?>
	<section class="abt-hero">
		<div class="abt-hero__bg" aria-hidden="true">
			<span class="abt-hero__glow"></span>
			<span class="abt-hero__grid"></span>
		</div>
		<div class="abt-container abt-hero__inner">
			<span class="abt-eyebrow" data-reveal><?php esc_html_e( 'من نحن', 'novira-academy' ); ?></span>
			<h1 class="abt-hero__title" data-reveal style="--i:1">
				<span class="abt-hero__flourish abt-hero__flourish--r" aria-hidden="true"><?php echo novira_abt_icon( 'sparkle', 22 ); // phpcs:ignore ?></span>
				<?php esc_html_e( 'نؤمن أن التعلم رحلة لا تتوقف', 'novira-academy' ); ?>
				<span class="abt-hero__flourish abt-hero__flourish--l" aria-hidden="true"><?php echo novira_abt_icon( 'sparkle', 22 ); // phpcs:ignore ?></span>
			</h1>
			<p class="abt-hero__desc" data-reveal style="--i:2">
				<?php esc_html_e( 'في نوفيرا أكاديمي نساعد جميع الفئات على تعلم ما بحبون، وتنمية مهاراتهم، وتحقيق أهدافهم.', 'novira-academy' ); ?>
			</p>
		</div>
	</section>

	<?php // ===================== 2. FOUNDER ===================== ?>
	<section class="abt-section abt-founder-wrap">
		<div class="abt-container">
			<div class="abt-founder" data-reveal>
				<div class="abt-founder__media">
					<span class="abt-founder__halo" aria-hidden="true"></span>
					<img class="abt-founder__photo" src="<?php echo esc_url( $abt_img . '/founder/founder.webp' ); ?>" alt="<?php esc_attr_e( 'مستر يوسف زكي — مؤسس نوفيرا أكاديمي', 'novira-academy' ); ?>" width="360" height="440" loading="lazy" decoding="async">
					<span class="abt-founder__name">
						<strong><?php esc_html_e( 'مستر', 'novira-academy' ); ?></strong>
						<b><?php esc_html_e( 'يوسف زكي', 'novira-academy' ); ?></b>
						<em><?php esc_html_e( 'المؤسس', 'novira-academy' ); ?></em>
					</span>
				</div>
				<div class="abt-founder__body">
					<h2 class="abt-founder__title"><span class="abt-founder__ico"><?php echo novira_abt_icon( 'user', 26 ); // phpcs:ignore ?></span> <?php esc_html_e( 'المؤسس', 'novira-academy' ); ?></h2>
					<p><?php esc_html_e( 'مؤسس أكاديمية نوفيرا الأستاذ يوسف زكي يمتلك خبرة واسعة في مجال الدبلومة الأمريكية واللغة الإنجليزية والاختبارات الدولية لسنوات.', 'novira-academy' ); ?></p>
					<p><?php esc_html_e( 'متخصص في اللغات والترجمة الفورية، واهتم خلال مسيرته بتطوير المهارات وبناء القدرات بأسلوب عملي ومبتكر.', 'novira-academy' ); ?></p>
					<p><?php esc_html_e( 'انطلق في تأسيس الأكاديمية إيمانًا منه بأهمية التعليم والتدريب في تحقيق النجاح، وحرصًا على تقديم محتوى تدريبي عالي الجودة يواكب متطلبات سوق العمل، ويسهم في إعداد كوادر مؤهلة وقادرة على التطور المستمر.', 'novira-academy' ); ?></p>
				</div>
			</div>
		</div>
	</section>

	<?php // ===================== 3. MISSION / VISION / PLAN ===================== ?>
	<section class="abt-section abt-mvp">
		<div class="abt-container abt-mvp__grid">
			<article class="abt-mvp__card" data-reveal>
				<span class="abt-mvp__ico"><?php echo novira_abt_icon( 'send', 30 ); // phpcs:ignore ?></span>
				<h3 class="abt-mvp__t"><?php esc_html_e( 'رسالتنا', 'novira-academy' ); ?></h3>
				<p class="abt-mvp__p"><?php esc_html_e( 'نؤمن بأن التعلم رحلة مستمرة تبدأ من الصغر ولا تنتهي، ولذلك نعمل على توفير بيئة تعليمية مرنة، تفاعلية، وآمنة لجميع الفئات العمرية، من خلال مدربين محترفين، محتوى تدريبي قوي، ونظام متابعة متميز، لنساعد كل متدرب على تحقيق أهدافه بثقة وكفاءة.', 'novira-academy' ); ?></p>
			</article>

			<article class="abt-mvp__card" data-reveal style="--i:1">
				<span class="abt-mvp__ico"><?php echo novira_abt_icon( 'eye', 30 ); // phpcs:ignore ?></span>
				<h3 class="abt-mvp__t"><?php esc_html_e( 'رؤيتنا', 'novira-academy' ); ?></h3>
				<p class="abt-mvp__p"><?php esc_html_e( 'أن نكون من أوائل المؤسسات التعليمية في صعيد مصر التي تقدم تجربة تعليمية حديثة، متكاملة، وملهمة، تدمج بين الاختبارات الدولية للدبلومات الأمريكية والمهارات اللغوية والتقنية والحياتية، وتُعِد المتدربين ليكونوا أكثر جاهزية لسوق العمل المحلي والدولي.', 'novira-academy' ); ?></p>
			</article>

			<article class="abt-mvp__card" data-reveal style="--i:2">
				<span class="abt-mvp__ico"><?php echo novira_abt_icon( 'target', 30 ); // phpcs:ignore ?></span>
				<h3 class="abt-mvp__t"><?php esc_html_e( 'خطتنا المستقبلية', 'novira-academy' ); ?></h3>
				<ul class="abt-mvp__list" role="list">
					<li><?php echo novira_abt_icon( 'check', 20 ); // phpcs:ignore ?> <?php esc_html_e( 'العمل على تطوير وتحسين طلاب الدبلومة الأمريكية وإعدادهم بشكل جيد للاختبارات الدولية', 'novira-academy' ); ?></li>
					<li><?php echo novira_abt_icon( 'check', 20 ); // phpcs:ignore ?> <?php esc_html_e( 'جنبًا إلى جنب مع كورسات ومجالات جديدة', 'novira-academy' ); ?></li>
					<li><?php echo novira_abt_icon( 'check', 20 ); // phpcs:ignore ?> <?php esc_html_e( 'متعاونين مع جهات تعليمية معتمدة داخل وخارج مصر', 'novira-academy' ); ?></li>
					<li><?php echo novira_abt_icon( 'check', 20 ); // phpcs:ignore ?> <?php esc_html_e( 'تطوير أنظمة التعليم الإلكتروني داخل الأكاديمية وخارجها', 'novira-academy' ); ?></li>
				</ul>
			</article>
		</div>
	</section>

	<?php // ===================== 4. COURSE CARDS (YouTube iframes) ===================== ?>
	<section class="abt-section abt-cards">
		<div class="abt-container">
			<div class="abt-cards__grid">
				<?php
				// Each card is a lightweight YouTube facade keyed by the course
				// video ID in 'vid' (thumbnail now, iframe injected on click).
				$abt_cards = array(
					array( 't' => __( 'اللغة الألمانية للصغار', 'novira-academy' ), 'i' => 'headphones', 'vid' => 'qhG2SOqJrVs' ),
					array( 't' => __( 'اللغة الألمانية الكبار', 'novira-academy' ), 'i' => 'chat',       'vid' => 'h6TKX-FCK-E' ),
					array( 't' => __( 'اللغة الفرنسية', 'novira-academy' ),         'i' => 'chat',       'vid' => 'LS3YzkvosPY'),
					array( 't' => __( 'المهارات الحياتية', 'novira-academy' ),      'i' => 'sprout',     'vid' => 'p2NBKbYosLA' ),
					array( 't' => __( 'الإسعافات الأولية', 'novira-academy' ),      'i' => 'firstaid',   'vid' => 'zxFXq-CdP14' ),
					array( 't' => 'ICDL',                    'i' => 'monitor',    'vid' => 'fTc3vEUX_pk' ),
					array( 't' => __( 'البرمجة', 'novira-academy' ),                 'i' => 'code',       'vid' => 'eAmCS7889MY' ),
					array( 't' => __( 'طلابنا', 'novira-academy' ),                  'i' => 'users',      'vid' => 'F6j3JvqU-ik' ),
					array( 't' => __( 'القرآن الكريم', 'novira-academy' ),           'i' => 'book',       'vid' => 'YaWpNu4fd0o' ),
					array( 't' => 'MATHS',                   'i' => 'hash',       'vid' => '6cLzAIGQiTg' ),
					array( 't' => 'UCMAS',                   'i' => 'brain',      'vid' => 'y5TFZDGR_tY' ),
				);
				foreach ( $abt_cards as $abt_n => $abt_c ) : ?>
					<article class="abt-card" data-reveal style="--i:<?php echo (int) ( $abt_n % 4 ); ?>">
						<div class="abt-card__media">
							<?php
							// Lightweight facade: shows the YouTube thumbnail + play button;
							// the real iframe is injected on click (see about-landing.js).
							?>
							<button type="button" class="abt-card__play" data-vid="<?php echo esc_attr( $abt_c['vid'] ); ?>" aria-label="<?php /* translators: %s: course card title. */ echo esc_attr( sprintf( __( 'تشغيل فيديو %s', 'novira-academy' ), $abt_c['t'] ) ); ?>">
								<img class="abt-card__thumb" src="https://i.ytimg.com/vi/<?php echo esc_attr( $abt_c['vid'] ); ?>/hqdefault.jpg" alt="" loading="lazy" decoding="async">
								<span class="abt-card__playicon" aria-hidden="true">
									<svg width="26" height="26" viewBox="0 0 24 24" fill="#ffffff"><path d="M8 5v14l11-7z"/></svg>
								</span>
							</button>
							<span class="abt-card__badge">
								<?php if ( 'letterA' === $abt_c['i'] ) : ?>
									<span class="abt-card__badge-txt">A</span>
								<?php else : ?>
									<?php echo novira_abt_icon( $abt_c['i'], 22 ); // phpcs:ignore ?>
								<?php endif; ?>
							</span>
						</div>
						<div class="abt-card__body">
							<h3 class="abt-card__t"><?php echo esc_html( $abt_c['t'] ); ?></h3>
							<a href="<?php echo esc_url( $abt_wa ); ?>" class="abt-card__cta" target="_blank" rel="noopener noreferrer">
								<?php esc_html_e( 'انضم الآن', 'novira-academy' ); ?> <?php echo novira_abt_icon( 'chevron', 16 ); // phpcs:ignore ?>
							</a>
						</div>
					</article>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

	<?php // ===================== 5. LOCATION (map iframe) ===================== ?>
	<section class="abt-section abt-location">
		<div class="abt-container">
			<h2 class="abt-h2" data-reveal><span class="abt-h2__ico"><?php echo novira_abt_icon( 'pin', 26 ); // phpcs:ignore ?></span> <?php esc_html_e( 'موقعنا', 'novira-academy' ); ?></h2>
			<div class="abt-location__grid">
				<div class="abt-map" data-reveal>
					<iframe
						src="<?php echo esc_url( $abt_map_src ); ?>"
						title="<?php esc_attr_e( 'موقع نوفيرا أكاديمي على الخريطة', 'novira-academy' ); ?>"
						loading="lazy"
						referrerpolicy="no-referrer-when-downgrade"
						allowfullscreen></iframe>
				</div>
				<div class="abt-location__info" data-reveal style="--i:1">
					<p class="abt-location__addr"><?php echo wp_kses( __( 'المنيا ، بني مزار ، بجري السنترال العام<br>بجوار مدخل مكتبة الناطر', 'novira-academy' ), array( 'br' => array() ) ); ?></p>
					<div class="abt-location__cards">
						<div class="abt-info">
							<span class="abt-info__ico"><?php echo novira_abt_icon( 'clock', 26 ); // phpcs:ignore ?></span>
							<h4 class="abt-info__t"><?php esc_html_e( 'أوقات العمل', 'novira-academy' ); ?></h4>
							<p class="abt-info__d"><?php echo wp_kses( __( 'من 9:00 ص<br>إلى 10:00 م', 'novira-academy' ), array( 'br' => array() ) ); ?></p>
						</div>
						<a class="abt-info" href="tel:<?php echo esc_attr( $abt_phone ); ?>">
							<span class="abt-info__ico"><?php echo novira_abt_icon( 'phone', 26 ); // phpcs:ignore ?></span>
							<h4 class="abt-info__t"><?php esc_html_e( 'رقم الهاتف', 'novira-academy' ); ?></h4>
							<p class="abt-info__d"><?php echo esc_html( $abt_phone ); ?></p>
						</a>
						<a class="abt-info abt-info--wa" href="<?php echo esc_url( $abt_wa ); ?>" target="_blank" rel="noopener noreferrer">
							<span class="abt-info__ico"><?php echo novira_abt_icon( 'whatsapp', 26 ); // phpcs:ignore ?></span>
							<h4 class="abt-info__t"><?php esc_html_e( 'واتساب', 'novira-academy' ); ?></h4>
							<p class="abt-info__d"><?php esc_html_e( 'تواصل معنا الآن', 'novira-academy' ); ?></p>
						</a>
					</div>
				</div>
			</div>
		</div>
	</section>

	<?php // ===================== 6. CTA BAND ===================== ?>
	<section class="abt-cta">
		<div class="abt-container abt-cta__inner">
			<span class="abt-cta__art" aria-hidden="true">
				<svg viewBox="0 0 150 130" fill="none" xmlns="http://www.w3.org/2000/svg">
					<rect x="30" y="86" width="90" height="10" rx="2" fill="#c9b3ff"/>
					<rect x="38" y="76" width="74" height="10" rx="2" fill="#a887ff"/>
					<path d="M75 40 26 60l49 20 49-20z" fill="#2a0a66"/>
					<path d="M46 68v13c0 6 13 11 29 11s29-5 29-11V68" stroke="#fff" stroke-width="4" fill="none"/>
					<path d="M124 60v18" stroke="#ffd24a" stroke-width="3" stroke-linecap="round"/>
					<circle cx="124" cy="82" r="4" fill="#ffd24a"/>
					<rect x="66" y="94" width="18" height="26" rx="3" fill="#ffd24a" transform="rotate(8 75 107)"/>
				</svg>
			</span>
			<div class="abt-cta__copy">
				<h2 class="abt-cta__t"><?php esc_html_e( 'ابدأ رحلتك التعليمية الآن!', 'novira-academy' ); ?></h2>
				<p class="abt-cta__s"><?php esc_html_e( 'احجز استشارتك المجانية وتعرف على أفضل البرامج المناسبة لك أو لأولادك.', 'novira-academy' ); ?></p>
			</div>
			<div class="abt-cta__actions">
				<a href="<?php echo esc_url( $abt_wa ); ?>" class="abt-btn abt-btn--white" target="_blank" rel="noopener noreferrer">
					<?php echo novira_abt_icon( 'calendar', 20 ); // phpcs:ignore ?>
					<?php esc_html_e( 'احجز استشارتك المجانية', 'novira-academy' ); ?>
				</a>
				<a href="<?php echo esc_url( $abt_wa ); ?>" class="abt-btn abt-btn--ghost" target="_blank" rel="noopener noreferrer">
					<?php echo novira_abt_icon( 'whatsapp', 20 ); // phpcs:ignore ?>
					<?php esc_html_e( 'تواصل واتساب', 'novira-academy' ); ?>
				</a>
			</div>
		</div>
	</section>

</div><!-- .abt -->

<?php get_footer(); ?>
