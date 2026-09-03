<?php
/**
 * Translation Request Form Handler
 *
 * Handles translation request form submissions with WordPress action hooks
 * for future plugin extensibility.
 *
 * @package Novira_Academy
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Handle translation request form submission
 */
function novira_handle_translation_request() {
	// Verify nonce
	if ( ! isset( $_POST['translation_request_nonce'] ) ||
		 ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['translation_request_nonce'] ) ), 'novira_translation_request' ) ) {
		wp_send_json_error( array(
			'message' => __( 'خطأ في الأمان. يرجى المحاولة مرة أخرى.', 'novira-academy' ),
		) );
	}

	// Reject obvious spam / abusive submission rates.
	if ( function_exists( 'novira_form_is_abusive' ) && novira_form_is_abusive( 'translation' ) ) {
		wp_send_json_error( array(
			'message' => __( 'تم استلام عدد كبير من الطلبات. يرجى المحاولة لاحقاً.', 'novira-academy' ),
		) );
	}

	// Allow plugins to validate before processing
	$validation_result = apply_filters( 'novira_validate_translation_request', true, $_POST );
	if ( true !== $validation_result ) {
		wp_send_json_error( array(
			'message' => is_string( $validation_result ) ? $validation_result : __( 'خطأ في التحقق من البيانات.', 'novira-academy' ),
		) );
	}

	// Sanitize input
	$submission_data = apply_filters( 'novira_sanitize_translation_request', array(
		'company'       => sanitize_text_field( wp_unslash( $_POST['company_name'] ?? '' ) ),
		'contact'       => sanitize_text_field( wp_unslash( $_POST['contact_person'] ?? '' ) ),
		'email'         => sanitize_email( wp_unslash( $_POST['email'] ?? '' ) ),
		'phone'         => sanitize_text_field( wp_unslash( $_POST['phone'] ?? '' ) ),
		'service'       => sanitize_text_field( wp_unslash( $_POST['service_type'] ?? '' ) ),
		'source_lang'   => sanitize_text_field( wp_unslash( $_POST['source_language'] ?? '' ) ),
		'target_lang'   => sanitize_text_field( wp_unslash( $_POST['target_language'] ?? '' ) ),
		'page_count'    => absint( $_POST['page_count'] ?? 1 ),
		'details'       => sanitize_textarea_field( wp_unslash( $_POST['details'] ?? '' ) ),
		'deadline'      => sanitize_text_field( wp_unslash( $_POST['deadline'] ?? '' ) ),
	) );

	// Validate required fields
	$errors = novira_validate_translation_fields( $submission_data );

	if ( ! empty( $errors ) ) {
		wp_send_json_error( array(
			'message' => implode( '<br>', $errors ),
		) );
	}

	// Allow plugins to modify submission data before processing
	$submission_data = apply_filters( 'novira_before_process_translation_request', $submission_data );

	// Process the request
	$request_id = novira_process_translation_request( $submission_data );

	if ( is_wp_error( $request_id ) ) {
		wp_send_json_error( array(
			'message' => $request_id->get_error_message(),
		) );
	}

	// Allow plugins to run actions after successful submission
	do_action( 'novira_after_translation_request', $request_id, $submission_data );

	// Send notifications
	novira_send_translation_notifications( $request_id, $submission_data );

	wp_send_json_success( array(
		'message' => __( 'تم إرسال طلبك بنجاح. سنتواصل معك قريباً.', 'novira-academy' ),
		'request_id' => $request_id,
	) );
}
add_action( 'wp_ajax_novira_translation_request', 'novira_handle_translation_request' );
add_action( 'wp_ajax_nopriv_novira_translation_request', 'novira_handle_translation_request' );

/**
 * Validate translation request fields
 */
