<?php
/**
 * Exam Spoke — S4 Preparation Method
 *
 * OWNS: how Novira prepares — teaching, practice, mock exams, follow-up. Carries
 * the on-page anchor #exam-prep. Uses the dev placeholder for the explainer
 * video (replaceable by filename). Null-safe.
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
<section id="exam-prep" class="section exam-prep" aria-label="<?php esc_attr_e( 'طريقة الإعداد', 'novira-academy' ); ?>">
	<div class="container">
		<div class="section-header">
			<span class="section-tag"><?php esc_html_e( 'الإعداد', 'novira-academy' ); ?></span>
			<h2 class="section-title"><?php esc_html_e( 'طريقة الإعداد', 'novira-academy' ); ?></h2>
		</div>

		<div class="value-card">
			<h4><?php esc_html_e( 'منهج الإعداد', 'novira-academy' ); ?></h4>
			<p><?php echo esc_html( novira_exam_text( $meta['preparation_method'] ) ); ?></p>
		</div>
		<div class="value-card">
			<h4><?php esc_html_e( 'الاختبارات التجريبية', 'novira-academy' ); ?></h4>
			<p><?php echo esc_html( novira_exam_text( $meta['mock_exam_policy'] ) ); ?></p>
		</div>

		<?php if ( ! empty( $meta['video_placeholder'] ) ) : ?>
			<figure class="exam-prep__video">
				<img src="<?php echo esc_url( $meta['video_placeholder'] ); ?>" alt="<?php esc_attr_e( 'فيديو توضيحي للإعداد', 'novira-academy' ); ?>" loading="lazy" decoding="async">
			</figure>
		<?php endif; ?>
	</div>
</section>
