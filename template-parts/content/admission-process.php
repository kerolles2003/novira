<?php
/**
 * Template Part: Admission Process Component
 *
 * Displays admission process steps and required documents.
 *
 * @package Novira_Academy
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Get data from template args
$deadlines = isset( $args['deadlines'] ) ? $args['deadlines'] : array();
$documents = isset( $args['documents'] ) ? $args['documents'] : array();
$steps     = isset( $args['steps'] ) ? $args['steps'] : array();

// Default steps if not provided
if ( empty( $steps ) ) {
	$steps = array(
		array(
			'title'       => __( 'تقديم طلب الالتحاق', 'novira-academy' ),
			'description' => __( 'املأ نموذج طلب الالتحاق عبر الإنترنت أو في الأكاديمية.', 'novira-academy' ),
		),
		array(
			'title'       => __( 'اختبار القبول', 'novira-academy' ),
			'description' => __( 'اختبار لتحديد المستوى الأكاديمي في اللغة الإنجليزية والرياضيات.', 'novira-academy' ),
		),
		array(
			'title'       => __( 'مقابلة شخصية', 'novira-academy' ),
			'description' => __( 'مقابلة مع الطالب وولي الأمر لمناقشةEXPECTATIONS.', 'novira-academy' ),
		),
		array(
			'title'       => __( 'القبول والتسجيل', 'novira-academy' ),
			'description' => __( 'استلام خط القبول وإتمام إجراءات التسجيل.', 'novira-academy' ),
		),
	);
}
?>

<div class="admission-process">
	<div class="process-steps">
		<h3 class="steps-title"><?php esc_html_e( 'خطوات القبول', 'novira-academy' ); ?></h3>
		<ol class="steps-list">
			<?php foreach ( $steps as $index => $step ) : ?>
				<li class="step-item">
					<span class="step-number" aria-hidden="true"><?php echo esc_html( $index + 1 ); ?></span>
					<div class="step-content">
						<h4 class="step-title"><?php echo esc_html( $step['title'] ); ?></h4>
						<p class="step-description"><?php echo esc_html( $step['description'] ); ?></p>
					</div>
				</li>
			<?php endforeach; ?>
		</ol>
	</div>

	<div class="process-info">
		<?php if ( ! empty( $deadlines ) ) : ?>
			<div class="info-box">
				<h4 class="info-title"><?php esc_html_e( 'مواعيد مهمة', 'novira-academy' ); ?></h4>
				<ul class="info-list">
					<?php foreach ( $deadlines as $deadline ) : ?>
						<li>
							<span class="info-icon" aria-hidden="true">
								<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
									<circle cx="12" cy="12" r="10"/>
									<path d="M12 6v6l4 2"/>
								</svg>
							</span>
							<?php echo esc_html( $deadline ); ?>
						</li>
					<?php endforeach; ?>
				</ul>
			</div>
		<?php endif; ?>

		<?php if ( ! empty( $documents ) ) : ?>
			<div class="info-box">
				<h4 class="info-title"><?php esc_html_e( 'المستندات المطلوبة', 'novira-academy' ); ?></h4>
				<ul class="info-list">
					<?php foreach ( $documents as $document ) : ?>
						<li>
							<span class="info-icon" aria-hidden="true">
								<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
									<path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/>
									<path d="M14 2v6h6"/>
								</svg>
							</span>
							<?php echo esc_html( $document ); ?>
						</li>
					<?php endforeach; ?>
				</ul>
			</div>
		<?php endif; ?>
	</div>
</div>
