<?php
/**
 * Template Part: Testimonials Section (Stitch Pixel-Perfect)
 *
 * Animated testimonials section from Stitch Project ID 10612256545289588306,
 * Screen 9f62cb8381594255bf8001aa8161f679.
 *
 * @package Novira_Academy
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$novira_testimonials = array(
	array(
		'initial'    => __( 'م', 'novira-academy' ),
		'name'       => __( 'Mostafa Ahmed', 'novira-academy' ),
		'label'      => __( 'مراجعة على Google', 'novira-academy' ),
		'rating'     => 5,
		'quote'      => __( 'خدمة ممتازة وسريعة جداً. الترجمة كانت معتمدة وتم قبولها في السفارة بدون أي مشاكل.', 'novira-academy' ),
		'float_icon' => 'heart',
		'float_pos'  => 'bottom-right rotate-12',
	),
	array(
		'initial'    => __( 'خ', 'novira-academy' ),
		'name'       => __( 'Khedr Nageh', 'novira-academy' ),
		'label'      => __( 'مراجعة على Google', 'novira-academy' ),
		'rating'     => 5,
		'quote'      => __( 'مكان ممتاز والله ف كل حاجة ف التعليم ف الترجمة ف الكورسات ف المعاملة كل حاجة ماشاء الله يجد وان شاء الله من نجاح لنجاح يارب', 'novira-academy' ),
		'float_icon' => 'heart',
		'float_pos'  => 'bottom-left rotate-minus-6',
		'is_active'  => true,
	),
	array(
		'initial'    => __( 'أ', 'novira-academy' ),
		'name'       => __( 'Mariem Mohamed', 'novira-academy' ),
		'label'      => __( 'مراجعة على Google', 'novira-academy' ),
		'rating'     => 5,
		'quote'      => __( 'دورات الاختبارات الدولية كانت منظمة جداً واستفدت كتير، وحسيت بفرق كبير في نتيجتي.', 'novira-academy' ),
		'float_icon' => 'heart',
		'float_pos'  => 'bottom-left rotate-minus-12',
	),
);
?>

<section class="testimonials-stitch" aria-labelledby="testimonials-stitch-heading">
	<div class="testimonials-stitch__waves" aria-hidden="true"></div>

	<div class="testimonials-stitch__container">
		<!-- Section Header -->
		<header class="testimonials-stitch__header">
			<div class="testimonials-stitch__badge reveal-item" data-animation="animate-fade-in">
				<svg class="testimonials-stitch__badge-icon" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
					<path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z"></path>
				</svg>
				<?php esc_html_e( 'تقييمات من Google', 'novira-academy' ); ?>
			</div>

			<h2 id="testimonials-stitch-heading" class="testimonials-stitch__title reveal-item" data-animation="animate-fade-in">
				<?php esc_html_e( 'ماذا يقول', 'novira-academy' ); ?> <span class="testimonials-stitch__title-accent"><?php esc_html_e( 'طلابنا', 'novira-academy' ); ?></span> <?php esc_html_e( 'عنا؟', 'novira-academy' ); ?>
			</h2>

			<div class="testimonials-stitch__dots reveal-item" data-animation="animate-fade-in" aria-hidden="true">
				<span class="testimonials-stitch__dot"></span>
				<span class="testimonials-stitch__dot testimonials-stitch__dot--active"></span>
				<span class="testimonials-stitch__dot"></span>
			</div>

			<p class="testimonials-stitch__subtitle reveal-item" data-animation="animate-fade-in">
				<?php esc_html_e( 'نفتخر بثقة طلابنا ورضاهم عن خدماتنا في الترجمة والاختبارات الدولية.', 'novira-academy' ); ?>
				<?php esc_html_e( 'هذه بعض من تجاربهم الحقيقية.', 'novira-academy' ); ?>
			</p>

			<?php
			$novira_google_rating = get_theme_mod( 'novira_google_rating', '' );
			$novira_google_count  = get_theme_mod( 'novira_google_reviews_count', '' );
			if ( '' !== $novira_google_rating || '' !== $novira_google_count ) :
			?>
				<div class="testimonials-stitch__rating reveal-item" data-animation="animate-fade-in"<?php echo ( '' !== $novira_google_rating ) ? ' aria-label="' . esc_attr( sprintf( __( 'تقييم %s من 5 على Google', 'novira-academy' ), $novira_google_rating ) ) . '"' : ''; ?>>
					<?php if ( '' !== $novira_google_rating ) : ?>
						<span class="testimonials-stitch__rating-value"><?php echo esc_html( $novira_google_rating ); ?></span>
						<span class="testimonials-stitch__rating-star" aria-hidden="true">★</span>
					<?php endif; ?>
					<?php if ( '' !== $novira_google_rating && '' !== $novira_google_count ) : ?>
						<span class="testimonials-stitch__rating-sep" aria-hidden="true"></span>
					<?php endif; ?>
					<?php if ( '' !== $novira_google_count ) : ?>
						<span class="testimonials-stitch__rating-count">
							<?php
							/* translators: %s: number of Google reviews, e.g. "20+". */
							printf( esc_html__( '%s تقييم على Google', 'novira-academy' ), esc_html( $novira_google_count ) );
							?>
						</span>
					<?php endif; ?>
				</div>
			<?php endif; ?>
		</header>

		<!-- Carousel Area -->
		<div class="testimonials-stitch__carousel reveal-item" data-animation="animate-fade-in" role="region" aria-roledescription="carousel" aria-label="<?php esc_attr_e( 'آراء العملاء', 'novira-academy' ); ?>">
			<button class="testimonials-stitch__arrow testimonials-stitch__arrow--prev" aria-label="<?php esc_attr_e( 'السابق', 'novira-academy' ); ?>">
				<svg class="testimonials-stitch__arrow-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
					<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
				</svg>
			</button>

			<div class="testimonials-stitch__cards">
				<?php foreach ( $novira_testimonials as $index => $testimonial ) : ?>
					<article class="testimonials-stitch__card<?php echo ! empty( $testimonial['is_active'] ) ? ' testimonials-stitch__card--active' : ' testimonials-stitch__card--side'; ?> reveal-item" data-animation="animate-fade-up" style="animation-delay: <?php echo esc_attr( 0.2 + $index * 0.2 ); ?>s;" aria-roledescription="slide" aria-label="<?php echo esc_attr( sprintf( __( 'تقييم %1$d من %2$d', 'novira-academy' ), $index + 1, count( $novira_testimonials ) ) ); ?>">
						<div class="testimonials-stitch__float testimonials-stitch__float--<?php echo esc_attr( str_replace( ' ', '-', $testimonial['float_pos'] ) ); ?>">
							<svg class="testimonials-stitch__float-icon" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
								<path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd"></path>
							</svg>
						</div>

						<div class="testimonials-stitch__card-top">
							<div class="testimonials-stitch__author">
								<div class="testimonials-stitch__avatar">
									<?php echo esc_html( $testimonial['initial'] ); ?>
								</div>
								<div class="testimonials-stitch__author-info">
									<h4 class="testimonials-stitch__author-name"><?php echo esc_html( $testimonial['name'] ); ?></h4>
									<p class="testimonials-stitch__author-label"><?php echo esc_html( $testimonial['label'] ); ?></p>
								</div>
							</div>
							<svg class="testimonials-stitch__quote-mark" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
								<path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z"></path>
							</svg>
						</div>

						<div class="testimonials-stitch__stars" aria-label="<?php echo esc_attr( sprintf( __( 'تقييم %d من 5', 'novira-academy' ), $testimonial['rating'] ) ); ?>">
							<?php for ( $i = 0; $i < 5; $i++ ) : ?>
								<svg class="testimonials-stitch__star" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true" style="animation-delay: <?php echo esc_attr( 0.1 + $i * 0.1 ); ?>s;">
									<path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
								</svg>
							<?php endfor; ?>
						</div>

						<p class="testimonials-stitch__text"><?php echo esc_html( $testimonial['quote'] ); ?></p>
					</article>
				<?php endforeach; ?>
			</div>

			<button class="testimonials-stitch__arrow testimonials-stitch__arrow--next" aria-label="<?php esc_attr_e( 'التالي', 'novira-academy' ); ?>">
				<svg class="testimonials-stitch__arrow-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
					<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
				</svg>
			</button>
		</div>

		<!-- Pagination -->
		<div class="testimonials-stitch__pagination reveal-item" data-animation="animate-fade-in" role="tablist" aria-label="<?php esc_attr_e( 'شريحة التقييم', 'novira-academy' ); ?>">
			<button class="testimonials-stitch__page testimonials-stitch__page--active" aria-label="<?php esc_attr_e( 'شريحة 1', 'novira-academy' ); ?>" aria-selected="true" role="tab"></button>
			<button class="testimonials-stitch__page" aria-label="<?php esc_attr_e( 'شريحة 2', 'novira-academy' ); ?>" aria-selected="false" role="tab"></button>
			<button class="testimonials-stitch__page" aria-label="<?php esc_attr_e( 'شريحة 3', 'novira-academy' ); ?>" aria-selected="false" role="tab"></button>
		</div>

		<!-- More on Google Reviews -->
		<?php $novira_google_url = get_theme_mod( 'novira_google_reviews_url', '' ); ?>
		<div class="testimonials-stitch__more reveal-item" data-animation="animate-fade-in">
			<p class="testimonials-stitch__more-note">
				<?php esc_html_e( 'المزيد من آراء أولياء الأمور والطلاب متاحة على Google Reviews.', 'novira-academy' ); ?>
			</p>
			<?php if ( '' !== $novira_google_url ) : ?>
				<a class="testimonials-stitch__more-link" href="<?php echo esc_url( $novira_google_url ); ?>" target="_blank" rel="noopener noreferrer nofollow">
					<?php esc_html_e( 'عرض جميع التقييمات', 'novira-academy' ); ?>
					<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
						<path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"></path>
						<polyline points="15 3 21 3 21 9"></polyline>
						<line x1="10" y1="14" x2="21" y2="3"></line>
					</svg>
				</a>
			<?php endif; ?>
		</div>

		<!-- CTA Banner -->
		<div class="testimonials-stitch__cta reveal-item" data-animation="animate-scale-up">
			<div class="testimonials-stitch__cta-waves" aria-hidden="true"></div>
			<svg class="testimonials-stitch__cta-watermark" fill="currentColor" viewBox="0 0 100 100" aria-hidden="true">
				<rect height="40" rx="2" width="10" x="20" y="40"></rect>
				<rect height="60" rx="2" width="10" x="45" y="20"></rect>
				<rect height="50" rx="2" width="10" x="70" y="30"></rect>
				<path d="M10,85 L90,85" stroke="currentColor" stroke-linecap="round" stroke-width="4"></path>
			</svg>

			<div class="testimonials-stitch__cta-content">
				<h3 class="testimonials-stitch__cta-title"><?php esc_html_e( 'عايز نفس المتابعة لطالبك؟', 'novira-academy' ); ?></h3>
				<p class="testimonials-stitch__cta-desc"><?php esc_html_e( 'تواصل معنا، نبدأ بتقييم مستواه ونحدّد الاختبار والخطة المناسبة.', 'novira-academy' ); ?></p>
				<a href="https://wa.me/<?php echo esc_attr( get_theme_mod( 'novira_whatsapp', '201090600927' ) ); ?>" class="testimonials-stitch__cta-btn" target="_blank" rel="noopener noreferrer">
					<span class="testimonials-stitch__cta-btn-text"><?php esc_html_e( 'احجز تقييم', 'novira-academy' ); ?></span>
					<svg class="testimonials-stitch__cta-btn-icon" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
						<path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51a12.8 12.8 0 00-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"></path>
					</svg>
				</a>
			</div>
		</div>
	</div>
