/**
 * animations.js — Scroll Reveal & 3D Animations
 * Uses Intersection Observer. Lightweight, transform/opacity only.
 * Respects prefers-reduced-motion.
 */

(function () {
    'use strict';

    const reduced = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    /* =============================================
       SCROLL REVEAL (Intersection Observer)
    ============================================= */

    if (!reduced) {
        const revealObserver = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('revealed');
                    observer.unobserve(entry.target);
                }
            });
        }, {
            threshold: 0.12,
            rootMargin: '0px 0px -40px 0px'
        });

        document.querySelectorAll('.reveal, .reveal-left, .reveal-right, .reveal-scale')
            .forEach(el => revealObserver.observe(el));
    } else {
        // Instantly show all for reduced-motion users
        document.querySelectorAll('.reveal, .reveal-left, .reveal-right, .reveal-scale')
            .forEach(el => el.classList.add('revealed'));
    }

    /* =============================================
       HERO TYPING ANIMATION
    ============================================= */

    const typingEl = document.getElementById('typingText');

    if (typingEl && !reduced) {
        const words = typingEl.dataset.words
            ? JSON.parse(typingEl.dataset.words)
            : ['Laravel Developer', 'PHP Developer', 'Backend Architect', 'Web Developer'];

        let wordIndex = 0;
        let charIndex = 0;
        let isDeleting = false;
        let typeTimeout;

        function type() {
            const current = words[wordIndex];
            const displayed = isDeleting
                ? current.substring(0, charIndex - 1)
                : current.substring(0, charIndex + 1);

            typingEl.textContent = displayed;
            charIndex = isDeleting ? charIndex - 1 : charIndex + 1;

            let delay = isDeleting ? 60 : 100;

            if (!isDeleting && charIndex === current.length) {
                delay = 1800;
                isDeleting = true;
            } else if (isDeleting && charIndex === 0) {
                isDeleting = false;
                wordIndex = (wordIndex + 1) % words.length;
                delay = 300;
            }

            typeTimeout = setTimeout(type, delay);
        }

        type();
    }

    /* =============================================
       ANIMATED SKILL BARS
    ============================================= */

    const skillBarsObserver = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.querySelectorAll('.skill-bar-fill[data-level]').forEach(bar => {
                    const level = parseInt(bar.dataset.level, 10) || 0;
                    if (!reduced) {
                        setTimeout(() => { bar.style.width = level + '%'; }, 100);
                    } else {
                        bar.style.width = level + '%';
                    }
                });
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.3 });

    document.querySelectorAll('.skills-section, .skills-grid')
        .forEach(el => skillBarsObserver.observe(el));

    /* =============================================
       ANIMATED STAT COUNTERS
    ============================================= */

    const statsObserver = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.querySelectorAll('[data-count]').forEach(counter => {
                    if (reduced) {
                        counter.textContent = counter.dataset.count;
                        return;
                    }

                    const target = parseInt(counter.dataset.count, 10) || 0;
                    const duration = 1800;
                    const startTime = performance.now();

                    function update(currentTime) {
                        const elapsed = currentTime - startTime;
                        const progress = Math.min(elapsed / duration, 1);
                        // Ease out
                        const eased = 1 - Math.pow(1 - progress, 3);
                        counter.textContent = Math.round(eased * target);

                        if (progress < 1) {
                            requestAnimationFrame(update);
                        } else {
                            counter.textContent = target;
                        }
                    }

                    requestAnimationFrame(update);
                });

                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.4 });

    document.querySelectorAll('.stats-section, .about-stats, .hero-stats')
        .forEach(el => statsObserver.observe(el));

    /* =============================================
       FLOATING 3D OBJECTS IN HERO
    ============================================= */

    const floatingObjects = document.querySelectorAll('.hero-floating-obj');

    if (floatingObjects.length && !reduced) {
        floatingObjects.forEach((obj, i) => {
            const delay = i * 0.8;
            const duration = 4 + i * 0.5;
            obj.style.animation = `float ${duration}s ease-in-out ${delay}s infinite`;
        });
    }

    /* =============================================
       PROFILE IMAGE 3D TILT
    ============================================= */

    const tiltCard = document.querySelector('.hero-image-wrapper');

    if (tiltCard && !reduced && window.matchMedia('(hover: hover)').matches) {
        tiltCard.addEventListener('mousemove', function (e) {
            const rect   = this.getBoundingClientRect();
            const cx     = rect.left + rect.width / 2;
            const cy     = rect.top  + rect.height / 2;
            const dx     = (e.clientX - cx) / (rect.width  / 2);
            const dy     = (e.clientY - cy) / (rect.height / 2);
            const rotX   = -dy * 12;
            const rotY   =  dx * 12;

            this.style.transform = `perspective(600px) rotateX(${rotX}deg) rotateY(${rotY}deg) scale(1.02)`;
        });

        tiltCard.addEventListener('mouseleave', function () {
            this.style.transform = 'perspective(600px) rotateX(0deg) rotateY(0deg) scale(1)';
        });
    }

    /* =============================================
       PROJECT CARD TILT (3D)
    ============================================= */

    document.querySelectorAll('.project-card').forEach(card => {
        if (reduced || !window.matchMedia('(hover: hover)').matches) return;

        card.style.transition = 'transform 0.4s cubic-bezier(0.16,1,0.3,1), box-shadow 0.4s ease';

        card.addEventListener('mousemove', function (e) {
            const rect = this.getBoundingClientRect();
            const cx   = rect.left + rect.width  / 2;
            const cy   = rect.top  + rect.height / 2;
            const dx   = (e.clientX - cx) / (rect.width  / 2);
            const dy   = (e.clientY - cy) / (rect.height / 2);
            const rotX = -dy * 8;
            const rotY =  dx * 8;

            this.style.transform = `perspective(800px) rotateX(${rotX}deg) rotateY(${rotY}deg) translateZ(10px)`;
            this.style.boxShadow = `${dx * -10}px ${dy * -10}px 40px rgba(139,92,246,0.15)`;
        });

        card.addEventListener('mouseleave', function () {
            this.style.transform = 'perspective(800px) rotateX(0deg) rotateY(0deg) translateZ(0)';
            this.style.boxShadow = '';
        });
    });

})();
