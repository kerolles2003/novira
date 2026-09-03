<?php
/**
 * Template Part: Program Card
 *
 * Reusable program card component for education department.
 *
 * @package Novira_Academy
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Get data from template args
$title        = isset( $args['title'] ) ? $args['title'] : '';
$description  = isset( $args['description'] ) ? $args['description'] : '';
$duration     = isset( $args['duration'] ) ? $args['duration'] : '';
$requirements = isset( $args['requirements'] ) ? $args['requirements'] : array();

if ( empty( $title ) ) {
	return;
}
?>

<article class="program-card">
	<div class="program-header">
		<div class="program-icon" aria-hidden="true">
			<svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
				<path d="M4 19.5A2.5 2.5 0 016.5 17H20"/>
				<path d="M6.5 2H20v20H6.5A2.5 2.5 0 014 19.5v-15A2.5 2.5 0 016.5 2z"/>
			</svg>
		</div>
		<h3 class="program-title"><?php echo esc_html( $title ); ?></h3>
	</div>

	<div class="program-content">
		<p class="program-description"><?php echo esc_html( $description ); ?></p>

		<?php if ( $duration ) : ?>
			<div class="program-duration">
				<span class="duration-icon" aria-hidden="true">
					<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
						<circle cx="12" cy="12" r="10"/>
						<path d="M12 6v6l4 2"/>
					</svg>
				</span>
				<span class="duration-text"><?php echo esc_html( $duration ); ?></span>
			</div>
		<?php endif; ?>

		<?php if ( ! empty( $requirements ) ) : ?>
			<div class="program-requirements">
				<h4 class="requirements-title"><?php esc_html_e( 'المتطلبات:', 'novira-academy' ); ?></h4>
				<ul class="requirements-list">
					<?php foreach ( $requirements as $requirement ) : ?>
						<li><?php echo esc_html( $requirement ); ?></li>
					<?php endforeach; ?>
				</ul>
			</div>
		<?php endif; ?>
	</div>

	<div class="program-footer">
		<a href="#contact" class="btn btn-primary">
			<?php esc_html_e( 'سجّل الآن', 'novira-academy' ); ?>
		</a>
	</div>
</article>
