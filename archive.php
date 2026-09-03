<?php
/**
 * Archive Template
 *
 * Template for displaying blog and event archives.
 *
 * @package Novira_Academy
 */

get_header();
?>

<main id="primary" class="archive-page">
	<div class="container">
		<header class="archive-header">
			<h1 class="archive-title">
				<?php
				if ( is_post_type_archive( 'blog_post' ) ) {
					esc_html_e( 'المقالات', 'novira-academy' );
				} elseif ( is_post_type_archive( 'event' ) ) {
					esc_html_e( 'الأحداث', 'novira-academy' );
				} elseif ( is_category() ) {
					single_cat_title();
				} elseif ( is_tag() ) {
					single_tag_title();
				} elseif ( is_author() ) {
					printf( __( 'مقالات %s', 'novira-academy' ), get_the_author() );
				} elseif ( is_year() ) {
					printf( __( 'أرشيف %s', 'novira-academy' ), get_the_date( 'Y' ) );
				} elseif ( is_month() ) {
					printf( __( 'أرشيف %s', 'novira-academy' ), get_the_date( 'F Y' ) );
				} elseif ( is_day() ) {
					printf( __( 'أرشيف %s', 'novira-academy' ), get_the_date() );
				} else {
					esc_html_e( 'الأرشيف', 'novira-academy' );
				}
				?>
			</h1>

			<?php if ( is_category() || is_tag() ) : ?>
				<div class="archive-description">
					<?php the_archive_description(); ?>
				</div>
			<?php endif; ?>
		</header>

		<?php if ( have_posts() ) : ?>
			<div class="posts-grid">
				<?php while ( have_posts() ) : the_post(); ?>
					<?php
					if ( 'event' === get_post_type() ) {
						get_template_part( 'template-parts/content/event-card' );
					} else {
						get_template_part( 'template-parts/content/blog-post-card' );
					}
					?>
				<?php endwhile; ?>
			</div>

			<?php
			the_posts_pagination( array(
				'mid_size'  => 2,
				'prev_text' => '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M15 18l-6-6 6-6"/></svg>',
				'next_text' => '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 18l6-6-6-6"/></svg>',
			) );
			?>
		<?php else : ?>
			<div class="no-results">
				<h2><?php esc_html_e( 'لم يتم العثور على محتوى', 'novira-academy' ); ?></h2>
				<p><?php esc_html_e( 'عذراً، لا يوجد محتوى يطابق بحثك. جرب البحث بكلمات مختلفة.', 'novira-academy' ); ?></p>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn btn-primary">
					<?php esc_html_e( 'العودة للرئيسية', 'novira-academy' ); ?>
				</a>
			</div>
		<?php endif; ?>
	</div>
</main>

<?php get_footer(); ?>
