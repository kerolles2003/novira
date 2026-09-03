<?php
/**
 * Custom Fields for Department Pages
 *
 * Registers custom meta boxes for department-specific content.
 * Uses WordPress native custom fields (no plugins required).
 *
 * @package Novira_Academy
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Enqueue admin assets for meta boxes.
 */
function novira_admin_meta_box_assets( $hook ) {
	$allowed = array( 'post.php', 'post-new.php', 'page.php', 'page-new.php' );
	if ( ! in_array( $hook, $allowed, true ) ) {
		return;
	}

	wp_enqueue_style(
		'novira-admin-meta-boxes',
		get_template_directory_uri() . '/assets/css/admin/meta-boxes.css',
		array(),
		NOVIRA_VERSION
	);

	wp_enqueue_script(
		'novira-admin-meta-boxes',
		get_template_directory_uri() . '/assets/js/admin/meta-boxes.js',
		array(),
		NOVIRA_VERSION,
		true
	);

	wp_localize_script( 'novira-admin-meta-boxes', 'noviraMetaBoxLabels', array(
		'program_name'       => __( 'اسم البرنامج:', 'novira-academy' ),
		'program_desc'       => __( 'الوصف:', 'novira-academy' ),
		'program_duration'   => __( 'المدة:', 'novira-academy' ),
		'program_reqs'       => __( 'المتطلبات (سطر لكل متطلب):', 'novira-academy' ),
		'remove'             => __( 'إزالة', 'novira-academy' ),
		'course_name'        => __( 'اسم الكورس:', 'novira-academy' ),
		'course_schedule'    => __( 'الجدول:', 'novira-academy' ),
		'service_type'       => __( 'نوع الخدمة:', 'novira-academy' ),
		'service_turnaround' => __( 'وقت التسليم:', 'novira-academy' ),
		'pricing_service'    => __( 'الخدمة:', 'novira-academy' ),
		'pricing_price'      => __( 'السعر:', 'novira-academy' ),
		'pricing_includes'   => __( 'الاشتمالات (سطر لكل اشتمالية):', 'novira-academy' ),
		'curriculum_subject' => __( 'المادة:', 'novira-academy' ),
		'curriculum_grades'  => __( 'المستويات:', 'novira-academy' ),
		'curriculum_hours'   => __( 'الحصص:', 'novira-academy' ),
	) );
}
add_action( 'admin_enqueue_scripts', 'novira_admin_meta_box_assets' );

/**
 * Add custom meta boxes for department pages
 */
function novira_add_department_meta_boxes() {
	add_meta_box(
		'novira_education_programs',
		__( 'برامج التعليم', 'novira-academy' ),
		'novira_education_programs_callback',
		'page',
		'normal',
		'high'
	);

	add_meta_box(
		'novira_education_courses',
		__( 'الكورسات', 'novira-academy' ),
		'novira_education_courses_callback',
		'page',
		'normal',
		'high'
	);

	add_meta_box(
		'novira_translation_services',
		__( 'خدمات الترجمة', 'novira-academy' ),
		'novira_translation_services_callback',
		'page',
		'normal',
		'high'
	);

	add_meta_box(
		'novira_translation_pricing',
		__( 'أسعار الترجمة', 'novira-academy' ),
		'novira_translation_pricing_callback',
		'page',
		'normal',
		'high'
	);

	add_meta_box(
		'novira_diploma_curriculum',
		__( 'منهج الدبلوم الأمريكي', 'novira-academy' ),
		'novira_diploma_curriculum_callback',
		'page',
		'normal',
		'high'
	);

	add_meta_box(
		'novira_diploma_admission',
		__( 'قبول الدبلوم الأمريكي', 'novira-academy' ),
		'novira_diploma_admission_callback',
		'page',
		'normal',
		'high'
	);
}
add_action( 'add_meta_boxes', 'novira_add_department_meta_boxes' );

/**
 * Education Programs meta box callback
 */
