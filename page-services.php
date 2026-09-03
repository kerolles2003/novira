<?php
/**
 * Template Name: خدماتنا
 */
get_header();
get_template_part( 'template-parts/page-hero', null, array(
	'title'    => __( 'خدماتنا', 'novira-academy' ),
	'subtitle' => __( 'كل اللي تحتاجه في مكان واحد', 'novira-academy' ),
) );
?>

<section class="services-intro-section">
	<div class="services-intro reveal">
		<div class="section-tag"><?php esc_html_e( 'ليه نوفيرا؟', 'novira-academy' ); ?></div>
		<h2 class="section-title"><?php esc_html_e( 'ثلاث خدمات.', 'novira-academy' ); ?><br><span class="hl"><?php esc_html_e( 'معيار واحد: التميز.', 'novira-academy' ); ?></span></h2>
		<p class="section-desc"><?php esc_html_e( 'من الكورسات التكنولوجية للصغار والكبار، للدبلومة الأمريكية المعتمدة، للترجمة الرسمية — كل خدماتنا بمعايير دولية.', 'novira-academy' ); ?></p>
	</div>
</section>

<section class="courses-section" id="courses">
	<div class="courses-grid reveal">
		<div class="course-detail-card">
			<div class="course-icon">🖥️</div>
			<h3><?php esc_html_e( 'برامج الكمبيوتر والتكنولوجيا', 'novira-academy' ); ?></h3>
			<p><?php esc_html_e( 'كورسات برمجة وتكنولوجيا مصممة للأطفال والكبار — من البداية للاحتراف.', 'novira-academy' ); ?></p>
			<ul class="course-list">
				<li><?php esc_html_e( 'Scratch & Python للأطفال', 'novira-academy' ); ?></li>
				<li>Web Development</li>
				<li><?php esc_html_e( 'Microsoft Office احترافي', 'novira-academy' ); ?></li>
				<li><?php esc_html_e( 'Graphic Design أساسيات', 'novira-academy' ); ?></li>
			</ul>
		</div>
		<div class="course-detail-card">
			<div class="course-icon">🗣️</div>
			<h3><?php esc_html_e( 'كورسات اللغات', 'novira-academy' ); ?></h3>
			<p><?php esc_html_e( 'تعلم لغة جديدة بأسلوب عملي وممتع مع مدرسين متخصصين.', 'novira-academy' ); ?></p>
			<ul class="course-list">
				<li><?php esc_html_e( 'اللغة الإنجليزية (جميع المستويات)', 'novira-academy' ); ?></li>
				<li><?php esc_html_e( 'اللغة الفرنسية', 'novira-academy' ); ?></li>
				<li><?php esc_html_e( 'تقوية القراءة والكتابة', 'novira-academy' ); ?></li>
				<li><?php esc_html_e( 'كورسات مكثفة للكبار', 'novira-academy' ); ?></li>
			</ul>
		</div>
	</div>
</section>

<?php get_template_part( 'template-parts/diploma' ); ?>
<?php get_template_part( 'template-parts/translation' ); ?>
<?php get_template_part( 'template-parts/cta' ); ?>

<?php get_footer(); ?>
