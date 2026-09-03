<?php
/**
 * Template Part: Registration Interest Form
 *
 * Form for American Diploma registration interest.
 * Includes client-side validation and AJAX submission.
 *
 * @package Novira_Academy
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

<form id="registration-interest-form" class="registration-form" method="post" action="">
	<?php wp_nonce_field( 'novira_registration_interest', 'registration_nonce' ); ?>
	
	<div class="form-row">
		<div class="form-group">
			<label for="parent-name"><?php esc_html_e( 'اسم ولي الأمر', 'novira-academy' ); ?> <span class="required">*</span></label>
			<input type="text" id="parent-name" name="parent_name" required>
		</div>

		<div class="form-group">
			<label for="student-name"><?php esc_html_e( 'اسم الطالب', 'novira-academy' ); ?> <span class="required">*</span></label>
			<input type="text" id="student-name" name="student_name" required>
		</div>
	</div>

	<div class="form-row">
		<div class="form-group">
			<label for="reg-email"><?php esc_html_e( 'البريد الإلكتروني', 'novira-academy' ); ?> <span class="required">*</span></label>
			<input type="email" id="reg-email" name="email" required>
		</div>

		<div class="form-group">
			<label for="reg-phone"><?php esc_html_e( 'رقم الهاتف', 'novira-academy' ); ?> <span class="required">*</span></label>
			<input type="tel" id="reg-phone" name="phone" required>
		</div>
	</div>

	<div class="form-row">
		<div class="form-group">
			<label for="student-age"><?php esc_html_e( 'عمر الطالب', 'novira-academy' ); ?> <span class="required">*</span></label>
			<input type="number" id="student-age" name="student_age" min="5" max="18" required>
		</div>

		<div class="form-group">
			<label for="current-grade"><?php esc_html_e( 'المستوى الدراسي الحالي', 'novira-academy' ); ?></label>
			<select id="current-grade" name="current_grade">
				<option value=""><?php esc_html_e( 'اختر المستوى', 'novira-academy' ); ?></option>
				<option value="kg"><?php esc_html_e( 'روضة', 'novira-academy' ); ?></option>
				<option value="g1"><?php esc_html_e( 'الصف الأول', 'novira-academy' ); ?></option>
				<option value="g2"><?php esc_html_e( 'الصف الثاني', 'novira-academy' ); ?></option>
				<option value="g3"><?php esc_html_e( 'الصف الثالث', 'novira-academy' ); ?></option>
				<option value="g4"><?php esc_html_e( 'الصف الرابع', 'novira-academy' ); ?></option>
				<option value="g5"><?php esc_html_e( 'الصف الخامس', 'novira-academy' ); ?></option>
				<option value="g6"><?php esc_html_e( 'الصف السادس', 'novira-academy' ); ?></option>
				<option value="g7"><?php esc_html_e( 'الصف السابع', 'novira-academy' ); ?></option>
				<option value="g8"><?php esc_html_e( 'الصف الثامن', 'novira-academy' ); ?></option>
				<option value="g9"><?php esc_html_e( 'الصف التاسع', 'novira-academy' ); ?></option>
				<option value="g10"><?php esc_html_e( 'الصف العاشر', 'novira-academy' ); ?></option>
				<option value="g11"><?php esc_html_e( 'الصف الحادي عشر', 'novira-academy' ); ?></option>
				<option value="g12"><?php esc_html_e( 'الصف الثاني عشر', 'novira-academy' ); ?></option>
			</select>
		</div>
	</div>

	<div class="form-group">
		<label for="program-interest"><?php esc_html_e( 'البرنامج المطلوب', 'novira-academy' ); ?> <span class="required">*</span></label>
		<select id="program-interest" name="program_interest" required>
			<option value=""><?php esc_html_e( 'اختر البرنامج', 'novira-academy' ); ?></option>
			<option value="full-time"><?php esc_html_e( 'الدبلوم الأمريكي بدوام كامل', 'novira-academy' ); ?></option>
			<option value="part-time"><?php esc_html_e( 'الدبلوم الأمريكي بدوام جزئي', 'novira-academy' ); ?></option>
			<option value="summer"><?php esc_html_e( 'برنامج الصيف', 'novira-academy' ); ?></option>
		</select>
	</div>

	<div class="form-group">
		<label for="additional-notes"><?php esc_html_e( 'ملاحظات إضافية', 'novira-academy' ); ?></label>
		<textarea id="additional-notes" name="additional_notes" rows="3" placeholder="<?php esc_attr_e( 'أي معلومات إضافية عن الطالب...', 'novira-academy' ); ?>"></textarea>
	</div>

	<div class="form-submit">
		<button type="submit" class="btn btn-primary btn-lg">
			<?php esc_html_e( 'إرسال طلب الاهتمام', 'novira-academy' ); ?>
			<span class="btn-icon" aria-hidden="true">
				<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
					<path d="M22 2L11 13"/>
					<path d="M22 2l-7 20-4-9-9-4z"/>
				</svg>
			</span>
		</button>
		<p class="form-note"><?php esc_html_e( 'سنتواصل معك خلال 24 ساعة لتحديد موعد مقابلة.', 'novira-academy' ); ?></p>
	</div>
</form>

<div id="reg-form-success" class="form-message form-success" style="display: none;">
	<span class="message-icon" aria-hidden="true">
		<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
			<path d="M22 11.08V12a10 10 0 11-5.93-9.14"/>
			<path d="M22 4L12 14.01l-3-3"/>
		</svg>
	</span>
	<h3><?php esc_html_e( 'تم استلام طلبك بنجاح!', 'novira-academy' ); ?></h3>
	<p><?php esc_html_e( 'سنتواصل معك قريباً لتحديد موعد مقابلة. شكراً لاهتمامك بالدبلوم الأمريكي.', 'novira-academy' ); ?></p>
</div>

<div id="reg-form-error" class="form-message form-error" style="display: none;">
	<span class="message-icon" aria-hidden="true">
		<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
			<circle cx="12" cy="12" r="10"/>
			<path d="M15 9l-6 6M9 9l6 6"/>
		</svg>
	</span>
	<h3><?php esc_html_e( 'حدث خطأ', 'novira-academy' ); ?></h3>
	<p><?php esc_html_e( 'يرجى المحاولة مرة أخرى أو التواصل معنا مباشرة على واتساب.', 'novira-academy' ); ?></p>
</div>
