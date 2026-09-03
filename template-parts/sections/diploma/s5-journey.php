<?php
/**
 * Diploma Hub — S5 Academic Journey (HEART OF THE PAGE / secondary hub)
 *
 * OWNS: the seven-stage accompaniment model. Reads ONLY novira_diploma_journey()
 * and consumes novira_admission_disclaimer(). No hardcoded stages, no copy that
 * duplicates the data layer, no guarantee language.
 *
 * Stage 4 (exams) is rendered identically to the others — it is NOT the climax.
 * Stages with a 'links' set route to the on-page program ecosystem (S6). Stages
 * with a 'future_page' are anticipated by the data layer; their standalone pages
 * (Exam Logistics, Application Guidance) are built in a later sprint, so no live
 * link is emitted yet.
 *
 * Rendering only.
 *
 * @package Novira_Academy
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$novira_stages     = function_exists( 'novira_diploma_journey' ) ? novira_diploma_journey() : array();
$novira_disclaimer = function_exists( 'novira_admission_disclaimer' ) ? novira_admission_disclaimer() : '';

if ( empty( $novira_stages ) ) {
	return;
}
?>
<section id="journey" class="section diploma-journey" aria-label="<?php esc_attr_e( 'الرحلة الأكاديمية', 'novira-academy' ); ?>">
	<div class="container">
		<div class="section-header">
			<span class="section-tag"><?php esc_html_e( 'الرحلة الأكاديمية', 'novira-academy' ); ?></span>
			<h2 class="section-title"><?php esc_html_e( 'نرافق الطالب خطوة بخطوة', 'novira-academy' ); ?></h2>
			<p class="section-desc"><?php esc_html_e( 'من التقييم الأول حتى الامتحان الرسمي — نرافق طالبك في كل مرحلة حتى يدخله مستعداً وقادراً على أفضل درجة ممكنة.', 'novira-academy' ); ?></p>
		</div>

		<ol class="diploma-journey__stages">
			<?php foreach ( $novira_stages as $novira_stage ) : ?>
				<li class="value-card diploma-journey__stage" id="stage-<?php echo esc_attr( $novira_stage['id'] ); ?>">
					<span class="diploma-journey__order" aria-hidden="true"><?php echo esc_html( $novira_stage['order'] ); ?></span>
					<h4 class="diploma-journey__label"><?php echo esc_html( $novira_stage['label'] ); ?></h4>

					<?php if ( ! empty( $novira_stage['student_need'] ) ) : ?>
						<p class="diploma-journey__need">
							<span class="diploma-journey__field"><?php esc_html_e( 'احتياج الطالب:', 'novira-academy' ); ?></span>
							<?php echo esc_html( $novira_stage['student_need'] ); ?>
						</p>
					<?php endif; ?>

					<?php if ( ! empty( $novira_stage['novira_role'] ) ) : ?>
						<p class="diploma-journey__role">
							<span class="diploma-journey__field"><?php esc_html_e( 'دور نوفيرا:', 'novira-academy' ); ?></span>
							<?php echo esc_html( $novira_stage['novira_role'] ); ?>
						</p>
					<?php endif; ?>

					<?php if ( ! empty( $novira_stage['links'] ) ) : ?>
						<p class="diploma-journey__cta">
							<a href="#ecosystem"><?php esc_html_e( 'استكشف برامج الاختبارات', 'novira-academy' ); ?></a>
						</p>
					<?php endif; ?>
				</li>
			<?php endforeach; ?>
		</ol>

		<?php if ( '' !== $novira_disclaimer ) : ?>
			<p class="diploma-journey__disclaimer value-card">
				<?php echo esc_html( $novira_disclaimer ); ?>
			</p>
		<?php endif; ?>
	</div>
</section>
