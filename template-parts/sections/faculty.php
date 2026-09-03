<?php
/**
 * Template Part: Faculty ("Who teaches my child?")
 *
 * Real, named teachers with real specializations — placed on the About page,
 * directly after the Founder.
 *
 * IMPORTANT — TRUTH RULE:
 * This section is intentionally DATA-DRIVEN and SELF-HIDING. It renders
 * nothing while the $faculty array below is empty, so the page never shows
 * invented teachers. Add ONLY verified people. Do not invent names,
 * qualifications, or years of experience.
 *
 * Minimum truthful entry = 'name' + 'specialization'. Every other field is
 * optional and simply does not display when left empty — so you can publish a
 * teacher with just a name and what they teach, and fill in the rest later.
 *
 * To populate: copy the example below into the $faculty array, replace with
 * verified data, and remove the example comment.
 *
 *   array(
 *       'name'           => 'مستر يوسف زكي',
 *       'role'           => 'مدرّس الدبلومة الأمريكية واللغة الإنجليزية',
 *       'specialization' => 'SAT / EST / اللغة الإنجليزية',
 *       'program'        => 'الدبلومة الأمريكية',                 // optional
 *       'qualification'  => 'بكالوريوس اللغات والترجمة الفورية',  // optional
 *       'experience'     => '',                                   // optional, e.g. 'خبرة 10 سنوات'
 *   ),
 *
 * @package Novira_Academy
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Verified faculty only. Section stays hidden while this is empty.
$faculty = array(
	// Add verified teachers here.
);

// Allow faculty to be supplied/extended without editing this file.
$faculty = apply_filters( 'novira_faculty', $faculty );

// Self-hide until at least one verified teacher is added.
if ( empty( $faculty ) ) {
	return;
}
?>
<section class="faculty-section reveal">
	<div class="section-header" style="text-align:center;">
		<div class="section-tag"><?php esc_html_e( 'هيئة التدريس', 'novira-academy' ); ?></div>
		<h2 class="section-title"><?php echo wp_kses( __( 'من <span class="hl">يُدرّس</span> أبناءكم', 'novira-academy' ), array( 'span' => array( 'class' => array() ) ) ); ?></h2>
		<p class="section-desc" style="margin:0 auto;"><?php esc_html_e( 'نعرّفكم بالمعلمين المسؤولين عن كل برنامج، بأسمائهم وتخصصاتهم.', 'novira-academy' ); ?></p>
	</div>
	<div class="faculty-grid" style="display:grid; grid-template-columns:repeat(auto-fit, minmax(240px, 1fr)); gap:var(--space-md); margin-top:var(--space-lg);">
		<?php foreach ( $faculty as $member ) : ?>
			<?php if ( empty( $member['name'] ) ) { continue; } ?>
			<div class="value-card">
				<h4><?php echo esc_html( $member['name'] ); ?></h4>
				<?php if ( ! empty( $member['role'] ) ) : ?>
					<p class="section-desc" style="margin-top:8px;"><?php echo esc_html( $member['role'] ); ?></p>
				<?php endif; ?>
				<?php if ( ! empty( $member['specialization'] ) ) : ?>
					<p style="margin-top:8px;"><strong><?php esc_html_e( 'التخصص:', 'novira-academy' ); ?></strong> <?php echo esc_html( $member['specialization'] ); ?></p>
				<?php endif; ?>
				<?php if ( ! empty( $member['program'] ) ) : ?>
					<p><strong><?php esc_html_e( 'البرنامج:', 'novira-academy' ); ?></strong> <?php echo esc_html( $member['program'] ); ?></p>
				<?php endif; ?>
				<?php if ( ! empty( $member['qualification'] ) ) : ?>
					<p><?php echo esc_html( $member['qualification'] ); ?></p>
				<?php endif; ?>
				<?php if ( ! empty( $member['experience'] ) ) : ?>
					<p><?php echo esc_html( $member['experience'] ); ?></p>
				<?php endif; ?>
			</div>
		<?php endforeach; ?>
	</div>
</section>
