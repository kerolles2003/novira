<?php
/**
 * Pre-footer CTA band — turns reading intent into a booked assessment.
 *
 * @package Novira_Academy
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$nvb_whatsapp = get_theme_mod( 'novira_whatsapp', '201090600927' );
?>
<section class="nvblog-cta" aria-labelledby="nvblog-cta-title">
	<div class="nvblog-container">
		<div class="nvblog-cta__panel">
			<span class="nvblog-cta__eyebrow"><?php esc_html_e( 'من المقال إلى الخطة', 'novira-academy' ); ?></span>
			<h2 id="nvblog-cta-title" class="nvblog-cta__title"><?php esc_html_e( 'محتاج إجابة تخص طالبك بالتحديد؟', 'novira-academy' ); ?></h2>
			<p class="nvblog-cta__desc"><?php esc_html_e( 'المقالات تعطيك الصورة الكاملة، والتقييم يحوّلها إلى خطة عملية لطالبك. كلّمنا على واتساب ونرشّح لك الخطوة التالية.', 'novira-academy' ); ?></p>
			<div class="nvblog-cta__actions">
				<a class="nvblog-cta__btn nvblog-cta__btn--wa" href="https://wa.me/<?php echo esc_attr( $nvb_whatsapp ); ?>" target="_blank" rel="noopener noreferrer">
					<svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M12 2a10 10 0 0 0-8.5 15.2L2 22l4.9-1.4A10 10 0 1 0 12 2zm0 18.2a8.2 8.2 0 0 1-4.2-1.2l-.3-.2-2.9.8.8-2.8-.2-.3A8.2 8.2 0 1 1 12 20.2zm4.5-6.1c-.2-.1-1.4-.7-1.7-.8s-.4-.1-.6.1-.6.8-.8 1-.3.2-.6.1a6.7 6.7 0 0 1-2-1.2 7.4 7.4 0 0 1-1.3-1.7c-.1-.2 0-.4.1-.5l.4-.5.3-.4v-.4c0-.1-.6-1.4-.8-1.9s-.4-.4-.5-.4h-.5a1 1 0 0 0-.7.3 3 3 0 0 0-.9 2.2 5.2 5.2 0 0 0 1.1 2.8 11.8 11.8 0 0 0 4.5 4c.6.3 1.1.4 1.5.5a3.7 3.7 0 0 0 1.6.1c.5-.1 1.4-.6 1.6-1.1a2 2 0 0 0 .1-1.1c0-.2-.2-.2-.5-.4z"/></svg>
					<?php esc_html_e( 'احجز تقييم مجاني', 'novira-academy' ); ?>
				</a>
				<a class="nvblog-cta__btn nvblog-cta__btn--ghost" href="<?php echo esc_url( home_url( '/american-diploma/' ) ); ?>">
					<?php esc_html_e( 'تعرّف على برامجنا', 'novira-academy' ); ?>
				</a>
			</div>
			<?php
			$nvb_reassurances = array(
				__( 'رد سريع على واتساب', 'novira-academy' ),
				__( 'تقييم بدون التزام', 'novira-academy' ),
				__( 'فريق متخصّص لكل مسار', 'novira-academy' ),
			);
			?>
			<div class="nvblog-cta__reassure">
				<?php foreach ( $nvb_reassurances as $nvb_reassurance ) : ?>
					<span>
						<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M20 6L9 17l-5-5"/></svg>
						<?php echo esc_html( $nvb_reassurance ); ?>
					</span>
				<?php endforeach; ?>
			</div>
		</div>
	</div>
</section>
