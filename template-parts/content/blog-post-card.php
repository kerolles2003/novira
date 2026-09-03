<?php
/**
 * Template Part: Blog Post Card
 *
 * Reusable card component for displaying blog post previews.
 *
 * @package Novira_Academy
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'blog-post-card' ); ?>>
	<a href="<?php the_permalink(); ?>" class="card-link" aria-hidden="true" tabindex="-1">
		<?php if ( has_post_thumbnail() ) : ?>
			<div class="card-thumbnail">
				<?php the_post_thumbnail( 'medium_large', array( 'class' => 'card-image' ) ); ?>
				<div class="card-overlay">
					<span class="read-more"><?php esc_html_e( 'اقرأ المزيد', 'novira-academy' ); ?></span>
				</div>
			</div>
		<?php endif; ?>
	</a>

	<div class="card-content">
		<div class="card-meta">
			<?php
			$categories = get_the_category( get_the_ID() );
			if ( ! empty( $categories ) ) :
			?>
				<span class="card-category">
					<a href="<?php echo esc_url( get_category_link( $categories[0]->term_id ) ); ?>">
						<?php echo esc_html( $categories[0]->name ); ?>
					</a>
				</span>
			<?php endif; ?>

			<span class="card-date">
				<time datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>">
					<?php echo esc_html( get_the_date() ); ?>
				</time>
			</span>
		</div>

		<h2 class="card-title">
			<a href="<?php the_permalink(); ?>">
				<?php the_title(); ?>
			</a>
		</h2>

		<div class="card-excerpt">
			<?php the_excerpt(); ?>
		</div>

		<div class="card-footer">
			<div class="card-author">
				<?php echo get_avatar( get_the_author_meta( 'ID' ), 32 ); ?>
				<span class="author-name"><?php the_author(); ?></span>
			</div>

			<a href="<?php the_permalink(); ?>" class="card-read-more">
				<?php esc_html_e( 'اقرأ المزيد', 'novira-academy' ); ?>
				<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
					<path d="M5 12h14M12 5l7 7-7 7"/>
				</svg>
			</a>
		</div>
	</div>
</article>
