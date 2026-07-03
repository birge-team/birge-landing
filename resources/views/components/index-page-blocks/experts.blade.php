<section id="team" class="team-section bg-transparent py-[140px] md:py-20 text-white bg-azure-500">
    <div class="mx-auto container">
        <div
            class="mb-9 flex items-center justify-between transition-all duration-700 ease-out"
        >
            <h2 class="">
                Эксперты Birge
            </h2>

            <div class="flex gap-2 md:hidden">
                <button
                    class="team-prev gradient-border-cirle flex h-12 w-12 items-center justify-center border-gradient !rounded-full !bg-bright-40/10 hover hover:!bg-bright-40/20 transition">
                    <svg class="mr-1" width="12" height="21" viewBox="0 0 12 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M11.0146 19.9071L1.41465 10.3071L11.0146 0.707104" stroke="white" stroke-width="2"/>
                    </svg>
                </button>
                <button
                    class="team-next gradient-border-cirle flex h-12 w-12 items-center justify-center border-gradient !rounded-full !bg-bright-40/10 hover hover:!bg-bright-40/20 transition">
                    <svg class="ml-1" width="12" height="21" viewBox="0 0 12 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M0.707031 19.9071L10.307 10.3071L0.707031 0.707104" stroke="white" stroke-width="2"/>
                    </svg>
                </button>
            </div>
        </div>


        <div
            x-data="revealOnScroll(150)"
            :class="shown ? 'translate-y-0 opacity-100' : 'translate-y-10 opacity-0'"
            class="swiper team-swiper transition-all duration-700 ease-out md:!overflow-visible"
        >
            <div class="swiper-wrapper">
                @foreach($experts as $expert)
                    <article
                        class="swiper-slide cursor-pointer overflow-hidden rounded-lg max-w-[328px] md:max-w-[280px]"
                        @click="$dispatch('open-expert', { id: {{ $expert->id }} })"
                    >
                        <div class="overflow-hidden rounded-lg h-[362px] w-[328px] md:w-[280px] md:h-[309px]">
                            <img
                                data-expert-image="{{ $expert->id }}"
                                src="{{ $expert->getFirstMediaUrl('image') }}"
                                alt="{{ $expert->getLocalizedValue('name') }}"
                                class="object-cover transition hover:scale-105 duration-500"
                            >
                        </div>

                        <div class="min-h-[190px] md:min-h-[153px] max-w-[328px] md:max-w-[280px] bg-bright-40/10 p-4 pt-5 flex flex-col">
                            <h3 class="text-[22px] md:text-[17px] font-semibold leading-tight">
                                {{ $expert->getLocalizedValue('name') }}
                            </h3>

                            <p class="mt-4 text-lg font-normal md:text-sm leading-[120%] text-white/60">
                                {{ $expert->getLocalizedValue('description_short') }}
                            </p>

                            <span class="font-normal md:text-sm block mt-auto text-lg text-white">
            {{ $expert->email }}
        </span>
                        </div>
                    </article>
                @endforeach
            </div>
        </div>
    </div>
    <livewire:components.expert-popup />
</section>

@push('scripts')
    <script>
        function initTeamSwiper() {
            const el = document.querySelector('.team-swiper');

            if (!el) {
                return;
            }

            if (el.swiper) {
                el.swiper.destroy(true, true);
            }

            new Swiper(el, {
                speed: 650,
                navigation: {
                    nextEl: '.team-next',
                    prevEl: '.team-prev',
                },
                breakpoints: {
                    0: {
                        slidesPerView: 'auto',
                        spaceBetween: 10,
                        centeredSlides: false,
                    },
                    900: {
                        slidesPerView: 2,
                        slidesPerGroup: 2,
                        spaceBetween: 14,
                    },
                    1024: {
                        slidesPerView: 4,
                        slidesPerGroup: 4,
                        spaceBetween: 14,
                    },
                },
            });
        }

        document.addEventListener('DOMContentLoaded', initTeamSwiper);

        document.addEventListener('livewire:navigated', () => {
            setTimeout(initTeamSwiper, 0);
        });
    </script>
@endpush
