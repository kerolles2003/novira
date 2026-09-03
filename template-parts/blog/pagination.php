<?php
/**
 * Accessible numbered pagination for the blog archive / category views.
 * Operates on the main query. Arrows are authored for RTL and mirrored in LTR
 * via CSS. Renders nothing when there is a single page.
 *
 * @package Novira_Academy
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $wp_query;
$nvb_total = isset( $wp_query->max_num_pages ) ? (int) $wp_query->max_num_pages : 1;
if ( $nvb_total < 2 ) {
	return;
}
$nvb_current = max( 1, (int) get_query_var( 'paged' ), (int) get_query_var( 'page' ) );
$nvb_range   = 1;
?>
<nav class="nvblog-pagination" aria-label="<?php esc_attr_e( 'التنقل بين صفحات المقالات', 'novira-academy' ); ?>">
	<ul class="nvblog-pagination__list">
		<?php if ( $nvb_current > 1 ) : ?>
			<li>
				<a class="nvblog-pagination__link nvblog-pagination__nav" href="<?php echo esc_url( get_pagenum_link( $nvb_current - 1 ) ); ?>" rel="prev">
					<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M9 6l6 6-6 6"/></svg>
					<span><?php esc_html_e( 'السابق', 'novira-academy' ); ?></span>
				</a>
			</li>
		<?php endif; ?>

		<?php for ( $nvb_i = 1; $nvb_i <= $nvb_total; $nvb_i++ ) : ?>
			<?php if ( 1 === $nvb_i || $nvb_total === $nvb_i || ( $nvb_i >= $nvb_current - $nvb_range && $nvb_i <= $nvb_current + $nvb_range ) ) : ?>
				<?php if ( $nvb_i === $nvb_current ) : ?>
					<li><span class="nvblog-pagination__current" aria-current="page"><?php echo esc_html( number_format_i18n( $nvb_i ) ); ?></span></li>
				<?php else : ?>
					<li><a class="nvblog-pagination__link" href="<?php echo esc_url( get_pagenum_link( $nvb_i ) ); ?>" aria-label="<?php echo esc_attr( sprintf( __( 'الصفحة %s', 'novira-academy' ), number_format_i18n( $nvb_i ) ) ); ?>"><?php echo esc_html( number_format_i18n( $nvb_i ) ); ?></a></li>
				<?php endif; ?>
			<?php elseif ( $nvb_i === $nvb_current - $nvb_range - 1 || $nvb_i === $nvb_current + $nvb_range + 1 ) : ?>
				<li><span class="nvblog-pagination__dots" aria-hidden="true">…</span></li>
			<?php endif; ?>
		<?php endfor; ?>

		<?php if ( $nvb_current < $nvb_total ) : ?>
			<li>
				<a class="nvblog-pagination__link nvblog-pagination__nav" href="<?php echo esc_url( get_pagenum_link( $nvb_current + 1 ) ); ?>" rel="next">
					<span><?php esc_html_e( 'التالي', 'novira-academy' ); ?></span>
					<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M15 6l-6 6 6 6"/></svg>
				</a>
			</li>
		<?php endif; ?>
	</ul>
</nav>