function novira_education_programs_callback( $post ) {
	wp_nonce_field( 'novira_education_programs_nonce', 'novira_education_programs_nonce_field' );

	$programs = get_post_meta( $post->ID, '_education_programs', true );
	if ( empty( $programs ) ) {
		$programs = array(
			array(
				'title'        => '',
				'description'  => '',
				'duration'     => '',
				'requirements' => '',
			),
		);
	}
	?>
	<div id="programs-container">
		<?php foreach ( $programs as $index => $program ) : ?>
			<div class="novira-repeater-item program-row">
				<label><?php esc_html_e( 'اسم البرنامج:', 'novira-academy' ); ?></label>
				<input type="text" name="education_programs[<?php echo esc_attr( $index ); ?>][title]" value="<?php echo esc_attr( $program['title'] ); ?>">

				<label><?php esc_html_e( 'الوصف:', 'novira-academy' ); ?></label>
				<textarea name="education_programs[<?php echo esc_attr( $index ); ?>][description]"><?php echo esc_textarea( $program['description'] ); ?></textarea>

				<label><?php esc_html_e( 'المدة:', 'novira-academy' ); ?></label>
				<input type="text" name="education_programs[<?php echo esc_attr( $index ); ?>][duration]" value="<?php echo esc_attr( $program['duration'] ); ?>">

				<label><?php esc_html_e( 'المتطلبات (سطر لكل متطلب):', 'novira-academy' ); ?></label>
				<textarea name="education_programs[<?php echo esc_attr( $index ); ?>][requirements]"><?php echo esc_textarea( is_array( $program['requirements'] ) ? implode( "\n", $program['requirements'] ) : $program['requirements'] ); ?></textarea>

				<button type="button" class="button button-secondary novira-remove-item"><?php esc_html_e( 'إزالة', 'novira-academy' ); ?></button>
			</div>
		<?php endforeach; ?>
	</div>
	<button type="button" class="button button-primary novira-add-item" data-group="programs"><?php esc_html_e( '+ إضافة برنامج', 'novira-academy' ); ?></button>
	<?php
}

/**
 * Education Courses meta box callback
 */
function novira_education_courses_callback( $post ) {
	wp_nonce_field( 'novira_education_courses_nonce', 'novira_education_courses_nonce_field' );

	$courses = get_post_meta( $post->ID, '_education_courses', true );
	if ( empty( $courses ) ) {
		$courses = array(
			array(
				'title'       => '',
				'description' => '',
				'schedule'    => '',
			),
		);
	}
	?>
	<div id="courses-container">
		<?php foreach ( $courses as $index => $course ) : ?>
			<div class="novira-repeater-item course-row">
				<label><?php esc_html_e( 'اسم الكورس:', 'novira-academy' ); ?></label>
				<input type="text" name="education_courses[<?php echo esc_attr( $index ); ?>][title]" value="<?php echo esc_attr( $course['title'] ); ?>">

				<label><?php esc_html_e( 'الوصف:', 'novira-academy' ); ?></label>
				<textarea name="education_courses[<?php echo esc_attr( $index ); ?>][description]"><?php echo esc_textarea( $course['description'] ); ?></textarea>

				<label><?php esc_html_e( 'الجدول:', 'novira-academy' ); ?></label>
				<input type="text" name="education_courses[<?php echo esc_attr( $index ); ?>][schedule]" value="<?php echo esc_attr( $course['schedule'] ); ?>">

				<button type="button" class="button button-secondary novira-remove-item"><?php esc_html_e( 'إزالة', 'novira-academy' ); ?></button>
			</div>
		<?php endforeach; ?>
	</div>
	<button type="button" class="button button-primary novira-add-item" data-group="courses"><?php esc_html_e( '+ إضافة كورس', 'novira-academy' ); ?></button>
	<?php
}

/**
 * Translation Services meta box callback
 */
function novira_translation_services_callback( $post ) {
	wp_nonce_field( 'novira_translation_services_nonce', 'novira_translation_services_nonce_field' );

	$services = get_post_meta( $post->ID, '_translation_services', true );
	if ( empty( $services ) ) {
		$services = array(
			array(
				'type'        => '',
				'description' => '',
				'turnaround'  => '',
			),
		);
	}
	?>
	<div id="services-container">
		<?php foreach ( $services as $index => $service ) : ?>
			<div class="novira-repeater-item service-row">
				<label><?php esc_html_e( 'نوع الخدمة:', 'novira-academy' ); ?></label>
				<input type="text" name="translation_services[<?php echo esc_attr( $index ); ?>][type]" value="<?php echo esc_attr( $service['type'] ); ?>">

				<label><?php esc_html_e( 'الوصف:', 'novira-academy' ); ?></label>
				<textarea name="translation_services[<?php echo esc_attr( $index ); ?>][description]"><?php echo esc_textarea( $service['description'] ); ?></textarea>

				<label><?php esc_html_e( 'وقت التسليم:', 'novira-academy' ); ?></label>
				<input type="text" name="translation_services[<?php echo esc_attr( $index ); ?>][turnaround]" value="<?php echo esc_attr( $service['turnaround'] ); ?>">

				<button type="button" class="button button-secondary novira-remove-item"><?php esc_html_e( 'إزالة', 'novira-academy' ); ?></button>
			</div>
		<?php endforeach; ?>
	</div>
	<button type="button" class="button button-primary novira-add-item" data-group="services"><?php esc_html_e( '+ إضافة خدمة', 'novira-academy' ); ?></button>
	<?php
}

/**
 * Translation Pricing meta box callback
 */
