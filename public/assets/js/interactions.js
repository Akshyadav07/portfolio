/**
 * interactions.js — Mouse cursor, scroll effects, skill cards
 * Lightweight interactive effects only.
 */

(function () {
    'use strict';

    const reduced = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    const hasHover = window.matchMedia('(hover: hover)').matches;

    /* =============================================
       CUSTOM CURSOR
    ============================================= */

    const cursorDot  = document.getElementById('cursorDot');
    const cursorRing = document.getElementById('cursorRing');

    if (cursorDot && cursorRing && hasHover && !reduced) {
        let mouseX = 0, mouseY = 0;
        let ringX = 0, ringY = 0;
        let animFrame;

        document.addEventListener('mousemove', e => {
            mouseX = e.clientX;
            mouseY = e.clientY;
            cursorDot.style.left = mouseX + 'px';
            cursorDot.style.top  = mouseY + 'px';
        });

        function animateRing() {
            const lerp = (a, b, n) => a + (b - a) * n;
            ringX = lerp(ringX, mouseX, 0.12);
            ringY = lerp(ringY, mouseY, 0.12);
            cursorRing.style.left = ringX + 'px';
            cursorRing.style.top  = ringY + 'px';
            animFrame = requestAnimationFrame(animateRing);
        }

        animateRing();

        // Hover state on interactive elements
        const interactiveEls = document.querySelectorAll('a, button, .skill-card, .project-card, .service-card, [data-cursor-hover]');

        interactiveEls.forEach(el => {
            el.addEventListener('mouseenter', () => {
                document.body.classList.add('cursor-hover');
            });
            el.addEventListener('mouseleave', () => {
                document.body.classList.remove('cursor-hover');
            });
        });

        // Hide on mouse leave window
        document.addEventListener('mouseleave', () => {
            cursorDot.style.opacity  = '0';
            cursorRing.style.opacity = '0';
        });

        document.addEventListener('mouseenter', () => {
            cursorDot.style.opacity  = '1';
            cursorRing.style.opacity = '1';
        });
    } else {
        // Remove cursor elements on touch / reduced motion
        cursorDot  && cursorDot.remove();
        cursorRing && cursorRing.remove();
    }

    /* =============================================
       HERO MOUSE PARALLAX
    ============================================= */

    const heroSection = document.getElementById('home');
    const parallaxEls = document.querySelectorAll('[data-parallax]');

    if (heroSection && parallaxEls.length && !reduced && hasHover) {
        heroSection.addEventListener('mousemove', function (e) {
            const rect = this.getBoundingClientRect();
            const cx   = rect.width  / 2;
            const cy   = rect.height / 2;
            const dx   = (e.clientX - rect.left - cx) / cx;
            const dy   = (e.clientY - rect.top  - cy) / cy;

            parallaxEls.forEach(el => {
                const depth = parseFloat(el.dataset.parallax) || 20;
                el.style.transform = `translate(${dx * depth}px, ${dy * depth}px)`;
            });
        });

        heroSection.addEventListener('mouseleave', () => {
            parallaxEls.forEach(el => {
                el.style.transform = 'translate(0px, 0px)';
            });
        });
    }

    /* =============================================
       SKILL CARD HOVER — 3D TILT
    ============================================= */

    document.querySelectorAll('.skill-card').forEach(card => {
        if (reduced || !hasHover) return;

        card.addEventListener('mousemove', function (e) {
            const rect = this.getBoundingClientRect();
            const cx   = rect.left + rect.width  / 2;
            const cy   = rect.top  + rect.height / 2;
            const dx   = (e.clientX - cx) / (rect.width  / 2);
            const dy   = (e.clientY - cy) / (rect.height / 2);

            this.style.transform = `perspective(400px) rotateX(${-dy * 10}deg) rotateY(${dx * 10}deg) translateZ(8px)`;
        });

        card.addEventListener('mouseleave', function () {
            this.style.transform = '';
        });
    });

    /* =============================================
       BACK TO TOP BUTTON
    ============================================= */

    const backToTop = document.getElementById('backToTop');

    if (backToTop) {
        window.addEventListener('scroll', () => {
            if (window.scrollY > 400) {
                backToTop.classList.add('visible');
            } else {
                backToTop.classList.remove('visible');
            }
        }, { passive: true });

        backToTop.addEventListener('click', () => {
            window.scrollTo({ top: 0, behavior: reduced ? 'auto' : 'smooth' });
        });
    }

    /* =============================================
       SECTION BACKGROUND GRID PARALLAX
    ============================================= */

    if (!reduced) {
        const bgGrid = document.querySelector('.hero-bg-grid');
        if (bgGrid) {
            window.addEventListener('scroll', () => {
                const y = window.scrollY * 0.3;
                bgGrid.style.transform = `translateY(${y}px)`;
            }, { passive: true });
        }
    }

})();
