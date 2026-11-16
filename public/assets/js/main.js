/**
 * main.js — Core Portfolio JavaScript
 * Handles: Header scroll, navigation, smooth scrolling, mobile menu
 */

(function () {
    'use strict';

    /* =============================================
       HEADER SCROLL EFFECT
    ============================================= */

    const header = document.querySelector('.header');

    if (header) {
        const handleScroll = () => {
            if (window.scrollY > 50) {
                header.classList.add('scrolled');
            } else {
                header.classList.remove('scrolled');
            }
        };

        window.addEventListener('scroll', handleScroll, { passive: true });
        handleScroll(); // Initial call
    }

    /* =============================================
       MOBILE MENU
    ============================================= */

    const hamburger    = document.querySelector('.hamburger');
    const mobileMenu   = document.querySelector('.mobile-menu');
    const mobileLinks  = document.querySelectorAll('.mobile-menu .mobile-nav-link');
    const mobileClose  = document.querySelector('.mobile-menu-close');

    function openMenu() {
        if (!mobileMenu) return;
        mobileMenu.classList.add('open');
        document.body.style.overflow = 'hidden';
        hamburger && hamburger.classList.add('active');
    }

    function closeMenu() {
        if (!mobileMenu) return;
        mobileMenu.classList.remove('open');
        document.body.style.overflow = '';
        hamburger && hamburger.classList.remove('active');
    }

    hamburger  && hamburger.addEventListener('click', openMenu);
    mobileClose && mobileClose.addEventListener('click', closeMenu);

    mobileLinks.forEach(link => {
        link.addEventListener('click', closeMenu);
    });

    /* =============================================
       ACTIVE NAV LINK (Intersection Observer)
    ============================================= */

    const sections   = document.querySelectorAll('section[id]');
    const navLinks   = document.querySelectorAll('.nav-menu a[href^="#"], .nav-menu a[href*="#"]');

    if (sections.length && navLinks.length) {
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const id = entry.target.id;
                    navLinks.forEach(link => {
                        link.classList.remove('active');
                        if (link.getAttribute('href') === '#' + id ||
                            link.getAttribute('href')?.endsWith('#' + id)) {
                            link.classList.add('active');
                        }
                    });
                }
            });
        }, { threshold: 0.4 });

        sections.forEach(section => observer.observe(section));
    }

    /* =============================================
       SMOOTH SCROLL FOR ANCHOR LINKS
    ============================================= */

    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            const href = this.getAttribute('href');
            if (href === '#') return;

            const target = document.querySelector(href);
            if (target) {
                e.preventDefault();
                const offset = 70; // header height
                const top = target.getBoundingClientRect().top + window.pageYOffset - offset;
                window.scrollTo({ top, behavior: 'smooth' });
            }
        });
    });

    /* =============================================
       CONTACT FORM — CSRF + AJAX-like submit
    ============================================= */

    const contactForm = document.getElementById('contactForm');

    if (contactForm) {
        const submitBtn    = contactForm.querySelector('[type="submit"]');
        const successAlert = document.getElementById('contactSuccess');
        const errorAlert   = document.getElementById('contactError');

        contactForm.addEventListener('submit', async function (e) {
            e.preventDefault();

            const originalText = submitBtn ? submitBtn.innerHTML : '';
            if (submitBtn) {
                submitBtn.disabled = true;
                submitBtn.innerHTML = '<span class="btn-spinner"></span> Sending...';
            }

            // Clear previous alerts
            if (successAlert) successAlert.style.display = 'none';
            if (errorAlert)   errorAlert.style.display = 'none';

            // Clear field errors
            contactForm.querySelectorAll('.field-error').forEach(el => el.textContent = '');

            try {
                const formData = new FormData(contactForm);
                const token    = document.querySelector('meta[name="csrf-token"]')?.content;

                const response = await fetch(contactForm.action, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': token || '',
                        'Accept': 'application/json',
                    },
                    body: formData,
                });

                if (response.ok) {
                    // Try JSON first; fall back to redirect success
                    const contentType = response.headers.get('Content-Type') || '';
                    if (contentType.includes('application/json')) {
                        const data = await response.json();
                        if (data.success) {
                            if (successAlert) successAlert.style.display = 'flex';
                            contactForm.reset();
                        }
                    } else {
                        // Server redirected — treat as success
                        if (successAlert) successAlert.style.display = 'flex';
                        contactForm.reset();
                    }
                } else if (response.status === 422) {
                    // Validation errors
                    const data = await response.json();
                    if (data.errors) {
                        Object.entries(data.errors).forEach(([field, messages]) => {
                            const errorEl = contactForm.querySelector(`[data-field-error="${field}"]`);
                            if (errorEl) errorEl.textContent = messages[0];
                        });
                    }
                } else {
                    if (errorAlert) errorAlert.style.display = 'flex';
                }
            } catch (err) {
                if (errorAlert) errorAlert.style.display = 'flex';
            } finally {
                if (submitBtn) {
                    submitBtn.disabled = false;
                    submitBtn.innerHTML = originalText;
                }
            }
        });
    }

    /* =============================================
       CURRENT YEAR IN FOOTER
    ============================================= */

    document.querySelectorAll('[data-year]').forEach(el => {
        el.textContent = new Date().getFullYear();
    });

})();
