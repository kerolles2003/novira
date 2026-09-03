<?php
/**
 * Template Part: Enrollment Process + FAQ (Transparency Pass)
 *
 * Goal: reduce a parent's uncertainty about "what happens if I enroll my child?"
 *
 * TRUTH RULES:
 * - Answers use ONLY information already verifiable on this site (programs,
 *   contact channels, working hours, Cognia accreditation, location).
 * - Items flagged 'confirm' => true are questions whose exact answer is internal
 *   policy the academy must supply (fees, documents, placement, class size,
 *   parent-communication, withdrawal). They show a safe, truthful "contact us /
 *   depends on program" answer and carry a source TODO. DO NOT invent prices,
 *   documents, durations, or policies.
 *
 * The FAQ data lives in inc/seo.php::novira_faq_items() so the visible section
 * and the FAQPage JSON-LD never drift apart (single source of truth).
 *
 * @package Novira_Academy
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Minimum truthful enrollment flow (high-level; confirm specifics with the academy).
$process = array(
	array( __( 'التواصل', 'novira-academy' ), __( 'راسلنا على واتساب أو اتصل بنا أو زُر المقر في بني مزار.', 'novira-academy' ) ),
	array( __( 'الاستشارة', 'novira-academy' ), __( 'نتعرّف على هدف الطالب ونرشّح البرنامج المناسب.', 'novira-academy' ) ),
	array( __( 'تحديد المستوى', 'novira-academy' ), __( 'نساعد في تحديد المستوى أو البرنامج المناسب للطالب.', 'novira-academy' ) ),
	array( __( 'التسجيل', 'novira-academy' ), __( 'استكمال بيانات التسجيل في البرنامج المختار.', 'novira-academy' ) ),
	array( __( 'الدراسة والمتابعة', 'novira-academy' ), __( 'بدء الدراسة مع متابعة أكاديمية مستمرة.', 'novira-academy' ) ),
);

// FAQ data source: injected items take precedence (e.g. American Diploma, EST,
// SAT, ACT), otherwise fall back to the shared contact/site FAQ. One partial,
// many data sources. Backward compatible: existing callers pass no args and
// keep the contact/homepage behavior unchanged.
$faqs = ( isset( $args['faqs'] ) && is_array( $args['faqs'] ) )
	? $args['faqs']
	: ( function_exists( 'novira_faq_items' ) ? novira_faq_items() : array() );
?>
<section class="faq-section reveal" aria-label="<?php esc_attr_e( 'خطوات التسجيل والأسئلة الشائعة', 'novira-academy' ); ?>">
	<div class="section-header" style="text-align:center;">
		<div class="section-tag"><?php esc_html_e( 'خطوات التسجيل والأسئلة الشائعة', 'novira-academy' ); ?></div>
		<h2 class="section-title"><?php esc_html_e( 'ماذا يحدث إذا قررت', 'novira-academy' ); ?> <span class="hl"><?php esc_html_e( 'التسجيل', 'novira-academy' ); ?></span>؟</h2>
		<p class="section-desc" style="margin:0 auto;"><?php esc_html_e( 'خطوات واضحة وإجابات مباشرة لتقليل أي غموض قبل اتخاذ القرار.', 'novira-academy' ); ?></p>
	</div>

	<ol class="faq-process" style="list-style:none; margin:40px 0 0; padding:0; display:grid; grid-template-columns:repeat(auto-fit, minmax(180px, 1fr)); gap:16px;">
		<?php foreach ( $process as $i => $step ) : ?>
			<li class="value-card" style="display:flex; flex-direction:column; gap:6px;">
				<span aria-hidden="true" style="display:inline-flex; align-items:center; justify-content:center; width:34px; height:34px; border-radius:9999px; background:rgba(91,20,230,0.1); color:#5B14E6; font-weight:800;"><?php echo esc_html( $i + 1 ); ?></span>
				<h4 style="margin:6px 0 0;"><?php echo esc_html( $step[0] ); ?></h4>
				<p style="margin:0;"><?php echo esc_html( $step[1] ); ?></p>
			</li>
		<?php endforeach; ?>
	</ol>

	<div class="faq-list" style="margin:40px auto 0; max-width:820px; display:grid; gap:16px;">
		<?php foreach ( $faqs as $item ) : ?>
			<?php
			// Normalize both shapes: site/contact FAQ { q, a, confirm } and exam FAQ
			// { question, answer, status }. One partial, many providers.
			$faq_q       = isset( $item['q'] ) ? $item['q'] : ( isset( $item['question'] ) ? $item['question'] : '' );
			$faq_a       = isset( $item['a'] ) ? $item['a'] : ( isset( $item['answer'] ) ? $item['answer'] : '' );
			$faq_confirm = ! empty( $item['confirm'] ) || ( isset( $item['status'] ) && 'confirmed' !== $item['status'] );
			if ( '' === trim( (string) $faq_q ) ) { continue; }
			if ( '' === trim( (string) $faq_a ) ) {
				// Dev-mode null-safe: keep the question, mark the answer pending (never hide).
				$faq_a       = __( 'سيتم تحديث الإجابة من المصدر الرسمي.', 'novira-academy' );
				$faq_confirm = true;
			}
			if ( $faq_confirm ) { echo "<!-- TODO (الأكاديمية): استبدل بالسياسة/الحقيقة الدقيقة لهذا البند -->\n"; }
			?>
			<div class="value-card">
				<h4 style="margin:0 0 8px;"><?php echo esc_html( $faq_q ); ?></h4>
				<p style="margin:0;"><?php echo esc_html( $faq_a ); ?></p>
			</div>
		<?php endforeach; ?>
	</div>
</section>
