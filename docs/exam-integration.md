# Exam Provider Integration Guide

## Overview

This document provides guidelines for integrating external exam providers with the Novira Academy theme.

## Current Implementation

The exam integration layer is implemented in `inc/exam-integration.php`:
- `Novira_Exam_Integration` class
- Custom post type `novira_exam`
- Meta boxes for exam details
- Provider registration system

## Architecture

### Exam Integration Class

```php
// Get exam integration instance
$exam_integration = novira_get_exam_integration();

// Register a provider
$exam_integration->register_provider( 'microsoft_forms', array(
    'name'        => 'Microsoft Forms',
    'description' => 'Microsoft Forms integration',
    'embed_url'   => 'https://forms.office.com',
    'api_url'     => 'https://graph.microsoft.com/v1.0',
    'callback'    => 'novira_microsoft_forms_callback',
) );

// Get registered providers
$providers = $exam_integration->get_providers();

// Get specific provider
$provider = $exam_integration->get_provider( 'microsoft_forms' );

// Render exam embed
$embed = $exam_integration->render_exam_embed( $exam_id );
```

### Custom Post Type

The `novira_exam` CPT stores exam data:
- `_novira_exam_url` - External exam URL
- `_novira_exam_duration` - Exam duration in minutes
- `_novira_exam_passing_score` - Passing score percentage
- `_novira_exam_provider` - Provider identifier

## Available Hooks

### Action Hooks

| Hook | Parameters | Description |
|------|------------|-------------|
| `novira_register_exam_providers` | `$integration` | Register exam providers |
| `novira_save_exam_meta` | `$post_id`, `$post_data` | Save exam meta data |

### Filter Hooks

| Hook | Parameters | Description |
|------|------------|-------------|
| `novira_exam_embed_code` | `$embed_code`, `$exam_id`, `$provider` | Filter exam embed code |

## Implementing a Provider

### 1. Microsoft Forms

```php
/**
 * Register Microsoft Forms provider
 */
function register_microsoft_forms_provider( $integration ) {
    $integration->register_provider( 'microsoft_forms', array(
        'name'        => 'Microsoft Forms',
        'description' => 'Microsoft Forms integration',
        'embed_url'   => 'https://forms.office.com',
        'api_url'     => 'https://graph.microsoft.com/v1.0',
        'callback'    => 'novira_microsoft_forms_embed',
    ) );
}
add_action( 'novira_register_exam_providers', 'register_microsoft_forms_provider' );

/**
 * Microsoft Forms embed callback
 */
function novira_microsoft_forms_embed( $embed_code, $exam_id, $provider ) {
    $exam_url = get_post_meta( $exam_id, '_novira_exam_url', true );
    
    if ( empty( $exam_url ) ) {
        return $embed_code;
    }
    
    // Convert forms.office.com URL to embed format
    $embed_url = str_replace( '/response.aspx', '/embed', $exam_url );
    
    return sprintf(
        '<iframe src="%s" width="100%%" height="600" frameborder="0" allowfullscreen></iframe>',
        esc_url( $embed_url )
    );
}
add_filter( 'novira_exam_embed_code', 'novira_microsoft_forms_embed', 10, 3 );
```

### 2. Google Forms

```php
/**
 * Register Google Forms provider
 */
function register_google_forms_provider( $integration ) {
    $integration->register_provider( 'google_forms', array(
        'name'        => 'Google Forms',
        'description' => 'Google Forms integration',
        'embed_url'   => 'https://docs.google.com/forms',
        'callback'    => 'novira_google_forms_embed',
    ) );
}
add_action( 'novira_register_exam_providers', 'register_google_forms_provider' );

/**
 * Google Forms embed callback
 */
function novira_google_forms_embed( $embed_code, $exam_id, $provider ) {
    $exam_url = get_post_meta( $exam_id, '_novira_exam_url', true );
    
    if ( empty( $exam_url ) ) {
        return $embed_code;
    }
    
    // Convert Google Forms URL to embed format
    $embed_url = str_replace( '/viewform', '/viewform?embedded=true', $exam_url );
    
    return sprintf(
        '<iframe src="%s" width="100%%" height="600" frameborder="0" marginheight="0" marginwidth="0">Loading…</iframe>',
        esc_url( $embed_url )
    );
}
add_filter( 'novira_exam_embed_code', 'novira_google_forms_embed', 10, 3 );
```

### 3. Custom Provider

```php
/**
 * Register custom provider
 */
function register_custom_provider( $integration ) {
    $integration->register_provider( 'custom', array(
        'name'        => 'Custom Exam',
        'description' => 'Custom exam integration',
        'callback'    => 'novira_custom_exam_embed',
    ) );
}
add_action( 'novira_register_exam_providers', 'register_custom_provider' );

/**
 * Custom exam embed callback
 */
function novira_custom_exam_embed( $embed_code, $exam_id, $provider ) {
    $exam_url = get_post_meta( $exam_id, '_novira_exam_url', true );
    
    if ( empty( $exam_url ) ) {
        return $embed_code;
    }
    
    return sprintf(
        '<div class="novira-custom-exam"><a href="%s" target="_blank" class="btn btn-primary">%s</a></div>',
        esc_url( $exam_url ),
        esc_html__( 'بدء الامتحان', 'novira-academy' )
    );
}
add_filter( 'novira_exam_embed_code', 'novira_custom_exam_embed', 10, 3 );
```

## Implementation Checklist

When implementing a new exam provider:

- [ ] Register provider with `register_provider()`
- [ ] Implement embed callback function
- [ ] Add filter for `novira_exam_embed_code`
- [ ] Handle authentication (if required)
- [ ] Implement score retrieval (if supported)
- [ ] Add admin UI for provider settings
- [ ] Create documentation for users
- [ ] Test with various exam types

## API Integration

For providers with API support:

### 1. Authentication

```php
/**
 * Get API access token
 */
function get_provider_access_token( $provider_id ) {
    $option_name = 'novira_' . $provider_id . '_api_key';
    $api_key = get_option( $option_name );
    
    // Implement OAuth or API key authentication
    return $api_token;
}
```

### 2. Score Retrieval

```php
/**
 * Get exam scores from provider
 */
function get_exam_scores( $exam_id, $student_id ) {
    $provider = get_post_meta( $exam_id, '_novira_exam_provider', true );
    $exam_url = get_post_meta( $exam_id, '_novira_exam_url', true );
    
    // Implement API call to retrieve scores
    $scores = array();
    
    return apply_filters( 'novira_exam_scores', $scores, $exam_id, $student_id );
}
```

## Security Considerations

1. **API Key Storage** - Store API keys securely in WordPress options
2. **Nonce Verification** - Verify nonces for all form submissions
3. **Rate Limiting** - Implement rate limiting for API calls
4. **Error Handling** - Handle API errors gracefully
5. **Data Validation** - Validate all data from external providers
6. **HTTPS** - Always use HTTPS for API communications

## Troubleshooting

### Common Issues

1. **Embed not showing** - Check URL format and iframe sandbox settings
2. **API authentication fails** - Verify API keys and tokens
3. **Scores not retrieving** - Check API permissions and endpoints
4. **CORS errors** - Implement proxy or server-side API calls

### Debug Mode

Enable debug mode for detailed logging:

```php
// In wp-config.php
define( 'NOVIRA_DEBUG_EXAMS', true );

// Check debug log
$log_file = WP_CONTENT_DIR . '/novira-exam-debug.log';
```
