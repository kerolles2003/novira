<?php
/**
 * Exam Spoke — S3 Exam Structure
 *
 * OWNS: sections, timing, score model. Truth-gated & null-safe — no invented
 * numbers, no promises. `sections` renders as a list when supplied (array),
 * otherwise a pending marker.
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
$sections = $meta['sections'];
?>
<section class="section exam-structure" aria-label="<?php esc_attr_e( 'بنية الاختبار', 'novira-academy' ); ?>">
	<div class="container">
		<div class="section-header">
			<span class="section-tag"><?php esc_html_e( 'بنية الاختبار', 'novira-academy' ); ?></span>
			<h2 class="section-title"><?php esc_html_e( 'مكوّنات الاختبار', 'novira-academy' ); ?></h2>
		</div>

		<div class="value-card">
			<h4><?php esc_html_e( 'الأقسام', 'novira-academy' ); ?></h4>
			<?php if ( is_array( $sections ) && ! empty( $sections ) ) : ?>
				<ul>
					<?php foreach ( $sections as $sec ) : ?>
						<li><?php echo esc_html( $sec ); ?></li>
					<?php endforeach; ?>
				</ul>
			<?php else : ?>
				<p><?php echo esc_html( novira_exam_text( null ) ); ?></p>
			<?php endif; ?>
		</div>

		<div class="value-card">
			<h4><?php esc_html_e( 'المدة', 'novira-academy' ); ?></h4>
			<p><?php echo esc_html( novira_exam_text( $meta['timing'] ) ); ?></p>
		</div>

		<div class="value-card">
			<h4><?php esc_html_e( 'نظام الدرجات', 'novira-academy' ); ?></h4>
			<p><?php echo esc_html( novira_exam_text( $meta['score_model'] ) ); ?></p>
		</div>

		<p class="exam-structure__note"><?php esc_html_e( 'نعرض البنية للمعلومة فقط، ولا نقدّم وعوداً بأي نتيجة.', 'novira-academy' ); ?></p>
	</div>
</section>
