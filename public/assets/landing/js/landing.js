(() => {
    const reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    const finePointer = window.matchMedia('(pointer: fine)').matches;
    const root = document.documentElement;

    const header = document.querySelector('.site-header');
    const backToTopButton = document.querySelector('.back-to-top');
    const handleHeaderState = () => {
        if (!header) {
            return;
        }

        header.classList.toggle('is-scrolled', window.scrollY > 16);

        const scrollRoot = document.documentElement;
        const scrollTop = window.scrollY || scrollRoot.scrollTop;
        const scrollRange = Math.max(scrollRoot.scrollHeight - window.innerHeight, 1);
        const progress = Math.min(100, Math.max(0, (scrollTop / scrollRange) * 100));
        root.style.setProperty('--scroll-progress', progress.toFixed(2));

        if (!backToTopButton) {
            return;
        }

        const nearBottomThreshold = 220;
        const nearBottom = window.innerHeight + window.scrollY >= scrollRoot.scrollHeight - nearBottomThreshold;
        backToTopButton.classList.toggle('is-visible', nearBottom);
    };

    window.addEventListener('scroll', handleHeaderState, {
        passive: true
    });
    handleHeaderState();

    const navAnchors = Array.from(document.querySelectorAll('.nav-links a[href^="#"]'));
    const navTargets = navAnchors
        .map((anchor) => {
            const id = anchor.getAttribute('href');
            if (!id || id === '#') {
                return null;
            }

            const target = document.querySelector(id);
            if (!target) {
                return null;
            }

            return {
                anchor,
                target
            };
        })
        .filter(Boolean);

    const syncCurrentNav = () => {
        if (navTargets.length === 0) {
            return;
        }

        const headerOffset = header ? header.offsetHeight + 24 : 96;
        const current = navTargets
            .slice()
            .reverse()
            .find((item) => window.scrollY + headerOffset >= item.target.offsetTop);

        navAnchors.forEach((anchor) => anchor.classList.remove('is-current'));

        if (current) {
            current.anchor.classList.add('is-current');
        } else {
            navTargets[0].anchor.classList.add('is-current');
        }
    };

    window.addEventListener('scroll', syncCurrentNav, {
        passive: true
    });
    window.addEventListener('resize', syncCurrentNav);
    syncCurrentNav();

    if (backToTopButton) {
        backToTopButton.addEventListener('click', () => {
            window.scrollTo({
                top: 0,
                behavior: reduceMotion ? 'auto' : 'smooth'
            });
        });
    }

    const revealNodes = document.querySelectorAll('.reveal');
    if (reduceMotion) {
        revealNodes.forEach((node) => node.classList.add('is-visible'));
    } else {
        const observer = new IntersectionObserver((entries) => {
            entries.forEach((entry) => {
                if (!entry.isIntersecting) {
                    return;
                }

                const delay = Number(entry.target.getAttribute('data-delay') || 0);
                entry.target.style.transitionDelay = `${delay}s`;
                entry.target.classList.add('is-visible');
                observer.unobserve(entry.target);
            });
        }, {
            threshold: 0.15,
            rootMargin: '0px 0px -8% 0px'
        });

        revealNodes.forEach((node) => observer.observe(node));
    }

    const scrollStages = document.querySelectorAll('.scroll-stage');
    if (reduceMotion) {
        scrollStages.forEach((stage) => stage.classList.add('is-active'));
    } else if (scrollStages.length > 0) {
        const stageObserver = new IntersectionObserver((entries) => {
            entries.forEach((entry) => {
                if (!entry.isIntersecting) {
                    return;
                }

                entry.target.classList.add('is-active');
                stageObserver.unobserve(entry.target);
            });
        }, {
            threshold: 0.22,
            rootMargin: '0px 0px -10% 0px'
        });

        scrollStages.forEach((stage) => stageObserver.observe(stage));
    }

    const animatedSections = document.querySelectorAll('.classes, .instructors, .contact');
    if (reduceMotion) {
        animatedSections.forEach((section) => section.classList.add('is-inview'));
    } else if (animatedSections.length > 0) {
        const sectionObserver = new IntersectionObserver((entries) => {
            entries.forEach((entry) => {
                if (!entry.isIntersecting) {
                    return;
                }

                entry.target.classList.add('is-inview');
                sectionObserver.unobserve(entry.target);
            });
        }, {
            threshold: 0.2,
            rootMargin: '0px 0px -12% 0px'
        });

        animatedSections.forEach((section) => sectionObserver.observe(section));
    }

    if (!reduceMotion) {
        const orbs = document.querySelectorAll('.hero-orb');
        const hero = document.querySelector('.hero');

        if (hero && orbs.length > 0) {
            let targetOffsetX = 0;
            let targetOffsetY = 0;
            let currentOffsetX = 0;
            let currentOffsetY = 0;
            let rafId = 0;

            const renderOrbs = () => {
                currentOffsetX += (targetOffsetX - currentOffsetX) * 0.12;
                currentOffsetY += (targetOffsetY - currentOffsetY) * 0.12;

                orbs.forEach((orb, index) => {
                    const factor = (index + 1) * 5;
                    orb.style.transform =
                        `translate3d(${currentOffsetX * factor}px, ${currentOffsetY * factor}px, 0)`;
                });

                if (Math.abs(targetOffsetX - currentOffsetX) > 0.001 || Math.abs(targetOffsetY - currentOffsetY) > 0.001) {
                    rafId = window.requestAnimationFrame(renderOrbs);
                } else {
                    rafId = 0;
                }
            };

            hero.addEventListener('mousemove', (event) => {
                const bounds = hero.getBoundingClientRect();
                targetOffsetX = (event.clientX - bounds.left) / bounds.width - 0.5;
                targetOffsetY = (event.clientY - bounds.top) / bounds.height - 0.5;

                if (!rafId) {
                    rafId = window.requestAnimationFrame(renderOrbs);
                }
            });

            hero.addEventListener('mouseleave', () => {
                targetOffsetX = 0;
                targetOffsetY = 0;

                if (!rafId) {
                    rafId = window.requestAnimationFrame(renderOrbs);
                }
            });
        }
    }

    if (!reduceMotion && finePointer) {
        const tiltCards = document.querySelectorAll('.schedule-day, .coach, .contact-card, .gallery-slide');

        tiltCards.forEach((card) => {
            card.addEventListener('mousemove', (event) => {
                const rect = card.getBoundingClientRect();
                const px = (event.clientX - rect.left) / rect.width;
                const py = (event.clientY - rect.top) / rect.height;
                const rotateY = (px - 0.5) * 8;
                const rotateX = (0.5 - py) * 8;

                card.style.setProperty('--tilt-x', `${rotateX.toFixed(2)}deg`);
                card.style.setProperty('--tilt-y', `${rotateY.toFixed(2)}deg`);
            });

            card.addEventListener('mouseleave', () => {
                card.style.removeProperty('--tilt-x');
                card.style.removeProperty('--tilt-y');
            });
        });
    }

    const gallerySection = document.querySelector('.yoga-gallery');
    const gallerySlides = gallerySection?.querySelectorAll('.gallery-slide') ?? [];

    if (gallerySection && gallerySlides.length > 0 && !reduceMotion) {
        const pauseGallery = () => gallerySection.classList.add('is-paused');
        const resumeGallery = () => gallerySection.classList.remove('is-paused');

        gallerySlides.forEach((slide) => {
            slide.addEventListener('mouseenter', pauseGallery);
            slide.addEventListener('mouseleave', resumeGallery);
            slide.addEventListener('focus', pauseGallery);
            slide.addEventListener('blur', resumeGallery);
        });
    }
})();
