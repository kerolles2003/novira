<?php
/**
 * Template Part: Accreditations Section
 *
 * Presents accreditation partners. Redesigned with a clean white background
 * and premium gold borders.
 *
 * @package Novira_Academy
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

<section class="bg-white py-16 md:py-24" aria-label="<?php esc_attr_e( 'الاعتماد الأكاديمي', 'novira-academy' ); ?>">
	<div class="max-w-7xl mx-auto px-5 lg:px-lg">
		<header class="text-center mb-12 md:mb-16">
			<span class="inline-block text-[#d4af37] font-bold text-sm tracking-widest uppercase mb-3 bg-[#d4af37]/10 px-4 py-1 rounded-full border border-[#d4af37]/20">
				<?php esc_html_e( 'الاعتماد الأكاديمي', 'novira-academy' ); ?>
			</span>
			<h2 class="font-h1 text-3xl md:text-4xl lg:text-5xl font-bold text-text-dark">
				<?php esc_html_e( 'برنامج الدبلومة الأمريكية معتمد من Cognia', 'novira-academy' ); ?>
			</h2>
			<p class="font-body-lg text-base md:text-lg text-gray-600 max-w-2xl mx-auto mt-5 leading-relaxed">
				<?php esc_html_e( 'Cognia هي الهيئة الدولية الأكبر لاعتماد المؤسسات التعليمية في العالم. اعتمادنا منها ضمانة حقيقية لجودة التعليم اللي بنقدمه.', 'novira-academy' ); ?>
			</p>
		</header>

		<div class="max-w-3xl mx-auto grid grid-cols-1 sm:grid-cols-2 gap-6" role="list" aria-label="<?php esc_attr_e( 'جهة الاعتماد', 'novira-academy' ); ?>">

			<!-- Cognia -->
			<div class="bg-white border-2 border-[#d4af37] rounded-2xl p-8 w-full flex flex-col items-center justify-center gap-4 shadow-sm transition-all duration-300 hover:-translate-y-2 hover:shadow-[0_12px_30px_rgba(212,175,55,0.25)] group" role="listitem">
				<div class="h-28 w-full flex items-center justify-center">
					<img
						src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/accreditations/cognia.avif' ); ?>"
						alt="<?php esc_attr_e( 'Cognia', 'novira-academy' ); ?>"
						class="h-full w-auto object-contain grayscale opacity-70 transition-all duration-500 group-hover:grayscale-0 group-hover:opacity-100"
						loading="lazy"
					>
				</div>
				<span class="font-bold text-text-dark/80 tracking-wide text-sm uppercase">
					<?php esc_html_e( 'Cognia', 'novira-academy' ); ?>
				</span>
			</div>

			<!-- Cambridge -->
			<div class="bg-white border-2 border-[#d4af37] rounded-2xl p-8 w-full flex flex-col items-center justify-center gap-4 shadow-sm transition-all duration-300 hover:-translate-y-2 hover:shadow-[0_12px_30px_rgba(212,175,55,0.25)] group" role="listitem">
				<div class="h-28 w-full flex items-center justify-center">
					<img
						src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/accreditations/cambridge.avif' ); ?>"
						alt="<?php esc_attr_e( 'Cambridge', 'novira-academy' ); ?>"
						class="h-full w-auto object-contain grayscale opacity-70 transition-all duration-500 group-hover:grayscale-0 group-hover:opacity-100"
						loading="lazy"
					>
				</div>
				<span class="font-bold text-text-dark/80 tracking-wide text-sm uppercase">
					<?php esc_html_e( 'Cambridge', 'novira-academy' ); ?>
				</span>
			</div>

		</div>
	</div>
</section>
