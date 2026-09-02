import './bootstrap';
import {livewire_hot_reload} from 'virtual:livewire-hot-reload'
// import Swiper JS
import Swiper from 'swiper';
// import Swiper styles
import 'swiper/css';
import {Navigation, Pagination} from 'swiper/modules';

import 'swiper/css';
import 'swiper/css/navigation';

import {gsap} from "gsap";

import {ScrollTrigger} from "gsap/ScrollTrigger";
import {ScrollSmoother} from "gsap/ScrollSmoother";

import Lenis from 'lenis'

// Initialize Lenis
const lenis = new Lenis();

// Use requestAnimationFrame to continuously update the scroll
function raf(time) {
    lenis.raf(time);
    requestAnimationFrame(raf);
}

requestAnimationFrame(raf);

gsap.registerPlugin(ScrollTrigger, ScrollSmoother);

Swiper.use([Navigation, Pagination]);
window.Swiper = Swiper;
window.gsap = gsap;
window.ScrollTrigger = ScrollTrigger;

livewire_hot_reload();

window.revealOnScroll = function revealOnScroll(delay = 0) {
    return {
        shown: false,
        delay,

        init() {
            const observer = new IntersectionObserver(
                ([entry]) => {
                    if (entry.isIntersecting) {
                        setTimeout(() => this.shown = true, this.delay);
                        observer.unobserve(this.$el);
                    }
                },
                {
                    threshold: 0.12,
                    rootMargin: '0px 0px -6% 0px',
                }
            );

            observer.observe(this.$el);
        },
    };
}


function scrollToHash(hash) {
    if (!hash) {
        return;
    }

    const target = document.querySelector(hash);

    if (!target) {
        return;
    }

    const headerOffset = 90;
    let top = target.getBoundingClientRect().top + window.scrollY - headerOffset;

    // The expertise section is inside a pinned GSAP timeline. Its DOM position
    // points to the beginning of the transition, where the section is hidden.
    if (hash === '#about' && window.innerWidth >= 768) {
        const trigger = window.ScrollTrigger?.getById('team-about-transition-main');
        const aboutScroll = trigger?.labelToScroll?.('about-ready');

        if (aboutScroll > 0) {
            top = aboutScroll;
        } else if (trigger) {
            top = trigger.start + (trigger.end - trigger.start) * 0.6;
        }
    }

    window.scrollTo({
        top,
        behavior: 'smooth',
    });
}

document.addEventListener('click', (e) => {
    const link = e.target.closest('[data-anchor-link]');

    if (!link) {
        return;
    }

    const url = new URL(link.href);
    const currentUrl = new URL(window.location.href);

    if (!url.hash) {
        return;
    }

    e.preventDefault();

    const samePath = url.pathname === currentUrl.pathname;

    if (samePath) {
        history.pushState(null, '', url.hash);
        scrollToHash(url.hash);
        return;
    }

    Livewire.navigate(url.pathname + url.search + url.hash);
});

function scrollToTop() {
    window.scrollTo({
        top: 0,
        behavior: 'smooth',
    });
}

let isInitialLoad = true;
let welcomeAnimationDone = false;

document.addEventListener('livewire:navigated', () => {
    setTimeout(() => {
        if (window.location.hash) {
            scrollToHash(window.location.hash);
            return;
        }

        scrollToTop();
    }, 100);

    if (isInitialLoad) {
        isInitialLoad = false;
        return;
    } else {
        welcomeAnimationDone = false;
    }

    setTimeout(startWelcomeAnimation, 100);
});

function startWelcomeAnimation() {

    if (!welcomeAnimationDone) {


        const welcomeTextLines = document.querySelectorAll('.welcome-text-line');
        const expertItems = document.querySelectorAll('.welcome-expert-item');
        const ctaButton = document.querySelector('.welcome-cta-button');

        if (!welcomeTextLines.length) return;

        // Animate text lines with curtain effect
        gsap.fromTo(welcomeTextLines,
            {y: '100%'},
            {y: '0%', duration: 1, stagger: 0.15, ease: 'power3.out'}
        );

        if (expertItems.length > 0) {
            // Animate expert blocks after text
            gsap.fromTo(expertItems,
                {
                    y: '100%',
                    opacity: 0,
                    visibility: 'hidden'
                },
                {
                    y: '0%',
                    opacity: 1,
                    visibility: 'visible',
                    duration: 0.8,
                    stagger: 0.1,
                    ease: 'power3.out',
                    delay: 0.8 // Start after text animation
                }
            );
        }

        if (ctaButton) {
            gsap.fromTo(ctaButton,
                {
                    y: '100%',
                    opacity: 0,
                    visibility: 'hidden'
                },
                {
                    y: '0%',
                    opacity: 1,
                    visibility: 'visible',
                    duration: 0.8,
                    ease: 'power3.out',
                    delay: 1.25
                }
            );
        }
        welcomeAnimationDone = true;
    }
}

document.addEventListener('DOMContentLoaded', () => {
    setTimeout(() => {
        scrollToHash(window.location.hash);
    }, 100);

    // Welcome animation - start after preloader disappears
    const preloader = document.getElementById('site-preloader');

    if (preloader) {
        // Simple polling approach - check every 100ms if preloader is removed
        const checkInterval = setInterval(() => {
            const currentPreloader = document.getElementById('site-preloader');
            if (!currentPreloader) {
                clearInterval(checkInterval);
                setTimeout(startWelcomeAnimation, 500);
            }
        }, 100);

        // Also check if preloader is hidden (has is-hidden class)
        const checkHiddenInterval = setInterval(() => {
            const currentPreloader = document.getElementById('site-preloader');
            if (currentPreloader && currentPreloader.classList.contains('is-hidden')) {
                clearInterval(checkHiddenInterval);
                clearInterval(checkInterval);
                setTimeout(startWelcomeAnimation, 500);
            }
        }, 100);

        // Fallback: start after 5 seconds regardless
        setTimeout(() => {
            clearInterval(checkInterval);
            clearInterval(checkHiddenInterval);
            startWelcomeAnimation();
        }, 5000);
    } else {
        // No preloader, start animation after 2 seconds
        setTimeout(startWelcomeAnimation, 500);
    }
});
