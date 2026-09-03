<?php
/**
 * Template Part: Student Portal Dashboard
 *
 * Placeholder template for student portal dashboard.
 * This is a stub for future implementation.
 *
 * @package Novira_Academy
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

<div class="novira-portal-dashboard" id="student-portal-dashboard">
	<div class="portal-dashboard-header">
		<h2><?php esc_html_e( 'مرحباً بك في بوابة الطالب', 'novira-academy' ); ?></h2>
		<p class="portal-welcome">
			<?php
			printf(
				esc_html__( 'مرحباً %s', 'novira-academy' ),
				'<strong>' . esc_html( wp_get_current_user()->display_name ) . '</strong>'
			);
			?>
		</p>
	</div>
	
	<div class="portal-dashboard-stats">
		<div class="stat-card">
			<div class="stat-icon">
				<span class="dashicons dashicons-welcome-learn-more"></span>
			</div>
			<div class="stat-content">
				<h3><?php esc_html_e( 'الدورات الحالية', 'novira-academy' ); ?></h3>
				<p class="stat-number">0</p>
			</div>
		</div>
		
		<div class="stat-card">
			<div class="stat-icon">
				<span class="dashicons dashicons-awards"></span>
			</div>
			<div class="stat-content">
				<h3><?php esc_html_e( 'الشهادات', 'novira-academy' ); ?></h3>
				<p class="stat-number">0</p>
			</div>
		</div>
		
		<div class="stat-card">
			<div class="stat-icon">
				<span class="dashicons dashicons-chart-bar"></span>
			</div>
			<div class="stat-content">
				<h3><?php esc_html_e( 'التقدم', 'novira-academy' ); ?></h3>
				<p class="stat-number">0%</p>
			</div>
		</div>
	</div>
	
	<div class="portal-dashboard-content">
		<div class="portal-section">
			<h3><?php esc_html_e( 'آخر النشاطات', 'novira-academy' ); ?></h3>
			<div class="activity-list">
				<p class="no-activity"><?php esc_html_e( 'لا توجد نشاطات حديثة', 'novira-academy' ); ?></p>
			</div>
		</div>
		
		<div class="portal-section">
			<h3><?php esc_html_e( 'الإعلانات', 'novira-academy' ); ?></h3>
			<div class="announcements-list">
				<p class="no-announcements"><?php esc_html_e( 'لا توجد إعلانات', 'novira-academy' ); ?></p>
			</div>
		</div>
	</div>
	
	<div class="portal-dashboard-sidebar">
		<div class="portal-section">
			<h3><?php esc_html_e( 'الحساب', 'novira-academy' ); ?></h3>
			<ul class="account-menu">
				<li><a href="#profile"><?php esc_html_e( 'الملف الشخصي', 'novira-academy' ); ?></a></li>
				<li><a href="#settings"><?php esc_html_e( 'الإعدادات', 'novira-academy' ); ?></a></li>
				<li><a href="#notifications"><?php esc_html_e( 'الإشعارات', 'novira-academy' ); ?></a></li>
				<li><a href="#" class="logout-link"><?php esc_html_e( 'تسجيل الخروج', 'novira-academy' ); ?></a></li>
			</ul>
		</div>
	</div>
</div>
