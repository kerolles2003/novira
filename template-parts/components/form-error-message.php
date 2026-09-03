<?php
/**
 * Template Part: Form Error Message
 *
 * Reusable error message component for forms.
 *
 * @package Novira_Academy
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Get data from template args
$title   = isset( $args['title'] ) ? $args['title'] : __( 'حدث خطأ', 'novira-academy' );
$message = isset( $args['message'] ) ? $args['message'] : __( 'يرجى المحاولة مرة أخرى أو التواصل معنا مباشرة.', 'novira-academy' );
$icon    = isset( $args['icon'] ) ? $args['icon'] : 'error';
?>

<div class="form-message form-error" role="alert">
	<span class="message-icon" aria-hidden="true">
		<?php if ( 'error' === $icon ) : ?>
			<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
				<circle cx="12" cy="12" r="10"/>
				<path d="M15 9l-6 6M9 9l6 6"/>
			</svg>
		<?php elseif ( 'warning' === $icon ) : ?>
			<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
				<path d="M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"/>
				<line x1="12" y1="9" x2="12" y2="13"/>
				<line x1="12" y1="17" x2="12.01" y2="17"/>
			</svg>
		<?php endif; ?>
	</span>
	<h3><?php echo esc_html( $title ); ?></h3>
	<p><?php echo esc_html( $message ); ?></p>
</div>
