<?php
/**
 * Template: Generic American Diploma Exam Spoke
 *
 * ONE template for EST / Digital SAT / ACT / future AP. Thin orchestrator —
 * reads novira_current_exam_meta() once and composes the section stack. No
 * arrays, no copy, no hardcoded exam logic, no schema. Everything is slug-driven.
 *
 * Routed here for any offered spoke by the template_include filter in
 * functions.php (novira_force_diploma_exam_template). There is intentionally no
 * page-est.php / page-sat.php / page-act.php.
 *
 * @package Novira_Academy
 */

get_header();

$novira_exam = function_exists( 'novira_current_exam_meta' ) ? novira_current_exam_meta() : null;

if ( $novira_exam && ! empty( $novira_exam['offered'] ) ) :
	$novira_exam_args = array( 'meta' => $novira_exam );

	get_template_part( 'template-parts/sections/exam/s1-hero', null, $novira_exam_args );
	get_template_part( 'template-parts/sections/exam/s2-what-is', null, $novira_exam_args );
	get_template_part( 'template-parts/sections/exam/s3-structure', null, $novira_exam_args );
	get_template_part( 'template-parts/sections/exam/s4-preparation', null, $novira_exam_args );
	get_template_part( 'template-parts/sections/exam/s5-registration', null, $novira_exam_args );
	get_template_part( 'template-parts/sections/exam/s6-progress', null, $novira_exam_args );

	// S7 — reuse the single FAQ partial, injecting the current exam's FAQ.
	get_template_part(
		'template-parts/sections/faq',
		null,
		array( 'faqs' => function_exists( 'novira_current_exam_faq' ) ? novira_current_exam_faq() : array() )
	);

	get_template_part( 'template-parts/sections/exam/s8-consultation', null, $novira_exam_args );
	get_template_part( 'template-parts/sections/exam/s9-related-exams', null, $novira_exam_args );

endif;

get_footer();
