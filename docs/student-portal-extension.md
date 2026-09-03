# Student Portal Extension Guide

## Overview

This document provides guidelines for extending the student portal functionality in the Novira Academy theme.

## Current Implementation

The student portal is implemented as placeholder templates in `template-parts/portal/`:
- `login.php` - Student login form
- `dashboard.php` - Student dashboard

## Architecture

### Authentication System

The theme provides hooks and filters for student authentication through `Novira_Student_Auth` class:

```php
// Check if user is a student
$is_student = novira_get_student_auth()->is_student( $user_id );

// Get student data
$student_data = novira_get_student_auth()->get_student_data( $user_id );
```

### Available Hooks

#### Action Hooks

| Hook | Parameters | Description |
|------|------------|-------------|
| `novira_student_login_after` | `$user_id`, `$user_data` | Fires after student login |
| `novira_student_logout_after` | `$user_id` | Fires after student logout |
| `novira_student_register_after` | `$user_id`, `$user_data` | Fires after student registration |
| `novira_student_role_created_after` | `$role` | Fires after student role is created |
| `novira_student_session_started` | `$user_id` | Fires when session starts |
| `novira_student_session_ended` | `$user_id` | Fires when session ends |
| `novira_student_password_reset_after` | `$user_id`, `$new_password` | Fires after password reset |
| `novira_student_profile_updated` | `$user_id`, `$profile_data` | Fires after profile update |

#### Filter Hooks

| Hook | Parameters | Description |
|------|------------|-------------|
| `novira_student_capabilities_filter` | `$capabilities`, `$role` | Filter student capabilities |
| `novira_student_password_strength_check` | `$is_strong`, `$password` | Filter password strength check |
| `novira_student_profile_data_filter` | `$profile_data`, `$user_id` | Filter profile data |
| `novira_is_student` | `$is_student`, `$user` | Filter whether user is a student |
| `novira_student_data` | `$student_data`, `$user` | Filter student data |

## Extending the Portal

### 1. Custom Login Handler

```php
/**
 * Custom login handler
 */
function custom_student_login_handler( $user_id, $user_data ) {
    // Log login activity
    update_user_meta( $user_id, 'last_login', current_time( 'mysql' ) );
    
    // Send welcome email
    wp_mail(
        $user_data['user_email'],
        'Welcome to Novira Academy',
        'Welcome back!'
    );
}
add_action( 'novira_student_login_after', 'custom_student_login_handler', 10, 2 );
```

### 2. Custom Registration Process

```php
/**
 * Custom registration handler
 */
function custom_student_registration_handler( $user_id, $user_data ) {
    // Create student profile
    update_user_meta( $user_id, 'student_id', generate_student_id() );
    update_user_meta( $user_id, 'enrollment_date', current_time( 'mysql' ) );
    
    // Assign to default program
    wp_set_object_terms( $user_id, 'general', 'student_program' );
}
add_action( 'novira_student_register_after', 'custom_student_registration_handler', 10, 2 );
```

### 3. Custom Capabilities

```php
/**
 * Add custom capabilities
 */
function add_custom_student_capabilities( $capabilities, $role ) {
    if ( 'student' === $role ) {
        $capabilities['novira_access_forums'] = true;
        $capabilities['novira_download_resources'] = true;
        $capabilities['novira_submit_assignments'] = true;
    }
    return $capabilities;
}
add_filter( 'novira_student_capabilities_filter', 'add_custom_student_capabilities', 10, 2 );
```

### 4. Custom Profile Fields

```php
/**
 * Add custom profile fields
 */
function add_custom_profile_fields( $profile_data, $user_id ) {
    $profile_data['student_id'] = get_user_meta( $user_id, 'student_id', true );
    $profile_data['program'] = wp_get_object_terms( $user_id, 'student_program', array( 'fields' => 'names' ) );
    $profile_data['enrollment_date'] = get_user_meta( $user_id, 'enrollment_date', true );
    
    return $profile_data;
}
add_filter( 'novira_student_profile_data_filter', 'add_custom_profile_fields', 10, 2 );
```

## Implementation Checklist

When implementing a full student portal:

- [ ] Create custom user role 'student'
- [ ] Implement custom authentication system
- [ ] Create student registration form
- [ ] Build student dashboard with course progress
- [ ] Implement course enrollment system
- [ ] Create exam/quiz system
- [ ] Build grade tracking system
- [ ] Implement certificate generation
- [ ] Create student profile management
- [ ] Build notification system
- [ ] Implement session management
- [ ] Create admin panel for student management

## Security Considerations

1. **Nonce Verification** - Always verify nonces in form submissions
2. **Capability Checks** - Use `current_user_can()` for authorization
3. **Input Sanitization** - Sanitize all user input
4. **Output Escaping** - Escape all output to prevent XSS
5. **Rate Limiting** - Implement rate limiting for login attempts
6. **Session Security** - Use secure session handling

## Integration Points

### WordPress User System

The portal integrates with WordPress user system:
- User roles and capabilities
- User meta for additional data
- WordPress authentication cookies

### Custom Post Types

Future CPTs for portal:
- `student_course` - Enrolled courses
- `student_grade` - Grade records
- `student_certificate` - Certificates

### Taxonomies

Future taxonomies:
- `student_program` - Student programs
- `student_cohort` - Student cohorts
