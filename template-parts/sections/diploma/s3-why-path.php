<?php
/**
 * Diploma Hub — S3 Why Families Choose This Path
 *
 * OWNS: neutral reasons families consider this path. Contains NO Novira claims
 * and NO comparison attacks against any other system. Educational and neutral.
 *
 * Rendering only. Copy is factual/neutral and subject to academy review.
 *
 * @package Novira_Academy
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$novira_reasons = array(
	array(
		'title' => __( 'مرونة المسار', 'novira-academy' ),
		'text'  => __( 'نظام يتيح للطالب التقدّم وفق مستواه واهتماماته.', 'novira-academy' ),
	),
	array(
		'title' => __( 'إتقان اللغة الإنجليزية', 'novira-academy' ),
		'text'  => __( 'الدراسة بالإنجليزية تنمّي مهارات لغوية يحتاجها الطالب أكاديمياً ومهنياً.', 'novira-academy' ),
	),
	array(
		'title' => __( 'انفتاح دولي', 'novira-academy' ),
		'text'  => __( 'محتوى ومعايير ذات طابع دولي توسّع مدارك الطالب.', 'novira-academy' ),
	),
	array(
		'title' => __( 'تعدّد مسارات الجامعة', 'novira-academy' ),
		'text'  => __( 'يفتح المسار خيارات تقديم متعددة، وفق متطلبات كل جامعة وجهة مختصة.', 'novira-academy' ),
	),
);
?>
<section class="section diploma-why-path" aria-label="<?php esc_attr_e( 'لماذا تختار بعض الأسر هذا المسار؟', 'novira-academy' ); ?>">
	<div class="container">
		<div class="section-header">
			<span class="section-tag"><?php esc_html_e( 'المسار', 'novira-academy' ); ?></span>
			<h2 class="section-title"><?php esc_html_e( 'لماذا تختار بعض الأسر هذا المسار؟', 'novira-academy' ); ?></h2>
		</div>

		<div class="diploma-reasons">
			<?php foreach ( $novira_reasons as $novira_reason ) : ?>
				<div class="value-card">
					<h4><?php echo esc_html( $novira_reason['title'] ); ?></h4>
					<p><?php echo esc_html( $novira_reason['text'] ); ?></p>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>
