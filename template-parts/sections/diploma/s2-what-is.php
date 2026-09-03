<?php
/**
 * Diploma Hub — S2 What is the American Diploma?
 *
 * OWNS: category literacy — credits, GPA, graduation requirements, university
 * pathways. One-sentence definitions only. Does NOT own exam mechanics; for the
 * assessments it links down to the program ecosystem (S6 → spokes).
 *
 * Rendering only. Definitions are factual/neutral and subject to academy review.
 *
 * @package Novira_Academy
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Plain, one-sentence literacy definitions (no exam mechanics, no marketing).
$novira_concepts = array(
	array(
		'term' => __( 'الساعات المعتمدة (Credits)', 'novira-academy' ),
		'def'  => __( 'وحدات يحصل عليها الطالب عند إتمام كل مادة دراسية بنجاح.', 'novira-academy' ),
	),
	array(
		'term' => __( 'المعدل التراكمي (GPA)', 'novira-academy' ),
		'def'  => __( 'متوسط تقديرات الطالب عبر المواد، ويُحسب بشكل تراكمي خلال سنوات الدراسة.', 'novira-academy' ),
	),
	array(
		'term' => __( 'متطلبات التخرج', 'novira-academy' ),
		'def'  => __( 'مجموعة الساعات والمواد التي يحتاج الطالب لاستكمالها للحصول على الدبلومة.', 'novira-academy' ),
	),
	array(
		'term' => __( 'مسارات الجامعة', 'novira-academy' ),
		'def'  => __( 'الطرق التي يتقدّم بها الطالب للجامعات بعد الدبلومة، وفق متطلبات كل جامعة وجهة مختصة.', 'novira-academy' ),
	),
);
?>
<section class="section diploma-what-is" aria-label="<?php esc_attr_e( 'ما هي الدبلومة الأمريكية؟', 'novira-academy' ); ?>">
	<div class="container">
		<div class="section-header">
			<span class="section-tag"><?php esc_html_e( 'تعريف', 'novira-academy' ); ?></span>
			<h2 class="section-title"><?php esc_html_e( 'ما هي الدبلومة الأمريكية؟', 'novira-academy' ); ?></h2>
			<p class="section-desc"><?php esc_html_e( 'مفاهيم أساسية تساعد الأسرة على فهم المسار قبل اتخاذ القرار.', 'novira-academy' ); ?></p>
		</div>

		<dl class="diploma-concepts">
			<?php foreach ( $novira_concepts as $novira_concept ) : ?>
				<div class="value-card">
					<dt><?php echo esc_html( $novira_concept['term'] ); ?></dt>
					<dd><?php echo esc_html( $novira_concept['def'] ); ?></dd>
				</div>
			<?php endforeach; ?>
		</dl>

		<p class="diploma-what-is__more">
			<?php esc_html_e( 'أما تفاصيل الاختبارات الدولية (EST و Digital SAT و ACT) فتجدها في منظومة البرامج.', 'novira-academy' ); ?>
			<a href="#ecosystem"><?php esc_html_e( 'استكشف البرامج', 'novira-academy' ); ?></a>
		</p>
	</div>
</section>
