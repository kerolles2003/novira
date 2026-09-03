document.addEventListener('DOMContentLoaded', () => {
    const slides = document.querySelectorAll('.carousel-slide');
    const dots = document.querySelectorAll('.dot-wrapper');
    const prevBtn = document.getElementById('prevBtn');
    const nextBtn = document.getElementById('nextBtn');
    
    // Check if carousel exists on this page
    if (!slides.length || !dots.length) return;

    let currentSlide = 0;
    const totalSlides = slides.length;
    let slideInterval;
    const autoPlayDuration = 5000;

    const carousel = document.getElementById('carousel');
    const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)');

    // Mark up the carousel for assistive tech without changing visuals.
    if (carousel) {
        carousel.setAttribute('aria-roledescription', 'carousel');
    }
    slides.forEach((slide, i) => {
        slide.setAttribute('role', 'group');
        slide.setAttribute('aria-roledescription', 'slide');
    });

    // Hide inactive slides from AT and keyboard (prevents focus on off-screen CTAs).
    const applySlideA11y = (activeIndex) => {
        slides.forEach((slide, i) => {
            const isActive = i === activeIndex;
            slide.setAttribute('aria-hidden', isActive ? 'false' : 'true');
            if (isActive) {
                slide.removeAttribute('inert');
            } else {
                slide.setAttribute('inert', '');
            }
        });
    };

    const updateCarousel = (index) => {
        // Reset all
        slides.forEach(slide => {
            slide.classList.remove('active');
        });
        dots.forEach(dot => {
            dot.classList.remove('dot-active');
        });

        // Small delay to ensure CSS transition restarts for progress bar
        setTimeout(() => {
            slides[index].classList.add('active');
            dots[index].classList.add('dot-active');
        }, 50);

        applySlideA11y(index);
        currentSlide = index;
    };

    const nextSlide = () => {
        let next = (currentSlide + 1) % totalSlides;
        updateCarousel(next);
    };

    const prevSlide = () => {
        let prev = (currentSlide - 1 + totalSlides) % totalSlides;
        updateCarousel(prev);
    };

    const startAutoplay = () => {
        clearInterval(slideInterval);
        // Respect reduced-motion: do not auto-advance.
        if (prefersReducedMotion.matches) return;
        slideInterval = setInterval(nextSlide, autoPlayDuration);
    };

    const stopAutoplay = () => {
        clearInterval(slideInterval);
    };

    // Kept for compatibility with the control handlers below.
    const resetInterval = startAutoplay;

    if (nextBtn) {
        nextBtn.addEventListener('click', () => {
            nextSlide();
            resetInterval();
        });
    }

    if (prevBtn) {
        prevBtn.addEventListener('click', () => {
            prevSlide();
            resetInterval();
        });
    }

    dots.forEach((dot, index) => {
        dot.addEventListener('click', () => {
            if (currentSlide !== index) {
                updateCarousel(index);
                resetInterval();
            }
        });
    });

    // Interactive Glass Cards (Tilt Effect)
    const cards = document.querySelectorAll('.tilt-card');
    cards.forEach(card => {
        card.addEventListener('mousemove', (e) => {
            if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) return;
            const rect = card.getBoundingClientRect();
            const x = e.clientX - rect.left;
            const y = e.clientY - rect.top;
            const centerX = rect.width / 2;
            const centerY = rect.height / 2;
            const rotateX = ((y - centerY) / centerY) * -5; // max 5 deg tilt
            const rotateY = ((x - centerX) / centerX) * 5;
            
            card.style.setProperty('--rx', `${rotateX}deg`);
            card.style.setProperty('--ry', `${rotateY}deg`);
        });
        card.addEventListener('mouseleave', () => {
            card.classList.add('leave');
            card.style.setProperty('--rx', `0deg`);
            card.style.setProperty('--ry', `0deg`);
            setTimeout(() => card.classList.remove('leave'), 600);
        });
    });

    // Pause autoplay on hover/focus; resume on leave/blur.
    if (carousel) {
        carousel.addEventListener('mouseenter', stopAutoplay);
        carousel.addEventListener('mouseleave', startAutoplay);
        carousel.addEventListener('focusin', stopAutoplay);
        carousel.addEventListener('focusout', startAutoplay);
    }

    // React to runtime changes of the reduced-motion preference.
    prefersReducedMotion.addEventListener('change', () => {
        if (prefersReducedMotion.matches) {
            stopAutoplay();
        } else {
            startAutoplay();
        }
    });

    // Initial AT state + start auto play (no-op when reduced motion is on).
    applySlideA11y(0);
    startAutoplay();

    // Init first progress bar
    setTimeout(() => {
        if (dots[0]) dots[0].classList.add('dot-active');
    }, 50);
});
