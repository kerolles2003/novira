<?php
/**
 * Template Part: Programs Section
 *
 * Three program dossiers presented as a catalog of credentials.
 * Each card is styled like an official folder for its department,
 * with a colored tab, scannable bullet points, and a clear CTA.
 *
 * @package Novira_Academy
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$programs = array(
	array(
		'title'       => __( 'تنمية المهارات واللغات', 'novira-academy' ),
		'subtitle'    => __( 'للصغار والكبار', 'novira-academy' ),
		'desc'        => __( 'كورسات لغات ومهارات رقمية في مجموعات صغيرة مع فريق تدريسي متخصص.', 'novira-academy' ),
		'points'      => array(
			__( 'لغات عملية: إنجليزي، ألماني، فرنسي', 'novira-academy' ),
			__( 'مهارات رقمية: برمجة، ذكاء اصطناعي، تسويق', 'novira-academy' ),
			__( 'مجموعات صغيرة وفريق تدريسي متخصص', 'novira-academy' ),
		),
		'tags'        => array( 'English', 'German', 'Programming', 'AI' ),
		'link_text'   => __( 'استكشف البرامج', 'novira-academy' ),
		'link_url'    => home_url( '/services#languages' ),
		'image'       => get_template_directory_uri() . '/assets/images/services/courses.webp',
		'image_alt'   => __( 'طلاب يتعلمون المهارات الرقمية واللغات', 'novira-academy' ),
		'theme'       => 'blue',
	),
	array(
		'title'       => __( 'الترجمة المعتمدة', 'novira-academy' ),
		'subtitle'    => __( 'ورقك في أمان', 'novira-academy' ),
		'desc'        => __( 'نوفر خدمات ترجمة للمستندات الرسمية وفق المتطلبات المعمول بها.', 'novira-academy' ),
		'points'      => array(
			__( 'ترجمة معتمدة لجميع الوثائق الرسمية', 'novira-academy' ),
			__( 'ترجمة معتمدة وفق المتطلبات الرسمية', 'novira-academy' ),
			__( 'عدد كبير من اللغات بسرعة وسعر واضح', 'novira-academy' ),
		),
		'tags'        => array( __( 'السفارات', 'novira-academy' ), __( 'الجامعات', 'novira-academy' ), __( 'الحكومة', 'novira-academy' ), __( 'كل اللغات', 'novira-academy' ) ),
		'link_text'   => __( 'استكشف الخدمة', 'novira-academy' ),
		'link_url'    => home_url( '/services#translations' ),
		'image'       => get_template_directory_uri() . '/assets/images/services/translation.webp',
		'image_alt'   => __( 'ترجمة معتمدة للوثائق الرسمية', 'novira-academy' ),
		'theme'       => 'gold',
	),
	array(
		'title'       => __( 'الدبلومة الأمريكية', 'novira-academy' ),
		'subtitle'    => __( 'Novira Academy', 'novira-academy' ),
		'desc'        => __( 'برنامج ثلاث سنوات معتمد من Cognia يؤهّل طالبك لاختبار EST أو Digital SAT أو ACT حسب مساره الأكاديمي.', 'novira-academy' ),
		'points'      => array(
			__( 'برنامج معتمد دولياً من Cognia', 'novira-academy' ),
			__( 'ثلاثة اختبارات دولية: EST و Digital SAT و ACT', 'novira-academy' ),
			__( 'مسار يُختار حسب مستوى الطالب وهدفه', 'novira-academy' ),
		),
		'tags'        => array( 'EST', 'Digital SAT', 'ACT' ),
		'link_text'   => __( 'اعرف كيف يسير البرنامج', 'novira-academy' ),
		'link_url'    => home_url( '/services#diploma' ),
		'image'       => get_template_directory_uri() . '/assets/images/services/IG.webp',
		'image_alt'   => __( 'طلاب الدبلومة الأمريكية في نوفيرا أكاديمي', 'novira-academy' ),
		'theme'       => 'navy',
	),
);
?>

<section class="programs-academic relative py-20 lg:py-32 overflow-hidden bg-gray-50" id="programs" aria-label="<?php esc_attr_e( 'مجالات التخصص', 'novira-academy' ); ?>">
	<!-- Decorative background blob -->
	<div class="absolute top-0 right-0 -mr-32 -mt-32 w-96 h-96 rounded-full bg-brand-purple/5 blur-3xl pointer-events-none"></div>
	<div class="absolute bottom-0 left-0 -ml-32 -mb-32 w-[500px] h-[500px] rounded-full bg-electric-violet/5 blur-3xl pointer-events-none"></div>

	<div class="max-w-7xl mx-auto px-5 lg:px-8 relative z-10">

		<!-- Section header -->
		<div class="text-center max-w-3xl mx-auto mb-16 lg:mb-24 reveal-up">
			<span class="inline-block px-4 py-1.5 rounded-full bg-brand-purple/10 text-brand-purple font-label-sm text-sm font-bold tracking-wide mb-4">
				<?php esc_html_e( 'مجالات التخصص', 'novira-academy' ); ?>
			</span>
			<h2 class="font-h1 text-4xl md:text-5xl font-black text-brand-dark mb-6 leading-tight">
				<?php esc_html_e( 'ما الذي يحتاجه طالبك؟', 'novira-academy' ); ?>
			</h2>
			<p class="font-body-lg text-lg text-gray-600 leading-relaxed">
				<?php esc_html_e( 'ثلاثة تخصصات أكاديمية متكاملة — لغات ومهارات، ترجمة معتمدة، وإعداد للدبلومة الأمريكية.', 'novira-academy' ); ?>
			</p>
		</div>

		<!-- Dossier grid -->
		<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 lg:gap-10">

			<?php foreach ( $programs as $index => $program ) : 
				// Determine colors based on theme
				$theme_color_bg = 'bg-brand-purple';
				$theme_color_text = 'text-brand-purple';
				$theme_color_light = 'bg-brand-purple/10';
				$theme_hover_ring = 'group-hover:ring-brand-purple/30';
				
				if ( 'gold' === $program['theme'] ) {
					$theme_color_bg = 'bg-yellow-500';
					$theme_color_text = 'text-gold-accessible';
					$theme_color_light = 'bg-yellow-500/10';
					$theme_hover_ring = 'group-hover:ring-yellow-500/30';
				} elseif ( 'navy' === $program['theme'] ) {
					$theme_color_bg = 'bg-blue-600';
					$theme_color_text = 'text-blue-600';
					$theme_color_light = 'bg-blue-600/10';
					$theme_hover_ring = 'group-hover:ring-blue-600/30';
				}
			?>
			<article class="group relative bg-white rounded-2xl shadow-xl shadow-gray-200/50 hover:shadow-2xl hover:-translate-y-2 transition-all duration-500 flex flex-col overflow-hidden reveal-up" style="transition-delay: <?php echo esc_attr($index * 150); ?>ms;">
				
				<!-- Cover image -->
				<div class="relative w-full aspect-[4/3] overflow-hidden bg-gray-100">
					<img
						src="<?php echo esc_url( $program['image'] ); ?>"
						alt="<?php echo esc_attr( $program['image_alt'] ); ?>"
						class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700 ease-out"
						loading="lazy"
					>
					<div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-80"></div>
					
					<!-- Floating Icon -->
					<div class="absolute top-4 right-4 w-12 h-12 rounded-full bg-white shadow-lg flex items-center justify-center <?php echo esc_attr($theme_color_text); ?>">
						<?php if ( 'blue' === $program['theme'] ) : ?>
							<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
								<path d="M12 2a10 10 0 100 20 10 10 0 000-20z"/>
								<path d="M2 12h20"/>
								<path d="M12 2a15.3 15.3 0 010 20"/>
							</svg>
						<?php elseif ( 'gold' === $program['theme'] ) : ?>
							<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
								<path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/>
								<polyline points="14 2 14 8 20 8"/>
								<path d="M9 15l2 2 4-4"/>
							</svg>
						<?php else : ?>
							<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
								<path d="M22 10v6M2 10l10-5 10 5-10 5z"/>
								<path d="M6 12v5c3 3 9 3 12 0v-5"/>
							</svg>
						<?php endif; ?>
					</div>

					<div class="absolute bottom-4 left-4 right-4">
						<span class="inline-block px-3 py-1 bg-white/20 backdrop-blur-md border border-white/30 rounded-full text-white text-xs font-bold mb-2">
							<?php echo esc_html( $program['subtitle'] ); ?>
						</span>
						<h3 class="text-2xl font-bold font-h3 text-white leading-tight">
							<?php echo esc_html( $program['title'] ); ?>
						</h3>
					</div>
				</div>

				<!-- Body -->
				<div class="p-6 md:p-8 flex flex-col flex-grow">
					<p class="text-gray-600 mb-6 line-clamp-2">
						<?php echo esc_html( $program['desc'] ); ?>
					</p>

					<ul class="space-y-3 mb-8 flex-grow">
						<?php foreach ( $program['points'] as $point ) : ?>
							<li class="flex items-start gap-3">
								<svg class="w-5 h-5 mt-0.5 flex-shrink-0 <?php echo esc_attr($theme_color_text); ?>" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
								<span class="text-sm font-medium text-gray-700"><?php echo esc_html( $point ); ?></span>
							</li>
						<?php endforeach; ?>
					</ul>

					<div class="flex flex-wrap gap-2 mb-8">
						<?php foreach ( $program['tags'] as $tag ) : ?>
							<span class="px-2.5 py-1 rounded-md text-xs font-bold <?php echo esc_attr($theme_color_light . ' ' . $theme_color_text); ?>">
								<?php echo esc_html( $tag ); ?>
							</span>
						<?php endforeach; ?>
					</div>

					<a href="<?php echo esc_url( $program['link_url'] ); ?>" class="mt-auto flex items-center justify-center w-full gap-2 py-3.5 px-6 rounded-xl text-white font-bold transition-all duration-300 transform active:scale-95 <?php echo esc_attr($theme_color_bg); ?> hover:opacity-90 shadow-lg shadow-gray-200">
						<?php echo esc_html( $program['link_text'] ); ?>
						<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="transform group-hover:-translate-x-1 transition-transform"><path d="M19 12H5M12 19l-7-7 7-7"/></svg>
					</a>
				</div>
			</article>
			<?php endforeach; ?>

		</div>

	</div>
</section>

<style>
/* Reveal Animation Utilities */
.reveal-up {
	opacity: 0;
	transform: translateY(30px);
	transition-property: opacity, transform;
	transition-duration: 0.8s;
	transition-timing-function: cubic-bezier(0.16, 1, 0.3, 1);
}
.reveal-up.is-visible {
	opacity: 1;
	transform: translateY(0);
}
</style>

<script>
document.addEventListener('DOMContentLoaded', () => {
	const observer = new IntersectionObserver((entries) => {
		entries.forEach(entry => {
			if (entry.isIntersecting) {
				entry.target.classList.add('is-visible');
				observer.unobserve(entry.target);
			}
		});
	}, {
		threshold: 0.1,
		rootMargin: "0px 0px -50px 0px"
	});

	document.querySelectorAll('.reveal-up').forEach(el => observer.observe(el));
});
</script>
