<?php
/**
 * Template Part: Event Card
 *
 * Reusable card component for displaying event previews.
 *
 * @package Novira_Academy
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$event_date     = get_post_meta( get_the_ID(), '_event_date', true );
$event_time     = get_post_meta( get_the_ID(), '_event_time', true );
$event_location = get_post_meta( get_the_ID(), '_event_location', true );

// Get event type
$event_types = get_the_terms( get_the_ID(), 'event_type' );
$event_type  = ! empty( $event_types ) ? $event_types[0] : null;
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'event-card' ); ?>>
	<div class="card-date-badge">
		<?php if ( $event_date ) : ?>
			<span class="date-day"><?php echo esc_html( date( 'd', strtotime( $event_date ) ) ); ?></span>
			<span class="date-month"><?php echo esc_html( date( 'M', strtotime( $event_date ) ) ); ?></span>
		<?php endif; ?>
	</div>

	<a href="<?php the_permalink(); ?>" class="card-link" aria-hidden="true" tabindex="-1">
		<?php if ( has_post_thumbnail() ) : ?>
			<div class="card-thumbnail">
				<?php the_post_thumbnail( 'medium', array( 'class' => 'card-image' ) ); ?>
			</div>
		<?php endif; ?>
	</a>

	<div class="card-content">
		<?php if ( $event_type ) : ?>
			<span class="card-type"><?php echo esc_html( $event_type->name ); ?></span>
		<?php endif; ?>

		<h2 class="card-title">
			<a href="<?php the_permalink(); ?>">
				<?php the_title(); ?>
			</a>
		</h2>

		<div class="card-details">
			<?php if ( $event_date ) : ?>
				<div class="detail-item">
					<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
						<rect x="3" y="4" width="18" height="18" rx="2" ry="2"/>
						<line x1="16" y1="2" x2="16" y2="6"/>
						<line x1="8" y1="2" x2="8" y2="6"/>
						<line x1="3" y1="10" x2="21" y2="10"/>
					</svg>
					<span><?php echo esc_html( date_i18n( 'l, d F Y', strtotime( $event_date ) ) ); ?></span>
				</div>
			<?php endif; ?>

			<?php if ( $event_time ) : ?>
				<div class="detail-item">
					<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
						<circle cx="12" cy="12" r="10"/>
						<path d="M12 6v6l4 2"/>
					</svg>
					<span><?php echo esc_html( date_i18n( 'g:i A', strtotime( $event_time ) ) ); ?></span>
				</div>
			<?php endif; ?>

			<?php if ( $event_location ) : ?>
				<div class="detail-item">
					<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
						<path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z"/>
						<circle cx="12" cy="10" r="3"/>
					</svg>
					<span><?php echo esc_html( $event_location ); ?></span>
				</div>
			<?php endif; ?>
		</div>

		<div class="card-excerpt">
			<?php the_excerpt(); ?>
		</div>

		<div class="card-footer">
			<a href="<?php the_permalink(); ?>" class="btn btn-outline">
				<?php esc_html_e( 'التفاصيل', 'novira-academy' ); ?>
				<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
					<path d="M5 12h14M12 5l7 7-7 7"/>
				</svg>
			</a>
		</div>
	</div>
</article>
