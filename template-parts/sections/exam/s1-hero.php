<?php
/**
 * Exam Spoke — S1 Hero (orientation only)
 *
 * OWNS: orientation + breadcrumb. Reads $args['meta'] (slug-driven). Contains
 * the page's single <h1>. No exam mechanics here. Rendering only.
 *
 * @package Novira_Academy
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$meta = isset( $args['meta'] ) ? $args['meta'] : null;
if ( ! $meta ) {
	return;
}
?>
<section class="section exam-hero" aria-label="<?php echo esc_attr( $meta['name'] ); ?>">
	<div class="container">
		<?php get_template_part( 'template-parts/components/breadcrumb-trail' ); ?>

		<div class="section-header">
			<span class="section-tag"><?php echo esc_html( $meta['name'] ); ?></span>
			<h1 class="section-title"><?php echo esc_html( $meta['hero_title'] ); ?></h1>
			<?php if ( ! empty( $meta['hero_desc'] ) ) : ?>
				<p class="section-desc"><?php echo esc_html( $meta['hero_desc'] ); ?></p>
			<?php endif; ?>
		</div>

		<p class="exam-hero__actions">
			<a class="btn btn-primary" href="#exam-prep"><?php esc_html_e( 'استكشف طريقة الإعداد', 'novira-academy' ); ?></a>
			<a class="btn btn-outline" href="#exam-consult"><?php esc_html_e( 'تحدّث مع فريقنا', 'novira-academy' ); ?></a>
		</p>
	</div>
</section>
