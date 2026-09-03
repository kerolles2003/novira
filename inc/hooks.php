<?php
/**
 * Translation Workflow Hooks
 *
 * Defines all hooks and filters for the translation workflow.
 * This file serves as documentation and registration point for extensibility.
 *
 * @package Novira_Academy
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * ============================================
 * FILTERS (Return modified values)
 * ============================================
 */

/**
 * Filter validation result before processing
 *
 * @param bool|string $result True if valid, error message string if invalid
 * @param array       $post_data Raw POST data
 */
// apply_filters( 'novira_validate_translation_request', $result, $post_data );

/**
 * Filter sanitized submission data
 *
 * @param array $data Sanitized data array
 */
// apply_filters( 'novira_sanitize_translation_request', $data );

/**
 * Filter submission data before processing
 *
 * @param array $data Submission data
 */
// apply_filters( 'novira_before_process_translation_request', $data );

/**
 * Filter data before storage
 *
 * @param array $data Final data to be stored
 */
// apply_filters( 'novira_before_store_translation_request', $data );

/**
 * Filter whether to send notifications
 *
 * @param bool  $send Whether to send notifications
 * @param int   $request_id Request ID
 * @param array $data Submission data
 */
// apply_filters( 'novira_send_translation_notifications', $send, $request_id, $data );

/**
 * Filter notification email template
 *
 * @param string|null $template Custom template or null for default
 * @param string      $type 'admin' or 'customer'
 * @param array       $data Submission data
 */
// apply_filters( 'novira_translation_notification_template', $template, $type, $data );

/**
 * Filter log entry before storage
 *
 * @param array $log_entry Log entry data
 * @param array $data Original submission data
 */
// apply_filters( 'novira_translation_log_entry', $log_entry, $data );

/**
 * Filter available languages
 *
 * @param array $languages Array of language codes => names
 */
// apply_filters( 'novira_available_languages', $languages );

/**
 * Filter available services
 *
 * @param array $services Array of service slugs => names
 */
// apply_filters( 'novira_available_services', $services );

/**
 * Filter latest posts query
 *
 * @param array $args WP_Query arguments
 */
// apply_filters( 'novira_latest_posts_query', $args );

/**
 * Filter upcoming events query
 *
 * @param array $args WP_Query arguments
 */
// apply_filters( 'novira_upcoming_events_query', $args );

/**
 * Filter testimonials for trust-proof section
 *
 * @param array $testimonials Array of testimonial data arrays
 */
// apply_filters( 'novira_homepage_testimonials', $testimonials );

/**
 * Filter gallery images for media-gallery section
 *
 * @param array $gallery_images Array of image data arrays
 */
// apply_filters( 'novira_homepage_gallery', $gallery_images );

/**
 * Filter WhatsApp CTA data
 *
 * @param array $cta_data CTA data array with title, text, button keys
 */
// apply_filters( 'novira_whatsapp_cta', $cta_data );

/**
 * ============================================
 * ACTIONS (Run functions at specific points)
 * ============================================
 */

/**
 * Runs after translation request is stored
 *
 * @param int   $request_id Request ID
 * @param array $data Submission data
 */
// do_action( 'novira_after_store_translation_request', $request_id, $data );

/**
 * Runs after translation request notifications are sent
 *
 * @param int   $request_id Request ID
 * @param array $data Submission data
 */
// do_action( 'novira_after_translation_request', $request_id, $data );

/**
 * Runs after translation request status changes
 *
 * @param int    $request_id Request ID
 * @param string $new_status New status
 * @param array  $log_entry Log entry data
 */
// do_action( 'novira_translation_request_status_changed', $request_id, $new_status, $log_entry );

/**
 * Runs after logging a translation request
 *
 * @param int   $request_id Request ID
 * @param array $log_entry Log entry data
 */
// do_action( 'novira_after_log_translation_request', $request_id, $log_entry );

/**
 * Runs after registration request is stored
 *
 * @param int   $registration_id Registration ID
 * @param array $data Submission data
 */
// do_action( 'novira_after_store_registration_request', $registration_id, $data );

/**
 * ============================================
 * EXTENSION POINTS FOR FUTURE PLUGINS
 * ============================================
 *
 * 1. Payment Integration
 *    - Hook into 'novira_before_process_translation_request' to add payment validation
 *    - Use 'novira_translation_request_status_changed' to track payment status
 *
 * 2. CRM Integration
 *    - Hook into 'novira_after_translation_request' to sync with external CRM
 *    - Use 'novira_translation_log_entry' to add CRM IDs
 *
 * 3. Email Marketing
 *    - Hook into 'novira_after_translation_request' to add to mailing list
 *    - Filter 'novira_send_translation_notifications' to customize emails
 *
 * 4. Analytics Tracking
 *    - Hook into 'novira_after_store_translation_request' to track conversions
 *    - Use 'novira_translation_log_entry' to add tracking data
 *
 * 5. Multi-language Support
 *    - Filter 'novira_available_languages' to add/remove languages
 *    - Filter 'novira_translation_notification_template' for translated emails
 *
 * 6. Custom Validation Rules
 *    - Filter 'novira_validate_translation_request' to add business rules
 *    - Filter 'novira_sanitize_translation_request' for custom sanitization
 *
 * 7. Workflow Automation
 *    - Hook into 'novira_translation_request_status_changed' to trigger workflows
 *    - Use 'novira_after_store_translation_request' for auto-assignment
 *
 * 8. Reporting & Analytics
 *    - Use 'novira_get_translation_logs' for custom reports
 *    - Hook into 'novira_after_log_translation_request' for real-time analytics
 */
