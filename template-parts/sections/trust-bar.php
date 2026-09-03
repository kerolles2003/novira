<?php
/**
 * Template Part: Trust Bar (Stitch Pixel-Perfect)
 *
 * Glass panel trust indicators matching the Stitch design.
 * Source: Stitch Project ID 10612256545289588306, Screen b108730878cf4f30b387c008d17a0ee2
 *
 * @package Novira_Academy
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

<section class="trust-bar" aria-label="<?php esc_attr_e( 'مؤشرات الثقة', 'novira-academy' ); ?>">
	<div class="trust-bar__container">
		<div class="trust-bar__panel">
			<div class="trust-bar__grid">
				<div class="trust-bar__item">
					<div class="trust-bar__icon-wrapper">
						<span class="material-symbols-outlined">workspace_premium</span>
					</div>
					<span class="trust-bar__text"><?php esc_html_e( 'برامج تعليمية متخصصة', 'novira-academy' ); ?></span>
				</div>
				<div class="trust-bar__item">
					<div class="trust-bar__icon-wrapper">
						<span class="material-symbols-outlined">group</span>
					</div>
					<span class="trust-bar__text"><?php esc_html_e( 'فريق تدريسي متخصص', 'novira-academy' ); ?></span>
				</div>
				<div class="trust-bar__item">
					<div class="trust-bar__icon-wrapper">
						<span class="material-symbols-outlined">location_on</span>
					</div>
					<span class="trust-bar__text"><?php esc_html_e( 'من قلب المنيا', 'novira-academy' ); ?></span>
				</div>
				<div class="trust-bar__item">
					<div class="trust-bar__icon-wrapper">
						<span class="material-symbols-outlined">handyman</span>
					</div>
					<span class="trust-bar__text"><?php esc_html_e( 'تدريب عملي وتطبيقي', 'novira-academy' ); ?></span>
				</div>
				<div class="trust-bar__item">
					<div class="trust-bar__icon-wrapper">
						<span class="material-symbols-outlined">support_agent</span>
					</div>
					<span class="trust-bar__text"><?php esc_html_e( 'دعم أكاديمي مستمر', 'novira-academy' ); ?></span>
				</div>
				<div class="trust-bar__item">
					<div class="trust-bar__icon-wrapper">
						<span class="material-symbols-outlined">route</span>
					</div>
					<span class="trust-bar__text"><?php esc_html_e( 'متابعة أكاديمية لكل طالب', 'novira-academy' ); ?></span>
				</div>
			</div>
		</div>
	</div>
</section>
