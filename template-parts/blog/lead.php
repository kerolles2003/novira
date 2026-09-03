<?php
/**
 * Editorial lead — the featured (editor's-pick) article as the visual focal
 * point, paired with a ranked "most-read" rail. Rendered on the archive's first
 * page. Consumes the newest main-query post for the featured card; the rail is a
 * separate, most-discussed query (excluding the featured).
 *
 * @package Novira_Academy
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

the_post(); // Featured = newest post (first in the main query).
$nvb_featured_id = get_the_ID();
$nvb_trending    = novira_blog_trending_posts( 5, array( $nvb_featured_id ) );
?>
<section class="nvblog-lead-section" aria-label="<?php esc_attr_e( 'المقال المميّز والأكثر قراءة', 'novira-academy' ); ?>">
	<div class="nvblog-container">
		<div class="nvblog-lead">
			<?php get_template_part( 'template-parts/blog/featured' ); ?>

			<?php if ( count( $nvb_trending ) >= 3 ) : ?>
				<aside class="nvblog-trend" aria-labelledby="nvblog-trend-title">
					<div class="nvblog-trend__head">
						<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M3 17l6-6 4 4 8-8"/><path d="M16 7h5v5"/></svg>
						<h2 id="nvblog-trend-title" class="nvblog-trend__title"><?php esc_html_e( 'الأكثر قراءةً', 'novira-academy' ); ?></h2>
					</div>
					<div class="nvblog-trend__list">
						<?php
						$nvb_rank = 1;
						foreach ( $nvb_trending as $nvb_tpost ) :
							$nvb_tcat    = novira_blog_primary_category( $nvb_tpost->ID );
							$nvb_taccent = novira_blog_accent( $nvb_tcat );
							?>
							<article class="nvblog-trend__item" style="--cc: <?php echo esc_attr( $nvb_taccent ); ?>;">
								<span class="nvblog-trend__rank" aria-hidden="true"><?php echo esc_html( number_format_i18n( $nvb_rank ) ); ?></span>
								<div class="nvblog-trend__body">
									<a class="nvblog-trend__link" href="<?php echo esc_url( get_permalink( $nvb_tpost ) ); ?>"><?php echo esc_html( get_the_title( $nvb_tpost ) ); ?></a>
									<div class="nvblog-trend__meta">
										<?php if ( $nvb_tcat ) : ?>
											<span class="nvblog-trend__dot" aria-hidden="true"></span><?php echo esc_html( $nvb_tcat->name ); ?>
											<span class="nvblog-metadot" aria-hidden="true"></span>
										<?php endif; ?>
										<span><?php echo esc_html( novira_blog_reading_time_label( $nvb_tpost->ID ) ); ?></span>
									</div>
								</div>
							</article>
							<?php
							$nvb_rank++;
						endforeach;
						?>
					</div>
				</aside>
			<?php endif; ?>
		</div>
	</div>
</section>
