<?php
/**
 * Template Part: Upcoming Events Section
 *
 * Homepage section displaying upcoming events.
 * Uses a filter to allow plugins to customize the query.
 *
 * @package Novira_Academy
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Filter the upcoming events query.
 *
 * @param array $args WP_Query arguments.
 */
$args = apply_filters( 'novira_upcoming_events_query', array(
	'post_type'      => 'event',
	'posts_per_page' => 3,
	'post_status'    => 'publish',
	'meta_key'       => '_event_date',
	'meta_value'     => date( 'Y-m-d' ),
	'meta_compare'   => '>=',
	'orderby'        => 'meta_value',
	'order'          => 'ASC',
) );

$events_query = new WP_Query( $args );

if ( ! $events_query->have_posts() ) {
	return;
}
?>

<section class="upcoming-events-section section" aria-label="<?php esc_attr_e( 'الأحداث القادمة', 'novira-academy' ); ?>">
	<div class="container">
		<div class="section-header">
			<span class="section-tag"><?php esc_html_e( 'الأحداث', 'novira-academy' ); ?></span>
			<h2 class="section-title"><?php esc_html_e( 'الأحداث القادمة', 'novira-academy' ); ?></h2>
			<p class="section-subtitle"><?php esc_html_e( 'تابع أحداثنا وأنشطةنا القادمة.', 'novira-academy' ); ?></p>
		</div>

		<div class="events-grid">
			<?php while ( $events_query->have_posts() ) : $events_query->the_post(); ?>
				<?php get_template_part( 'template-parts/content/event-card' ); ?>
			<?php endwhile; ?>
		</div>

		<div class="section-footer">
			<a href="<?php echo esc_url( get_post_type_archive_link( 'event' ) ); ?>" class="btn btn-outline">
				<?php esc_html_e( 'عرض جميع الأحداث', 'novira-academy' ); ?>
				<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
					<path d="M5 12h14M12 5l7 7-7 7"/>
				</svg>
			</a>
		</div>
	</div>
</section>

<?php wp_reset_postdata(); ?>
