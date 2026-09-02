<section class="bg-mint-200 flex-1">
    <style>
        .article-content p {
            max-width: 648px;
            margin: auto;
        }

        .article-content img {
            margin: auto;
        }

        .attachment__caption {
            display: none;
        }
    </style>
    @section('title')
        {{$article->getLocalizedValue('title')}}
    @endsection
    <div class="flex flex-col mb-24 container md:mb-12">
        <div class="w-full py-12">
            <div class="w-full article-content flex flex-col items-center ">
                <div x-data="revealOnScroll()"
                     :class="shown ? 'translate-y-0 opacity-100' : 'translate-y-10 opacity-0'"
                     class="grid grid-cols-3 md:flex md:flex-col  mb-6 w-full transition-all duration-700 ease-out md:gap-8">
                    <a
                        wire:navigate
                        href="{{ route('portal.article_list') }}"
                        class="group flex w-fit items-center gap-2 text-lg"
                    >
                        <svg
                            class="transition-transform duration-300 ease-out group-hover:-translate-x-1"
                            width="18"
                            height="10"
                            viewBox="0 0 18 10"
                            fill="none"
                            xmlns="http://www.w3.org/2000/svg"
                        >
                            <path
                                d="M17.8486 4.92427H0.848633M5.34863 9.42427L0.848633 4.92427L5.34863 0.424271"
                                stroke="currentColor"
                                stroke-width="1.2"
                            />
                        </svg>

                        <span>{{ __('portal.back') }}</span>
                    </a>

                    <span
                        class="mx-auto  px-3 py-2 text-sm text-center text-azure-500/40 uppercase w-fit md:px-0 md:text-start md:mx-0">
                    {{ $article->category->localizedName() }} / {{ $article['date'] }}
                </span>
                </div>

                <h1 x-data="revealOnScroll()"
                    :class="shown ? 'translate-y-0 opacity-100' : 'translate-y-10 opacity-0'"
                    class="mb-8 max-w-5xl leading-none text-center transition-all duration-700 ease-out md:text-start">{{$article->getLocalizedValue('title')}}</h1>
                <span x-data="revealOnScroll()"
                      :class="shown ? 'translate-y-0 opacity-100' : 'translate-y-10 opacity-0'"
                      class="transition-all duration-700 ease-out max-w-2xl text-lg font-normal text-center md:text-start">{{$article->getLocalizedValue('description')}}</span>
            </div>
        </div>

        <img
            x-data="revealOnScroll()"
            :class="shown ? 'translate-y-0 opacity-100' : 'translate-y-10 opacity-0'"
            src="{{$article->getFirstMediaUrl('cover')}}" class=" transition-all duration-700 ease-out w-full rounded-lg max-h-[642px] object-cover md:aspect-square" alt="">

    </div>
    <x-article-content :article="$article"/>

    <div
        x-data="revealOnScroll()"
        :class="shown ? 'translate-y-0 opacity-100' : 'translate-y-10 opacity-0'"
        class="container mb-6 flex flex-col gap-4 border-b border-black/40 pb-[150px] md:pb-[80px] transition-all duration-700 ease-out"
    >
        <div class="mb-10 flex items-center justify-between md:mb-6">
            <h2 class="text-nowrap text-black">{{ __('portal.other_articles') }}</h2>
        </div>

        <div class="swiper other-articles-swiper w-full overflow-hidden">
            <div class="swiper-wrapper">
                @foreach($otherArticles as $article)
                    <div class="swiper-slide !h-auto">
                        <x-article-card color="dark" :article="$article"/>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

@push('scripts')
    <script>
        function initOtherArticlesSwiper() {
            const el = document.querySelector('.other-articles-swiper')

            if (!el) {
                return
            }

            if (el.swiper) {
                el.swiper.destroy(true, true)
            }

            new Swiper(el, {
                speed: 700,
                slidesPerView: 3,
                spaceBetween: 16,
                preventClicks: false,
                preventClicksPropagation: false,
                touchStartPreventDefault: false,

                breakpoints: {
                    0: {
                        slidesPerView: 1.1,
                        spaceBetween: 12,
                    },
                    768: {
                        slidesPerView: 2,
                        spaceBetween: 16,
                    },
                    1024: {
                        slidesPerView: 3,
                        spaceBetween: 16,
                    },
                },
            })
        }

        document.addEventListener('DOMContentLoaded', initOtherArticlesSwiper)

        document.addEventListener('livewire:navigated', () => {
            setTimeout(initOtherArticlesSwiper, 0)
        })
    </script>
@endpush
