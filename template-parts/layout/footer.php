<?php
/**
 * Template Part: Footer Content (Redesigned)
 *
 * Trust-first footer with Cognia accreditation strip,
 * clear service/contact columns, and a WhatsApp-first CTA.
 *
 * @package Novira_Academy
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$whatsapp    = get_theme_mod( 'novira_whatsapp', '201090600927' );
$email       = get_theme_mod( 'novira_email', 'noviraacademy@gmail.com' );
$phone       = get_theme_mod( 'novira_phone', '01090600927' );
$address     = get_theme_mod( 'novira_address', __( 'المنيا، بني مزار، طريق الإبراهيمية، آخر شارع مستشفى أبو عوف', 'novira-academy' ) );
$facebook    = get_theme_mod( 'novira_facebook', 'https://www.facebook.com/noviraacademy' );
$instagram   = get_theme_mod( 'novira_instagram', 'https://www.instagram.com/noviraacademy?igsh=MXBlcnZ1b3o4NThraw==' );
$tiktok      = get_theme_mod( 'novira_tiktok', 'https://www.tiktok.com/@noviraacademy' );
$youtube     = get_theme_mod( 'novira_youtube', 'https://youtube.com/@noviraacadem?si=C2tRTrf-D1X9a9dY' );
$copyright   = get_theme_mod( 'novira_copyright', __( 'جميع الحقوق محفوظة', 'novira-academy' ) );
$logo_url    = get_template_directory_uri() . '/assets/images/logo.jpg';

$social_links = array(
	'facebook' => array(
		'url'   => $facebook,
		'label' => __( 'فيسبوك', 'novira-academy' ),
		'svg'   => '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/></svg>',
	),
	'instagram' => array(
		'url'   => $instagram,
		'label' => __( 'إنستجرام', 'novira-academy' ),
		'svg'   => '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"/><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"/></svg>',
	),
	'tiktok' => array(
		'url'   => $tiktok,
		'label' => __( 'تيك توك', 'novira-academy' ),
		'svg'   => '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M9 12a4 4 0 1 0 4 4V4a5 5 0 0 0 5 5"/></svg>',
	),
	'youtube' => array(
		'url'   => $youtube,
		'label' => __( 'يوتيوب', 'novira-academy' ),
		'svg'   => '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M22.54 6.42a2.78 2.78 0 0 0-1.94-2C18.88 4 12 4 12 4s-6.88 0-8.6.46a2.78 2.78 0 0 0-1.94 2A29 29 0 0 0 1 11.75a29 29 0 0 0 .46 5.33A2.78 2.78 0 0 0 3.4 19c1.72.46 8.6.46 8.6.46s6.88 0 8.6-.46a2.78 2.78 0 0 0 1.94-2 29 29 0 0 0 .46-5.25 29 29 0 0 0-.46-5.33z"/><polygon points="9.75 15.02 15.5 11.75 9.75 8.48 9.75 15.02"/></svg>',
	),
	'whatsapp' => array(
		'url'   => $whatsapp ? 'https://wa.me/' . $whatsapp : '',
		'label' => __( 'واتساب', 'novira-academy' ),
		'svg'   => '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"/></svg>',
	),
);
?>

<footer class="site-footer" role="contentinfo">

	<!-- Accreditation trust strip -->
	<div class="footer-trust-strip">
		<div class="footer-trust-inner">
			<div class="footer-trust-seal">
				<svg width="44" height="44" viewBox="0 0 44 44" fill="none" aria-hidden="true">
					<circle cx="22" cy="22" r="20" stroke="currentColor" stroke-width="1.5"/>
					<circle cx="22" cy="22" r="14" stroke="currentColor" stroke-width="1"/>
					<path d="M15 22l5 5 9-9" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
				</svg>
			</div>
			<div class="footer-trust-body">
				<span class="footer-trust-label"><?php esc_html_e( 'معتمدة دولياً', 'novira-academy' ); ?></span>
				<span class="footer-trust-org">Cognia</span>
			</div>
			<p class="footer-trust-tagline"><?php esc_html_e( 'تعليم أمريكي معتمد في قلب الصعيد', 'novira-academy' ); ?></p>
		</div>
	</div>

	<!-- Main footer -->
	<div class="footer-main">
		<div class="footer-grid">

			<!-- Brand -->
			<div class="footer-block footer-block-brand reveal">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="footer-brand-logo" aria-label="<?php bloginfo( 'name' ); ?>">
					<img
						src="<?php echo esc_url( $logo_url ); ?>"
						alt="<?php bloginfo( 'name' ); ?>"
						width="80"
						height="80"
						loading="lazy"
					>
				</a>
				<p class="footer-brand-statement">
					<?php esc_html_e( 'أكاديمية متخصصة في التعليم الدولي والترجمة المعتمدة. نُعدّ الطلاب لفرص عالمية من بني مزار إلى أبعد من ذلك.', 'novira-academy' ); ?>
				</p>
				<?php if ( $address ) : ?>
					<address class="footer-address">
						<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
						<?php echo esc_html( $address ); ?>
					</address>
				<?php endif; ?>
			</div>

			<!-- Navigation -->
			<div class="footer-block reveal">
				<h3 class="footer-heading"><?php esc_html_e( 'روابط سريعة', 'novira-academy' ); ?></h3>
				<ul class="footer-links">
					<li>
						<a href="<?php echo esc_url( home_url( '/american-diploma/' ) ); ?>">
							<?php esc_html_e( 'الدبلومة الأمريكية', 'novira-academy' ); ?>
						</a>
					</li>
					<li>
						<a href="<?php echo esc_url( home_url( '/translation/' ) ); ?>">
							<?php esc_html_e( 'الترجمة المعتمدة', 'novira-academy' ); ?>
						</a>
					</li>
					<li>
						<a href="<?php echo esc_url( home_url( '/education/' ) ); ?>">
							<?php esc_html_e( 'التعليم والتطوير المهني', 'novira-academy' ); ?>
						</a>
					</li>
					<li>
						<a href="<?php echo esc_url( home_url( '/about' ) ); ?>">
							<?php esc_html_e( 'من نحن', 'novira-academy' ); ?>
						</a>
					</li>
					<li>
						<a href="<?php echo esc_url( home_url( '/contact' ) ); ?>">
							<?php esc_html_e( 'تواصل معنا', 'novira-academy' ); ?>
						</a>
					</li>
				</ul>
			</div>

			<!-- Contact -->
			<div class="footer-block reveal">
				<h3 class="footer-heading"><?php esc_html_e( 'تواصل معنا', 'novira-academy' ); ?></h3>
				<ul class="footer-contact-list">
					<?php if ( $whatsapp ) : ?>
						<li>
							<a href="https://wa.me/<?php echo esc_attr( $whatsapp ); ?>" target="_blank" rel="noopener noreferrer">
								<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"/></svg>
								<span><?php echo esc_html( $phone ); ?></span>
							</a>
						</li>
					<?php endif; ?>
					<?php if ( $email ) : ?>
						<li>
							<a href="mailto:<?php echo esc_attr( $email ); ?>">
								<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
								<span><?php echo esc_html( $email ); ?></span>
							</a>
						</li>
					<?php endif; ?>
					<?php if ( $phone ) : ?>
						<li>
							<a href="tel:<?php echo esc_attr( $phone ); ?>">
								<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
								<span><?php echo esc_html( $phone ); ?></span>
							</a>
						</li>
					<?php endif; ?>
					<li>
						<a href="<?php echo esc_url( home_url( '/contact' ) ); ?>">
							<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="12" cy="12" r="10"/><path d="M12 16v-4M12 8h.01"/></svg>
							<span><?php esc_html_e( 'صفحة التواصل الكاملة', 'novira-academy' ); ?></span>
						</a>
					</li>
				</ul>
			</div>

			<!-- CTA -->
			<div class="footer-block footer-block-cta reveal">
				<h3 class="footer-heading"><?php esc_html_e( 'ابدأ الآن', 'novira-academy' ); ?></h3>
				<p class="footer-cta-text">
					<?php esc_html_e( 'احجز استشارتك المجانية عبر واتساب واعرف البرنامج الأنسب ليك.', 'novira-academy' ); ?>
				</p>
				<?php if ( $whatsapp ) : ?>
					<a href="https://wa.me/<?php echo esc_attr( $whatsapp ); ?>"
					   class="footer-cta-button"
					   target="_blank"
					   rel="noopener noreferrer">
						<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"/></svg>
						<?php esc_html_e( 'سجّل استشارتك', 'novira-academy' ); ?>
					</a>
				<?php endif; ?>
			</div>

		</div>
	</div>

	<!-- Bottom bar -->
	<div class="footer-bottom">
		<p class="footer-copyright">
			&copy; <?php echo esc_html( date( 'Y' ) ); ?> <?php bloginfo( 'name' ); ?> — <?php echo esc_html( $copyright ); ?>
		</p>

		<?php
		$has_social = false;
		foreach ( $social_links as $network => $data ) {
			if ( ! empty( $data['url'] ) ) {
				$has_social = true;
				break;
			}
		}
		?>
		<?php if ( $has_social ) : ?>
			<ul class="footer-social" role="list" aria-label="<?php esc_attr_e( 'حسابات التواصل الاجتماعي', 'novira-academy' ); ?>">
				<?php foreach ( $social_links as $network => $data ) : ?>
					<?php if ( ! empty( $data['url'] ) ) : ?>
						<li>
							<a href="<?php echo esc_url( $data['url'] ); ?>"
							   target="_blank"
							   rel="noopener noreferrer"
							   aria-label="<?php echo esc_attr( $data['label'] ); ?>">
								<?php echo $data['svg']; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
							</a>
						</li>
					<?php endif; ?>
				<?php endforeach; ?>
			</ul>
		<?php endif; ?>
	</div>

</footer>
