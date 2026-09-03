<?php
/**
 * Form Submission Handler
 *
 * Server-side processing for quote request form submissions.
 * Logs submissions and sends email notifications.
 *
 * @package Novira_Academy
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Handle quote request form submission via AJAX
 */
function novira_handle_quote_request() {
	// Verify nonce
	if ( ! isset( $_POST['quote_nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['quote_nonce'] ) ), 'novira_quote_request' ) ) {
		wp_send_json_error( array(
			'message' => __( 'خطأ في الأمان. يرجى المحاولة مرة أخرى.', 'novira-academy' ),
		) );
	}

	// Reject obvious spam / abusive submission rates.
	if ( novira_form_is_abusive( 'quote' ) ) {
		wp_send_json_error( array(
			'message' => __( 'تم استلام عدد كبير من الطلبات. يرجى المحاولة لاحقاً.', 'novira-academy' ),
		) );
	}

	// Sanitize input
	$company      = sanitize_text_field( wp_unslash( $_POST['company_name'] ?? '' ) );
	$contact      = sanitize_text_field( wp_unslash( $_POST['contact_person'] ?? '' ) );
	$email        = sanitize_email( wp_unslash( $_POST['email'] ?? '' ) );
	$phone        = sanitize_text_field( wp_unslash( $_POST['phone'] ?? '' ) );
	$service      = sanitize_text_field( wp_unslash( $_POST['service_type'] ?? '' ) );
	$source_lang  = sanitize_text_field( wp_unslash( $_POST['source_language'] ?? '' ) );
	$target_lang  = sanitize_text_field( wp_unslash( $_POST['target_language'] ?? '' ) );
	$page_count   = absint( $_POST['page_count'] ?? 1 );
	$details      = sanitize_textarea_field( wp_unslash( $_POST['details'] ?? '' ) );
	$deadline     = sanitize_text_field( wp_unslash( $_POST['deadline'] ?? '' ) );

	// Validate required fields
	$errors = array();

	if ( empty( $company ) ) {
		$errors[] = __( 'اسم الشركة مطلوب', 'novira-academy' );
	}

	if ( empty( $contact ) ) {
		$errors[] = __( 'اسم المسؤول مطلوب', 'novira-academy' );
	}

	if ( empty( $email ) || ! is_email( $email ) ) {
		$errors[] = __( 'البريد الإلكتروني غير صحيح', 'novira-academy' );
	}

	if ( empty( $phone ) ) {
		$errors[] = __( 'رقم الهاتف مطلوب', 'novira-academy' );
	}

	if ( empty( $service ) ) {
		$errors[] = __( 'نوع الخدمة مطلوب', 'novira-academy' );
	}

	if ( empty( $source_lang ) ) {
		$errors[] = __( 'اللغة المصدر مطلوبة', 'novira-academy' );
	}

	if ( empty( $target_lang ) ) {
		$errors[] = __( 'اللغة الهدف مطلوبة', 'novira-academy' );
	}

	if ( ! empty( $errors ) ) {
		wp_send_json_error( array(
			'message' => implode( '<br>', $errors ),
		) );
	}

	// Prepare submission data
	$submission = array(
		'company'       => $company,
		'contact'       => $contact,
		'email'         => $email,
		'phone'         => $phone,
		'service'       => $service,
		'source_lang'   => $source_lang,
		'target_lang'   => $target_lang,
		'page_count'    => $page_count,
		'details'       => $details,
		'deadline'      => $deadline,
		'submitted_at'  => current_time( 'mysql' ),
		'ip_address'    => novira_get_client_ip(),
	);

	// Submissions are persisted below as a private CPT (the single source of
	// truth). No plaintext file logging — it would place customer PII at a
	// publicly guessable URL under wp-content/.

	// Send email notification to admin
	$admin_email = get_option( 'admin_email' );
	$subject     = __( 'طلب عرض سعر جديد - أكاديمية نوفيرا', 'novira-academy' );
	$message     = __( 'طلب عرض سعر جديد', 'novira-academy' ) . "\n\n";
	/* translators: %s: company name. */
	$message    .= sprintf( __( 'الشركة: %s', 'novira-academy' ), $company ) . "\n";
	/* translators: %s: contact person name. */
	$message    .= sprintf( __( 'المسؤول: %s', 'novira-academy' ), $contact ) . "\n";
	/* translators: %s: email address. */
	$message    .= sprintf( __( 'البريد: %s', 'novira-academy' ), $email ) . "\n";
	/* translators: %s: phone number. */
	$message    .= sprintf( __( 'الهاتف: %s', 'novira-academy' ), $phone ) . "\n";
	/* translators: %s: service type. */
	$message    .= sprintf( __( 'الخدمة: %s', 'novira-academy' ), $service ) . "\n";
	/* translators: 1: source language, 2: target language. */
	$message    .= sprintf( __( 'اللغات: %1$s → %2$s', 'novira-academy' ), $source_lang, $target_lang ) . "\n";
	/* translators: %s: page count. */
	$message    .= sprintf( __( 'الصفحات: %s', 'novira-academy' ), $page_count ) . "\n";
	/* translators: %s: request details. */
	$message    .= sprintf( __( 'التفاصيل: %s', 'novira-academy' ), $details ) . "\n";
	/* translators: %s: deadline. */
	$message    .= sprintf( __( 'الموعد: %s', 'novira-academy' ), $deadline ) . "\n";
	/* translators: %s: submission date/time. */
	$message    .= sprintf( __( 'الوقت: %s', 'novira-academy' ), current_time( 'mysql' ) ) . "\n";

	wp_mail( $admin_email, $subject, $message );

	// Send confirmation email to customer
	$customer_subject = __( 'تأكيد استلام طلب عرض السعر - أكاديمية نوفيرا', 'novira-academy' );
	/* translators: %s: contact person name. */
	$customer_message = sprintf( __( 'مرحباً %s,', 'novira-academy' ), $contact ) . "\n\n";
	$customer_message .= __( 'تم استلام طلب عرض السعر الخاص بك بنجاح.', 'novira-academy' ) . "\n\n";
	$customer_message .= __( 'التفاصيل:', 'novira-academy' ) . "\n";
	/* translators: %s: company name. */
	$customer_message .= sprintf( __( '- الشركة: %s', 'novira-academy' ), $company ) . "\n";
	/* translators: %s: service type. */
	$customer_message .= sprintf( __( '- الخدمة: %s', 'novira-academy' ), $service ) . "\n";
	/* translators: 1: source language, 2: target language. */
	$customer_message .= sprintf( __( '- اللغات: %1$s → %2$s', 'novira-academy' ), $source_lang, $target_lang ) . "\n\n";
	$customer_message .= __( 'سنتواصل معك خلال ساعة في أيام العمل.', 'novira-academy' ) . "\n\n";
	$customer_message .= __( "مع تحياتنا،\nفريق أكاديمية نوفيرا", 'novira-academy' ) . "\n";
	$customer_message .= get_theme_mod( 'novira_phone', '01090600927' ) . "\n";
	$customer_message .= get_theme_mod( 'novira_email', 'noviraacademy@gmail.com' ) . "\n";

	wp_mail( $email, $customer_subject, $customer_message );

	// Store in database for admin viewing
	$quote_id = wp_insert_post( array(
		'post_type'   => 'novira_quote',
		'post_title'  => sprintf( '%s - %s', $company, $service ),
		'post_status' => 'private',
		'meta_input'  => $submission,
	) );

	wp_send_json_success( array(
		'message' => __( 'تم إرسال طلبك بنجاح. سنتواصل معك قريباً.', 'novira-academy' ),
		'quote_id' => $quote_id,
	) );
}
add_action( 'wp_ajax_novira_quote_request', 'novira_handle_quote_request' );
add_action( 'wp_ajax_nopriv_novira_quote_request', 'novira_handle_quote_request' );

/**
 * Get client IP address.
 *
 * Uses REMOTE_ADDR only (set by the web server and not spoofable via request
 * headers) and validates it as a real IP. Trusting HTTP_CLIENT_IP /
 * HTTP_X_FORWARDED_FOR would let a client forge the logged/rate-limited IP.
 */
if ( ! function_exists( 'novira_get_client_ip' ) ) :
function novira_get_client_ip() {
	$remote = isset( $_SERVER['REMOTE_ADDR'] ) ? wp_unslash( $_SERVER['REMOTE_ADDR'] ) : '';
	$ip     = filter_var( $remote, FILTER_VALIDATE_IP );
	return $ip ? $ip : '';
}
endif;

/**
 * Lightweight anti-abuse gate for public form endpoints.
 *
 * Combines a honeypot field (`novira_hp`, hidden from real users) with a
 * per-IP, per-action rate limit backed by transients. Returns true when the
 * submission looks abusive so the caller can reject it. No external
 * dependencies — safe on shared hosting.
 *
 * @param string $action Unique key for the form (namespaces the transient).
 * @param int    $max    Max submissions allowed per window.
 * @param int    $window Window length in seconds.
 * @return bool True when the request should be blocked.
 */
if ( ! function_exists( 'novira_form_is_abusive' ) ) :
function novira_form_is_abusive( $action, $max = 5, $window = HOUR_IN_SECONDS ) {
	// Honeypot: bots fill this hidden field; real users leave it empty.
	if ( ! empty( $_POST['novira_hp'] ) ) {
		return true;
	}

	$ip = novira_get_client_ip();
	if ( '' === $ip ) {
		// Can't identify the client — don't hard-block a legitimate user.
		return false;
	}

	$key   = 'novira_rl_' . sanitize_key( $action ) . '_' . md5( $ip );
	$count = (int) get_transient( $key );
	if ( $count >= $max ) {
		return true;
	}

	set_transient( $key, $count + 1, $window );
	return false;
}
endif;

/**
 * Register custom post type for quote submissions
 */
function novira_register_quote_cpt() {
	$labels = array(
		'name'                  => _x( 'عروض الأسعار', 'Post type general name', 'novira-academy' ),
		'singular_name'         => _x( 'عرض سعر', 'Post type singular name', 'novira-academy' ),
		'menu_name'             => _x( 'عروض الأسعار', 'Admin Menu text', 'novira-academy' ),
		'add_new'               => __( 'إضافة جديد', 'novira-academy' ),
		'add_new_item'          => __( 'إضافة عرض سعر جديد', 'novira-academy' ),
		'edit_item'             => __( 'تعديل عرض السعر', 'novira-academy' ),
		'new_item'              => __( 'عرض سعر جديد', 'novira-academy' ),
		'view_item'             => __( 'عرض عرض السعر', 'novira-academy' ),
		'search_items'          => __( 'بحث في عروض الأسعار', 'novira-academy' ),
		'not_found'             => __( 'لم يتم العثور على عروض أسعار', 'novira-academy' ),
		'not_found_in_trash'    => __( 'لم يتم العثور على عروض أسعار في سلة المهملات', 'novira-academy' ),
		'all_items'             => __( 'جميع عروض الأسعار', 'novira-academy' ),
	);

	$args = array(
		'labels'             => $labels,
		'public'             => false,
		'publicly_queryable' => false,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => false,
		'rewrite'            => array( 'slug' => 'novira-quote' ),
		'capability_type'    => 'post',
		'has_archive'        => false,
		'hierarchical'       => false,
		'menu_position'      => 25,
		'menu_icon'          => 'dashicons-feedback',
		'supports'           => array( 'title' ),
	);

	register_post_type( 'novira_quote', $args );
}
add_action( 'init', 'novira_register_quote_cpt' );

/**
 * Add AJAX handler for form validation
 */
function novira_enqueue_form_validation() {
	if ( is_page_template( 'page-department.php' ) ) {
		wp_enqueue_script(
			'novira-form-validation',
			NOVIRA_URI . '/assets/js/form-validation.js',
			array(),
			NOVIRA_VERSION,
			true
		);

		wp_localize_script( 'novira-form-validation', 'noviraData', array(
			'ajaxUrl' => admin_url( 'admin-ajax.php' ),
			'nonce'   => wp_create_nonce( 'novira_quote_request' ),
		) );
	}
}
add_action( 'wp_enqueue_scripts', 'novira_enqueue_form_validation' );
