<?php
/**
 * Diploma Hub — S9 Consultation CTA
 *
 * OWNS: a calm, advisory call to action. NO urgency, NO scarcity, NO
 * "register now". Prefers "book a consultation / talk to our team". Reuses the
 * existing WhatsApp + contact channels (single source via theme mods).
 *
 * Rendering only.
 *
 * @package Novira_Academy
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$novira_whatsapp = get_theme_mod( 'novira_whatsapp', '201090600927' );
?>
<section id="consultation" class="section diploma-consultation" aria-label="<?php esc_attr_e( 'احجز استشارة', 'novira-academy' ); ?>">
	<div class="container">
		<div class="section-header">
			<span class="section-tag"><?php esc_html_e( 'استشارة', 'novira-academy' ); ?></span>
			<h2 class="section-title"><?php esc_html_e( 'تحدّث مع فريقنا', 'novira-academy' ); ?></h2>
			<p class="section-desc"><?php esc_html_e( 'احجز استشارة لمناقشة مسار طالبك في الدبلومة الأمريكية. نجيب عن أسئلتك دون أي التزام.', 'novira-academy' ); ?></p>
		</div>

		<p class="diploma-consultation__actions">
			<?php if ( $novira_whatsapp ) : ?>
				<a class="btn btn-primary"
				   href="https://wa.me/<?php echo esc_attr( $novira_whatsapp ); ?>"
				   target="_blank"
				   rel="noopener noreferrer">
					<?php esc_html_e( 'احجز استشارة عبر واتساب', 'novira-academy' ); ?>
				</a>
			<?php endif; ?>
			<a class="btn btn-outline" href="<?php echo esc_url( home_url( '/contact' ) ); ?>">
				<?php esc_html_e( 'تواصل مع فريقنا', 'novira-academy' ); ?>
			</a>
		</p>
	</div>
</section>
