<?php
/**
 * Template Name: Department Page
 *
 * Flexible department page template for all departments.
 * Displays department-specific content based on page slug.
 *
 * @package Novira_Academy
 */

get_header();

// 'american-diploma' is intentionally excluded: it now renders through
// page-american-diploma.php (forced via the template_include filter in
// functions.php), not this generic department template.
$departments = array( 'education', 'translation' );
$slug        = get_post_field( 'post_name', get_the_ID() );

if ( ! in_array( $slug, $departments, true ) ) {
	get_footer();
	return;
}
?>

<main id="primary" class="department-page">
	<?php
	// Hero section
	get_template_part( 'template-parts/sections/department-hero', $slug );

	// Department-specific content
	get_template_part( 'template-parts/sections/department-' . str_replace( '-', '_', $slug ) );

	// Admission details
	get_template_part( 'template-parts/sections/admission-details', $slug );

	// WhatsApp CTA
	get_template_part( 'template-parts/sections/department-whatsapp', $slug );
	?>
</main>

<?php get_footer(); ?>
