const fs = require('fs');

const phpContent = `<?php
/**
 * Template Part: Student Results Section (Scoreboard)
 *
 * @package Novira_Academy
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$results = array(
	array(
		'score'       => '1560',
		'suffix'      => '',
		'name'        => __( 'SAT', 'novira-academy' ),
		'desc'        => __( 'أعلى درجة لطلابنا', 'novira-academy' ),
		'icon'        => '<svg class="w-10 h-10 text-brand-purple" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2L1 7l11 5 9-4.09V17h2V7l-11-5zm0 13l-8-3.64v3.18L12 18l8-3.46v-3.18L12 15z"/></svg>',
		'format'      => 'int',
        'color'       => 'text-brand-purple'
	),
	array(
		'score'       => '8.0',
		'suffix'      => '',
		'name'        => __( 'IELTS', 'novira-academy' ),
		'desc'        => __( 'متوسط الدرجات', 'novira-academy' ),
		'icon'        => '<svg class="w-10 h-10 text-blue-600" fill="currentColor" viewBox="0 0 24 24"><path d="M11.99 2C6.47 2 2 6.48 2 12s4.47 10 9.99 10C17.52 22 22 17.52 22 12S17.52 2 11.99 2zm6.93 6h-2.95c-.32-1.25-.78-2.45-1.38-3.56 1.84.63 3.37 1.91 4.33 3.56zM12 4.04c.83 1.2 1.48 2.53 1.91 3.96h-3.82c.43-1.43 1.08-2.76 1.91-3.96zM4.26 14C4.1 13.36 4 12.69 4 12s.1-1.36.26-2h3.38c-.08.66-.14 1.32-.14 2 0 .68.06 1.34.14 2H4.26zm.82 2h2.95c.32 1.25.78 2.45 1.38 3.56-1.84-.63-3.37-1.9-4.33-3.56zm2.95-8H5.08c.96-1.66 2.49-2.93 4.33-3.56C8.81 5.55 8.35 6.75 8.03 8zM12 19.96c-.83-1.2-1.48-2.53-1.91-3.96h3.82c-.43 1.43-1.08 2.76-1.91 3.96zM14.34 14H9.66c-.09-.66-.16-1.32-.16-2 0-.68.07-1.35.16-2h4.68c.09.65.16 1.32.16 2 0 .68-.07 1.34-.16 2zm1.63 3.56c.6-1.11 1.06-2.31 1.38-3.56h2.95c-.96 1.65-2.49 2.93-4.33 3.56zM19.74 14h-3.38c.08-.66.14-1.32.14-2 0-.68-.06-1.34-.14-2h3.38c.16.64.26 1.31.26 2s-.1 1.36-.26 2z"/></svg>',
		'format'      => 'float',
        'color'       => 'text-blue-600'
	),
	array(
		'score'       => '33',
		'suffix'      => '',
		'name'        => __( 'ACT', 'novira-academy' ),
		'desc'        => __( 'أعلى درجة لطلابنا', 'novira-academy' ),
		'icon'        => '<svg class="w-10 h-10 text-indigo-600" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>',
		'format'      => 'int',
        'color'       => 'text-indigo-600'
	),
	array(
		'score'       => __( 'قبول', 'novira-academy' ),
		'suffix'      => '',
		'name'        => '',
		'desc'        => __( 'جامعات عالمية', 'novira-academy' ),
		'icon'        => '<svg class="w-10 h-10 text-yellow-500" fill="currentColor" viewBox="0 0 24 24"><path d="M12 1L3 5v6c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V5l-9-4zm-2 16l-4-4 1.41-1.41L10 14.17l6.59-6.59L18 9l-8 8z"/></svg>',
		'format'      => 'text',
        'color'       => 'text-yellow-500'
	),
);
?>

<style>
/* Reveal Animation Utilities */
.stagger-up {
	opacity: 0;
	transform: translateY(40px);
	transition-property: opacity, transform;
	transition-duration: 0.8s;
	transition-timing-function: cubic-bezier(0.16, 1, 0.3, 1);
}
.stagger-up.is-visible {
	opacity: 1;
	transform: translateY(0);
}
</style>

<section class="py-20 bg-gray-50 relative overflow-hidden" aria-label="<?php esc_attr_e( 'نتائج طلابنا', 'novira-academy' ); ?>">
	<!-- Decorative background elements -->
	<div class="absolute top-0 right-0 w-64 h-64 bg-brand-purple/5 rounded-full blur-3xl -translate-y-1/2 translate-x-1/2"></div>
	<div class="absolute bottom-0 left-0 w-96 h-96 bg-brand-violet/5 rounded-full blur-3xl translate-y-1/2 -translate-x-1/2"></div>

	<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
		<div class="text-center mb-16 stagger-up delay-0">
			<span class="inline-block bg-brand-purple/10 text-brand-purple px-4 py-1 rounded-full font-bold text-sm mb-4">
				<?php esc_html_e( 'إنجازاتنا', 'novira-academy' ); ?>
			</span>
			<h2 class="text-4xl md:text-5xl font-black text-brand-dark mb-4">
				<?php esc_html_e( 'نتائج طلابنا تتحدث عنا', 'novira-academy' ); ?>
			</h2>
			<p class="text-lg text-gray-600 max-w-2xl mx-auto">
				<?php esc_html_e( 'أرقام حقيقية من امتحانات دولية وقبولات جامعية في أفضل جامعات العالم.', 'novira-academy' ); ?>
			</p>
		</div>

		<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 lg:gap-8">
			<?php foreach ( $results as $index => $result ) : ?>
				<div class="glass-card bg-white/80 rounded-3xl p-8 flex flex-col items-center text-center group hover:-translate-y-2 transition-transform duration-500 shadow-lg hover:shadow-xl stagger-up" style="transition-delay: <?php echo esc_attr( $index * 150 ); ?>ms;">
					<div class="w-20 h-20 rounded-2xl bg-gray-50 flex items-center justify-center mb-6 shadow-inner group-hover:scale-110 transition-transform duration-500">
						<?php echo $result['icon']; ?>
					</div>

					<div class="flex-grow flex flex-col justify-center">
						<?php if ( 'text' === $result['format'] ) : ?>
							<h3 class="text-4xl font-black <?php echo esc_attr( $result['color'] ); ?> mb-2">
								<?php echo esc_html( $result['score'] ); ?>
							</h3>
						<?php else : ?>
							<h3 class="text-5xl font-black font-english <?php echo esc_attr( $result['color'] ); ?> mb-2 flex items-center justify-center">
								<span class="score-number" data-target="<?php echo esc_attr( $result['score'] ); ?>" data-format="<?php echo esc_attr( $result['format'] ); ?>">0</span>
								<?php if ( ! empty( $result['suffix'] ) ) : ?>
									<span class="text-2xl ml-1"><?php echo esc_html( $result['suffix'] ); ?></span>
								<?php endif; ?>
							</h3>
						<?php endif; ?>

						<?php if ( ! empty( $result['name'] ) ) : ?>
							<p class="text-xl font-bold text-gray-800 font-english mb-1"><?php echo esc_html( $result['name'] ); ?></p>
						<?php endif; ?>
						
						<p class="text-sm text-gray-500"><?php echo esc_html( $result['desc'] ); ?></p>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
	const easeOutQuart = t => 1 - Math.pow(1 - t, 4);

	function animateCounter(el, target, format) {
		const duration = 2000;
		const start = performance.now();
		const targetNum = parseFloat(target);
		const isFloat = format === 'float';
		const decimals = isFloat ? 1 : 0;

		function step(now) {
			const progress = Math.min((now - start) / duration, 1);
			const eased = easeOutQuart(progress);
			const current = targetNum * eased;
			
			el.textContent = current.toFixed(decimals);
			
			if (progress < 1) {
				requestAnimationFrame(step);
			} else {
				el.textContent = target;
			}
		}
		requestAnimationFrame(step);
	}

	const observer = new IntersectionObserver((entries) => {
		entries.forEach(entry => {
			if (entry.isIntersecting) {
				entry.target.classList.add('is-visible');
				
				// Trigger counter if this element contains one
				const counter = entry.target.querySelector('.score-number');
				if (counter) {
					setTimeout(() => {
						const target = counter.getAttribute('data-target');
						const format = counter.getAttribute('data-format');
						animateCounter(counter, target, format);
					}, 300); // Wait for fade up to complete slightly
				}
				
				observer.unobserve(entry.target);
			}
		});
	}, {
		threshold: 0.1,
		rootMargin: "0px 0px -50px 0px"
	});

	document.querySelectorAll('.stagger-up').forEach(el => observer.observe(el));
});
</script>
`;

fs.writeFileSync('d:/novira/final_site/novira-theme/template-parts/sections/student-results.php', phpContent, 'utf8');
console.log('student-results rewritten!');
