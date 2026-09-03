<?php
/**
 * Exam Spoke — S2 What is this exam?
 *
 * OWNS: the instrument's definition, purpose, and role. Truth-gated & null-safe
 * (definition/purpose are authoritative — academy supplied). Links UP to the
 * hub for "what is the American Diploma" — never restates it.
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
$name = $meta['name'];
?>
<section class="section exam-what-is" aria-label="<?php echo esc_attr( sprintf( __( 'ما هو %s؟', 'novira-academy' ), $name ) ); ?>">
	<div class="container">
		<div class="section-header">
			<span class="section-tag"><?php esc_html_e( 'تعريف', 'novira-academy' ); ?></span>
			<h2 class="section-title"><?php echo esc_html( sprintf( __( 'ما هو %s؟', 'novira-academy' ), $name ) ); ?></h2>
		</div>

		<div class="value-card">
			<h4><?php esc_html_e( 'التعريف', 'novira-academy' ); ?></h4>
			<p><?php echo esc_html( novira_exam_text( $meta['definition'] ) ); ?></p>
		</div>
		<div class="value-card">
			<h4><?php esc_html_e( 'الغرض والدور', 'novira-academy' ); ?></h4>
			<p><?php echo esc_html( novira_exam_text( $meta['purpose'] ) ); ?></p>
		</div>

		<?php if ( ! empty( $meta['comparison_note'] ) ) : ?>
			<p class="exam-what-is__note"><?php echo esc_html( $meta['comparison_note'] ); ?></p>
		<?php endif; ?>

		<p class="exam-what-is__up">
			<?php esc_html_e( 'هذا الاختبار جزء من الدبلومة الأمريكية.', 'novira-academy' ); ?>
			<a href="<?php echo esc_url( home_url( '/american-diploma/' ) ); ?>"><?php esc_html_e( 'تعرّف على الدبلومة الأمريكية', 'novira-academy' ); ?></a>
		</p>
	</div>
</section>
