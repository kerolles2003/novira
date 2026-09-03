<?php
/**
 * Media Categories Taxonomy
 *
 * Registers media_category taxonomy for organizing media attachments.
 * Uses WordPress attachment post type with custom taxonomy.
 *
 * @package Novira_Academy
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Register media category taxonomy
 */
function novira_register_media_category_taxonomy() {
	$labels = array(
		'name'              => _x( 'تصنيفات الوسائط', 'taxonomy general name', 'novira-academy' ),
		'singular_name'     => _x( 'تصنيف وسائط', 'taxonomy singular name', 'novira-academy' ),
		'search_items'      => __( 'بحث في التصنيفات', 'novira-academy' ),
		'all_items'         => __( 'جميع التصنيفات', 'novira-academy' ),
		'parent_item'       => __( 'تصنيف أب', 'novira-academy' ),
		'parent_item_colon' => __( 'تصنيف أب:', 'novira-academy' ),
		'edit_item'         => __( 'تعديل التصنيف', 'novira-academy' ),
		'update_item'       => __( 'تحديث التصنيف', 'novira-academy' ),
		'add_new_item'      => __( 'إضافة تصنيف جديد', 'novira-academy' ),
		'new_item_name'     => __( 'اسم التصنيف الجديد', 'novira-academy' ),
		'menu_name'         => __( 'تصنيفات الوسائط', 'novira-academy' ),
	);

	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'show_in_rest'      => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'media-category' ),
	);

	register_taxonomy( 'media_category', 'attachment', $args );
}
add_action( 'init', 'novira_register_media_category_taxonomy' );

/**
 * Add media category column to media library
 */
function novira_add_media_category_column( $columns ) {
	$columns['media_category'] = __( 'التصنيف', 'novira-academy' );
	return $columns;
}
add_filter( 'manage_media_columns', 'novira_add_media_category_column' );

/**
 * Display media category column content
 */
function novira_display_media_category_column( $column_name, $post_id ) {
	if ( 'media_category' !== $column_name ) {
		return;
	}

	$categories = get_the_terms( $post_id, 'media_category' );
	if ( ! empty( $categories ) && ! is_wp_error( $categories ) ) {
		$cat_names = array();
		foreach ( $categories as $category ) {
			$cat_names[] = sprintf(
				'<a href="%s">%s</a>',
				esc_url( admin_url( 'upload.php?media_category=' . $category->slug ) ),
				esc_html( $category->name )
			);
		}
		echo implode( ', ', $cat_names );
	} else {
		echo '<span class="na">—</span>';
	}
}
add_action( 'manage_media_custom_column', 'novira_display_media_category_column', 10, 2 );

/**
 * Make media category column sortable
 */
function novira_sortable_media_category_column( $columns ) {
	$columns['media_category'] = 'media_category';
	return $columns;
}
add_filter( 'manage_upload_sortable_columns', 'novira_sortable_media_category_column' );

/**
 * Query by media category in admin
 */
function novira_filter_media_by_category( $query ) {
	global $pagenow;

	if ( 'upload.php' !== $pagenow || ! isset( $_GET['media_category'] ) ) {
		return;
	}

	$term = sanitize_text_field( $_GET['media_category'] );
	if ( ! empty( $term ) ) {
		$query->query_vars['tax_query'] = array(
			array(
				'taxonomy' => 'media_category',
				'field'    => 'slug',
				'terms'    => $term,
			),
		);
	}
}
add_filter( 'parse_query', 'novira_filter_media_by_category' );

/**
 * Add default media categories
 */
function novira_add_default_media_categories() {
	$default_categories = array(
		'education'    => __( 'التعليم', 'novira-academy' ),
		'translation'  => __( 'الترجمة', 'novira-academy' ),
		'diploma'      => __( 'الدبلوم الأمريكي', 'novira-academy' ),
		'events'       => __( 'الأحداث', 'novira-academy' ),
		'blog'         => __( 'المدونة', 'novira-academy' ),
		'gallery'      => __( 'المعرض', 'novira-academy' ),
		'team'         => __( 'الفريق', 'novira-academy' ),
		'testimonials' => __( 'الشهادات', 'novira-academy' ),
	);

	foreach ( $default_categories as $slug => $name ) {
		if ( ! term_exists( $slug, 'media_category' ) ) {
			wp_insert_term( $name, 'media_category', array( 'slug' => $slug ) );
		}
	}
}
add_action( 'init', 'novira_add_default_media_categories', 20 );
