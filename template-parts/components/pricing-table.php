<?php
/**
 * Template Part: Pricing Table
 *
 * Reusable pricing table component for service comparison.
 *
 * @package Novira_Academy
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Get pricing data from template args
$pricing = isset( $args['pricing'] ) ? $args['pricing'] : array();

if ( empty( $pricing ) ) {
	return;
}
?>

<div class="pricing-table">
	<?php foreach ( $pricing as $index => $plan ) : ?>
		<div class="pricing-plan <?php echo ( 0 === $index ) ? 'pricing-featured' : ''; ?>">
			<?php if ( 0 === $index ) : ?>
				<div class="pricing-badge"><?php esc_html_e( 'الأكثر طلباً', 'novira-academy' ); ?></div>
			<?php endif; ?>
			
			<h3 class="pricing-service"><?php echo esc_html( $plan['service'] ); ?></h3>
			
			<div class="pricing-price">
				<?php echo esc_html( $plan['price'] ); ?>
			</div>

			<ul class="pricing-features">
				<?php foreach ( $plan['includes'] as $feature ) : ?>
					<li>
						<span class="feature-icon" aria-hidden="true">
							<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
								<path d="M22 11.08V12a10 10 0 11-5.93-9.14"/>
								<path d="M22 4L12 14.01l-3-3"/>
							</svg>
						</span>
						<?php echo esc_html( $feature ); ?>
					</li>
				<?php endforeach; ?>
			</ul>

			<a href="#quote" class="btn <?php echo ( 0 === $index ) ? 'btn-primary' : 'btn-outline'; ?> btn-block">
				<?php esc_html_e( 'طلب عرض سعر', 'novira-academy' ); ?>
			</a>
		</div>
	<?php endforeach; ?>
</div>
