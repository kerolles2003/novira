<?php
/**
 * Template Part: Form Success Message
 *
 * Reusable success message component for forms.
 *
 * @package Novira_Academy
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Get data from template args
$title   = isset( $args['title'] ) ? $args['title'] : __( 'تم بنجاح!', 'novira-academy' );
$message = isset( $args['message'] ) ? $args['message'] : __( 'تم إرسال طلبك بنجاح. سنتواصل معك قريباً.', 'novira-academy' );
$icon    = isset( $args['icon'] ) ? $args['icon'] : 'success';
?>

<div class="form-message form-success" role="alert">
	<span class="message-icon" aria-hidden="true">
		<?php if ( 'success' === $icon ) : ?>
			<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
				<path d="M22 11.08V12a10 10 0 11-5.93-9.14"/>
				<path d="M22 4L12 14.01l-3-3"/>
			</svg>
		<?php elseif ( 'check' === $icon ) : ?>
			<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
				<path d="M22 11.08V12a10 10 0 11-5.93-9.14"/>
				<path d="M22 4L12 14.01l-3-3"/>
			</svg>
		<?php endif; ?>
	</span>
	<h3><?php echo esc_html( $title ); ?></h3>
	<p><?php echo esc_html( $message ); ?></p>
</div>
