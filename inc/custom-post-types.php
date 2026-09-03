<?php
/**
 * Custom Post Types Registration
 *
 * Registers blog_post and event CPTs.
 * Uses WordPress native features, no plugins required.
 *
 * @package Novira_Academy
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Register Blog Post CPT
 */
function novira_register_blog_post_cpt() {
	$labels = array(
		'name'                  => _x( 'المقالات', 'Post type general name', 'novira-academy' ),
		'singular_name'         => _x( 'مقال', 'Post type singular name', 'novira-academy' ),
		'menu_name'             => _x( 'المقالات', 'Admin Menu text', 'novira-academy' ),
		'add_new'               => __( 'إضافة مقال', 'novira-academy' ),
		'add_new_item'          => __( 'إضافة مقال جديد', 'novira-academy' ),
		'edit_item'             => __( 'تعديل المقال', 'novira-academy' ),
		'new_item'              => __( 'مقال جديد', 'novira-academy' ),
		'view_item'             => __( 'عرض المقال', 'novira-academy' ),
		'search_items'          => __( 'بحث في المقالات', 'novira-academy' ),
		'not_found'             => __( 'لم يتم العثور على مقالات', 'novira-academy' ),
		'not_found_in_trash'    => __( 'لم يتم العثور على مقالات في سلة المهملات', 'novira-academy' ),
		'all_items'             => __( 'جميع المقالات', 'novira-academy' ),
	);

	$args = array(
		'labels'             => $labels,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'blog' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => 20,
		'menu_icon'          => 'dashicons-welcome-write-blog',
		'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments', 'custom-fields' ),
		'show_in_rest'       => true,
	);

	register_post_type( 'blog_post', $args );

	// Register taxonomy for blog categories
	register_taxonomy( 'blog_category', array( 'blog_post' ), array(
		'labels' => array(
			'name'              => _x( 'تصنيفات المقالات', 'taxonomy general name', 'novira-academy' ),
			'singular_name'     => _x( 'تصنيف', 'taxonomy singular name', 'novira-academy' ),
			'search_items'      => __( 'بحث في التصنيفات', 'novira-academy' ),
			'all_items'         => __( 'جميع التصنيفات', 'novira-academy' ),
			'parent_item'       => __( 'تصنيف أب', 'novira-academy' ),
			'parent_item_colon' => __( 'تصنيف أب:', 'novira-academy' ),
			'edit_item'         => __( 'تعديل التصنيف', 'novira-academy' ),
			'update_item'       => __( 'تحديث التصنيف', 'novira-academy' ),
			'add_new_item'      => __( 'إضافة تصنيف جديد', 'novira-academy' ),
			'new_item_name'     => __( 'اسم التصنيف الجديد', 'novira-academy' ),
			'menu_name'         => __( 'التصنيفات', 'novira-academy' ),
		),
		'hierarchical'      => true,
		'public'            => true,
		'show_ui'           => true,
		'show_admin_column' => true,
		'show_in_rest'      => true,
		'rewrite'           => array( 'slug' => 'blog-category' ),
	) );
}
add_action( 'init', 'novira_register_blog_post_cpt' );

/**
 * Register Event CPT
 */
