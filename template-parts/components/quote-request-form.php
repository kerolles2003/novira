<?php
/**
 * Template Part: Quote Request Form
 *
 * Form for requesting translation service quotes.
 * Includes client-side validation and AJAX submission.
 *
 * @package Novira_Academy
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

<form id="quote-request-form" class="quote-form" method="post" action="">
	<?php wp_nonce_field( 'novira_quote_request', 'quote_nonce' ); ?>
	
	<div class="form-row">
		<div class="form-group">
			<label for="company-name"><?php esc_html_e( 'اسم الشركة / الجهة', 'novira-academy' ); ?> <span class="required">*</span></label>
			<input type="text" id="company-name" name="company_name" required>
		</div>

		<div class="form-group">
			<label for="contact-person"><?php esc_html_e( 'اسم المسؤول', 'novira-academy' ); ?> <span class="required">*</span></label>
			<input type="text" id="contact-person" name="contact_person" required>
		</div>
	</div>

	<div class="form-row">
		<div class="form-group">
			<label for="email"><?php esc_html_e( 'البريد الإلكتروني', 'novira-academy' ); ?> <span class="required">*</span></label>
			<input type="email" id="email" name="email" required>
		</div>

		<div class="form-group">
			<label for="phone"><?php esc_html_e( 'رقم الهاتف', 'novira-academy' ); ?> <span class="required">*</span></label>
			<input type="tel" id="phone" name="phone" required>
		</div>
	</div>

	<div class="form-group">
		<label for="service-type"><?php esc_html_e( 'نوع الخدمة', 'novira-academy' ); ?> <span class="required">*</span></label>
		<select id="service-type" name="service_type" required>
			<option value=""><?php esc_html_e( 'اختر نوع الخدمة', 'novira-academy' ); ?></option>
			<option value="regular"><?php esc_html_e( 'ترجمة عادية', 'novira-academy' ); ?></option>
			<option value="certified"><?php esc_html_e( 'ترجمة معتمدة', 'novira-academy' ); ?></option>
			<option value="urgent"><?php esc_html_e( 'ترجمة عاجلة', 'novira-academy' ); ?></option>
			<option value="legal"><?php esc_html_e( 'ترجمة قانونية', 'novira-academy' ); ?></option>
			<option value="technical"><?php esc_html_e( 'ترجمة تقنية', 'novira-academy' ); ?></option>
		</select>
	</div>

	<div class="form-row">
		<div class="form-group">
			<label for="source-lang"><?php esc_html_e( 'اللغة المصدر', 'novira-academy' ); ?> <span class="required">*</span></label>
			<select id="source-lang" name="source_language" required>
				<option value=""><?php esc_html_e( 'اختر اللغة المصدر', 'novira-academy' ); ?></option>
				<option value="ar"><?php esc_html_e( 'العربية', 'novira-academy' ); ?></option>
				<option value="en"><?php esc_html_e( 'الإنجليزية', 'novira-academy' ); ?></option>
				<option value="fr"><?php esc_html_e( 'الفرنسية', 'novira-academy' ); ?></option>
				<option value="de"><?php esc_html_e( 'الألمانية', 'novira-academy' ); ?></option>
				<option value="es"><?php esc_html_e( 'الإسبانية', 'novira-academy' ); ?></option>
			</select>
		</div>

		<div class="form-group">
			<label for="target-lang"><?php esc_html_e( 'اللغة الهدف', 'novira-academy' ); ?> <span class="required">*</span></label>
			<select id="target-lang" name="target_language" required>
				<option value=""><?php esc_html_e( 'اختر اللغة الهدف', 'novira-academy' ); ?></option>
				<option value="ar"><?php esc_html_e( 'العربية', 'novira-academy' ); ?></option>
				<option value="en"><?php esc_html_e( 'الإنجليزية', 'novira-academy' ); ?></option>
				<option value="fr"><?php esc_html_e( 'الفرنسية', 'novira-academy' ); ?></option>
				<option value="de"><?php esc_html_e( 'الألمانية', 'novira-academy' ); ?></option>
				<option value="es"><?php esc_html_e( 'الإسبانية', 'novira-academy' ); ?></option>
			</select>
		</div>
	</div>

	<div class="form-group">
		<label for="page-count"><?php esc_html_e( 'عدد الصفحات (تقديري)', 'novira-academy' ); ?></label>
		<input type="number" id="page-count" name="page_count" min="1" value="1">
	</div>

	<div class="form-group">
		<label for="details"><?php esc_html_e( 'تفاصيل إضافية', 'novira-academy' ); ?></label>
		<textarea id="details" name="details" rows="4" placeholder="<?php esc_attr_e( 'اكتب أي تفاصيل إضافية حول طلبك...', 'novira-academy' ); ?>"></textarea>
	</div>

	<div class="form-group">
		<label for="deadline"><?php esc_html_e( 'الموعد المطلوب', 'novira-academy' ); ?></label>
		<input type="date" id="deadline" name="deadline">
	</div>

	<div class="form-submit">
		<button type="submit" class="btn btn-primary btn-lg">
			<?php esc_html_e( 'إرسال طلب عرض السعر', 'novira-academy' ); ?>
			<span class="btn-icon" aria-hidden="true">
				<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
					<path d="M22 2L11 13"/>
					<path d="M22 2l-7 20-4-9-9-4z"/>
				</svg>
			</span>
		</button>
		<p class="form-note"><?php esc_html_e( 'سنرد عليك خلال ساعة في أيام العمل.', 'novira-academy' ); ?></p>
	</div>
</form>

<div id="form-success" class="form-message form-success" style="display: none;">
	<span class="message-icon" aria-hidden="true">
		<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
			<path d="M22 11.08V12a10 10 0 11-5.93-9.14"/>
			<path d="M22 4L12 14.01l-3-3"/>
		</svg>
	</span>
	<h3><?php esc_html_e( 'تم إرسال طلبك بنجاح!', 'novira-academy' ); ?></h3>
	<p><?php esc_html_e( 'سنتواصل معك قريباً. شكراً لاهتمامك بخدماتنا.', 'novira-academy' ); ?></p>
</div>

<div id="form-error" class="form-message form-error" style="display: none;">
	<span class="message-icon" aria-hidden="true">
		<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
			<circle cx="12" cy="12" r="10"/>
			<path d="M15 9l-6 6M9 9l6 6"/>
		</svg>
	</span>
	<h3><?php esc_html_e( 'حدث خطأ', 'novira-academy' ); ?></h3>
	<p><?php esc_html_e( 'يرجى المحاولة مرة أخرى أو التواصل معنا مباشرة.', 'novira-academy' ); ?></p>
</div>