</section>

<style>
/* Verified Google Reviews — additive trust elements (scoped to this section, no redesign) */
.testimonials-stitch__rating {
	display: inline-flex;
	align-items: center;
	gap: 10px;
	margin-top: 20px;
	padding: 8px 18px;
	background: #ffffff;
	border: 1px solid rgba(30, 26, 56, 0.08);
	border-radius: 999px;
	box-shadow: 0 4px 14px -6px rgba(107, 61, 235, 0.25);
}
.testimonials-stitch__rating-value {
	font-size: 18px;
	font-weight: 800;
	line-height: 1;
	color: var(--testimonials-purple-dark, #1e1a38);
}
.testimonials-stitch__rating-star {
	font-size: 18px;
	line-height: 1;
	color: var(--testimonials-yellow, #facc15);
}
.testimonials-stitch__rating-sep {
	width: 1px;
	height: 16px;
	background: rgba(30, 26, 56, 0.15);
}
.testimonials-stitch__rating-count {
	font-size: 14px;
	font-weight: 600;
	color: #5b5772;
}
.testimonials-stitch__more {
	margin-top: 40px;
	display: flex;
	flex-direction: column;
	align-items: center;
	gap: 14px;
	text-align: center;
}
.testimonials-stitch__more-note {
	margin: 0;
	font-size: 15px;
	color: #5b5772;
}
.testimonials-stitch__more-link {
	display: inline-flex;
	align-items: center;
	gap: 8px;
	padding: 10px 22px;
	border: 1px solid rgba(107, 61, 235, 0.35);
	border-radius: 999px;
	font-size: 15px;
	font-weight: 700;
	text-decoration: none;
	color: var(--testimonials-purple, #6b3deb);
	background: #ffffff;
	transition: background 0.2s ease, border-color 0.2s ease, transform 0.2s ease;
}
.testimonials-stitch__more-link:hover {
	background: var(--testimonials-purple-light, #f5f3ff);
	border-color: var(--testimonials-purple, #6b3deb);
	transform: translateY(-1px);
}
.testimonials-stitch__more-link svg {
	width: 16px;
	height: 16px;
}
</style>

<script>
(function () {
	var section = document.querySelector('.testimonials-stitch');
	if (!section) return;

	var items = section.querySelectorAll('.reveal-item');
	if (!items.length) return;

	var observerOptions = {
		root: null,
		rootMargin: '0px',
		threshold: 0.1
	};

	var observer = new IntersectionObserver(function (entries, obs) {
		entries.forEach(function (entry) {
			if (entry.isIntersecting) {
				var animationClass = entry.target.getAttribute('data-animation');
				if (animationClass) {
					entry.target.classList.add(animationClass);
				}
				obs.unobserve(entry.target);
			}
		});
	}, observerOptions);

	items.forEach(function (item) {
		observer.observe(item);
	});

	/* Testimonial controls — arrows + pagination tabs select the emphasised
	   card and keep ARIA state in sync. (Previously bound to selectors that no
	   longer exist, so the visible controls did nothing.) */
	var cards = Array.prototype.slice.call(section.querySelectorAll('.testimonials-stitch__card'));
	var pages = Array.prototype.slice.call(section.querySelectorAll('.testimonials-stitch__page'));
	var dots  = Array.prototype.slice.call(section.querySelectorAll('.testimonials-stitch__dot'));
	var prev  = section.querySelector('.testimonials-stitch__arrow--prev');
	var next  = section.querySelector('.testimonials-stitch__arrow--next');

	if (cards.length) {
		var current = Math.max(0, cards.findIndex(function (c) {
			return c.classList.contains('testimonials-stitch__card--active');
		}));

		var setActive = function (i) {
			current = (i + cards.length) % cards.length;
			cards.forEach(function (card, idx) {
				var on = idx === current;
				card.classList.toggle('testimonials-stitch__card--active', on);
				card.classList.toggle('testimonials-stitch__card--side', !on);
			});
			pages.forEach(function (page, idx) {
				var on = idx === current;
				page.classList.toggle('testimonials-stitch__page--active', on);
				page.setAttribute('aria-selected', on ? 'true' : 'false');
			});
			dots.forEach(function (dot, idx) {
				dot.classList.toggle('testimonials-stitch__dot--active', idx === current);
			});
		};

		pages.forEach(function (page, idx) {
			page.addEventListener('click', function () { setActive(idx); });
		});
		if (prev) { prev.addEventListener('click', function () { setActive(current - 1); }); }
		if (next) { next.addEventListener('click', function () { setActive(current + 1); }); }
	}
})();
</script>
