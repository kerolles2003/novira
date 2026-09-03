
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

    // 5. Parallax Background & Elements
    document.addEventListener('mousemove', (e) => {
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
if (document.readyState === 'loading') { document.addEventListener('DOMContentLoaded', initAnimatedResults); } else { initAnimatedResults(); }
