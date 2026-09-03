const fs = require('fs');

const phpContent = `<?php
/**
 * Template Part: Map & Contact Section (Stitch Pixel-Perfect)
 *
 * @package Novira_Academy
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$whatsapp = get_theme_mod( 'novira_whatsapp', '010 90600927' );
$phone    = get_theme_mod( 'novira_phone', '010 90600927' );
$address  = get_theme_mod( 'novira_address', 'شارع الشهيد مصطفى الملاحظ، أخر شارع مستشفى أبو عوف، بجوار مكتبة الناظر، بني مزار - المنيا' );
?>

<style>
@keyframes fadeInUp {
  from { opacity: 0; transform: translateY(20px); }
  to { opacity: 1; transform: translateY(0); }
}
@keyframes fadeIn {
  from { opacity: 0; }
  to { opacity: 1; }
}
@keyframes slideInLeft {
  from { opacity: 0; transform: translateX(-50px); }
  to { opacity: 1; transform: translateX(0); }
}
@keyframes slideInRight {
  from { opacity: 0; transform: translateX(50px); }
  to { opacity: 1; transform: translateX(0); }
}
@keyframes float {
  0%, 100% { transform: translate(-50%, -50%) translateY(0); }
  50% { transform: translate(-50%, -50%) translateY(-10px); }
}
@media (prefers-reduced-motion: reduce) {
  * {
    animation-duration: 0.01ms !important;
    animation-iteration-count: 1 !important;
    transition-duration: 0.01ms !important;
    scroll-behavior: auto !important;
  }
}
</style>

<section class="relative bg-white overflow-hidden" aria-label="<?php esc_attr_e( 'تواصل معنا', 'novira-academy' ); ?>">
	<!-- Decorative Background Elements -->
	<div class="absolute top-0 left-0 w-full h-full overflow-hidden -z-10 pointer-events-none">
		<div class="absolute top-[-10%] right-[-5%] w-[40%] h-[40%] bg-brand-200/30 rounded-full blur-3xl"></div>
		<div class="absolute bottom-[20%] left-[-10%] w-[50%] h-[50%] bg-brand-300/20 rounded-full blur-3xl"></div>
	</div>

	<!-- BEGIN: Main Content Container -->
	<main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 relative z-10">
		<!-- BEGIN: Header Section -->
		<header class="text-center mb-16">
			<div class="inline-flex items-center justify-center bg-brand-100 text-brand-700 px-6 py-2 rounded-full mb-6 font-semibold shadow-sm transition-all duration-700 ease-out opacity-0 translate-y-4" style="animation: fadeInUp 0.6s ease-out forwards; animation-delay: 0.1s;">
				<svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewbox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path></svg>
				تواصل معنا
			</div>
			<h2 class="text-4xl md:text-5xl font-extrabold text-gray-900 mb-6 leading-tight opacity-0 translate-y-4" style="animation: fadeInUp 0.6s ease-out forwards; animation-delay: 0.3s;">
				زور <span class="text-brand-primary">نوفيرا أكاديمي</span> وابدأ رحلتك التعليمية
			</h2>
			<p class="text-lg text-gray-600 max-w-2xl mx-auto mb-8 opacity-0 translate-y-4" style="animation: fadeInUp 0.6s ease-out forwards; animation-delay: 0.5s;">
				نحن هنا لمساعدتك في اختيار المسار المناسب سواء الدبلومة الأمريكية أو الترجمة المعتمدة أو برامج اللغات والمهارات.
			</p>
			<div class="inline-flex items-center justify-center bg-white border border-brand-200 text-brand-800 px-8 py-3 rounded-xl shadow-glass font-medium opacity-0 translate-y-4" style="animation: fadeInUp 0.6s ease-out forwards; animation-delay: 0.7s;">
				<svg class="w-6 h-6 ml-3 text-brand-500" fill="none" stroke="currentColor" viewbox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path></svg>
				يسعدنا استقبالكم في مقر الأكاديمية لمناقشة أفضل مسار تعليمي يناسب أهدافكم.
			</div>
		</header>
		<!-- END: Header Section -->

		<!-- BEGIN: Main Content Grid (Map & Contact Card) -->
		<div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
			
			<div class="bg-white rounded-3xl p-3 shadow-card relative h-[500px] overflow-hidden group transition-all duration-500 hover:shadow-2xl opacity-0 -translate-x-12" style="animation: slideInLeft 1s cubic-bezier(0.34, 1.56, 0.64, 1) forwards; animation-delay: 1.4s;">
				<div class="absolute inset-0 bg-gradient-to-tr from-white/0 via-white/20 to-white/0 opacity-0 group-hover:opacity-100 transition-opacity duration-700 pointer-events-none z-20"></div>
				<div class="w-full h-full rounded-2xl bg-[#f2f4f5] relative overflow-hidden flex items-center justify-center">
					<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3506.3574745753367!2d30.802484900000007!3d28.4988907!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x145b078be7939ae5%3A0x5dde6c04c556b01!2sNovira%20Academy!5e0!3m2!1sar!2seg!4v1781613107625!5m2!1sar!2seg" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
				</div>
			</div>

			<div class="bg-white rounded-3xl p-8 lg:p-10 shadow-card border border-brand-50 flex flex-col h-full group relative overflow-hidden opacity-0 translate-x-12" style="animation: slideInRight 1s cubic-bezier(0.34, 1.56, 0.64, 1) forwards; animation-delay: 1.4s;">
				<div class="absolute inset-0 bg-gradient-to-tr from-white/0 via-white/10 to-white/0 opacity-0 group-hover:opacity-100 transition-opacity duration-700 pointer-events-none z-20"></div>
				<div class="flex items-start justify-between mb-8 pb-8 border-b border-gray-100">
					<div>
						<h3 class="text-3xl font-extrabold text-brand-900 mb-3 font-english">Novira Academy</h3>
						<p class="text-gray-600 text-sm leading-relaxed max-w-[280px]">مؤسسة تعليمية متخصصة في الدبلومة الأمريكية والترجمة المعتمدة وتنمية المهارات واللغات.</p>
					</div>
					<div class="w-20 h-20 bg-gradient-to-br from-brand-500 to-brand-800 rounded-2xl flex items-center justify-center shadow-lg flex-shrink-0 transition-transform duration-500 group-hover:rotate-3 group-hover:scale-110">
						<svg class="w-10 h-10 text-white" fill="currentColor" viewbox="0 0 24 24"><path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"></path></svg>
					</div>
				</div>
				<div class="space-y-6 flex-grow">
					<div class="flex items-start gap-4 group/item">
						<div class="w-10 h-10 rounded-full bg-brand-50 flex items-center justify-center text-brand-600 flex-shrink-0 mt-1 transition-colors group-hover/item:bg-brand-100">
							<svg class="w-5 h-5" fill="none" stroke="currentColor" viewbox="0 0 24 24"><path d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path><path d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path></svg>
						</div>
						<div>
							<h4 class="font-bold text-gray-900 mb-1">العنوان</h4>
							<p class="text-gray-600 text-sm leading-relaxed"><?php echo esc_html( $address ); ?></p>
						</div>
					</div>
					<div class="flex items-center gap-4 group/item">
						<div class="w-10 h-10 rounded-full bg-brand-50 flex items-center justify-center text-brand-600 flex-shrink-0 transition-colors group-hover/item:bg-brand-100">
							<svg class="w-5 h-5" fill="none" stroke="currentColor" viewbox="0 0 24 24"><path d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path></svg>
						</div>
						<div>
							<h4 class="font-bold text-gray-900 mb-1">الهاتف</h4>
							<p class="text-gray-600 text-sm dir-ltr text-right"><?php echo esc_html( $phone ); ?></p>
						</div>
					</div>
					<div class="flex items-center gap-4 group/item">
						<div class="w-10 h-10 rounded-full bg-brand-50 flex items-center justify-center text-brand-600 flex-shrink-0 transition-colors group-hover/item:bg-brand-100">
							<svg class="w-5 h-5" fill="none" stroke="currentColor" viewbox="0 0 24 24"><path d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path></svg>
						</div>
						<div>
							<h4 class="font-bold text-gray-900 mb-1">واتساب</h4>
							<p class="text-gray-600 text-sm dir-ltr text-right"><?php echo esc_html( $whatsapp ); ?></p>
						</div>
					</div>
					<div class="flex items-center gap-4 group/item">
						<div class="w-10 h-10 rounded-full bg-brand-50 flex items-center justify-center text-brand-600 flex-shrink-0 transition-colors group-hover/item:bg-brand-100">
							<svg class="w-5 h-5" fill="none" stroke="currentColor" viewbox="0 0 24 24"><path d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path></svg>
						</div>
						<div>
							<h4 class="font-bold text-gray-900 mb-1">مواعيد العمل</h4>
							<p class="text-gray-600 text-sm">يومياً من 10 صباحاً حتى 10 مساءً</p>
						</div>
					</div>
				</div>
				<div class="mt-8 pt-6 border-t border-gray-100 flex flex-col sm:flex-row gap-4">
					<a href="https://wa.me/<?php echo esc_attr( str_replace( array( ' ', '+', '-' ), '', $whatsapp ) ); ?>" target="_blank" rel="noopener noreferrer" class="flex-1 bg-gradient-to-r from-brand-600 to-brand-primary hover:from-brand-700 hover:to-brand-800 text-white font-bold py-4 px-6 rounded-xl shadow-lg transition-all hover:scale-[1.02] hover:shadow-brand-500/40 flex items-center justify-center gap-2">
						<svg class="w-5 h-5" fill="none" stroke="currentColor" viewbox="0 0 24 24"><path d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path></svg>
						تواصل واتساب
					</a>
				</div>
			</div>
		</div>
		<!-- END: Main Content Grid -->
	</main>
</section>
`;

fs.writeFileSync('d:/novira/final_site/novira-theme/template-parts/sections/map-contact.php', phpContent, 'utf8');
console.log('map-contact.php rewritten!');
