<?php
/**
 * Template Part: Course Card
 *
 * Reusable course card component for education department.
 *
 * @package Novira_Academy
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Get data from template args
$title       = isset( $args['title'] ) ? $args['title'] : '';
$description = isset( $args['description'] ) ? $args['description'] : '';
$schedule    = isset( $args['schedule'] ) ? $args['schedule'] : '';

if ( empty( $title ) ) {
	return;
}
?>

<article class="course-card">
	<div class="course-header">
		<div class="course-icon" aria-hidden="true">
			<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
				<path d="M12 2v20M17 5H9.5a3.5 3.5 0 000 7h5a3.5 3.5 0 010 7H6"/>
			</svg>
		</div>
		<h3 class="course-title"><?php echo esc_html( $title ); ?></h3>
	</div>

	<div class="course-content">
		<p class="course-description"><?php echo esc_html( $description ); ?></p>

		<?php if ( $schedule ) : ?>
			<div class="course-schedule">
				<span class="schedule-icon" aria-hidden="true">
					<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
						<rect x="3" y="4" width="18" height="18" rx="2" ry="2"/>
						<line x1="16" y1="2" x2="16" y2="6"/>
						<line x1="8" y1="2" x2="8" y2="6"/>
						<line x1="3" y1="10" x2="21" y2="10"/>
					</svg>
				</span>
				<span class="schedule-text"><?php echo esc_html( $schedule ); ?></span>
			</div>
		<?php endif; ?>
	</div>

	<div class="course-footer">
		<a href="#contact" class="btn btn-outline">
			<?php esc_html_e( 'المزيد من التفاصيل', 'novira-academy' ); ?>
		</a>
	</div>
</article>
