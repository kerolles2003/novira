<?php
/**
 * Translation Request Sanitization
 *
 * Provides sanitization and validation functions for translation requests.
 * Uses WordPress filters for extensibility.
 *
 * @package Novira_Academy
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Sanitize text field with custom rules
 */
function novira_sanitize_text_field( $value, $field_name = '' ) {
	$value = sanitize_text_field( $value );
	
	// Apply field-specific sanitization
	$value = apply_filters( 'novira_sanitize_' . $field_name, $value );
	
	return $value;
}

/**
 * Sanitize email field
 */
function novira_sanitize_email_field( $value ) {
	return sanitize_email( $value );
}

/**
 * Sanitize phone field
 */
function novira_sanitize_phone_field( $value ) {
	// Remove all non-numeric characters except + at the beginning
	$value = preg_replace( '/[^\d+]/', '', $value );
	
	// Ensure it starts with + or 0
	if ( ! preg_match( '/^(\+|0)/', $value ) ) {
		$value = '+' . $value;
	}
	
	return $value;
}

/**
 * Sanitize URL field
 */
function novira_sanitize_url_field( $value ) {
	return esc_url_raw( $value );
}

/**
 * Sanitize textarea field
 */
function novira_sanitize_textarea_field( $value, $field_name = '' ) {
	$value = sanitize_textarea_field( $value );
	
	// Apply field-specific sanitization
	$value = apply_filters( 'novira_sanitize_' . $field_name, $value );
	
	return $value;
}

/**
 * Sanitize select/radio field
 */
function novira_sanitize_select_field( $value, $allowed_values = array() ) {
	if ( ! empty( $allowed_values ) && ! in_array( $value, $allowed_values, true ) ) {
		return '';
	}
	
	return sanitize_text_field( $value );
}

/**
 * Sanitize integer field
 */
function novira_sanitize_integer_field( $value, $min = 0, $max = PHP_INT_MAX ) {
	$value = absint( $value );
	$value = max( $min, min( $max, $value ) );
	
	return $value;
}

/**
 * Sanitize date field
 */
function novira_sanitize_date_field( $value ) {
	// Validate date format Y-m-d
	$datetime = DateTime::createFromFormat( 'Y-m-d', $value );
	if ( $datetime && $datetime->format( 'Y-m-d' ) === $value ) {
		return $value;
	}
	
	return '';
}

/**
 * Sanitize time field
 */
function novira_sanitize_time_field( $value ) {
	// Validate time format H:i
	$datetime = DateTime::createFromFormat( 'H:i', $value );
	if ( $datetime && $datetime->format( 'H:i' ) === $value ) {
		return $value;
	}
	
	return '';
}

/**
 * Validate email format
 */
function novira_validate_email( $email ) {
	if ( empty( $email ) ) {
		return false;
	}
	
	return is_email( $email );
}

/**
 * Validate phone format (Egyptian numbers)
 */
function novira_validate_phone( $phone ) {
	if ( empty( $phone ) ) {
		return false;
	}
	
	// Egyptian phone patterns
	$patterns = array(
		'/^(\+20|0)?1[0125]\d{8}$/',  // Mobile
		'/^(\+20|0)?2\d{7,8}$/',       // Landline Cairo
		'/^(\+20|0)?[3-9]\d{7,8}$/',   // Other landlines
	);
	
	foreach ( $patterns as $pattern ) {
		if ( preg_match( $pattern, preg_replace( '/\s/', '', $phone ) ) ) {
			return true;
		}
	}
	
	return false;
}

/**
 * Validate date (must be in the future)
 */
function novira_validate_future_date( $date ) {
	if ( empty( $date ) ) {
		return true; // Optional field
	}
	
	$datetime = DateTime::createFromFormat( 'Y-m-d', $date );
	if ( ! $datetime ) {
		return false;
	}
	
	$today = new DateTime();
	$today->setTime( 0, 0, 0 );
	
	return $datetime >= $today;
}

/**
 * Validate page count
 */
function novira_validate_page_count( $count, $min = 1, $max = 1000 ) {
	$count = absint( $count );
	return $count >= $min && $count <= $max;
}

/**
 * Get available languages
 */
function novira_get_available_languages() {
	$languages = apply_filters( 'novira_available_languages', array(
		'ar' => __( 'العربية', 'novira-academy' ),
		'en' => __( 'الإنجليزية', 'novira-academy' ),
		'fr' => __( 'الفرنسية', 'novira-academy' ),
		'de' => __( 'الألمانية', 'novira-academy' ),
		'es' => __( 'الإسبانية', 'novira-academy' ),
		'it' => __( 'الإيطالية', 'novira-academy' ),
		'tr' => __( 'التركية', 'novira-academy' ),
		'zh' => __( 'الصينية', 'novira-academy' ),
		'ja' => __( 'اليابانية', 'novira-academy' ),
		'ko' => __( 'الكورية', 'novira-academy' ),
	) );
	
	return $languages;
}

/**
 * Get available services
 */
function novira_get_available_services() {
	$services = apply_filters( 'novira_available_services', array(
		'regular'   => __( 'ترجمة عادية', 'novira-academy' ),
		'certified' => __( 'ترجمة معتمدة', 'novira-academy' ),
		'urgent'    => __( 'ترجمة عاجلة', 'novira-academy' ),
		'legal'     => __( 'ترجمة قانونية', 'novira-academy' ),
		'technical' => __( 'ترجمة تقنية', 'novira-academy' ),
		'medical'   => __( 'ترجمة طبية', 'novira-academy' ),
		'financial' => __( 'ترجمة مالية', 'novira-academy' ),
	) );
	
	return $services;
}
