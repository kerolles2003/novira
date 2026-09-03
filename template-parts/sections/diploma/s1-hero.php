<?php
/**
 * Diploma Hub — S1 Hero
 *
 * OWNS: orientation only. Introduces the American Diploma, the Grade 10–12 span,
 * names the three assessments (EST · Digital SAT · ACT) as terms, and states the
 * companion philosophy. Does NOT explain exam mechanics (that is S6 + the spokes).
 *
 * Reuses the shared breadcrumb component. Contains the page's single <h1>.
 * Rendering only — no business logic. Copy here is factual/neutral and subject
 * to academy review.
 *
 * @package Novira_Academy
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<section class="section diploma-hero" aria-label="<?php esc_attr_e( 'البرنامج الأمريكي', 'novira-academy' ); ?>">
	<div class="container">
		<?php get_template_part( 'template-parts/components/breadcrumb-trail' ); ?>

		<div class="section-header">
			<span class="section-tag"><?php esc_html_e( 'البرنامج الأمريكي', 'novira-academy' ); ?></span>
			<h1 class="section-title">
				<?php esc_html_e( 'الدبلومة الأمريكية', 'novira-academy' ); ?>
				<span class="hl"><?php esc_html_e( 'رفيق رحلة طالبك حتى الجامعة', 'novira-academy' ); ?></span>
			</h1>
			<p class="section-desc">
				<?php esc_html_e( 'الدبلومة الأمريكية مسار تعليمي يرافق الطالب من الصف العاشر حتى الصف الثاني عشر (Grade 10 – Grade 12)، ويشمل الاستعداد للاختبارات الدولية EST و Digital SAT و ACT. لا نقدّم اختباراً واحداً فحسب، بل نرافق الطالب وأسرته خلال مراحل الرحلة الأكاديمية.', 'novira-academy' ); ?>
			</p>
		</div>

		<p class="diploma-hero__actions">
			<a class="btn btn-primary" href="#journey"><?php esc_html_e( 'تعرّف على الرحلة الأكاديمية', 'novira-academy' ); ?></a>
			<a class="btn btn-outline" href="#ecosystem"><?php esc_html_e( 'استكشف البرامج', 'novira-academy' ); ?></a>
		</p>
	</div>
</section>
