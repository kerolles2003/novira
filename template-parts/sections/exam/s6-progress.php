<?php
/**
 * Exam Spoke — S6 Progress Tracking
 *
 * OWNS: exam-specific performance monitoring, reporting, and parent
 * communication during preparation. Null-safe. Links UP to the hub's general
 * academic-follow-up rather than restating it.
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
<section class="section exam-progress" aria-label="<?php esc_attr_e( 'متابعة التقدّم', 'novira-academy' ); ?>">
	<div class="container">
		<div class="section-header">
			<span class="section-tag"><?php esc_html_e( 'المتابعة', 'novira-academy' ); ?></span>
			<h2 class="section-title"><?php esc_html_e( 'متابعة تقدّم الطالب', 'novira-academy' ); ?></h2>
		</div>

		<div class="value-card">
			<h4><?php esc_html_e( 'متابعة الأداء', 'novira-academy' ); ?></h4>
			<p><?php echo esc_html( novira_exam_text( $meta['progress_tracking'] ) ); ?></p>
		</div>
		<div class="value-card">
			<h4><?php esc_html_e( 'التقارير والتواصل مع أولياء الأمور', 'novira-academy' ); ?></h4>
			<p><?php echo esc_html( novira_exam_text( $meta['reporting_method'] ) ); ?></p>
		</div>

		<p class="exam-progress__up">
			<a href="<?php echo esc_url( home_url( '/american-diploma/' ) ); ?>"><?php esc_html_e( 'تعرّف على المتابعة الأكاديمية ضمن الرحلة الكاملة', 'novira-academy' ); ?></a>
		</p>
	</div>
</section>