function novira_register_event_cpt() {
	$labels = array(
		'name'                  => _x( 'الأحداث', 'Post type general name', 'novira-academy' ),
		'singular_name'         => _x( 'حدث', 'Post type singular name', 'novira-academy' ),
		'menu_name'             => _x( 'الأحداث', 'Admin Menu text', 'novira-academy' ),
		'add_new'               => __( 'إضافة حدث', 'novira-academy' ),
		'add_new_item'          => __( 'إضافة حدث جديد', 'novira-academy' ),
		'edit_item'             => __( 'تعديل الحدث', 'novira-academy' ),
		'new_item'              => __( 'حدث جديد', 'novira-academy' ),
		'view_item'             => __( 'عرض الحدث', 'novira-academy' ),
		'search_items'          => __( 'بحث في الأحداث', 'novira-academy' ),
		'not_found'             => __( 'لم يتم العثور على أحداث', 'novira-academy' ),
		'not_found_in_trash'    => __( 'لم يتم العثور على أحداث في سلة المهملات', 'novira-academy' ),
		'all_items'             => __( 'جميع الأحداث', 'novira-academy' ),
	);

	$args = array(
		'labels'             => $labels,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'events' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => 21,
		'menu_icon'          => 'dashicons-calendar-alt',
		'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'custom-fields' ),
		'show_in_rest'       => true,
	);

	register_post_type( 'event', $args );

	// Register taxonomy for event type
	register_taxonomy( 'event_type', array( 'event' ), array(
		'labels' => array(
			'name'              => _x( 'أنواع الأحداث', 'taxonomy general name', 'novira-academy' ),
			'singular_name'     => _x( 'نوع الحدث', 'taxonomy singular name', 'novira-academy' ),
			'search_items'      => __( 'بحث في الأنواع', 'novira-academy' ),
			'all_items'         => __( 'جميع الأنواع', 'novira-academy' ),
			'parent_item'       => __( 'نوع أب', 'novira-academy' ),
			'parent_item_colon' => __( 'نوع أب:', 'novira-academy' ),
			'edit_item'         => __( 'تعديل النوع', 'novira-academy' ),
			'update_item'       => __( 'تحديث النوع', 'novira-academy' ),
			'add_new_item'      => __( 'إضافة نوع جديد', 'novira-academy' ),
			'new_item_name'     => __( 'اسم النوع الجديد', 'novira-academy' ),
			'menu_name'         => __( 'أنواع الأحداث', 'novira-academy' ),
		),
		'hierarchical'      => true,
		'public'            => true,
		'show_ui'           => true,
		'show_admin_column' => true,
		'show_in_rest'      => true,
		'rewrite'           => array( 'slug' => 'event-type' ),
	) );
}
add_action( 'init', 'novira_register_event_cpt' );

/**
 * Add custom meta boxes for events
 */
function novira_add_event_meta_boxes() {
	add_meta_box(
		'novira_event_details',
		__( 'تفاصيل الحدث', 'novira-academy' ),
		'novira_event_details_callback',
		'event',
		'normal',
		'high'
	);
}
add_action( 'add_meta_boxes', 'novira_add_event_meta_boxes' );

/**
 * Event Details meta box callback
 */
function novira_event_details_callback( $post ) {
	wp_nonce_field( 'novira_event_details_nonce', 'novira_event_details_nonce_field' );

	$date     = get_post_meta( $post->ID, '_event_date', true );
	$time     = get_post_meta( $post->ID, '_event_time', true );
	$location = get_post_meta( $post->ID, '_event_location', true );
	?>
	<div class="novira-repeater-item event-field">
		<label><?php esc_html_e( 'التاريخ:', 'novira-academy' ); ?></label>
		<input type="date" name="event_date" value="<?php echo esc_attr( $date ); ?>">
	</div>
	<div class="event-field">
		<label><?php esc_html_e( 'الوقت:', 'novira-academy' ); ?></label>
		<input type="time" name="event_time" value="<?php echo esc_attr( $time ); ?>">
	</div>
	<div class="event-field">
		<label><?php esc_html_e( 'المكان:', 'novira-academy' ); ?></label>
		<input type="text" name="event_location" value="<?php echo esc_attr( $location ); ?>">
	</div>
	<?php
}

/**
 * Save event meta data
 */
function novira_save_event_meta( $post_id ) {
	// Verify nonce
	if ( ! isset( $_POST['novira_event_details_nonce_field'] ) || 
		 ! wp_verify_nonce( $_POST['novira_event_details_nonce_field'], 'novira_event_details_nonce' ) ) {
		return;
	}

	// Check autosave
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}

	// Check permissions
	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}

	// Save event details
	if ( isset( $_POST['event_date'] ) ) {
		update_post_meta( $post_id, '_event_date', sanitize_text_field( $_POST['event_date'] ) );
	}

	if ( isset( $_POST['event_time'] ) ) {
		update_post_meta( $post_id, '_event_time', sanitize_text_field( $_POST['event_time'] ) );
	}

	if ( isset( $_POST['event_location'] ) ) {
		update_post_meta( $post_id, '_event_location', sanitize_text_field( $_POST['event_location'] ) );
	}
}
add_action( 'save_post', 'novira_save_event_meta' );
