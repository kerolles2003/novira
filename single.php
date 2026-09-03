<?php
/**
 * Single Post Template
 *
 * Template for displaying single blog posts.
 *
 * @package Novira_Academy
 */

get_header();
?>

<main id="primary" class="single-post">
	<?php while ( have_posts() ) : the_post(); ?>
		<article id="post-<?php the_ID(); ?>" <?php post_class( 'blog-article' ); ?>>
			<header class="article-header">
				<div class="container">
					<div class="article-meta">
						<?php
						$categories = get_the_category( get_the_ID() );
						if ( ! empty( $categories ) ) :
						?>
							<span class="article-category">
								<a href="<?php echo esc_url( get_category_link( $categories[0]->term_id ) ); ?>">
									<?php echo esc_html( $categories[0]->name ); ?>
								</a>
							</span>
						<?php endif; ?>
						
						<span class="article-date">
							<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
								<rect x="3" y="4" width="18" height="18" rx="2" ry="2"/>
								<line x1="16" y1="2" x2="16" y2="6"/>
								<line x1="8" y1="2" x2="8" y2="6"/>
								<line x1="3" y1="10" x2="21" y2="10"/>
							</svg>
							<time datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>">
								<?php echo esc_html( get_the_date() ); ?>
							</time>
						</span>
					</div>

					<h1 class="article-title"><?php the_title(); ?></h1>

					<div class="article-author">
						<?php echo get_avatar( get_the_author_meta( 'ID' ), 48 ); ?>
						<div class="author-info">
							<span class="author-name"><?php the_author(); ?></span>
							<span class="author-reading-time">
								<?php
								$content = get_the_content();
								$word_count = str_word_count( strip_tags( $content ) );
								$reading_time = ceil( $word_count / 200 );
								echo esc_html( sprintf( __( '%d دقائق للقراءة', 'novira-academy' ), $reading_time ) );
								?>
							</span>
						</div>
					</div>
				</div>
			</header>

			<?php if ( has_post_thumbnail() ) : ?>
				<div class="article-thumbnail">
					<div class="container">
						<?php the_post_thumbnail( 'full', array( 'class' => 'featured-image' ) ); ?>
					</div>
				</div>
			<?php endif; ?>

			<div class="article-content">
				<div class="container">
					<div class="content-wrapper">
						<?php the_content(); ?>
					</div>

					<?php
					$tags = get_the_tags( get_the_ID() );
					if ( ! empty( $tags ) ) :
					?>
						<div class="article-tags">
							<?php foreach ( $tags as $tag ) : ?>
								<a href="<?php echo esc_url( get_tag_link( $tag->term_id ) ); ?>" class="tag-item">
									<?php echo esc_html( $tag->name ); ?>
								</a>
							<?php endforeach; ?>
						</div>
					<?php endif; ?>
				</div>
			</div>
		</article>

		<div class="container">
			<nav class="post-navigation">
				<div class="nav-links">
					<div class="nav-previous">
						<?php previous_post_link( '%link', '<span class="nav-subtitle">' . __( 'المقال السابق', 'novira-academy' ) . '</span><span class="nav-title">%title</span>' ); ?>
					</div>
					<div class="nav-next">
						<?php next_post_link( '%link', '<span class="nav-subtitle">' . __( 'المقال التالي', 'novira-academy' ) . '</span><span class="nav-title">%title</span>' ); ?>
					</div>
				</div>
			</nav>
		</div>
	<?php endwhile; ?>
</main>

<?php get_footer(); ?>
