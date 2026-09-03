<?php
/**
 * Template Part: Latest Posts Section
 *
 * Homepage section displaying latest blog posts.
 * Uses a filter to allow plugins to customize the query.
 *
 * @package Novira_Academy
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Filter the latest posts query.
 *
 * @param array $args WP_Query arguments.
 */
$args = apply_filters( 'novira_latest_posts_query', array(
	'post_type'      => 'blog_post',
	'posts_per_page' => 3,
	'post_status'    => 'publish',
	'orderby'        => 'date',
	'order'          => 'DESC',
) );

$posts_query = new WP_Query( $args );

if ( ! $posts_query->have_posts() ) {
	return;
}
?>

<section class="latest-posts-section section" aria-label="<?php esc_attr_e( 'آخر المقالات', 'novira-academy' ); ?>">
	<div class="container">
		<div class="section-header">
			<span class="section-tag"><?php esc_html_e( 'المدونة', 'novira-academy' ); ?></span>
			<h2 class="section-title"><?php esc_html_e( 'آخر المقالات', 'novira-academy' ); ?></h2>
			<p class="section-subtitle"><?php esc_html_e( 'تابع آخر أخبارنا ومقالاتنا التعليمية.', 'novira-academy' ); ?></p>
		</div>

		<div class="posts-grid">
			<?php while ( $posts_query->have_posts() ) : $posts_query->the_post(); ?>
				<?php get_template_part( 'template-parts/content/blog-post-card' ); ?>
			<?php endwhile; ?>
		</div>

		<div class="section-footer">
			<a href="<?php echo esc_url( get_post_type_archive_link( 'blog_post' ) ); ?>" class="btn btn-outline">
				<?php esc_html_e( 'عرض جميع المقالات', 'novira-academy' ); ?>
				<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
					<path d="M5 12h14M12 5l7 7-7 7"/>
				</svg>
			</a>
		</div>
	</div>
</section>

<?php wp_reset_postdata(); ?>
