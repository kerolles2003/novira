<?php
/**
 * Featured (editor's-pick) article card. Rendered inside the loop after the_post().
 * Inherits its category's brand accent via the inline --cc custom property.
 *
 * @package Novira_Academy
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$nvb_cat    = novira_blog_primary_category();
$nvb_accent = novira_blog_accent( $nvb_cat );
?>
<article class="nvblog-featured__card" style="--cc: <?php echo esc_attr( $nvb_accent ); ?>;">
	<div class="nvblog-featured__media<?php echo has_post_thumbnail() ? '' : ' nvblog-featured__media--empty'; ?>">
		<?php if ( has_post_thumbnail() ) : ?>
			<?php
			the_post_thumbnail(
				'large',
				array(
					'alt'           => the_title_attribute( array( 'echo' => false ) ),
					'loading'       => 'eager',
					'fetchpriority' => 'high',
					'decoding'      => 'async',
					'sizes'         => '(min-width: 1000px) 640px, 100vw',
				)
			);
			?>
		<?php else : ?>
			<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M4 5a2 2 0 0 1 2-2h6v18H6a2 2 0 0 0-2 2zM20 5a2 2 0 0 0-2-2h-6v18h6a2 2 0 0 1 2 2z"/></svg>
		<?php endif; ?>
	</div>
	<div class="nvblog-featured__body">
		<span class="nvblog-featured__flag">
			<svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M12 2.5l2.9 5.9 6.5.9-4.7 4.6 1.1 6.5L12 17.9 6.2 20.9l1.1-6.5L2.6 9.3l6.5-.9z"/></svg>
			<?php esc_html_e( 'المقال المميّز', 'novira-academy' ); ?>
		</span>
		<h2 class="nvblog-featured__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
		<p class="nvblog-featured__excerpt"><?php echo esc_html( wp_strip_all_tags( get_the_excerpt() ) ); ?></p>
		<div class="nvblog-featured__meta">
			<?php if ( $nvb_cat ) : ?>
				<span class="nvblog-metaitem nvblog-metaitem--cat">
					<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M20.6 13.4 12 22l-9-9V4a1 1 0 0 1 1-1h8z"/><circle cx="7.5" cy="7.5" r="1.4" fill="currentColor" stroke="none"/></svg>
					<?php echo esc_html( $nvb_cat->name ); ?>
				</span>
				<span class="nvblog-metadot" aria-hidden="true"></span>
			<?php endif; ?>
			<span class="nvblog-metaitem">
				<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="12" cy="12" r="9"/><path d="M12 7.5v5l3 1.8"/></svg>
				<span class="nvblog-num"><?php echo esc_html( novira_blog_reading_time_label() ); ?></span>
			</span>
			<span class="nvblog-metadot" aria-hidden="true"></span>
			<span class="nvblog-metaitem">
				<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="3" y="4.5" width="18" height="17" rx="2.5"/><path d="M3 9.5h18M8 2.5v4M16 2.5v4"/></svg>
				<?php echo novira_blog_meta_date(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- escaped in helper. ?>
			</span>
		</div>
		<a class="nvblog-featured__cta" href="<?php the_permalink(); ?>">
			<?php esc_html_e( 'اقرأ المقال', 'novira-academy' ); ?>
			<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M19 12H5M12 5l-7 7 7 7"/></svg>
		</a>
	</div>
</article>
