<?php
/**
 * Template Part: Hero Section (Cinematic Carousel)
 *
 * @package Novira_Academy
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$whatsapp = get_theme_mod( 'novira_whatsapp', '201090600927' );
?>

<!-- Hero Carousel -->
<section class="relative w-full h-screen min-h-[600px] md:min-h-[800px] flex-grow overflow-hidden bg-black" aria-label="<?php esc_attr_e( 'Hero Carousel', 'novira-academy' ); ?>">
	<!-- Slides Container -->
	<div class="absolute inset-0 w-full h-full" id="carousel">
		<!-- Slide 1 -->
		<div class="carousel-slide active w-full h-full">
			<div class="bg-zoom absolute inset-0 bg-cover bg-center bg-no-repeat" style="background-image: url('<?php echo esc_url( get_template_directory_uri() . '/assets/images/gallery/caro_1.webp' ); ?>');"></div>
			<div class="absolute inset-0 bg-gradient-to-l from-black/80 via-black/40 to-transparent"></div>
			<div class="relative z-20 h-full max-w-7xl mx-auto px-5 lg:px-lg flex items-center justify-start">
				<div class="glass-card tilt-card bg-brand-purple/40 backdrop-blur-md border border-brand-light/20 shadow-lg rounded-xl p-6 md:p-xl max-w-2xl w-full text-right">
					<div class="reveal-item delay-1">
						<span class="inline-block bg-electric-violet/20 text-electric-violet border border-electric-violet/30 px-4 py-1 rounded-full font-label-sm text-label-sm mb-4 md:mb-6 font-bold tracking-wide">
							<?php esc_html_e( 'الدبلومة الأمريكية', 'novira-academy' ); ?>
</span>
					</div>
					<h1 class="reveal-item delay-2 font-h1 text-h1-mobile md:text-h1 text-on-primary font-bold mb-4 md:mb-6 text-glow leading-tight">
						<?php esc_html_e( 'نُعِدّ طالبك ليدخل الاختبار قادراً على أعلى درجة', 'novira-academy' ); ?>
					</h1>
					<p class="reveal-item delay-3 font-body-lg text-base md:text-body-lg text-on-primary/80 mb-5 md:mb-8 max-w-xl ml-auto">
						<?php esc_html_e( 'من Grade 10 حتى يوم الاختبار، نبني مستوى طالبك أسبوعياً مع معلمين متخصصين — لا مراجعة في اللحظة الأخيرة، بل استعداد يتحسّن باستمرار حتى يدخل الامتحان مستعداً فعلاً.', 'novira-academy' ); ?>
					</p>
					<div class="reveal-item delay-4 grid grid-cols-2 gap-3 md:gap-4 mb-5 md:mb-8 text-on-primary/90">
						<div class="flex items-center gap-2 justify-end">
							<span class="text-xs md:text-sm"><?php esc_html_e( 'حصص أسبوعية مع معلمين متخصصين لبناء الفهم', 'novira-academy' ); ?></span>
							<span class="material-symbols-outlined text-electric-violet text-lg">check_circle</span>
						</div>
						<div class="flex items-center gap-2 justify-end">
							<span class="text-xs md:text-sm"><?php esc_html_e( 'اختبارات تجريبية تقيس جاهزيته قبل الموعد', 'novira-academy' ); ?></span>
							<span class="material-symbols-outlined text-electric-violet text-lg">check_circle</span>
						</div>
						<div class="flex items-center gap-2 justify-end">
							<span class="text-xs md:text-sm"><?php esc_html_e( 'متابعة دورية ترفع مستواه خطوة بخطوة', 'novira-academy' ); ?></span>
							<span class="material-symbols-outlined text-electric-violet text-lg">check_circle</span>
						</div>
					</div>
					<div class="reveal-item delay-4 flex flex-wrap gap-2 justify-end mb-6 md:mb-10">
						<span class="px-3 py-1 bg-white/5 border border-white/10 rounded-full text-xs text-white/70">EST</span>
						<span class="px-3 py-1 bg-white/5 border border-white/10 rounded-full text-xs text-white/70">Digital SAT</span>
						<span class="px-3 py-1 bg-white/5 border border-white/10 rounded-full text-xs text-white/70">ACT</span>
					</div>
					<div class="reveal-item delay-5 flex flex-row-reverse gap-3 md:gap-4">
						<a href="<?php echo esc_url( home_url( '/american-diploma' ) ); ?>" class="bg-gradient-to-r from-electric-violet to-deep-royal-purple text-white px-6 py-3 md:px-8 md:py-4 rounded-full font-bold transition-all duration-300 btn-glow flex-1 md:flex-none text-center inline-block text-sm md:text-base">
							<?php esc_html_e( 'اكتشف البرنامج', 'novira-academy' ); ?>
						</a>
						<a href="https://wa.me/<?php echo esc_attr( $whatsapp ); ?>" target="_blank" rel="noopener noreferrer" class="border border-white/30 hover:bg-white/10 text-white px-6 py-3 md:px-8 md:py-4 rounded-full font-bold transition-all duration-300 flex-1 md:flex-none text-center backdrop-blur-sm inline-block text-sm md:text-base">
							<?php esc_html_e( 'تواصل واتساب', 'novira-academy' ); ?>
						</a>
					</div>
				</div>
			</div>
		</div>
		
		<!-- Slide 2 -->
		<div class="carousel-slide w-full h-full">
			<div class="bg-zoom absolute inset-0 bg-cover bg-center bg-no-repeat" style="background-image: url('<?php echo esc_url( get_template_directory_uri() . '/assets/images/gallery/caro_2.webp' ); ?>');"></div>
			<div class="absolute inset-0 bg-gradient-to-l from-black/80 via-black/40 to-transparent"></div>
			<div class="relative z-20 h-full max-w-7xl mx-auto px-5 lg:px-lg flex items-center justify-start">
				<div class="glass-card tilt-card bg-brand-purple/40 backdrop-blur-md border border-brand-light/20 shadow-lg rounded-xl p-6 md:p-xl max-w-2xl w-full text-right">
					<div class="reveal-item delay-1">
						<span class="inline-block bg-bright-blue/20 text-bright-blue border border-bright-blue/30 px-4 py-1 rounded-full font-label-sm text-label-sm mb-4 md:mb-6 font-bold tracking-wide">
							<?php esc_html_e( 'الترجمة المعتمدة', 'novira-academy' ); ?>
						</span>
					</div>
					<h2 class="reveal-item delay-2 font-h1 text-h1-mobile md:text-h1 text-on-primary font-bold mb-4 md:mb-6 text-glow leading-tight">
						<?php esc_html_e( 'ورقك في أمان', 'novira-academy' ); ?>
					</h2>
					<p class="reveal-item delay-3 font-body-lg text-base md:text-body-lg text-on-primary/80 mb-5 md:mb-8 max-w-xl ml-auto">
						<?php esc_html_e( 'نوفر خدمات ترجمة للمستندات الرسمية وفق المتطلبات المعمول بها.', 'novira-academy' ); ?>
					</p>
					<div class="reveal-item delay-4 grid grid-cols-2 gap-3 md:gap-4 mb-5 md:mb-8 text-on-primary/90">
						<div class="flex items-center gap-2 justify-end">
							<span class="text-xs md:text-sm"><?php esc_html_e( 'ترجمة معتمدة لجميع الوثائق الرسمية', 'novira-academy' ); ?></span>
							<span class="material-symbols-outlined text-bright-blue text-lg">check_circle</span>
						</div>
						<div class="flex items-center gap-2 justify-end">
							<span class="text-xs md:text-sm"><?php esc_html_e( 'ترجمة معتمدة وفق المتطلبات الرسمية', 'novira-academy' ); ?></span>
							<span class="material-symbols-outlined text-bright-blue text-lg">check_circle</span>
						</div>
						<div class="flex items-center gap-2 justify-end">
							<span class="text-xs md:text-sm"><?php esc_html_e( 'عدد كبير من اللغات', 'novira-academy' ); ?></span>
							<span class="material-symbols-outlined text-bright-blue text-lg">check_circle</span>
						</div>
						<div class="flex items-center gap-2 justify-end">
							<span class="text-xs md:text-sm"><?php esc_html_e( 'سرعة ودقة وجودة', 'novira-academy' ); ?></span>
							<span class="material-symbols-outlined text-bright-blue text-lg">check_circle</span>
						</div>
					</div>
					<div class="reveal-item delay-4 flex flex-wrap gap-2 justify-end mb-6 md:mb-10">
						<span class="px-3 py-1 bg-white/5 border border-white/10 rounded-full text-xs text-white/70"><?php esc_html_e( 'السفارات', 'novira-academy' ); ?></span>
						<span class="px-3 py-1 bg-white/5 border border-white/10 rounded-full text-xs text-white/70"><?php esc_html_e( 'الجامعات', 'novira-academy' ); ?></span>
						<span class="px-3 py-1 bg-white/5 border border-white/10 rounded-full text-xs text-white/70"><?php esc_html_e( 'الحكومة', 'novira-academy' ); ?></span>
						<span class="px-3 py-1 bg-white/5 border border-white/10 rounded-full text-xs text-white/70"><?php esc_html_e( 'كل اللغات', 'novira-academy' ); ?></span>
					</div>
					<div class="reveal-item delay-5 flex flex-row-reverse gap-3 md:gap-4">
						<a href="<?php echo esc_url( home_url( '/translation' ) ); ?>" class="bg-gradient-to-r from-bright-blue to-tertiary-container text-white px-6 py-3 md:px-8 md:py-4 rounded-full font-bold transition-transform duration-300 shadow-[0_0_30px_rgba(33,150,255,0.4)] hover:shadow-[0_0_50px_rgba(33,150,255,0.6)] hover:scale-105 flex-1 md:flex-none text-center inline-block text-sm md:text-base">
							<?php esc_html_e( 'استكشف الخدمة', 'novira-academy' ); ?>
						</a>
						<a href="https://wa.me/<?php echo esc_attr( $whatsapp ); ?>" target="_blank" rel="noopener noreferrer" class="border border-white/30 hover:bg-white/10 text-white px-6 py-3 md:px-8 md:py-4 rounded-full font-bold transition-all duration-300 flex-1 md:flex-none text-center backdrop-blur-sm inline-block text-sm md:text-base">
							<?php esc_html_e( 'تواصل واتساب', 'novira-academy' ); ?>
						</a>
					</div>
				</div>
			</div>
		</div>

		<!-- Slide 3 -->
		<div class="carousel-slide w-full h-full">
			<div class="bg-zoom absolute inset-0 bg-cover bg-center bg-no-repeat" style="background-image: url('<?php echo esc_url( get_template_directory_uri() . '/assets/images/gallery/8.avif' ); ?>');"></div>
			<div class="absolute inset-0 bg-gradient-to-l from-black/80 via-black/40 to-transparent"></div>
			<div class="relative z-20 h-full max-w-7xl mx-auto px-5 lg:px-lg flex items-center justify-start">
				<div class="glass-card tilt-card bg-brand-purple/40 backdrop-blur-md border border-brand-light/20 shadow-lg rounded-xl p-6 md:p-xl max-w-2xl w-full text-right">
					<div class="reveal-item delay-1">
						<span class="inline-block bg-success/20 text-success border border-success/30 px-4 py-1 rounded-full font-label-sm text-label-sm mb-4 md:mb-6 font-bold tracking-wide">
							<?php esc_html_e( 'تنمية المهارات واللغات', 'novira-academy' ); ?>
						</span>
					</div>
					<h2 class="reveal-item delay-2 font-h1 text-h1-mobile md:text-h1 text-on-primary font-bold mb-4 md:mb-6 text-glow leading-tight">
						<?php esc_html_e( 'لغات ومهارات بتدريب عملي', 'novira-academy' ); ?>
					</h2>
					<p class="reveal-item delay-3 font-body-lg text-base md:text-body-lg text-on-primary/80 mb-5 md:mb-8 max-w-xl ml-auto">
						<?php esc_html_e( 'كورسات لغات ومهارات رقمية في مجموعات صغيرة مع فريق تدريسي متخصص.', 'novira-academy' ); ?>
					</p>
					<div class="reveal-item delay-4 grid grid-cols-2 gap-3 md:gap-4 mb-5 md:mb-8 text-on-primary/90">
						<div class="flex items-center gap-2 justify-end">
							<span class="text-xs md:text-sm"><?php esc_html_e( 'إنجليزي - ألماني - فرنسي', 'novira-academy' ); ?></span>
							<span class="material-symbols-outlined text-success text-lg">check_circle</span>
						</div>
						<div class="flex items-center gap-2 justify-end">
							<span class="text-xs md:text-sm"><?php esc_html_e( 'برمجة - ذكاء اصطناعي - تسويق', 'novira-academy' ); ?></span>
							<span class="material-symbols-outlined text-success text-lg">check_circle</span>
						</div>
						<div class="flex items-center gap-2 justify-end">
							<span class="text-xs md:text-sm"><?php esc_html_e( 'مجموعات صغيرة', 'novira-academy' ); ?></span>
							<span class="material-symbols-outlined text-success text-lg">check_circle</span>
						</div>
						<div class="flex items-center gap-2 justify-end">
							<span class="text-xs md:text-sm"><?php esc_html_e( 'فريق تدريسي متخصص', 'novira-academy' ); ?></span>
							<span class="material-symbols-outlined text-success text-lg">check_circle</span>
						</div>
					</div>
					<div class="reveal-item delay-4 flex flex-wrap gap-2 justify-end mb-6 md:mb-10">
						<span class="px-3 py-1 bg-white/5 border border-white/10 rounded-full text-xs text-white/70">English</span>
						<span class="px-3 py-1 bg-white/5 border border-white/10 rounded-full text-xs text-white/70">German</span>
						<span class="px-3 py-1 bg-white/5 border border-white/10 rounded-full text-xs text-white/70">Programming</span>
						<span class="px-3 py-1 bg-white/5 border border-white/10 rounded-full text-xs text-white/70">AI</span>
					</div>
					<div class="reveal-item delay-5 flex flex-row-reverse gap-3 md:gap-4">
						<a href="<?php echo esc_url( home_url( '/education' ) ); ?>" class="bg-gradient-to-r from-success to-emerald-700 text-white px-6 py-3 md:px-8 md:py-4 rounded-full font-bold transition-transform duration-300 shadow-[0_0_30px_rgba(16,185,129,0.4)] hover:shadow-[0_0_50px_rgba(16,185,129,0.6)] hover:scale-105 flex-1 md:flex-none text-center inline-block text-sm md:text-base">
							<?php esc_html_e( 'استكشف البرامج', 'novira-academy' ); ?>
						</a>
						<a href="https://wa.me/<?php echo esc_attr( $whatsapp ); ?>" target="_blank" rel="noopener noreferrer" class="border border-white/30 hover:bg-white/10 text-white px-6 py-3 md:px-8 md:py-4 rounded-full font-bold transition-all duration-300 flex-1 md:flex-none text-center backdrop-blur-sm inline-block text-sm md:text-base">
							<?php esc_html_e( 'تواصل واتساب', 'novira-academy' ); ?>
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Carousel Controls -->
	<div class="absolute bottom-10 left-0 right-0 z-30 flex justify-center items-center gap-8 max-w-7xl mx-auto px-5 lg:px-lg pointer-events-none">
		<div class="flex-1 flex justify-start pointer-events-auto">
			<button class="w-12 h-12 rounded-full border border-white/30 bg-black/20 backdrop-blur-md flex items-center justify-center text-white hover:bg-white/20 transition-transform duration-300 hover:scale-110 active:scale-95" id="prevBtn" aria-label="Previous Slide">
				<span class="material-symbols-outlined">arrow_forward</span>
			</button>
		</div>
		<div class="flex gap-3 pointer-events-auto h-3 items-center" id="dotsContainer">
			<button class="dot-wrapper dot-active relative h-3 w-3 rounded-full bg-white/30 overflow-hidden transition-all duration-300" data-index="0" aria-label="Slide 1">
				<div class="absolute inset-0 bg-electric-violet progress-fill shadow-[0_0_10px_rgba(123,44,255,0.8)]"></div>
			</button>
			<button class="dot-wrapper relative h-3 w-3 rounded-full bg-white/30 overflow-hidden transition-all duration-300" data-index="1" aria-label="Slide 2">
				<div class="absolute inset-0 bg-bright-blue progress-fill shadow-[0_0_10px_rgba(33,150,255,0.8)]"></div>
			</button>
			<button class="dot-wrapper relative h-3 w-3 rounded-full bg-white/30 overflow-hidden transition-all duration-300" data-index="2" aria-label="Slide 3">
				<div class="absolute inset-0 bg-success progress-fill shadow-[0_0_10px_rgba(16,185,129,0.8)]"></div>
			</button>
		</div>
		<div class="flex-1 flex justify-end pointer-events-auto">
			<button class="w-12 h-12 rounded-full border border-white/30 bg-black/20 backdrop-blur-md flex items-center justify-center text-white hover:bg-white/20 transition-transform duration-300 hover:scale-110 active:scale-95" id="nextBtn" aria-label="Next Slide">
				<span class="material-symbols-outlined">arrow_back</span>
			</button>
		</div>
	</div>
</section>
