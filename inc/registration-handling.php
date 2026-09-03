<?php
/**
 * Registration Form Submission Handler
 *
 * Server-side processing for registration interest form submissions.
 * Logs submissions and sends email notifications.
 *
 * @package Novira_Academy
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Handle registration interest form submission via AJAX
 */
function novira_handle_registration_interest() {
	// Verify nonce
	if ( ! isset( $_POST['registration_nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['registration_nonce'] ) ), 'novira_registration_interest' ) ) {
		wp_send_json_error( array(
			'message' => __( 'خطأ في الأمان. يرجى المحاولة مرة أخرى.', 'novira-academy' ),
		) );
	}

	// Reject obvious spam / abusive submission rates.
	if ( novira_form_is_abusive( 'registration' ) ) {
		wp_send_json_error( array(
			'message' => __( 'تم استلام عدد كبير من الطلبات. يرجى المحاولة لاحقاً.', 'novira-academy' ),
		) );
	}

	// Sanitize input
	$parent_name    = sanitize_text_field( wp_unslash( $_POST['parent_name'] ?? '' ) );
	$student_name   = sanitize_text_field( wp_unslash( $_POST['student_name'] ?? '' ) );
	$email          = sanitize_email( wp_unslash( $_POST['email'] ?? '' ) );
	$phone          = sanitize_text_field( wp_unslash( $_POST['phone'] ?? '' ) );
	$student_age    = absint( $_POST['student_age'] ?? 0 );
	$current_grade  = sanitize_text_field( wp_unslash( $_POST['current_grade'] ?? '' ) );
	$program        = sanitize_text_field( wp_unslash( $_POST['program_interest'] ?? '' ) );
	$notes          = sanitize_textarea_field( wp_unslash( $_POST['additional_notes'] ?? '' ) );

	// Validate required fields
	$errors = array();

	if ( empty( $parent_name ) ) {
		$errors[] = __( 'اسم ولي الأمر مطلوب', 'novira-academy' );
	}

	if ( empty( $student_name ) ) {
		$errors[] = __( 'اسم الطالب مطلوب', 'novira-academy' );
	}

	if ( empty( $email ) || ! is_email( $email ) ) {
		$errors[] = __( 'البريد الإلكتروني غير صحيح', 'novira-academy' );
	}

	if ( empty( $phone ) ) {
		$errors[] = __( 'رقم الهاتف مطلوب', 'novira-academy' );
	}

	if ( empty( $student_age ) || $student_age < 5 || $student_age > 18 ) {
		$errors[] = __( 'يرجى إدخال عمر صحيح للطالب', 'novira-academy' );
	}

	if ( empty( $program ) ) {
		$errors[] = __( 'يرجى اختيار البرنامج المطلوب', 'novira-academy' );
	}

	if ( ! empty( $errors ) ) {
		wp_send_json_error( array(
			'message' => implode( '<br>', $errors ),
		) );
	}

	// Prepare submission data
	$submission = array(
		'parent_name'   => $parent_name,
		'student_name'  => $student_name,
		'email'         => $email,
		'phone'         => $phone,
		'student_age'   => $student_age,
		'current_grade' => $current_grade,
		'program'       => $program,
		'notes'         => $notes,
		'submitted_at'  => current_time( 'mysql' ),
		'ip_address'    => novira_get_client_ip(),
	);

	// Submission is persisted below as a private CPT (single source of truth).
	// No plaintext file logging of PII under a publicly reachable path.

	// Send email notification to admin
	$admin_email = get_option( 'admin_email' );
	$subject     = __( 'طلب تسجيل جديد - الدبلوم الأمريكي', 'novira-academy' );
	$message     = __( 'طلب تسجيل جديد في الدبلوم الأمريكي', 'novira-academy' ) . "\n\n";
	/* translators: %s: parent name. */
	$message    .= sprintf( __( 'ولي الأمر: %s', 'novira-academy' ), $parent_name ) . "\n";
	/* translators: %s: student name. */
	$message    .= sprintf( __( 'الطالب: %s', 'novira-academy' ), $student_name ) . "\n";
	/* translators: %s: student age. */
	$message    .= sprintf( __( 'العمر: %s', 'novira-academy' ), $student_age ) . "\n";
	/* translators: %s: current grade. */
	$message    .= sprintf( __( 'المستوى الحالي: %s', 'novira-academy' ), $current_grade ) . "\n";
	/* translators: %s: program name. */
	$message    .= sprintf( __( 'البرنامج: %s', 'novira-academy' ), $program ) . "\n";
	/* translators: %s: email address. */
	$message    .= sprintf( __( 'البريد: %s', 'novira-academy' ), $email ) . "\n";
	/* translators: %s: phone number. */
	$message    .= sprintf( __( 'الهاتف: %s', 'novira-academy' ), $phone ) . "\n";
	/* translators: %s: additional notes. */
	$message    .= sprintf( __( 'ملاحظات: %s', 'novira-academy' ), $notes ) . "\n";
	/* translators: %s: submission date/time. */
	$message    .= sprintf( __( 'الوقت: %s', 'novira-academy' ), current_time( 'mysql' ) ) . "\n";

	wp_mail( $admin_email, $subject, $message );

	// Send confirmation email to parent
	$customer_subject = __( 'تأكيد استلام طلب التسجيل - أكاديمية نوفيرا', 'novira-academy' );
	/* translators: %s: parent name. */
	$customer_message = sprintf( __( 'مرحباً %s,', 'novira-academy' ), $parent_name ) . "\n\n";
	/* translators: %s: student name. */
	$customer_message .= sprintf( __( 'تم استلام طلب التسجيل لابنك/ابنتك %s في الدبلوم الأمريكي بنجاح.', 'novira-academy' ), $student_name ) . "\n\n";
	/* translators: %s: program name. */
	$customer_message .= sprintf( __( 'البرنامج المطلوب: %s', 'novira-academy' ), $program ) . "\n\n";
	$customer_message .= __( 'سنتواصل معك خلال 24 ساعة لتحديد موعد مقابلة.', 'novira-academy' ) . "\n\n";
	$customer_message .= __( "مع تحياتنا،\nفريق أكاديمية نوفيرا", 'novira-academy' ) . "\n";
	$customer_message .= get_theme_mod( 'novira_phone', '01090600927' ) . "\n";
	$customer_message .= get_theme_mod( 'novira_email', 'noviraacademy@gmail.com' ) . "\n";

	wp_mail( $email, $customer_subject, $customer_message );

	// Store in database for admin viewing
	$registration_id = wp_insert_post( array(
		'post_type'   => 'novira_registration',
		'post_title'  => sprintf( '%s - %s', $student_name, $parent_name ),
		'post_status' => 'private',
		'meta_input'  => $submission,
	) );

	wp_send_json_success( array(
		'message' => __( 'تم استلام طلبك بنجاح. سنتواصل معك قريباً.', 'novira-academy' ),
		'registration_id' => $registration_id,
	) );
}
add_action( 'wp_ajax_novira_registration_interest', 'novira_handle_registration_interest' );
add_action( 'wp_ajax_nopriv_novira_registration_interest', 'novira_handle_registration_interest' );

/**
 * Register custom post type for registration submissions
 */
function novira_register_registration_cpt() {
	$labels = array(
		'name'                  => _x( 'طلبات التسجيل', 'Post type general name', 'novira-academy' ),
		'singular_name'         => _x( 'طلب تسجيل', 'Post type singular name', 'novira-academy' ),
		'menu_name'             => _x( 'طلبات التسجيل', 'Admin Menu text', 'novira-academy' ),
		'add_new'               => __( 'إضافة جديد', 'novira-academy' ),
		'add_new_item'          => __( 'إضافة طلب تسجيل جديد', 'novira-academy' ),
		'edit_item'             => __( 'تعديل طلب التسجيل', 'novira-academy' ),
		'new_item'              => __( 'طلب تسجيل جديد', 'novira-academy' ),
		'view_item'             => __( 'عرض طلب التسجيل', 'novira-academy' ),
		'search_items'          => __( 'بحث في طلبات التسجيل', 'novira-academy' ),
		'not_found'             => __( 'لم يتم العثور على طلبات تسجيل', 'novira-academy' ),
		'not_found_in_trash'    => __( 'لم يتم العثور على طلبات تسجيل في سلة المهملات', 'novira-academy' ),
		'all_items'             => __( 'جميع طلبات التسجيل', 'novira-academy' ),
	);

	$args = array(
		'labels'             => $labels,
		'public'             => false,
		'publicly_queryable' => false,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => false,
		'rewrite'            => array( 'slug' => 'novira-registration' ),
		'capability_type'    => 'post',
		'has_archive'        => false,
		'hierarchical'       => false,
		'menu_position'      => 26,
		'menu_icon'          => 'dashicons-welcome-learn-more',
		'supports'           => array( 'title' ),
	);

	register_post_type( 'novira_registration', $args );
}
add_action( 'init', 'novira_register_registration_cpt' );

/**
 * Add AJAX handler for registration form validation
 */
function novira_enqueue_registration_validation() {
	if ( is_page_template( 'page-department.php' ) ) {
		wp_enqueue_script(
			'novira-registration-validation',
			NOVIRA_URI . '/assets/js/registration-validation.js',
			array(),
			NOVIRA_VERSION,
			true
		);

		wp_localize_script( 'novira-registration-validation', 'noviraData', array(
			'ajaxUrl' => admin_url( 'admin-ajax.php' ),
			'nonce'   => wp_create_nonce( 'novira_registration_interest' ),
		) );
	}
}
add_action( 'wp_enqueue_scripts', 'novira_enqueue_registration_validation' );

/**
 * Handle Stitch homepage registration form submission
 *
 * Processes standard form POST from the homepage registration CTA section.
 * Redirects back to homepage with success/error message.
 */
function novira_handle_stitch_registration() {
	// Verify this is a registration action
	if ( ! isset( $_POST['action'] ) || 'novira_registration' !== $_POST['action'] ) {
		return;
	}

	// Verify nonce
	if ( ! isset( $_POST['novira_registration_nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['novira_registration_nonce'] ) ), 'novira_registration' ) ) {
		wp_safe_redirect( add_query_arg( 'registration', 'nonce_error', home_url( '/' ) ) );
		exit;
	}

	// Reject obvious spam / abusive submission rates.
	if ( novira_form_is_abusive( 'registration_home' ) ) {
		wp_safe_redirect( add_query_arg( 'registration', 'error', home_url( '/' ) ) );
		exit;
	}

	// Sanitize input
	$first_name = sanitize_text_field( wp_unslash( $_POST['first_name'] ?? '' ) );
	$last_name  = sanitize_text_field( wp_unslash( $_POST['last_name'] ?? '' ) );
	$program    = sanitize_text_field( wp_unslash( $_POST['program'] ?? '' ) );
	$phone      = sanitize_text_field( wp_unslash( $_POST['phone'] ?? '' ) );

	// Validate required fields
	$errors = array();

	if ( empty( $first_name ) ) {
		$errors[] = __( 'الاسم الأول مطلوب', 'novira-academy' );
	}

	if ( empty( $last_name ) ) {
		$errors[] = __( 'الاسم الأخير مطلوب', 'novira-academy' );
	}

	if ( empty( $program ) ) {
		$errors[] = __( 'يرجى اختيار البرنامج', 'novira-academy' );
	}

	if ( empty( $phone ) ) {
		$errors[] = __( 'رقم الهاتف مطلوب', 'novira-academy' );
	}

	// If errors, redirect back with a fixed error flag (no user text echoed back).
	if ( ! empty( $errors ) ) {
		wp_safe_redirect( add_query_arg( 'registration', 'error', home_url( '/' ) ) );
		exit;
	}

	// Prepare submission data
	$submission = array(
		'first_name'   => $first_name,
		'last_name'    => $last_name,
		'full_name'    => $first_name . ' ' . $last_name,
		'program'      => $program,
		'phone'        => $phone,
		'submitted_at' => current_time( 'mysql' ),
		'ip_address'   => novira_get_client_ip(),
		'source'       => 'homepage_stitch',
	);

	// Store the lead as a private CPT below; no plaintext PII file logging.

	// Send email notification to admin
	$admin_email = get_option( 'admin_email' );
	$subject     = __( 'طلب تسجيل جديد من الصفحة الرئيسية', 'novira-academy' );
	$message     = __( 'طلب تسجيل جديد من الصفحة الرئيسية', 'novira-academy' ) . "\n\n";
	/* translators: 1: first name, 2: last name. */
	$message    .= sprintf( __( 'الاسم: %1$s %2$s', 'novira-academy' ), $first_name, $last_name ) . "\n";
	/* translators: %s: program name. */
	$message    .= sprintf( __( 'البرنامج: %s', 'novira-academy' ), $program ) . "\n";
	/* translators: %s: phone number. */
	$message    .= sprintf( __( 'الهاتف: %s', 'novira-academy' ), $phone ) . "\n";
	/* translators: %s: submission date/time. */
	$message    .= sprintf( __( 'الوقت: %s', 'novira-academy' ), current_time( 'mysql' ) ) . "\n";

	wp_mail( $admin_email, $subject, $message );

	// Send confirmation email to user
	$customer_subject = __( 'تأكيد استلام طلب التسجيل - أكاديمية نوفيرا', 'novira-academy' );
	/* translators: %s: first name. */
	$customer_message = sprintf( __( 'مرحباً %s,', 'novira-academy' ), $first_name ) . "\n\n";
	$customer_message .= __( 'تم استلام طلب التسجيل بنجاح.', 'novira-academy' ) . "\n\n";
	/* translators: %s: program name. */
	$customer_message .= sprintf( __( 'البرنامج المطلوب: %s', 'novira-academy' ), $program ) . "\n\n";
	$customer_message .= __( 'سنتواصل معك خلال 24 ساعة.', 'novira-academy' ) . "\n\n";
	$customer_message .= __( "مع تحياتنا،\nفريق أكاديمية نوفيرا", 'novira-academy' ) . "\n";

	// Get user email if available (from WP user or skip if not logged in)
	$user = wp_get_current_user();
	if ( $user && $user->user_email ) {
		wp_mail( $user->user_email, $customer_subject, $customer_message );
	}

	// Persist the lead as a private CPT so it survives beyond the email
	// (the file log that previously held this record has been removed).
	wp_insert_post( array(
		'post_type'   => 'novira_registration',
		'post_title'  => sprintf( '%s %s', $first_name, $last_name ),
		'post_status' => 'private',
		'meta_input'  => $submission,
	) );

	// Redirect back to homepage with success message
	wp_safe_redirect( add_query_arg( 'registration', 'success', home_url( '/' ) ) );
	exit;
}
add_action( 'admin_post_novira_registration', 'novira_handle_stitch_registration' );
add_action( 'admin_post_nopriv_novira_registration', 'novira_handle_stitch_registration' );

// novira_get_client_ip() is defined in form-handling.php