function novira_validate_translation_fields( $data ) {
	$errors = array();

	if ( empty( $data['company'] ) ) {
		$errors[] = __( 'اسم الشركة مطلوب', 'novira-academy' );
	}

	if ( empty( $data['contact'] ) ) {
		$errors[] = __( 'اسم المسؤول مطلوب', 'novira-academy' );
	}

	if ( empty( $data['email'] ) || ! is_email( $data['email'] ) ) {
		$errors[] = __( 'البريد الإلكتروني غير صحيح', 'novira-academy' );
	}

	if ( empty( $data['phone'] ) ) {
		$errors[] = __( 'رقم الهاتف مطلوب', 'novira-academy' );
	}

	if ( empty( $data['service'] ) ) {
		$errors[] = __( 'نوع الخدمة مطلوب', 'novira-academy' );
	}

	if ( empty( $data['source_lang'] ) ) {
		$errors[] = __( 'اللغة المصدر مطلوبة', 'novira-academy' );
	}

	if ( empty( $data['target_lang'] ) ) {
		$errors[] = __( 'اللغة الهدف مطلوبة', 'novira-academy' );
	}

	return $errors;
}

/**
 * Process translation request
 */
function novira_process_translation_request( $data ) {
	// Add metadata
	$data['submitted_at'] = current_time( 'mysql' );
	$data['ip_address']   = novira_get_client_ip();
	$data['user_agent']   = sanitize_text_field( $_SERVER['HTTP_USER_AGENT'] ?? '' );

	// Allow plugins to modify data before storage
	$data = apply_filters( 'novira_before_store_translation_request', $data );

	// Store in database
	$request_id = wp_insert_post( array(
		'post_type'   => 'novira_translation',
		'post_title'  => sprintf( '%s - %s', $data['company'], $data['service'] ),
		'post_status' => 'private',
		'meta_input'  => $data,
	) );

	if ( is_wp_error( $request_id ) ) {
		return new WP_Error( 'storage_error', __( 'حدث خطأ أثناء حفظ الطلب.', 'novira-academy' ) );
	}

	// Allow plugins to run actions after storage
	do_action( 'novira_after_store_translation_request', $request_id, $data );

	return $request_id;
}

/**
 * Send translation request notifications
 */
function novira_send_translation_notifications( $request_id, $data ) {
	// Allow plugins to customize notifications
	$send_email = apply_filters( 'novira_send_translation_notifications', true, $request_id, $data );

	if ( ! $send_email ) {
		return;
	}

	// Send admin notification
	$admin_email = get_option( 'admin_email' );
	$admin_subject = sprintf(
		/* translators: %s: company name */
		__( 'طلب ترجمة جديد من %s', 'novira-academy' ),
		$data['company']
	);

	$admin_message = novira_get_translation_notification_template( 'admin', $data );
	wp_mail( $admin_email, $admin_subject, $admin_message );

	// Send customer confirmation
	$customer_subject = __( 'تأكيد استلام طلب الترجمة - أكاديمية نوفيرا', 'novira-academy' );
	$customer_message = novira_get_translation_notification_template( 'customer', $data );
	wp_mail( $data['email'], $customer_subject, $customer_message );
}

/**
 * Get notification template
 */
