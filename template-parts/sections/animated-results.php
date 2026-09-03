<?php
/**
 * Template Part: Animated Results Section
 *
 * @package Novira_Academy
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

<section class="animated-results-section relative bg-white">

<!-- Animated brand-colored aurora background (light theme) -->
<div class="results-aurora" aria-hidden="true">
	<span class="results-aurora__blob results-aurora__blob--a"></span>
	<span class="results-aurora__blob results-aurora__blob--b"></span>
	<span class="results-aurora__blob results-aurora__blob--c"></span>
</div>
<style>
	.animated-results-section { position: relative; }
	/* Soft lavender→white base; blobs are clipped to the section by overflow:hidden. */
	.animated-results-section > .results-aurora { position: absolute; inset: 0; z-index: 0; overflow: hidden; pointer-events: none; background: linear-gradient(180deg, #f7f4fe 0%, #ffffff 68%); }
	.animated-results-section .results-aurora__blob { position: absolute; border-radius: 50%; filter: blur(72px); opacity: .5; will-change: transform; }
	.animated-results-section .results-aurora__blob--a { width: min(620px, 48vw); aspect-ratio: 1; top: -9%; inset-inline-end: -6%; background: radial-gradient(circle, rgba(91, 20, 230, .30), transparent 68%); animation: results-aurora-a 22s ease-in-out infinite; }
	.animated-results-section .results-aurora__blob--b { width: min(540px, 42vw); aspect-ratio: 1; top: 20%; inset-inline-start: -8%; background: radial-gradient(circle, rgba(33, 150, 255, .26), transparent 68%); animation: results-aurora-b 27s ease-in-out infinite; }
	.animated-results-section .results-aurora__blob--c { width: min(560px, 44vw); aspect-ratio: 1; top: 46%; inset-inline-start: 40%; background: radial-gradient(circle, rgba(123, 44, 255, .24), transparent 68%); animation: results-aurora-c 24s ease-in-out infinite; }
	@keyframes results-aurora-a { 0%, 100% { transform: translate(0, 0) scale(1); } 50% { transform: translate(-7%, 9%) scale(1.12); } }
	@keyframes results-aurora-b { 0%, 100% { transform: translate(0, 0) scale(1); } 50% { transform: translate(9%, -7%) scale(1.1); } }
	@keyframes results-aurora-c { 0%, 100% { transform: translate(0, 0) scale(1); } 50% { transform: translate(-9%, -11%) scale(1.16); } }
	@media (prefers-reduced-motion: reduce) { .animated-results-section .results-aurora__blob { animation: none; } }
</style>
<!-- BEGIN: Main Content Section -->
<main class="w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 lg:py-24 relative">
<!-- BEGIN: Section Header -->
<header class="text-center mb-16 relative z-10 fade-up-enter stagger-1">
<div class="inline-flex items-center justify-center space-x-2 space-x-reverse bg-brand-light border border-brand-purple/20 rounded-full px-6 py-2 mb-6 hover:shadow-lg transition-shadow duration-300">
<svg class="w-5 h-5 text-brand-purple" fill="currentColor" viewBox="0 0 24 24">
<path d="M19 5h-2V3H7v2H5c-1.1 0-2 .9-2 2v1c0 2.55 1.92 4.63 4.39 4.94A5.01 5.01 0 0011 15.9V19H7v2h10v-2h-4v-3.1a5.01 5.01 0 003.61-2.96C19.08 12.63 21 10.55 21 8V7c0-1.1-.9-2-2-2zM7 10.82C5.84 10.4 5 9.3 5 8V7h2v3.82zM19 8c0 1.3-.84 2.4-2 2.82V7h2v1z"></path>
</svg>
<span class="text-brand-purple font-bold text-sm tracking-wide"><?php esc_html_e( 'إنجازات طلابنا', 'novira-academy' ); ?></span>
</div>
<div class="relative inline-block parallax-element" data-speed="0.05">
<!-- Decorative Laurel Wreaths -->
<div class="absolute -left-12 top-1/2 -translate-y-1/2 text-brand-violet/40 hidden md:block animate-pulse">
<svg fill="none" height="80" viewBox="0 0 40 80" width="40" xmlns="http://www.w3.org/2000/svg"><path d="M35 10C20 20 10 40 10 60C10 70 15 75 20 75" stroke="currentColor" stroke-linecap="round" stroke-width="2"></path></svg>
</div>
<div class="absolute -right-12 top-1/2 -translate-y-1/2 text-brand-violet/40 hidden md:block transform scale-x-[-1] animate-pulse">
<svg fill="none" height="80" viewBox="0 0 40 80" width="40" xmlns="http://www.w3.org/2000/svg"><path d="M35 10C20 20 10 40 10 60C10 70 15 75 20 75" stroke="currentColor" stroke-linecap="round" stroke-width="2"></path></svg>
</div>
<h2 class="text-4xl md:text-5xl lg:text-6xl font-extrabold text-brand-dark mb-4 text-gradient leading-tight">
          <?php esc_html_e( 'نتائج طلابنا في الاختبارات الدولية', 'novira-academy' ); ?>
        </h2>
</div>
<p class="text-lg md:text-xl text-gray-600 max-w-2xl mx-auto leading-relaxed mt-4">
        <?php esc_html_e( 'درجات حقيقية حققها طلابنا في الاختبارات الدولية، موثّقة مع إخفاء البيانات الشخصية.', 'novira-academy' ); ?>
      </p>
</header>
<!-- END: Section Header -->
<!-- BEGIN: Cards Grid -->
<div class="grid grid-cols-1 lg:grid-cols-12 gap-6 lg:gap-8 relative z-10 perspective-1000">
<!-- BEGIN: Hero Metric Card (Left Side) -->
<div class="lg:col-span-5 xl:col-span-5 rounded-3xl overflow-hidden relative shadow-2xl h-[500px] bg-brand-purple flex items-center group fade-up-enter stagger-2 hover:shadow-brand-purple/50 transition-shadow duration-500 glass-card">
<!-- Simulate Student Image Background -->

<!-- Content Overlay -->
<div class="relative z-10 w-full p-8 md:p-12 flex flex-col h-full justify-between rtl:text-right">
<div class="self-start bg-[#FDF9C4]/10 backdrop-blur-md border border-[#FDE047]/30 rounded-full px-4 py-1.5 flex items-center space-x-2 space-x-reverse mb-6 transform transition-transform group-hover:scale-105">
<svg class="w-4 h-4 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
<span class="text-yellow-300 font-semibold text-sm font-english tracking-wide">SAT Excellence</span>
</div>
<div>
<h3 class="text-white/80 font-english font-medium text-xl mb-1">SAT Score</h3>
<div class="text-7xl md:text-8xl font-black font-english gold-gradient drop-shadow-[0_5px_15px_rgba(0,0,0,0.5)] mb-4 counter" data-target="1560">
              0
            </div>
<div class="flex items-center space-x-2 space-x-reverse text-white mb-6">
<svg class="w-5 h-5 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path></svg>
<span class="font-bold text-lg"><?php esc_html_e( 'إنجاز أكاديمي متميز', 'novira-academy' ); ?></span>
</div>
</div>
<div class="mt-auto relative">
<p class="text-white/90 text-sm md:text-base leading-relaxed pr-6 max-w-md">
              <?php esc_html_e( 'اختبار Digital SAT أحد الاختبارات الدولية التي نُعِدّ طلابنا لها.', 'novira-academy' ); ?>
            </p>
</div>
<!-- Pagination dots -->
<div class="absolute bottom-6 left-1/2 transform -translate-x-1/2 flex space-x-2 space-x-reverse">
<div class="w-2 h-2 rounded-full bg-yellow-400"></div>
<div class="w-2 h-2 rounded-full bg-white/30 hover:bg-white/50 cursor-pointer transition-colors"></div>
<div class="w-2 h-2 rounded-full bg-white/30 hover:bg-white/50 cursor-pointer transition-colors"></div>
</div>
</div>
</div>
<!-- END: Hero Metric Card -->
<!-- BEGIN: Feature Cards Grid (Right Side) -->
<div class="lg:col-span-7 xl:col-span-7 grid grid-cols-1 md:grid-cols-3 lg:grid-cols-3 gap-4 lg:gap-6">
<!-- IELTS Card -->
<div class="glass-card bg-white/80 rounded-3xl p-6 flex flex-col items-center justify-between relative overflow-hidden group hover:-translate-y-2 transition-all duration-300 shadow-lg hover:shadow-xl fade-up-enter stagger-3">
<div class="w-14 h-14 rounded-full bg-blue-50 flex items-center justify-center mb-4 text-blue-600 group-hover:scale-110 transition-transform">
<svg class="w-7 h-7" fill="currentColor" viewBox="0 0 24 24"><path d="M20 2H4c-1.1 0-2 .9-2 2v18l4-4h14c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zm-2 12H6v-2h12v2zm0-3H6V9h12v2zm0-3H6V6h12v2z"></path></svg>
</div>
<div class="text-center z-10">
<h4 class="font-english font-bold text-gray-700 tracking-wide">IELTS</h4>
<div class="text-5xl font-english font-black text-brand-purple my-2"><span class="counter float" data-decimals="1" data-target="8.0">0.0</span></div>
<p class="text-xs text-gray-500 font-english">Overall Band Score</p>
</div>
<!-- Decorative Chart Graphic - Animated Liquid Wave -->
<div class="absolute bottom-16 left-0 right-0 h-24 opacity-50 pointer-events-none overflow-hidden">
<div class="liquid-wave-container animate-liquid-wave text-brand-purple h-full flex">
<svg class="w-1/2 h-full fill-current flex-shrink-0" preserveAspectRatio="none" viewBox="0 0 100 30"><path d="M0 30 L0 25 Q25 15 50 25 T100 25 L100 30 Z" opacity="0.3"></path><path d="M0 30 L0 28 Q25 20 50 28 T100 28 L100 30 Z" opacity="0.6"></path></svg>
<svg class="w-1/2 h-full fill-current flex-shrink-0" preserveAspectRatio="none" viewBox="0 0 100 30"><path d="M0 30 L0 25 Q25 15 50 25 T100 25 L100 30 Z" opacity="0.3"></path><path d="M0 30 L0 28 Q25 20 50 28 T100 28 L100 30 Z" opacity="0.6"></path></svg>
</div>
</div>
<div class="mt-auto w-full pt-4 border-t border-gray-100 z-10">
<div class="bg-blue-50 text-blue-700 text-xs font-semibold py-1.5 px-3 rounded-full flex items-center justify-center space-x-1 space-x-reverse">
<svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path clip-rule="evenodd" d="M2.166 4.999A11.954 11.954 0 0010 1.944 11.954 11.954 0 0017.834 5c.11.65.166 1.32.166 2.001 0 5.225-3.34 9.67-8 11.317C5.34 16.67 2 12.225 2 7c0-.682.057-1.35.166-2.001zm11.541 3.708a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" fill-rule="evenodd"></path></svg>
<span class=""><?php esc_html_e( 'مستوى ممتاز', 'novira-academy' ); ?></span>
</div>
</div>
</div>
<!-- ACT Card -->
<div class="glass-card bg-white/80 rounded-3xl p-6 flex flex-col items-center justify-between relative overflow-hidden group hover:-translate-y-2 transition-all duration-300 shadow-lg hover:shadow-xl fade-up-enter stagger-4">
<div class="w-14 h-14 rounded-full bg-indigo-50 flex items-center justify-center mb-4 text-indigo-600 group-hover:scale-110 transition-transform">
<svg class="w-7 h-7" fill="currentColor" viewBox="0 0 20 20"><path clip-rule="evenodd" d="M10 2a1 1 0 011 1v1.323l3.954 1.582 1.599-.8a1 1 0 01.894 1.79l-1.233.616 1.738 5.42a1 1 0 01-.285 1.05A3.989 3.989 0 0115 15a3.989 3.989 0 01-2.667-1.019 1 1 0 01-.285-1.05l1.715-5.349L11 6.477V16h2a1 1 0 110 2H7a1 1 0 110-2h2V6.477L6.237 7.582l1.715 5.349a1 1 0 01-.285 1.05A3.989 3.989 0 015 15a3.989 3.989 0 01-2.667-1.019 1 1 0 01-.285-1.05l1.738-5.42-1.233-.617a1 1 0 01.894-1.788l1.599.799L9 4.323V3a1 1 0 011-1zm-5 8.274l-.818 2.552c.25.112.526.174.818.174.292 0 .569-.062.818-.174L5 10.274zm10 0l-.818 2.552c.25.112.526.174.818.174.292 0 .569-.062.818-.174L15 10.274z" fill-rule="evenodd"></path></svg>
</div>
<div class="text-center z-10">
<h4 class="font-english font-bold text-gray-700 tracking-wide">ACT</h4>
<div class="text-5xl font-english font-black text-indigo-600 my-2 counter" data-target="33">0</div>
<p class="text-xs text-gray-500 font-english">Composite Score</p>
</div>
<!-- Animated Gauge Graphic -->
<div class="mt-4 mb-8 relative w-24 h-12 flex justify-center overflow-hidden">
<svg class="w-24 h-24 absolute top-0" viewBox="0 0 100 100">
<circle cx="50" cy="50" fill="none" r="45" stroke="#e0e7ff" stroke-width="10"></circle>
<circle class="arc-progress text-indigo-600" cx="50" cy="50" fill="none" r="45" stroke="currentColor" stroke-dasharray="283" stroke-dashoffset="283" stroke-linecap="round" stroke-width="10" transform="rotate(-90 50 50)"></circle>
</svg>
<div class="absolute bottom-0 w-2 h-2 rounded-full bg-indigo-600"></div>
</div>
<div class="mt-auto w-full pt-4 border-t border-gray-100 z-10 text-center">
<p class="font-bold text-brand-dark text-sm"><?php esc_html_e( 'الدرجة المركبة', 'novira-academy' ); ?></p>
<p class="text-xs text-gray-500"><?php esc_html_e( 'من إجمالي 36', 'novira-academy' ); ?></p>
</div>
</div>
<!-- University Acceptance Card -->
<div class="glass-card bg-white/80 rounded-3xl p-1 flex flex-col relative overflow-hidden group hover:-translate-y-2 transition-all duration-300 shadow-lg hover:shadow-xl md:col-span-3 lg:col-span-2 xl:col-span-1 fade-up-enter stagger-5">
<div class="p-5 flex flex-col items-center justify-center text-center">
<div class="w-14 h-14 rounded-full bg-purple-50 flex items-center justify-center mb-4 text-brand-purple group-hover:scale-110 transition-transform">
<svg class="w-7 h-7" fill="currentColor" viewBox="0 0 24 24"><path d="M12 3L1 9l4 2.18v6L12 21l7-3.82v-6l2-1.09V17h2V9L12 3zm6.82 6L12 12.72 5.18 9 12 5.28 18.82 9zM17 15.99l-5 2.73-5-2.73v-3.72L12 15l5-2.73v3.72z"></path></svg>
</div>
<h4 class="font-bold text-brand-dark text-lg mb-1"><?php esc_html_e( 'تحسّن الأداء قبل الاختبار', 'novira-academy' ); ?></h4>
<p class="text-sm text-gray-600"><?php esc_html_e( 'نتائج الاختبارات التجريبية توجّه خطة التحسين حتى الموعد الرسمي', 'novira-academy' ); ?></p>
</div>
<!-- Image Placeholder for University Building -->
<div class="h-40 w-full mt-auto relative rounded-b-2xl overflow-hidden">
<img alt="University" class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-700" src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/services/university.webp' ); ?>" width="400" height="300" loading="lazy" decoding="async"/>
<div class="absolute inset-0 bg-gradient-to-t from-black/80 to-transparent flex items-end justify-center p-3">
<div class="bg-white/90 backdrop-blur text-brand-purple text-xs font-semibold py-1.5 px-4 rounded-full flex items-center space-x-1 space-x-reverse w-11/12 justify-center transform translate-y-2 opacity-80 group-hover:translate-y-0 group-hover:opacity-100 transition-all duration-300">
<svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path></svg>
<span class=""><?php esc_html_e( 'تحسّن الأداء', 'novira-academy' ); ?></span>
</div>
</div>
</div>
</div>
</div>
<!-- END: Feature Cards Grid -->
</div>
<!-- END: Cards Grid -->
</main>
<!-- END: Main Content Section -->
<!-- BEGIN: Method Bar (redesigned "Bottom Stats Bar") -->
<section class="nmethod" aria-label="<?php esc_attr_e( 'منهجية نوفيرا التعليمية', 'novira-academy' ); ?>">
<div class="nmethod__inner">
<div class="nmethod__head">
<span class="nmethod__eyebrow"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="12" cy="12" r="9"></circle><path d="m15 9-2.4 5.4L9.2 15l2.4-5.4z"></path></svg><?php esc_html_e( 'منهجية نوفيرا', 'novira-academy' ); ?></span>
<h3 class="nmethod__title"><?php echo wp_kses( __( 'خمس ركائز تصنع <b>هذه النتائج</b>', 'novira-academy' ), array( 'b' => array() ) ); ?></h3>
</div>
<ol class="nmethod__rail">
<li class="nmethod__pillar" style="--n:0">
<span class="nmethod__tile"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="6.5" cy="18" r="2.5"></circle><circle cx="17.5" cy="6" r="2.5"></circle><path d="M9 17.4h5.5a3 3 0 0 0 3-3V8.5"></path></svg></span>
<div class="nmethod__body"><h4><?php esc_html_e( 'خطة فردية', 'novira-academy' ); ?></h4><p><?php esc_html_e( 'لكل طالب حسب مستواه', 'novira-academy' ); ?></p></div>
</li>
<li class="nmethod__pillar" style="--n:1">
<span class="nmethod__tile"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="3.5" y="4.5" width="17" height="16" rx="2.5"></rect><path d="M3.5 9.5h17M8 3v3.5M16 3v3.5"></path><path d="m9 14.5 2 2 4-4"></path></svg></span>
<div class="nmethod__body"><h4><?php esc_html_e( 'متابعة دورية', 'novira-academy' ); ?></h4><p><?php esc_html_e( 'مع معلم متخصص خلال مراحل البرنامج', 'novira-academy' ); ?></p></div>
</li>
<li class="nmethod__pillar" style="--n:2">
<span class="nmethod__tile"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M9 4.5H7.5A1.5 1.5 0 0 0 6 6v13.5A1.5 1.5 0 0 0 7.5 21h9a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H15"></path><rect x="9" y="2.8" width="6" height="3.4" rx="1.2"></rect><path d="m9.5 13 2 2 3.5-3.5"></path></svg></span>
<div class="nmethod__body"><h4><?php esc_html_e( 'اختبار تجريبي', 'novira-academy' ); ?></h4><p><?php esc_html_e( 'لكل طالب قبل الامتحان الرسمي', 'novira-academy' ); ?></p></div>
</li>
<li class="nmethod__pillar" style="--n:3">
<span class="nmethod__tile"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M16 20v-1.5a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4V20"></path><circle cx="9" cy="7.5" r="3.5"></circle><path d="M22 20v-1.5a4 4 0 0 0-3-3.9"></path><path d="M16 4.1a3.5 3.5 0 0 1 0 6.8"></path></svg></span>
<div class="nmethod__body"><h4><?php esc_html_e( 'فريق تدريسي متخصص', 'novira-academy' ); ?></h4><p><?php esc_html_e( 'في التعليم والاختبارات الدولية', 'novira-academy' ); ?></p></div>
</li>
<li class="nmethod__pillar" style="--n:4">
<span class="nmethod__tile"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M4 5.5A2.5 2.5 0 0 1 6.5 3H20v14H6.5A2.5 2.5 0 0 0 4 19.5z"></path><path d="M4 19.5A2.5 2.5 0 0 0 6.5 22H20"></path><path d="M12 7.5v6"></path></svg></span>
<div class="nmethod__body"><h4><?php esc_html_e( 'مناهج حديثة', 'novira-academy' ); ?></h4><p><?php esc_html_e( 'تواكب المعايير الدولية وأحدث أساليب التعليم', 'novira-academy' ); ?></p></div>
</li>
</ol>
</div>
</section>

<style>
/* padding:0 overrides the theme-wide `section { padding: var(--space-3xl) 5% }`
   rule in main.css, which was padding this bar with ~120px of dead space. */
.nmethod { position: relative; z-index: 20; overflow: hidden; padding: 0; background: linear-gradient(180deg, #f7f4fe 0%, #ffffff 100%); border-top: 1px solid #ece7fb; box-shadow: 0 -12px 30px rgba(91, 20, 230, .05); }
.nmethod *, .nmethod *::before, .nmethod *::after { box-sizing: border-box; }
.nmethod::before { content: ""; position: absolute; top: -60%; left: 50%; transform: translateX(-50%); width: 62%; height: 150%; background: radial-gradient(closest-side, rgba(123, 44, 255, .10), transparent); pointer-events: none; }
.nmethod__inner { position: relative; max-width: 80rem; margin-inline: auto; padding: 42px 24px 46px; }

.nmethod__head { text-align: center; margin-bottom: 38px; }
.nmethod__eyebrow { display: inline-flex; align-items: center; gap: 8px; font-family: var(--ff-body, 'Almarai', sans-serif); font-weight: 800; font-size: 13px; letter-spacing: .3px; color: #7b2cff; background: #efe8ff; border: 1px solid #e0d3ff; padding: 7px 16px; border-radius: 999px; }
.nmethod__eyebrow svg { width: 16px; height: 16px; }
.nmethod__title { margin: 14px 0 0; font-family: var(--ff-display, 'Noto Kufi Arabic', sans-serif); font-weight: 800; font-size: clamp(20px, 2.4vw, 28px); line-height: 1.3; color: #1a0a3d; }
.nmethod__title b { background: linear-gradient(90deg, #5b14e6, #7b2cff); -webkit-background-clip: text; background-clip: text; color: transparent; }

.nmethod__rail { list-style: none; margin: 0; padding: 0; display: grid; grid-template-columns: repeat(5, 1fr); position: relative; }
/* The "study-plan rail" — draws right→left on reveal (RTL reading order) */
.nmethod__rail::before { content: ""; position: absolute; top: 30px; inset-inline-start: 9%; inset-inline-end: 9%; height: 2px; background: repeating-linear-gradient(-90deg, #c9b6f3 0 7px, transparent 7px 15px); transform: scaleX(0); transform-origin: right center; transition: transform 1.15s cubic-bezier(.16, 1, .3, 1) .12s; }
.nmethod__rail.is-drawn::before { transform: scaleX(1); }

.nmethod__pillar { position: relative; display: flex; flex-direction: column; align-items: center; text-align: center; padding: 0 14px; opacity: 0; transform: translateY(16px); transition: opacity .6s ease, transform .6s ease; transition-delay: calc(var(--n, 0) * 95ms); }
.nmethod.is-in .nmethod__pillar { opacity: 1; transform: none; }

.nmethod__tile { position: relative; z-index: 1; width: 60px; height: 60px; border-radius: 18px; display: grid; place-items: center; color: #fff; margin-bottom: 16px; background: linear-gradient(145deg, #8a45ff, #5b14e6); box-shadow: 0 12px 24px rgba(91, 20, 230, .28); border: 1px solid rgba(255, 255, 255, .35); overflow: hidden; transition: transform .3s cubic-bezier(.34, 1.56, .64, 1), box-shadow .3s ease; }
.nmethod__tile svg { width: 28px; height: 28px; position: relative; z-index: 1; }
.nmethod__tile::after { content: ""; position: absolute; inset: 0; background: linear-gradient(120deg, transparent 32%, rgba(255, 255, 255, .55) 50%, transparent 68%); transform: translateX(-130%); transition: transform .65s ease; }
.nmethod__pillar:hover .nmethod__tile { transform: translateY(-5px) rotate(-4deg); box-shadow: 0 18px 34px rgba(91, 20, 230, .42); }
.nmethod__pillar:hover .nmethod__tile::after { transform: translateX(130%); }

.nmethod__body h4 { margin: 0 0 5px; font-family: var(--ff-display, 'Noto Kufi Arabic', sans-serif); font-weight: 800; font-size: 15.5px; line-height: 1.3; color: #1a0a3d; }
.nmethod__body p { margin: 0; font-family: var(--ff-body, 'Almarai', sans-serif); font-weight: 600; font-size: 11.5px; line-height: 1.55; color: #6f63a3; }

@media (max-width: 900px) {
	.nmethod__rail { grid-template-columns: repeat(3, 1fr); gap: 30px 8px; }
	.nmethod__rail::before { display: none; }
}
@media (max-width: 560px) {
	.nmethod__inner { padding: 32px 18px 36px; }
	.nmethod__head { margin-bottom: 26px; }
	.nmethod__rail { grid-template-columns: 1fr; gap: 12px; }
	.nmethod__pillar { flex-direction: row; align-items: center; gap: 14px; text-align: start; padding: 13px 15px; background: #faf8ff; border: 1px solid #ece7fb; border-radius: 16px; }
	.nmethod__tile { margin-bottom: 0; width: 52px; height: 52px; border-radius: 14px; flex: none; }
	.nmethod__tile svg { width: 25px; height: 25px; }
	.nmethod__body { flex: 1; }
	.nmethod__body p { font-size: 12px; }
}
@media (prefers-reduced-motion: reduce) {
	.nmethod__pillar { opacity: 1; transform: none; transition: none; }
	.nmethod__rail::before { transform: scaleX(1); transition: none; }
	.nmethod__tile, .nmethod__tile::after { transition: none; }
}
/* LTR activation (inert under RTL): the study-plan rail draws with reading order. */
[dir="ltr"] .nmethod__rail::before { transform-origin: left center; }
</style>

<script>
( function () {
	var root = document.querySelector( '.nmethod' );
	if ( ! root ) { return; }
	var rail = root.querySelector( '.nmethod__rail' );
	var reduce = window.matchMedia && window.matchMedia( '(prefers-reduced-motion: reduce)' ).matches;
	function show() { root.classList.add( 'is-in' ); if ( rail ) { rail.classList.add( 'is-drawn' ); } }
	if ( ! ( 'IntersectionObserver' in window ) || reduce ) { show(); return; }
	var io = new IntersectionObserver( function ( entries ) {
		entries.forEach( function ( e ) { if ( e.isIntersecting ) { show(); io.disconnect(); } } );
	}, { threshold: 0.25 } );
	io.observe( root );
}() );
</script>
<!-- END: Method Bar -->



<style>

    
    
    .font-english {
      font-family: 'Plus Jakarta Sans', sans-serif;
    }

    .glass-card {
    
      backdrop-filter: blur(16px);
      -webkit-backdrop-filter: blur(16px);
      border: 1px solid rgba(255, 255, 255, 0.5);
      box-shadow: 0 20px 40px rgba(0, 0, 0, 0.05);
      position: relative;
      overflow: hidden;
    }

    /* Mouse Follow Glass Effect */
    .glass-card::before {
      content: "";
      position: absolute;
      top: var(--y, 50%);
      left: var(--x, 50%);
      width: 400px;
      height: 400px;
      background: radial-gradient(circle closest-side, rgba(255,255,255,0.4), transparent);
      transform: translate(-50%, -50%);
      transition: top 0.1s ease, left 0.1s ease, opacity 0.3s ease;
      opacity: 0;
      z-index: 0;
      pointer-events: none;
    }
    .glass-card:hover::before {
      opacity: 1;
    }
    .glass-card > * {
      position: relative;
      z-index: 10;
    }
    
    .text-gradient {
      background-clip: text;
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      background-image: linear-gradient(90deg, #1E1B4B, #5B14E6);
    }

    .gold-gradient {
      background-clip: text;
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      background-image: linear-gradient(180deg, #FDE047, #EAB308, #A16207);
    }
    
    .stat-bar-shadow {
      box-shadow: 0 -10px 30px rgba(91, 20, 230, 0.05);
    }

    /* Animation Classes */
    .fade-up-enter {
      opacity: 0;
      transform: translateY(30px);
      transition: opacity 0.8s cubic-bezier(0.16, 1, 0.3, 1), transform 0.8s cubic-bezier(0.16, 1, 0.3, 1);
    }
    .fade-up-enter-active {
      opacity: 1;
      transform: translateY(0);
    }

    /* Counter animation generic class */
    .counter {
      /* Handled by JS */
    }

    /* Progress Arc Animation */
    .arc-progress {
      stroke-dasharray: 283;
      stroke-dashoffset: 283;
      transition: stroke-dashoffset 2s ease-out;
    }
    .arc-progress.active {
      stroke-dashoffset: 60; /* Approx 80% */
    }

    /* Liquid Wave specific adjustments */
    .liquid-wave-container {
      width: 200%;
      display: flex;
    }

    /* Parallax Base */
    .parallax-bg {
      transition: transform 0.1s ease-out;
    }
    
    /* Footer Icon Glow */
    .footer-icon {
      transition: all 0.3s ease;
    }
    .footer-stat:hover .footer-icon {
      transform: scale(1.1);
      filter: drop-shadow(0 0 8px rgba(139, 92, 246, 0.6));
    }
  
</style>

<script>

const initAnimatedResults = () => {
    // 1. Entrance Animations (Intersection Observer)
    const observer = new IntersectionObserver((entries) => {
        entries.forEach((entry, index) => {
            if (entry.isIntersecting) {
                // Stagger based on DOM order or specific data attribute if needed, here just basic delay
                setTimeout(() => {
                    entry.target.classList.add('fade-up-enter-active');
                    // If it has an arc, animate it
                    const arc = entry.target.querySelector('.arc-progress');
                    if (arc) arc.classList.add('active');
                }, index * 150); // 150ms stagger
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.1 });

    document.querySelectorAll('.fade-up-enter').forEach(el => observer.observe(el));

    // 2. Counter Up Effects
    const counterObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const target = parseFloat(entry.target.getAttribute('data-target'));
                const isFloat = entry.target.classList.contains('float');
                const duration = 2000;
                const start = performance.now();
                
                const updateCounter = (currentTime) => {
                    const elapsed = currentTime - start;
                    const progress = Math.min(elapsed / duration, 1);
                    // easeOutQuart
                    const easeProgress = 1 - Math.pow(1 - progress, 4);
                    const current = target * easeProgress;
                    
                    if (isFloat) {
                        entry.target.innerText = current.toFixed(1);
                    } else {
                        entry.target.innerText = Math.floor(current);
                    }
                    
                    if (progress < 1) {
                        requestAnimationFrame(updateCounter);
                    } else {
                        entry.target.innerText = isFloat ? target.toFixed(1) : target;
                    }
                };
                requestAnimationFrame(updateCounter);
                counterObserver.unobserve(entry.target);
            }
        });
    }, { threshold: 0.5 });

    document.querySelectorAll('.counter').forEach(el => counterObserver.observe(el));

    // 4. Hover Micro-interactions (Glassmorphism highlight)
    document.querySelectorAll('.glass-card').forEach(card => {
        card.addEventListener('mousemove', e => {
            const rect = card.getBoundingClientRect();
            const x = e.clientX - rect.left;
            const y = e.clientY - rect.top;
            card.style.setProperty('--x', `${x}px`);
            card.style.setProperty('--y', `${y}px`);
        });
    });

    // 5. Parallax Background & Elements (skip entirely when reduced motion is requested)
    const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)');
    document.addEventListener('mousemove', (e) => {
        if (prefersReducedMotion.matches) return;
        const x = (e.clientX / window.innerWidth - 0.5) * 2;
        const y = (e.clientY / window.innerHeight - 0.5) * 2;
        
        document.querySelectorAll('.parallax-bg').forEach(el => {
            el.style.transform = `translate(${x * 15}px, ${y * 15}px) scale(1.05)`; // slight scale to hide edges
        });

        document.querySelectorAll('.parallax-element').forEach(el => {
            const speed = el.getAttribute('data-speed') || 0.02;
            // Negative for opposite movement
            el.style.transform = `translate(${x * -30 * speed}px, ${y * -30 * speed}px)`;
        });
    });
};
if (document.readyState === "loading") { document.addEventListener("DOMContentLoaded", initAnimatedResults); } else { initAnimatedResults(); }
</script>
</section>