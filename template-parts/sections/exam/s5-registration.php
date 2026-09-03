<?php
/**
 * Exam Spoke — S5 Registration & Logistics
 *
 * OWNS: exam-specific registration, requirements, travel support, fees. Carries
 * the anti-guarantee statement via the single-source helper. Null-safe; fees use
 * the 'contact' sentinel. No guarantees.
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
$disclaimer = function_exists( 'novira_admission_disclaimer' ) ? novira_admission_disclaimer() : '';
?>
<section class="section exam-registration" aria-label="<?php esc_attr_e( 'التسجيل والدعم اللوجستي', 'novira-academy' ); ?>">
	<div class="container">
		<div class="section-header">
			<span class="section-tag"><?php esc_html_e( 'التسجيل والدعم', 'novira-academy' ); ?></span>
			<h2 class="section-title"><?php esc_html_e( 'التسجيل والدعم اللوجستي', 'novira-academy' ); ?></h2>
		</div>

		<div class="value-card">
			<h4><?php esc_html_e( 'دعم التسجيل', 'novira-academy' ); ?></h4>
			<p><?php echo esc_html( novira_exam_text( $meta['registration_support'] ) ); ?></p>
		</div>
		<div class="value-card">
			<h4><?php esc_html_e( 'المتطلبات', 'novira-academy' ); ?></h4>
			<p><?php echo esc_html( novira_exam_text( $meta['requirements'] ) ); ?></p>
		</div>
		<div class="value-card">
			<h4><?php esc_html_e( 'الدعم في التنقّل', 'novira-academy' ); ?></h4>
			<p><?php echo esc_html( novira_exam_text( $meta['travel_support'] ) ); ?></p>
		</div>
		<div class="value-card">
			<h4><?php esc_html_e( 'الرسوم', 'novira-academy' ); ?></h4>
			<p><?php echo esc_html( novira_exam_text( $meta['fees'] ) ); ?></p>
		</div>

		<?php if ( '' !== $disclaimer ) : ?>
			<p class="exam-registration__disclaimer value-card"><?php echo esc_html( $disclaimer ); ?></p>
		<?php endif; ?>
	</div>
</section>
