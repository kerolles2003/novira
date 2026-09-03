<?php
/**
 * Template Part: Service Card
 *
 * Reusable service card component for translation department.
 *
 * @package Novira_Academy
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Get data from template args
$type        = isset( $args['type'] ) ? $args['type'] : '';
$description = isset( $args['description'] ) ? $args['description'] : '';
$turnaround  = isset( $args['turnaround'] ) ? $args['turnaround'] : '';

if ( empty( $type ) ) {
	return;
}
?>

<article class="service-card">
	<div class="service-icon" aria-hidden="true">
		<svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
			<path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/>
			<path d="M14 2v6h6"/>
			<path d="M16 13H8"/>
			<path d="M16 17H8"/>
			<path d="M10 9H8"/>
		</svg>
	</div>

	<h3 class="service-title"><?php echo esc_html( $type ); ?></h3>
	<p class="service-description"><?php echo esc_html( $description ); ?></p>

	<div class="service-turnaround">
		<span class="turnaround-icon" aria-hidden="true">
			<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
				<circle cx="12" cy="12" r="10"/>
				<path d="M12 6v6l4 2"/>
			</svg>
		</span>
		<span class="turnaround-text"><?php echo esc_html( $turnaround ); ?></span>
	</div>

	<a href="#quote" class="btn btn-outline">
		<?php esc_html_e( 'طلب عرض سعر', 'novira-academy' ); ?>
	</a>
</article>
