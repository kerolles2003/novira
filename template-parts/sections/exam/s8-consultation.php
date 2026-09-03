<?php
/**
 * Exam Spoke — S8 Consultation CTA
 *
 * OWNS: a calm, advisory next step for this exam. No urgency, no scarcity, no
 * "register now". Carries the #exam-consult anchor. Reuses WhatsApp + contact
 * channels (single source via theme mods). Null-safe.
 *
 * @package Novira_Academy
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$meta = isset( $args['meta'] ) ? $args['meta'] : null;
if ( ! $meta ) {
	return;
}
$whatsapp = get_theme_mod( 'novira_whatsapp', '201090600927' );
$title    = ! empty( $meta['consultation_title'] ) ? $meta['consultation_title'] : __( 'تحدّث مع فريقنا', 'novira-academy' );
$desc     = ! empty( $meta['consultation_desc'] ) ? $meta['consultation_desc'] : __( 'احجز استشارة لمناقشة استعداد طالبك. نجيب عن أسئلتك دون أي التزام.', 'novira-academy' );
?>
<section id="exam-consult" class="section exam-consult" aria-label="<?php esc_attr_e( 'استشارة', 'novira-academy' ); ?>">
	<div class="container">
		<div class="section-header">
			<span class="section-tag"><?php esc_html_e( 'استشارة', 'novira-academy' ); ?></span>
			<h2 class="section-title"><?php echo esc_html( $title ); ?></h2>
			<p class="section-desc"><?php echo esc_html( $desc ); ?></p>
		</div>

		<p class="exam-consult__actions">
			<?php if ( $whatsapp ) : ?>
				<a class="btn btn-primary" href="https://wa.me/<?php echo esc_attr( $whatsapp ); ?>" target="_blank" rel="noopener noreferrer">
					<?php esc_html_e( 'احجز استشارة عبر واتساب', 'novira-academy' ); ?>
				</a>
			<?php endif; ?>
			<a class="btn btn-outline" href="<?php echo esc_url( home_url( '/contact' ) ); ?>"><?php esc_html_e( 'تواصل مع فريقنا', 'novira-academy' ); ?></a>
		</p>
	</div>
</section>
