<?php
/**
 * Template Part: Student Portal Login
 *
 * Placeholder template for student portal login.
 * This is a stub for future implementation.
 *
 * @package Novira_Academy
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

<div class="novira-portal-login" id="student-portal-login">
	<div class="portal-login-container">
		<div class="portal-login-header">
			<h2><?php esc_html_e( 'بوابة الطالب', 'novira-academy' ); ?></h2>
			<p><?php esc_html_e( 'سجل الدخول للوصول إلى حسابك', 'novira-academy' ); ?></p>
		</div>
		
		<div class="portal-login-form">
			<form id="student-login-form" method="post">
				<?php wp_nonce_field( 'novira_student_login', 'novira_student_login_nonce' ); ?>
				
				<div class="form-group">
					<label for="student-email"><?php esc_html_e( 'البريد الإلكتروني', 'novira-academy' ); ?></label>
					<input type="email" id="student-email" name="student_email" required>
				</div>
				
				<div class="form-group">
					<label for="student-password"><?php esc_html_e( 'كلمة المرور', 'novira-academy' ); ?></label>
					<input type="password" id="student-password" name="student_password" required>
				</div>
				
				<div class="form-group">
					<label class="checkbox-label">
						<input type="checkbox" name="remember_me" value="1">
						<span><?php esc_html_e( 'تذكرني', 'novira-academy' ); ?></span>
					</label>
				</div>
				
				<button type="submit" class="btn btn-primary btn-block">
					<?php esc_html_e( 'تسجيل الدخول', 'novira-academy' ); ?>
				</button>
				
				<div class="portal-login-links">
					<a href="#" class="forgot-password"><?php esc_html_e( 'نسيت كلمة المرور؟', 'novira-academy' ); ?></a>
				</div>
			</form>
		</div>
		
		<div class="portal-login-footer">
			<p><?php esc_html_e( 'ليس لديك حساب؟', 'novira-academy' ); ?>
				<a href="#" class="register-link"><?php esc_html_e( 'سجل الآن', 'novira-academy' ); ?></a>
			</p>
		</div>
	</div>
</div>