function novira_translation_pricing_callback( $post ) {
	wp_nonce_field( 'novira_translation_pricing_nonce', 'novira_translation_pricing_nonce_field' );

	$pricing = get_post_meta( $post->ID, '_translation_pricing', true );
	if ( empty( $pricing ) ) {
		$pricing = array(
			array(
				'service'  => '',
				'price'    => '',
				'includes' => '',
			),
		);
	}
	?>
	<div id="pricing-container">
		<?php foreach ( $pricing as $index => $plan ) : ?>
			<div class="novira-repeater-item pricing-row">
				<label><?php esc_html_e( 'الخدمة:', 'novira-academy' ); ?></label>
				<input type="text" name="translation_pricing[<?php echo esc_attr( $index ); ?>][service]" value="<?php echo esc_attr( $plan['service'] ); ?>">

				<label><?php esc_html_e( 'السعر:', 'novira-academy' ); ?></label>
				<input type="text" name="translation_pricing[<?php echo esc_attr( $index ); ?>][price]" value="<?php echo esc_attr( $plan['price'] ); ?>">

				<label><?php esc_html_e( 'الاشتمالات (سطر لكل اشتمالية):', 'novira-academy' ); ?></label>
				<textarea name="translation_pricing[<?php echo esc_attr( $index ); ?>][includes]"><?php echo esc_textarea( is_array( $plan['includes'] ) ? implode( "\n", $plan['includes'] ) : $plan['includes'] ); ?></textarea>

				<button type="button" class="button button-secondary novira-remove-item"><?php esc_html_e( 'إزالة', 'novira-academy' ); ?></button>
			</div>
		<?php endforeach; ?>
	</div>
	<button type="button" class="button button-primary novira-add-item" data-group="pricing"><?php esc_html_e( '+ إضافة خطة سعر', 'novira-academy' ); ?></button>
	<?php
}

/**
 * Diploma Curriculum meta box callback
 */
function novira_diploma_curriculum_callback( $post ) {
	wp_nonce_field( 'novira_diploma_curriculum_nonce', 'novira_diploma_curriculum_nonce_field' );

	$curriculum = get_post_meta( $post->ID, '_diploma_curriculum', true );
	if ( empty( $curriculum ) ) {
		$curriculum = array(
			array(
				'subject'     => '',
				'grades'      => '',
				'hours'       => '',
				'description' => '',
			),
		);
	}
	?>
	<div id="curriculum-container">
		<?php foreach ( $curriculum as $index => $subject ) : ?>
			<div class="novira-repeater-item curriculum-row">
				<label><?php esc_html_e( 'المادة:', 'novira-academy' ); ?></label>
				<input type="text" name="diploma_curriculum[<?php echo esc_attr( $index ); ?>][subject]" value="<?php echo esc_attr( $subject['subject'] ); ?>">

				<label><?php esc_html_e( 'المستويات:', 'novira-academy' ); ?></label>
				<input type="text" name="diploma_curriculum[<?php echo esc_attr( $index ); ?>][grades]" value="<?php echo esc_attr( $subject['grades'] ); ?>">

				<label><?php esc_html_e( 'الحصص:', 'novira-academy' ); ?></label>
				<input type="text" name="diploma_curriculum[<?php echo esc_attr( $index ); ?>][hours]" value="<?php echo esc_attr( $subject['hours'] ); ?>">

				<label><?php esc_html_e( 'الوصف:', 'novira-academy' ); ?></label>
				<textarea name="diploma_curriculum[<?php echo esc_attr( $index ); ?>][description]"><?php echo esc_textarea( $subject['description'] ); ?></textarea>

				<button type="button" class="button button-secondary novira-remove-item"><?php esc_html_e( 'إزالة', 'novira-academy' ); ?></button>
			</div>
		<?php endforeach; ?>
	</div>
	<button type="button" class="button button-primary novira-add-item" data-group="curriculum"><?php esc_html_e( '+ إضافة مادة', 'novira-academy' ); ?></button>
	<?php
}

/**
 * Diploma Admission meta box callback
 */
function novira_diploma_admission_callback( $post ) {
	wp_nonce_field( 'novira_diploma_admission_nonce', 'novira_diploma_admission_nonce_field' );

	$admission = get_post_meta( $post->ID, '_diploma_admission', true );
	if ( empty( $admission ) ) {
		$admission = array(
			'deadlines' => array(),
			'documents' => array(),
		);
	}
	?>
	<div class="admission-row">
		<label><?php esc_html_e( 'المواعيد المهمة (سطر لكل موعد):', 'novira-academy' ); ?></label>
		<textarea name="diploma_admission[deadlines]" rows="4"><?php echo esc_textarea( is_array( $admission['deadlines'] ) ? implode( "\n", $admission['deadlines'] ) : '' ); ?></textarea>
	</div>
	<div class="admission-row">
		<label><?php esc_html_e( 'المستندات المطلوبة (سطر لكل مستند):', 'novira-academy' ); ?></label>
		<textarea name="diploma_admission[documents]" rows="4"><?php echo esc_textarea( is_array( $admission['documents'] ) ? implode( "\n", $admission['documents'] ) : '' ); ?></textarea>
	</div>
	<?php
}

