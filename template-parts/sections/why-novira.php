<?php
/**
 * Template Part: Why Novira Section (Guarantee Ledger)
 *
 * ⚠️ LEGACY — NOT RENDERED. This section is not included by any template
 * (no get_template_part reference). It predates the current homepage and
 * conflicts with the frozen UX-writing model: it uses a "مضمون" (guaranteed)
 * seal and career/"future" framing that the academy does not offer. Kept in
 * the repo intentionally (do not delete); do NOT re-enable without a full
 * copy rewrite. See docs/ux-writing-rewrite-4.2.W.md §3.
 *
 * Presents Novira's differentiators as entries in an official
 * guarantee ledger: two stamped primary guarantees plus four
 * supporting proof points, all set on a paper-like panel that
 * floats over the dark navy stage.
 *
 * @package Novira_Academy
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

<section class="why-novira-v2" aria-label="<?php esc_attr_e( 'لماذا نوفيرا', 'novira-academy' ); ?>">
	<div class="why-novira-v2__container">

		<!-- Ledger panel -->
		<div class="why-novira-v2__ledger">

			<!-- Left: ledger header with gold seal -->
			<div class="why-novira-v2__header">
				<span class="why-novira-v2__eyebrow"><?php esc_html_e( 'ليه نوفيرا؟', 'novira-academy' ); ?></span>
				<h2 class="why-novira-v2__title"><?php esc_html_e( 'تعليم مش بس شهادة', 'novira-academy' ); ?></h2>
				<p class="why-novira-v2__desc">
					<?php esc_html_e( 'نوفيرا أكاديمي مش مجرد أكاديمية تعليمية — دي مؤسسة بتبني مسارك الدراسي والمهني من البداية لحد ما توصل. بنؤمن إن التعليم الحقيقي هو اللي يخلّي مستقبلك في أمان.', 'novira-academy' ); ?>
				</p>

				<div class="why-novira-v2__seal" aria-hidden="true">
					<span class="why-novira-v2__seal-ring why-novira-v2__seal-ring--outer"></span>
					<span class="why-novira-v2__seal-ring why-novira-v2__seal-ring--inner"></span>
					<span class="why-novira-v2__seal-star">
						<svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M12 2l2.4 7.2h7.6l-6 4.8 2.4 7.2-6-4.8-6 4.8 2.4-7.2-6-4.8h7.6z"/></svg>
					</span>
					<span class="why-novira-v2__seal-text"><?php esc_html_e( 'مضمون', 'novira-academy' ); ?></span>
				</div>
			</div>

			<!-- Right: guarantee entries -->
			<div class="why-novira-v2__entries">

				<!-- Primary stamped guarantees -->
				<div class="why-novira-v2__primary">
					<article class="why-novira-v2__guarantee why-novira-v2__guarantee--primary">
						<span class="why-novira-v2__stamp" aria-hidden="true">
							<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
								<circle cx="12" cy="12" r="10"/>
								<path d="M8 12l3 3 5-6"/>
							</svg>
						</span>
						<div class="why-novira-v2__guarantee-body">
							<h3 class="why-novira-v2__guarantee-title"><?php esc_html_e( 'اعتماد دولي معترف بيها', 'novira-academy' ); ?></h3>
							<p class="why-novira-v2__guarantee-desc"><?php esc_html_e( 'شهاداتنا معتمدة من الجامعات والسفارات والجهات الحكومية — ورقك في أمان معانا.', 'novira-academy' ); ?></p>
						</div>
					</article>

					<article class="why-novira-v2__guarantee why-novira-v2__guarantee--primary">
						<span class="why-novira-v2__stamp" aria-hidden="true">
							<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
								<circle cx="12" cy="12" r="10"/>
								<path d="M8 12l3 3 5-6"/>
							</svg>
						</span>
						<div class="why-novira-v2__guarantee-body">
							<h3 class="why-novira-v2__guarantee-title"><?php esc_html_e( 'مدربون خبراء في مجالهم', 'novira-academy' ); ?></h3>
							<p class="why-novira-v2__guarantee-desc"><?php esc_html_e( 'مش بس شيوخ تعليم — مدربين شغالين في سوق العمل وبيجيبوا الخبرة الحقيقية للفصل.', 'novira-academy' ); ?></p>
						</div>
					</article>
				</div>

				<!-- Divider -->
				<hr class="why-novira-v2__divider">

				<!-- Secondary proof points -->
				<div class="why-novira-v2__secondary">
					<article class="why-novira-v2__guarantee why-novira-v2__guarantee--secondary">
						<span class="why-novira-v2__bullet" aria-hidden="true"></span>
						<div>
							<h4 class="why-novira-v2__guarantee-title"><?php esc_html_e( 'تدريب عملي', 'novira-academy' ); ?></h4>
							<p class="why-novira-v2__guarantee-desc"><?php esc_html_e( 'تطبّق مهاراتك على مشاريع حقيقية مش بس نظري.', 'novira-academy' ); ?></p>
						</div>
					</article>

					<article class="why-novira-v2__guarantee why-novira-v2__guarantee--secondary">
						<span class="why-novira-v2__bullet" aria-hidden="true"></span>
						<div>
							<h4 class="why-novira-v2__guarantee-title"><?php esc_html_e( 'دعم مهني مستمر', 'novira-academy' ); ?></h4>
							<p class="why-novira-v2__guarantee-desc"><?php esc_html_e( 'إرشاد مهني وفرص وظيفية حتى بعد ما تخلّص الكورس.', 'novira-academy' ); ?></p>
						</div>
					</article>

					<article class="why-novira-v2__guarantee why-novira-v2__guarantee--secondary">
						<span class="why-novira-v2__bullet" aria-hidden="true"></span>
						<div>
							<h4 class="why-novira-v2__guarantee-title"><?php esc_html_e( 'دعم أكاديمي متابع', 'novira-academy' ); ?></h4>
							<p class="why-novira-v2__guarantee-desc"><?php esc_html_e( 'متابعة مستمرة مع كل طالب من أول يوم لحد ما يحقق هدفه.', 'novira-academy' ); ?></p>
						</div>
					</article>

					<article class="why-novira-v2__guarantee why-novira-v2__guarantee--secondary">
						<span class="why-novira-v2__bullet" aria-hidden="true"></span>
						<div>
							<h4 class="why-novira-v2__guarantee-title"><?php esc_html_e( 'بيئة تعليمية حديثة', 'novira-academy' ); ?></h4>
							<p class="why-novira-v2__guarantee-desc"><?php esc_html_e( 'قاعات ذكية وتجهيزات على أعلى مستوى للتعلم الفعال.', 'novira-academy' ); ?></p>
						</div>
					</article>
				</div>

			</div>

		</div>

	</div>
</section>