function novira_get_translation_notification_template( $type, $data ) {
	$template = apply_filters( 'novira_translation_notification_template', null, $type, $data );

	if ( $template ) {
		return $template;
	}

	if ( 'admin' === $type ) {
		$message  = __( 'طلب ترجمة جديد', 'novira-academy' ) . "\n\n";
		/* translators: %s: company name */
		$message .= sprintf( __( 'الشركة: %s', 'novira-academy' ), $data['company'] ) . "\n";
		/* translators: %s: contact person name */
		$message .= sprintf( __( 'المسؤول: %s', 'novira-academy' ), $data['contact'] ) . "\n";
		/* translators: %s: email address */
		$message .= sprintf( __( 'البريد: %s', 'novira-academy' ), $data['email'] ) . "\n";
		/* translators: %s: phone number */
		$message .= sprintf( __( 'الهاتف: %s', 'novira-academy' ), $data['phone'] ) . "\n";
		/* translators: %s: service type */
		$message .= sprintf( __( 'الخدمة: %s', 'novira-academy' ), $data['service'] ) . "\n";
		/* translators: 1: source language, 2: target language */
		$message .= sprintf( __( 'اللغات: %1$s → %2$s', 'novira-academy' ), $data['source_lang'], $data['target_lang'] ) . "\n";
		/* translators: %s: page count */
		$message .= sprintf( __( 'الصفحات: %s', 'novira-academy' ), $data['page_count'] ) . "\n";
		/* translators: %s: request details */
		$message .= sprintf( __( 'التفاصيل: %s', 'novira-academy' ), $data['details'] ) . "\n";
		/* translators: %s: requested deadline */
		$message .= sprintf( __( 'الموعد: %s', 'novira-academy' ), $data['deadline'] ) . "\n";
		/* translators: %s: submission time */
		$message .= sprintf( __( 'الوقت: %s', 'novira-academy' ), $data['submitted_at'] ) . "\n";
	} else {
		/* translators: %s: contact person name */
		$message  = sprintf( __( 'مرحباً %s,', 'novira-academy' ), $data['contact'] ) . "\n\n";
		$message .= __( 'تم استلام طلب الترجمة الخاص بك بنجاح.', 'novira-academy' ) . "\n\n";
		$message .= __( 'التفاصيل:', 'novira-academy' ) . "\n";
		/* translators: %s: company name */
		$message .= sprintf( __( '- الشركة: %s', 'novira-academy' ), $data['company'] ) . "\n";
		/* translators: %s: service type */
		$message .= sprintf( __( '- الخدمة: %s', 'novira-academy' ), $data['service'] ) . "\n";
		/* translators: 1: source language, 2: target language */
		$message .= sprintf( __( '- اللغات: %1$s → %2$s', 'novira-academy' ), $data['source_lang'], $data['target_lang'] ) . "\n\n";
		$message .= __( 'سنتواصل معك خلال ساعة في أيام العمل.', 'novira-academy' ) . "\n\n";
		$message .= __( 'مع تحياتنا،', 'novira-academy' ) . "\n" . __( 'فريق أكاديمية نوفيرا', 'novira-academy' ) . "\n";
		$message .= get_theme_mod( 'novira_phone', '01090600927' ) . "\n";
		$message .= get_theme_mod( 'novira_email', 'noviraacademy@gmail.com' ) . "\n";
	}

	return $message;
}

/**
 * Register custom post type for translation requests
 */
function novira_register_translation_request_cpt() {
	$labels = array(
		'name'                  => _x( 'طلبات الترجمة', 'Post type general name', 'novira-academy' ),
		'singular_name'         => _x( 'طلب ترجمة', 'Post type singular name', 'novira-academy' ),
		'menu_name'             => _x( 'طلبات الترجمة', 'Admin Menu text', 'novira-academy' ),
		'add_new'               => __( 'إضافة طلب', 'novira-academy' ),
		'add_new_item'          => __( 'إضافة طلب ترجمة جديد', 'novira-academy' ),
		'edit_item'             => __( 'تعديل طلب الترجمة', 'novira-academy' ),
		'new_item'              => __( 'طلب ترجمة جديد', 'novira-academy' ),
		'view_item'             => __( 'عرض طلب الترجمة', 'novira-academy' ),
		'search_items'          => __( 'بحث في طلبات الترجمة', 'novira-academy' ),
		'not_found'             => __( 'لم يتم العثور على طلبات ترجمة', 'novira-academy' ),
		'not_found_in_trash'    => __( 'لم يتم العثور على طلبات ترجمة في سلة المهملات', 'novira-academy' ),
		'all_items'             => __( 'جميع طلبات الترجمة', 'novira-academy' ),
	);

	$args = array(
		'labels'             => $labels,
		'public'             => false,
		'publicly_queryable' => false,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => false,
		'rewrite'            => array( 'slug' => 'novira-translation' ),
		'capability_type'    => 'post',
		'has_archive'        => false,
		'hierarchical'       => false,
		'menu_position'      => 27,
		'menu_icon'          => 'dashicons-translation',
		'supports'           => array( 'title' ),
	);

	register_post_type( 'novira_translation', $args );
}
add_action( 'init', 'novira_register_translation_request_cpt' );

/**
 * Include supporting files
 */
require NOVIRA_DIR . '/inc/translation-request-sanitization.php';
require NOVIRA_DIR . '/inc/translation-request-logging.php';
require NOVIRA_DIR . '/inc/hooks.php';
