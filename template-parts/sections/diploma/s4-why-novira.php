<?php
/**
 * Diploma Hub — S4 Why Novira?
 *
 * OWNS: trust — framed as the companion claim ("we accompany students"). Adds
 * NO new claims; it reuses existing, approved trust assets only:
 *   - Founder block (template-parts/sections/founder.php)
 *   - Accreditation block (template-parts/sections/accreditations.php)
 *
 * Rendering only. The single framing line is factual and subject to review.
 *
 * @package Novira_Academy
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<section class="section diploma-why-novira" aria-label="<?php esc_attr_e( 'لماذا نوفيرا؟', 'novira-academy' ); ?>">
	<div class="container">
		<div class="section-header">
			<span class="section-tag"><?php esc_html_e( 'لماذا نوفيرا', 'novira-academy' ); ?></span>
			<h2 class="section-title"><?php esc_html_e( 'نرافق الطالب خلال رحلته', 'novira-academy' ); ?></h2>
			<p class="section-desc"><?php esc_html_e( 'دورنا أن نكون رفيقاً أكاديمياً للطالب وأسرته خلال مراحل الدبلومة الأمريكية.', 'novira-academy' ); ?></p>
		</div>
	</div>

	<?php
	// Reuse existing, approved trust assets — never re-author these.
	get_template_part( 'template-parts/sections/founder' );
	get_template_part( 'template-parts/sections/accreditations' );
	?>
</section>
