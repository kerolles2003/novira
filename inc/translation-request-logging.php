<?php
/**
 * Translation Request Logging
 *
 * Logs translation requests to WordPress options table and file.
 * Provides logging functions for debugging and audit.
 *
 * @package Novira_Academy
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Log translation request to options table
 */
function novira_log_translation_request( $request_id, $data ) {
	$logs = get_option( 'novira_translation_logs', array() );
	
	$log_entry = array(
		'id'          => $request_id,
		'timestamp'   => current_time( 'mysql' ),
		'company'     => $data['company'],
		'contact'     => $data['contact'],
		'email'       => $data['email'],
		'service'     => $data['service'],
		'source_lang' => $data['source_lang'],
		'target_lang' => $data['target_lang'],
		'page_count'  => $data['page_count'],
		'ip_address'  => $data['ip_address'],
		'status'      => 'pending',
	);
	
	// Allow plugins to modify log entry
	$log_entry = apply_filters( 'novira_translation_log_entry', $log_entry, $data );
	
	// Add to logs array
	$logs[ $request_id ] = $log_entry;

	// Keep only last 1000 entries
	if ( count( $logs ) > 1000 ) {
		$logs = array_slice( $logs, -1000, true );
	}

	// Store as a NON-autoloaded option so this admin audit trail is not loaded
	// into memory on every front-end request. The full request is also stored
	// as a private `novira_translation` CPT (the canonical record). Plaintext
	// file logging under wp-content/ has been removed — it exposed PII at a
	// publicly guessable URL.
	update_option( 'novira_translation_logs', $logs, false );

	// Allow plugins to run additional logging
	do_action( 'novira_after_log_translation_request', $request_id, $log_entry );
}

/**
 * Get translation logs
 */
function novira_get_translation_logs( $args = array() ) {
	$defaults = array(
		'per_page' => 20,
		'page'     => 1,
		'status'   => '',
		'orderby'  => 'timestamp',
		'order'    => 'DESC',
	);
	
	$args = wp_parse_args( $args, $defaults );
	
	$logs = get_option( 'novira_translation_logs', array() );
	
	// Filter by status
	if ( ! empty( $args['status'] ) ) {
		$logs = array_filter( $logs, function( $log ) use ( $args ) {
			return $log['status'] === $args['status'];
		});
	}
	
	// Sort
	$orderby = $args['orderby'];
	$order   = strtoupper( $args['order'] );
	
	uasort( $logs, function( $a, $b ) use ( $orderby, $order ) {
		if ( isset( $a[ $orderby ] ) && isset( $b[ $orderby ] ) ) {
			if ( 'DESC' === $order ) {
				return strcmp( $b[ $orderby ], $a[ $orderby ] );
			}
			return strcmp( $a[ $orderby ], $b[ $orderby ] );
		}
		return 0;
	});
	
	// Paginate
	$total    = count( $logs );
	$offset   = ( $args['page'] - 1 ) * $args['per_page'];
	$logs     = array_slice( $logs, $offset, $args['per_page'], true );
	
	return array(
		'logs'       => $logs,
		'total'      => $total,
		'per_page'   => $args['per_page'],
		'page'       => $args['page'],
		'total_pages' => ceil( $total / $args['per_page'] ),
	);
}

/**
 * Update log status
 */
function novira_update_translation_log_status( $request_id, $new_status, $notes = '' ) {
	$logs = get_option( 'novira_translation_logs', array() );
	
	if ( isset( $logs[ $request_id ] ) ) {
		$logs[ $request_id ]['status'] = $new_status;
		$logs[ $request_id ]['updated_at'] = current_time( 'mysql' );
		
		if ( ! empty( $notes ) ) {
			$logs[ $request_id ]['notes'] = $notes;
		}

		update_option( 'novira_translation_logs', $logs, false );
		
		// Allow plugins to run actions on status change
		do_action( 'novira_translation_request_status_changed', $request_id, $new_status, $logs[ $request_id ] );
		
		return true;
	}
	
	return false;
}

/**
 * Get log statistics
 */
function novira_get_translation_log_stats() {
	$logs = get_option( 'novira_translation_logs', array() );
	
	$stats = array(
		'total'     => count( $logs ),
		'pending'   => 0,
		'processing' => 0,
		'completed' => 0,
		'cancelled' => 0,
		'today'     => 0,
		'this_week' => 0,
		'this_month' => 0,
	);
	
	$today     = current_time( 'Y-m-d' );
	$week_start = wp_date( 'Y-m-d', strtotime( 'monday this week' ) );
	$month_start = current_time( 'Y-m-01' );
	
	foreach ( $logs as $log ) {
		// Count by status
		if ( isset( $log['status'] ) ) {
			$status = $log['status'];
			if ( isset( $stats[ $status ] ) ) {
				$stats[ $status ]++;
			}
		}
		
		// Count by date
		if ( isset( $log['timestamp'] ) ) {
			$log_date = substr( $log['timestamp'], 0, 10 );
			
			if ( $log_date === $today ) {
				$stats['today']++;
			}
			
			if ( $log_date >= $week_start ) {
				$stats['this_week']++;
			}
			
			if ( $log_date >= $month_start ) {
				$stats['this_month']++;
			}
		}
	}
	
	return $stats;
}

/**
 * Clear old logs
 */
function novira_clear_old_translation_logs( $days = 90 ) {
	$logs = get_option( 'novira_translation_logs', array() );
	$cutoff_date = wp_date( 'Y-m-d H:i:s', strtotime( "-{$days} days" ) );
	
	$logs = array_filter( $logs, function( $log ) use ( $cutoff_date ) {
		return isset( $log['timestamp'] ) && $log['timestamp'] > $cutoff_date;
	});

	update_option( 'novira_translation_logs', $logs, false );
	
	return count( $logs );
}

// Hook to log translation requests
add_action( 'novira_after_store_translation_request', 'novira_log_translation_request', 10, 2 );
