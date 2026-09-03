<?php
/**
 * Standard article card (grid). Rendered inside the loop after the_post().
 * The whole card is clickable via a stretched link on the title; the category
 * badge stays independently clickable above it. Inherits its category accent
 * via the inline --cc custom property.
 *
 * @package Novira_Academy
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$nvb_cat    = novira_blog_primary_category();
$nvb_accent = novira_blog_accent( $nvb_cat );
?>
<article <?php post_class( 'nvblog-card' ); ?> style="--cc: <?php echo esc_attr( $nvb_accent ); ?>;">
	<div class="nvblog-card__media<?php echo has_post_thumbnail() ? '' : ' nvblog-card__media--empty'; ?>">
		<?php if ( has_post_thumbnail() ) : ?>
			<?php
			the_post_thumbnail(
				'medium_large',
				array(
					'alt'      => the_title_attribute( array( 'echo' => false ) ),
					'loading'  => 'lazy',
					'decoding' => 'async',
					'sizes'    => '(min-width: 1000px) 360px, (min-width: 620px) 45vw, 92vw',
				)
			);
			?>
		<?php else : ?>
			<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M4 5a2 2 0 0 1 2-2h6v18H6a2 2 0 0 0-2 2zM20 5a2 2 0 0 0-2-2h-6v18h6a2 2 0 0 1 2 2z"/></svg>
		<?php endif; ?>
		<?php if ( $nvb_cat ) : ?>
			<a class="nvblog-card__badge" href="<?php echo esc_url( get_term_link( $nvb_cat ) ); ?>"><?php echo esc_html( $nvb_cat->name ); ?></a>
		<?php endif; ?>
	</div>
	<div class="nvblog-card__body">
		<div class="nvblog-card__meta">
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
		<h3 class="nvblog-card__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
		<p class="nvblog-card__excerpt"><?php echo esc_html( wp_strip_all_tags( get_the_excerpt() ) ); ?></p>
		<span class="nvblog-card__more" aria-hidden="true">
			<?php esc_html_e( 'اقرأ المزيد', 'novira-academy' ); ?>
			<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 12H5M12 5l-7 7 7 7"/></svg>
		</span>
	</div>
</article>
