<?php
/**
 * Template Part: Curriculum Component
 *
 * Displays a curriculum subject card for American Diploma.
 *
 * @package Novira_Academy
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Get data from template args
$subject     = isset( $args['subject'] ) ? $args['subject'] : '';
$grades      = isset( $args['grades'] ) ? $args['grades'] : '';
$hours       = isset( $args['hours'] ) ? $args['hours'] : '';
$description = isset( $args['description'] ) ? $args['description'] : '';

if ( empty( $subject ) ) {
	return;
}
?>

<article class="curriculum-card">
	<div class="curriculum-header">
		<div class="curriculum-icon" aria-hidden="true">
			<svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
				<path d="M2 3h6a4 4 0 014 4v14a3 3 0 00-3-3H2z"/>
				<path d="M22 3h-6a4 4 0 00-4 4v14a3 3 0 013-3h7z"/>
			</svg>
		</div>
		<h3 class="curriculum-subject"><?php echo esc_html( $subject ); ?></h3>
	</div>

	<div class="curriculum-content">
		<p class="curriculum-description"><?php echo esc_html( $description ); ?></p>

		<div class="curriculum-meta">
			<div class="meta-item">
				<span class="meta-icon" aria-hidden="true">
					<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
						<path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/>
						<circle cx="9" cy="7" r="4"/>
						<path d="M23 21v-2a4 4 0 00-3-3.87"/>
						<path d="M16 3.13a4 4 0 010 7.75"/>
					</svg>
				</span>
				<span class="meta-text"><?php echo esc_html( sprintf( __( 'المستوى: %s', 'novira-academy' ), $grades ) ); ?></span>
			</div>

			<div class="meta-item">
				<span class="meta-icon" aria-hidden="true">
					<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
						<circle cx="12" cy="12" r="10"/>
						<path d="M12 6v6l4 2"/>
					</svg>
				</span>
				<span class="meta-text"><?php echo esc_html( sprintf( __( 'الحصص: %s', 'novira-academy' ), $hours ) ); ?></span>
			</div>
		</div>
	</div>
</article>
