@push('styles')
    <style>
        .birge-bg {
            background: radial-gradient(circle at 75% 20%, rgba(153, 213, 184, .42), transparent 28%),
            radial-gradient(circle at 50% 0%, rgba(31, 139, 126, .5), transparent 38%),
            linear-gradient(180deg, #092f34 0%, #071d27 74%, #061722 100%);
        }

        .birge-soft-card {
            background: radial-gradient(circle at 60% 28%, rgba(30, 145, 132, .48), transparent 42%),
            linear-gradient(135deg, rgba(225, 234, 216, .96), rgba(211, 224, 204, .76));
        }

        .team-swiper .swiper-slide {
            height: auto;
        }

        .swiper-button-disabled {
            opacity: .35;
            pointer-events: none;
        }
    </style>
@endpush

<div class="text-[#071b25] relative">

    <div class="page-bg fixed inset-0 h-screen md:h-[130dvh] pointer-events-none z-[-2] bg-azure-500"></div>

    <div class="page-vectors fixed inset-0 h-screen pointer-events-none z-0 ">
        <div class="absolute md:hidden left-0 top-0 md:right-0 md:left-auto w-full h-full will-change-transform transform-gpu">
            <img src="/fixed/welcome-vector-1.png"
                 class="w-full h-full"
                 alt="">
        </div>
        <div class="absolute hidden md:block left-0 top-0 md:right-0 md:left-auto w-full h-full will-change-transform transform-gpu">
            <img src="/fixed/welcome-vector-1-mobile.png"
                 class="w-full h-full"
                 alt="">
        </div>

        <div class="absolute md:hidden right-0 top-0 w-full h-full will-change-transform transform-gpu">
            <img src="/fixed/welcome-vector-2.png"
                 class="w-full h-full"
                 alt="">
        </div>

        <div class="absolute hidden md:block right-0 top-0 w-full h-full will-change-transform transform-gpu">
            <img src="/fixed/welcome-vector-2-mobile.png"
                 class="w-full h-full"
                 alt="">
        </div>
    </div>

    <x-index-page-blocks.welcome :first-article="$articles[0]"/>

    <div class="team-about-transition relative h-screen overflow-visible md:h-auto md:overflow-visible pt-[10%] z-[99]">
        <div class="transition-bg absolute inset-0 z-0 0"></div>

        <div class="team-layer absolute inset-0 z-20 md:relative md:inset-auto md:z-auto">
            <x-index-page-blocks.experts :experts="$experts"/>
        </div>

        <div
            class="about-layer absolute inset-x-0 top-1/2 -translate-y-1/2 z-30 pointer-events-none md:relative md:inset-auto md:z-auto md:pointer-events-auto md:top-auto md:translate-y-0 top-[70%]">
            <x-index-page-blocks.expertise :expertise="$expertise"/>
        </div>
    </div>

    <div class="analytics-telegram-transition relative h-screen md:h-auto z-[99] overflow-visible mt-[200px] md:mt-[80px]">
        <div class="telegram-bg absolute md:hidden inset-0 z-0 bg-azure-500"></div>

        <div class="telegram-vectors fixed inset-0 z-10 pointer-events-none opacity-0 h-[130dvh]">
            <div class="absolute md:hidden left-0 top-0 md:right-0 md:left-auto w-full h-full will-change-transform transform-gpu">
                <img src="/fixed/welcome-vector-1.png"
                     class="w-full h-full"
                     alt="">
            </div>
            <div class="absolute hidden md:block left-0 top-0 md:right-0 md:left-auto w-full h-full will-change-transform transform-gpu">
                <img src="/fixed/welcome-vector-1-mobile.png"
                     class="w-full h-full"
                     alt="">
            </div>

            <div class="absolute md:hidden right-0 top-0 w-full h-full will-change-transform transform-gpu">
                <img src="/fixed/welcome-vector-2.png"
                     class="w-full h-full"
                     alt="">
            </div>

            <div class="absolute hidden md:block right-0 top-0 w-full h-full will-change-transform transform-gpu">
                <img src="/fixed/welcome-vector-2-mobile.png"
                     class="w-full h-full"
                     alt="">
            </div>
        </div>

        <div class="analytics-layer absolute md:relative  inset-0 z-20">
            <x-index-page-blocks.analytics :articles="$articles"/>
        </div>

        <div class="telegram-layer absolute inset-0 z-30 pointer-events-none md:relative">
            <x-index-page-blocks.telegram/>
        </div>
    </div>

</div>

@push('scripts')
    <script type="module">
        function initTeamAboutTransition() {

            gsap.registerPlugin(ScrollTrigger);

            const wrapper = document.querySelector('.team-about-transition');
            const teamLayer = wrapper?.querySelector('.team-layer');
            const aboutLayer = wrapper?.querySelector('.about-layer');
            const about = wrapper?.querySelector('#about');
            const track = wrapper?.querySelector('.about-track');
            const container = wrapper?.querySelector('#about .container');
            const vectors = document.querySelector('.page-vectors');
            const pageBg = document.querySelector('.page-bg');
            const isMobile = window.innerWidth < 768;
            // const bg = wrapper?.querySelector('.transition-bg');

            if (!wrapper || !teamLayer || !aboutLayer || !about || !track || !container || !vectors || !pageBg) {
                return;
            }

            ScrollTrigger.getAll().forEach(trigger => {
                if (trigger.vars?.id?.startsWith('team-about-transition')) {
                    trigger.kill();
                }
            });

            gsap.killTweensOf([wrapper, teamLayer, aboutLayer, about, track, vectors]);

            const getScrollDistance = () => {
                const containerWidth = container.getBoundingClientRect().width;

                return Math.max(0, track.scrollWidth - containerWidth);
            };

            // gsap.set(wrapper, {
            //     backgroundColor: '#0a1c2b',
            // });
            gsap.set(vectors, {
                opacity: 1,
                y: 0,
            });

            gsap.set(teamLayer, {
                y: 0,
                opacity: 1,
            });

            gsap.set(aboutLayer, {
                opacity: 0,
                y: 80,
                pointerEvents: 'none',
            });

            gsap.set(track, {
                x: 0,
            });

            const tl = gsap.timeline({
                scrollTrigger: {
                    id: 'team-about-transition-main',
                    trigger: wrapper,
                    start: '20% top',
                    end: () => isMobile
                        ? `+=${window.innerHeight * 0.5}`
                        : `+=${window.innerHeight * 0.7 + getScrollDistance()}`,
                    scrub: 1,
                    pin: !isMobile,
                    pinSpacing: !isMobile,
                    anticipatePin: isMobile ? 0 : 1,
                    invalidateOnRefresh: true,
                }
            });

            tl.to(teamLayer, {
                y: isMobile ? 0 : -160,
                opacity: 0,
                ease: 'none',
                duration: 0.2,
            }, 0);

            tl.to(vectors, {
                y: -120,
                opacity: 0,
                ease: 'none',
                duration: 0.2,
            }, '<');
            // }

            tl.to(pageBg, {
                backgroundColor: '#EFF5E9',
                ease: 'none',
                zIndex: 9,
                duration: 0.2,
                onReverseComplete() {
                    gsap.set(pageBg, {
                        backgroundColor: '#0a1c2b',
                        zIndex: -2,
                    });
                },
            }, '<');

            tl.to({}, {
                duration: 0.15,
            });

            // if (!isMobile) {
            tl.to(aboutLayer, {
                opacity: 1,
                y: 0,
                ease: 'none',
                duration: 0.22,
                onStart() {
                    aboutLayer.style.pointerEvents = 'auto';
                },
                onReverseComplete() {
                    aboutLayer.style.pointerEvents = 'none';
                },
            });
            tl.to(track, {
                x: () => -getScrollDistance(),
                ease: 'none',
                duration: 1,
            });
            // }

            ScrollTrigger.refresh();
        }

        function initAnalyticsTelegramTransition() {

            gsap.registerPlugin(ScrollTrigger);

            const wrapper = document.querySelector('.analytics-telegram-transition');
            const bg = wrapper?.querySelector('.telegram-bg');
            const vectors = wrapper?.querySelector('.telegram-vectors');
            const analyticsLayer = wrapper?.querySelector('.analytics-layer');
            const telegramLayer = wrapper?.querySelector('.telegram-layer');
            const pageBg = document.querySelector('.page-bg');

            const isMobile = window.innerWidth < 768;

            // const isMobile = false;

            if (!wrapper || !analyticsLayer || !telegramLayer) {
                return;
            }

            ScrollTrigger.getAll().forEach(trigger => {
                if (trigger.vars?.id?.startsWith('analytics-telegram-transition')) {
                    trigger.kill();
                }
            });

            gsap.killTweensOf([wrapper, bg, vectors, analyticsLayer, telegramLayer]);


            if (bg) {
                gsap.set(bg, {
                    backgroundColor: '#EFF5E9',
                });
            }

            if (vectors) {
                gsap.set(vectors, {
                    opacity: 0,
                    y: 120,
                });
            }
            analyticsLayer.style.pointerEvents = 'auto';
            gsap.set(analyticsLayer, {
                y: 0,
                opacity: 1,
            });

            gsap.set(telegramLayer, {
                opacity: 0,
                y: 80,
                pointerEvents: 'none',
            });

            if (isMobile) {
                gsap.set([analyticsLayer, telegramLayer], {
                    clearProps: 'all',
                    opacity: 1,
                    y: 0,
                    pointerEvents: 'auto',
                });

                if (vectors) {
                    gsap.set(vectors, {
                        opacity: 0,
                        y: 0,
                    });
                }

                if (isMobile) {
                    gsap.set([analyticsLayer, telegramLayer], {
                        clearProps: 'all',
                        opacity: 1,
                        y: 0,
                        pointerEvents: 'auto',
                    });

                    if (vectors) {
                        gsap.set(vectors, {
                            opacity: 0,
                            y: 0,
                        });
                    }

                    const mobileTl = gsap.timeline({
                        scrollTrigger: {
                            id: 'analytics-telegram-mobile-bg',
                            trigger: telegramLayer,
                            start: 'top bottom',
                            end: 'top center',
                            scrub: 1,
                            invalidateOnRefresh: true,
                        }
                    });

                    mobileTl.to(pageBg, {
                        backgroundColor: '#0A1C2B',
                        ease: 'none',
                        duration: 1,
                    }, 0);

                    mobileTl.to(analyticsLayer, {
                        opacity: 0,
                        ease: 'none',
                        duration: 1,
                    }, 0);

                    if (vectors) {
                        mobileTl.to(vectors, {
                            opacity: 1,
                            ease: 'none',
                            duration: 1,
                        }, 0);
                    }

                    return;
                }

                return;
            }

            const tl = gsap.timeline({
                scrollTrigger: {
                    id: 'analytics-telegram-transition-main',
                    trigger: wrapper,
                    start: 'bottom bottom',
                    end: () => isMobile
                        ? `+=${window.innerHeight * 1.4}`
                        : `+=${window.innerHeight * 1.4}`,
                    scrub: 1,
                    pin: !isMobile,
                    pinSpacing: !isMobile,
                    anticipatePin: isMobile ? 0 : 1,
                    invalidateOnRefresh: true,
                }
            });

            // 1. Аналитика исчезает
            tl.to(analyticsLayer, {
                y: -160,
                opacity: 0,
                ease: 'none',
                duration: 0.25,

                onStart() {
                    window.dispatchEvent(new CustomEvent('hide-articles-preview'));
                    analyticsLayer.style.pointerEvents = 'none';
                },

                onReverseComplete() {
                    analyticsLayer.style.pointerEvents = 'auto';
                },
            }, 0);

            if (!isMobile) {
                tl.to({}, {
                    duration: 0.8,   // чем больше число, тем дольше он будет закреплен
                });
            }

            // 2. Фон темнеет и вектора появляются одновременно
            if (bg) {
                tl.to(bg, {
                    backgroundColor: '#0A1C2B',
                    ease: 'none',
                    duration: 0.25,
                }, '<');
                tl.to(analyticsLayer, {
                    opacity: 0,
                }, '<');
                tl.to(pageBg, {
                    backgroundColor: '#0A1C2B',
                    ease: 'none',
                    zIndex: 9,
                    duration: 0.2,
                }, '<');
            }

            if (vectors) {
                tl.to(vectors, {
                    y: 0,
                    opacity: 1,
                    ease: 'none',
                    duration: 0.25,
                }, '<');
            }

            if (!isMobile) {
                // 3. Пауза
                tl.to({}, {
                    duration: 0.15,
                });
            }

            // 4. Telegram появляется
            tl.to(telegramLayer, {
                opacity: 1,
                y: 0,
                ease: 'none',
                duration: 0.25,
                onStart() {
                    telegramLayer.style.pointerEvents = 'auto';
                },
                onReverseComplete() {
                    telegramLayer.style.pointerEvents = 'none';
                },
            }, '<');

            // удерживаем Telegram на экране
            // if (!isMobile) {
            //     tl.to({}, {
            //         duration: 0.8,   // чем больше число, тем дольше он будет закреплен
            //     });
            // }

            ScrollTrigger.refresh();
        }

        function initPageTransitions() {
            initTeamAboutTransition();
            initAnalyticsTelegramTransition();
        }

        const isMobile = window.innerWidth < 768;
        // if (!isMobile) {
        document.addEventListener('DOMContentLoaded', initPageTransitions);
        document.addEventListener('livewire:navigated', () => {
            setTimeout(initPageTransitions, 0);
        });
        // }

    </script>
@endpush
