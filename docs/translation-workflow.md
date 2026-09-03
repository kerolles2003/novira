# Translation Workflow Extension Points

This document describes the available hooks and filters for extending the translation workflow in Novira Academy theme.

## Overview

The translation workflow is designed with a plugin-based architecture, allowing developers to extend and customize functionality without modifying theme files.

## Available Filters

### Validation & Sanitization

```php
// Validate submission before processing
add_filter( 'novira_validate_translation_request', function( $result, $post_data ) {
    // Return true if valid, or error message string if invalid
    return $result;
}, 10, 2 );

// Sanitize submission data
add_filter( 'novira_sanitize_translation_request', function( $data ) {
    // Modify and return sanitized data
    return $data;
}, 10, 1 );
```

### Data Processing

```php
// Modify data before processing
add_filter( 'novira_before_process_translation_request', function( $data ) {
    // Add custom fields or modify data
    return $data;
}, 10, 1 );

// Modify data before storage
add_filter( 'novira_before_store_translation_request', function( $data ) {
    // Final modifications before saving
    return $data;
}, 10, 1 );
```

### Notifications

```php
// Control whether to send notifications
add_filter( 'novira_send_translation_notifications', function( $send, $request_id, $data ) {
    // Return false to disable notifications
    return $send;
}, 10, 3 );

// Customize notification templates
add_filter( 'novira_translation_notification_template', function( $template, $type, $data ) {
    if ( 'admin' === $type ) {
        return "Custom admin template for {$data['company']}";
    }
    return $template;
}, 10, 3 );
```

### Logging

```php
// Modify log entry before storage
add_filter( 'novira_translation_log_entry', function( $log_entry, $data ) {
    // Add custom fields to log
    $log_entry['custom_field'] = 'value';
    return $log_entry;
}, 10, 2 );
```

### Configuration

```php
// Add available languages
add_filter( 'novira_available_languages', function( $languages ) {
    $languages['ja'] = 'اليابانية';
    return $languages;
}, 10, 1 );

// Add available services
add_filter( 'novira_available_services', function( $services ) {
    $services['notarized'] = 'ترجمة موثقة';
    return $services;
}, 10, 1 );
```

## Available Actions

### After Storage

```php
// Run after translation request is stored
add_action( 'novira_after_store_translation_request', function( $request_id, $data ) {
    // Sync with CRM, update analytics, etc.
}, 10, 2 );
```

### After Notifications

```php
// Run after notifications are sent
add_action( 'novira_after_translation_request', function( $request_id, $data ) {
    // Additional processing after submission
}, 10, 2 );
```

### Status Changes

```php
// Run when request status changes
add_action( 'novira_translation_request_status_changed', function( $request_id, $new_status, $log_entry ) {
    // Trigger workflows, send updates, etc.
}, 10, 3 );
```

## Use Cases

### 1. Payment Integration

```php
// Add payment validation
add_filter( 'novira_validate_translation_request', function( $result, $post_data ) {
    if ( empty( $post_data['payment_id'] ) ) {
        return 'يرجى إدخال معرف الدفع';
    }
    return $result;
}, 10, 2 );

// Track payment status
add_action( 'novira_translation_request_status_changed', function( $request_id, $new_status, $log_entry ) {
    if ( 'paid' === $new_status ) {
        // Update payment system
    }
}, 10, 3 );
```

### 2. CRM Integration

```php
// Sync with external CRM
add_action( 'novira_after_translation_request', function( $request_id, $data ) {
    $crm = new ExternalCRM();
    $crm->create_contact( $data );
}, 10, 2 );
```

### 3. Email Marketing

```php
// Add to mailing list
add_action( 'novira_after_store_translation_request', function( $request_id, $data ) {
    $mailchimp = new MailchimpIntegration();
    $mailchimp->add_subscriber( $data['email'], $data );
}, 10, 2 );
```

### 4. Analytics Tracking

```php
// Track conversion
add_action( 'novira_after_store_translation_request', function( $request_id, $data ) {
    // Google Analytics, Facebook Pixel, etc.
    track_conversion( 'translation_request', $data );
}, 10, 2 );
```

### 5. Custom Validation Rules

```php
// Add business rules
add_filter( 'novira_validate_translation_request', function( $result, $post_data ) {
    // Check if company is blacklisted
    $blacklist = get_option( 'novira_blacklist_companies', array() );
    if ( in_array( $post_data['company_name'], $blacklist ) ) {
        return 'هذا الشركة غير مقبولة';
    }
    return $result;
}, 10, 2 );
```

### 6. Workflow Automation

```php
// Auto-assign to translator
add_action( 'novira_translation_request_status_changed', function( $request_id, $new_status, $log_entry ) {
    if ( 'pending' === $new_status ) {
        $translator = find_available_translator( $log_entry['service'] );
        if ( $translator ) {
            novira_update_translation_log_status( $request_id, 'assigned', $translator['id'] );
        }
    }
}, 10, 3 );
```

## File Structure

```
inc/
├── translation-request-handler.php    # Main handler with AJAX
├── translation-request-sanitization.php # Sanitization functions
├── translation-request-logging.php    # Logging to options & file
├── hooks.php                          # All hooks documentation
└── hooks.php                          # Extension points
```

## Database

Translation requests are stored as:
- **Post Type**: `novira_translation_request`
- **Status**: `private` (not public)
- **Meta**: All form fields stored as post meta

Logs are stored in:
- **Option**: `novira_translation_logs` (last 1000 entries)
- **File**: `wp-content/novira-logs/translation-requests-YYYY-MM.log`

## Testing

To test hooks, use the Query Monitor plugin or add temporary logging:

```php
add_action( 'novira_after_store_translation_request', function( $request_id, $data ) {
    error_log( 'Test: Request stored - ' . $request_id );
}, 10, 2 );
```
