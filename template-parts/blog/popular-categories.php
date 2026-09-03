<?php
/**
 * Popular Categories — a browse-by-topic directory of the most-used blog
 * categories, each colour-coded with a matching icon. Skips itself when no
 * categories exist. Data-driven and expandable.
 *
 * @package Novira_Academy
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$nvb_cats = novira_blog_top_categories( 6 );
if ( empty( $nvb_cats ) ) {
	return;
}
?>
<section class="nvblog-cats" aria-labelledby="nvblog-cats-title">
	<div class="nvblog-container">
		<div class="nvblog-head">
			<span class="nvblog-head__eyebrow">
				<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="3" y="3" width="7" height="7" rx="2"/><rect x="14" y="3" width="7" height="7" rx="2"/><rect x="3" y="14" width="7" height="7" rx="2"/><rect x="14" y="14" width="7" height="7" rx="2"/></svg>
				<?php esc_html_e( 'استكشف حسب الموضوع', 'novira-academy' ); ?>
			</span>
			<h2 id="nvblog-cats-title" class="nvblog-head__title"><?php esc_html_e( 'تصفّح المكتبة حسب التصنيف', 'novira-academy' ); ?></h2>
		</div>
		<div class="nvblog-cats__grid">
			<?php foreach ( $nvb_cats as $nvb_cat ) : ?>
				<a class="nvblog-cat" style="--cc: <?php echo esc_attr( novira_blog_accent( $nvb_cat ) ); ?>;" href="<?php echo esc_url( get_term_link( $nvb_cat ) ); ?>">
					<span class="nvblog-cat__icon"><?php echo novira_blog_category_icon( $nvb_cat ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- static, theme-authored inline SVG. ?></span>
					<span class="nvblog-cat__body">
						<span class="nvblog-cat__name"><?php echo esc_html( $nvb_cat->name ); ?></span>
						<span class="nvblog-cat__count"><?php echo esc_html( sprintf( __( '%s مقال', 'novira-academy' ), number_format_i18n( $nvb_cat->count ) ) ); ?></span>
					</span>
					<span class="nvblog-cat__arrow" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 12H5M12 5l-7 7 7 7"/></svg></span>
				</a>
			<?php endforeach; ?>
		</div>
	</div>
</section>
