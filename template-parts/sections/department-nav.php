<?php
/**
 * Template Part: Department Navigation Section
 *
 * Homepage section displaying department cards from WordPress pages.
 * Queries pages with 'department' in their page template or slug.
 *
 * Constitution: Homepage Philosophy, Information Architecture
 *
 * @package Novira_Academy
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Department configuration - maps page slugs to display data
$department_config = array(
	'education' => array(
		'icon'     => 'education',
		'features' => array(
			__( 'كورسات لغات', 'novira-academy' ),
			__( 'تطوير مهني', 'novira-academy' ),
			__( 'شهادات معتمدة', 'novira-academy' ),
		),
	),
	'translation' => array(
		'icon'     => 'translation',
		'features' => array(
			__( 'ترجمة وثائق', 'novira-academy' ),
			__( 'ترجمة معتمدة', 'novira-academy' ),
			__( 'دقة عالية', 'novira-academy' ),
		),
	),
	'american-diploma' => array(
		'icon'     => 'diploma',
		'features' => array(
			__( 'دبلوم أمريكي', 'novira-academy' ),
			__( 'مناهج حديثة', 'novira-academy' ),
			__( 'معلمون أكاديميون', 'novira-academy' ),
		),
	),
);

// Query department pages
$department_slugs = array_keys( $department_config );
$departments      = array();

foreach ( $department_slugs as $slug ) {
	$page = get_page_by_path( $slug );
	if ( $page && 'publish' === $page->post_status ) {
		$departments[ $slug ] = $page;
	}
}
?>

<section id="departments" class="department-nav-section section" aria-label="<?php esc_attr_e( 'أقسامنا', 'novira-academy' ); ?>">
	<div class="container">
		<div class="section-header">
			<span class="section-tag"><?php esc_html_e( 'أقسامنا', 'novira-academy' ); ?></span>
			<h2 class="section-title"><?php esc_html_e( 'ثلاثة أقسام متخصصة لخدمة تعليمية شاملة', 'novira-academy' ); ?></h2>
			<p class="section-subtitle"><?php esc_html_e( 'نقدم مجموعة متكاملة من الخدمات التعليمية والمهنية لتلبية احتياجات طلابنا وشركائنا.', 'novira-academy' ); ?></p>
		</div>

		<div class="department-grid">
			<?php foreach ( $departments as $slug => $page ) : ?>
				<?php
				$config = $department_config[ $slug ];
				$args   = array(
					'title'       => get_the_title( $page ),
					'description' => get_the_excerpt( $page ),
					'icon'        => $config['icon'],
					'url'         => get_permalink( $page ),
					'features'    => $config['features'],
				);
				?>
				<?php get_template_part( 'template-parts/content/department-card', null, $args ); ?>
			<?php endforeach; ?>
		</div>
	</div>
</section>
