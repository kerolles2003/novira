<?php
/**
 * Search Results Template
 *
 * Template for displaying search results.
 *
 * @package Novira_Academy
 */

get_header();
?>

<main id="primary" class="search-page">
	<div class="container">
		<header class="search-header">
			<h1 class="search-title">
				<?php
				printf(
					/* translators: %s: search query */
					__( 'نتائج البحث عن: %s', 'novira-academy' ),
					'<span class="search-query">' . esc_html( get_search_query() ) . '</span>'
				);
				?>
			</h1>
			<p class="search-count">
				<?php
				printf(
					/* translators: %d: number of results */
					_n( 'تم العثور على نتيجة واحدة', 'تم العثور على %d نتيجة', $wp_query->found_posts, 'novira-academy' ),
					$wp_query->found_posts
				);
				?>
			</p>
		</header>

		<?php if ( have_posts() ) : ?>
			<div class="posts-grid">
				<?php while ( have_posts() ) : the_post(); ?>
					<?php
					if ( 'event' === get_post_type() ) {
						get_template_part( 'template-parts/content/event-card' );
					} elseif ( 'blog_post' === get_post_type() ) {
						get_template_part( 'template-parts/content/blog-post-card' );
					} else {
						get_template_part( 'template-parts/content/content', get_post_type() );
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
				<div class="no-results-icon" aria-hidden="true">
					<svg width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
						<circle cx="11" cy="11" r="8"/>
						<path d="M21 21l-4.35-4.35"/>
						<path d="M8 11h6"/>
					</svg>
				</div>
				<h2><?php esc_html_e( 'لم يتم العثور على نتائج', 'novira-academy' ); ?></h2>
				<p><?php esc_html_e( 'عذراً، لا توجد نتائج تطابق بحثك. جرب البحث بكلمات مختلفة.', 'novira-academy' ); ?></p>
				
				<div class="search-form">
					<?php get_search_form(); ?>
				</div>
			</div>
		<?php endif; ?>
	</div>
</main>

<?php get_footer(); ?>