/**
 * Save custom field data
 */
function novira_save_department_meta( $post_id ) {
	$nonce_fields = array(
		'novira_education_programs_nonce_field' => 'novira_education_programs_nonce',
		'novira_education_courses_nonce_field' => 'novira_education_courses_nonce',
		'novira_translation_services_nonce_field' => 'novira_translation_services_nonce',
		'novira_translation_pricing_nonce_field' => 'novira_translation_pricing_nonce',
		'novira_diploma_curriculum_nonce_field' => 'novira_diploma_curriculum_nonce',
		'novira_diploma_admission_nonce_field' => 'novira_diploma_admission_nonce',
	);

	$nonce_valid = false;
	foreach ( $nonce_fields as $field => $action ) {
		if ( isset( $_POST[ $field ] ) && wp_verify_nonce( $_POST[ $field ], $action ) ) {
			$nonce_valid = true;
			break;
		}
	}

	if ( ! $nonce_valid ) {
		return;
	}

	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}

	if ( ! current_user_can( 'edit_page', $post_id ) ) {
		return;
	}

	if ( isset( $_POST['education_programs'] ) ) {
		$programs = array();
		foreach ( $_POST['education_programs'] as $program ) {
			if ( ! empty( $program['title'] ) ) {
				$programs[] = array(
					'title'        => sanitize_text_field( $program['title'] ),
					'description'  => sanitize_textarea_field( $program['description'] ),
					'duration'     => sanitize_text_field( $program['duration'] ),
					'requirements' => array_filter( array_map( 'trim', explode( "\n", $program['requirements'] ) ) ),
				);
			}
		}
		update_post_meta( $post_id, '_education_programs', $programs );
	}

	if ( isset( $_POST['education_courses'] ) ) {
		$courses = array();
		foreach ( $_POST['education_courses'] as $course ) {
			if ( ! empty( $course['title'] ) ) {
				$courses[] = array(
					'title'       => sanitize_text_field( $course['title'] ),
					'description' => sanitize_textarea_field( $course['description'] ),
					'schedule'    => sanitize_text_field( $course['schedule'] ),
				);
			}
		}
		update_post_meta( $post_id, '_education_courses', $courses );
	}

	if ( isset( $_POST['translation_services'] ) ) {
		$services = array();
		foreach ( $_POST['translation_services'] as $service ) {
			if ( ! empty( $service['type'] ) ) {
				$services[] = array(
					'type'        => sanitize_text_field( $service['type'] ),
					'description' => sanitize_textarea_field( $service['description'] ),
					'turnaround'  => sanitize_text_field( $service['turnaround'] ),
				);
			}
		}
		update_post_meta( $post_id, '_translation_services', $services );
	}

	if ( isset( $_POST['translation_pricing'] ) ) {
		$pricing = array();
		foreach ( $_POST['translation_pricing'] as $plan ) {
			if ( ! empty( $plan['service'] ) ) {
				$pricing[] = array(
					'service'  => sanitize_text_field( $plan['service'] ),
					'price'    => sanitize_text_field( $plan['price'] ),
					'includes' => array_filter( array_map( 'trim', explode( "\n", $plan['includes'] ) ) ),
				);
			}
		}
		update_post_meta( $post_id, '_translation_pricing', $pricing );
	}

	if ( isset( $_POST['diploma_curriculum'] ) ) {
		$curriculum = array();
		foreach ( $_POST['diploma_curriculum'] as $subject ) {
			if ( ! empty( $subject['subject'] ) ) {
				$curriculum[] = array(
					'subject'     => sanitize_text_field( $subject['subject'] ),
					'grades'      => sanitize_text_field( $subject['grades'] ),
					'hours'       => sanitize_text_field( $subject['hours'] ),
					'description' => sanitize_textarea_field( $subject['description'] ),
				);
			}
		}
		update_post_meta( $post_id, '_diploma_curriculum', $curriculum );
	}

	if ( isset( $_POST['diploma_admission'] ) ) {
		$admission = array(
			'deadlines' => array_filter( array_map( 'trim', explode( "\n", $_POST['diploma_admission']['deadlines'] ?? '' ) ) ),
			'documents' => array_filter( array_map( 'trim', explode( "\n", $_POST['diploma_admission']['documents'] ?? '' ) ) ),
		);
		update_post_meta( $post_id, '_diploma_admission', $admission );
	}
}
add_action( 'save_post', 'novira_save_department_meta' );
