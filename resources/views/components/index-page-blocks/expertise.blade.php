<style>
    .about-hidden {
        opacity: 0;
        transform: translateY(80px);
    }
</style>

<section id="about" class="h-screen md:h-auto about-section overflow-hidden bg-transparent py-16 md:px-4 relative z-40 ">
    <style>
        .gradient-border-circle-about {
            border-radius: 9999px;
        }

        .group:hover .gradient-border-circle-about::before {
            background: linear-gradient(
                135deg,
                rgb(255, 255, 255) 0%,
                rgba(255, 255, 255, 0) 100%
            );
        }

        .gradient-border-circle-about::before {
            content: "";
            position: absolute;
            inset: 0;
            padding: 1.5px;
            border-radius: inherit;

            background: linear-gradient(
                135deg,
                rgba(41, 90, 87, 1) 0%,
                rgba(41, 90, 87, 0) 100%
            );

            -webkit-mask:
                linear-gradient(#fff 0 0) content-box,
                linear-gradient(#fff 0 0);
            -webkit-mask-composite: xor;

            mask:
                linear-gradient(#fff 0 0) content-box,
                linear-gradient(#fff 0 0);
            mask-composite: exclude;

            pointer-events: none;
        }
    </style>
    <div class="mx-auto container md:w-full">
        <h2
            x-data="revealOnScroll()"
            :class="shown ? 'translate-y-0 opacity-100' : 'translate-y-10 opacity-0'"
            class="text-azure-500 transition-all duration-700 ease-out mb-10"
        >
            {{ __('portal.expertise_title') }}
        </h2>

        <div
            x-data="revealOnScroll(150)"
            :class="shown ? 'translate-y-0 opacity-100' : 'translate-y-10 opacity-0'"
            class="about-viewport overflow-visible transition-all duration-700 ease-out"
        >
            <div class="about-track flex md:flex-col gap-4 will-change-transform">
                @foreach($expertise as $key => $item)
                    @php
                        $subject = __('portal.email_subject');

                        $body = __('portal.email_body', ['service' => $item['mail_title']]);

                        $mailto = 'mailto:info@birgeteam.com?subject='
                            . rawurlencode($subject)
                            . '&body='
                            . rawurlencode(strip_tags($body));
                    @endphp


                    <article
                        x-data="{
                            get minH() {
                                return window.innerWidth < 768 ? this.$el.offsetWidth + 'px' : null;
                            }
                        }"
                        x-init="$el.style.minHeight = minH"
                        @resize.window="$el.style.minHeight = minH"
                        class="@if($loop->even) mt-10 md:mt-0 @endif p-6 md:p-4 birge-soft-card relative flex h-[520px] w-[520px] md:w-full md:min-w-0 md:h-auto min-w-[520px] aspect-square md:hover:aspect-auto flex-col justify-end rounded-lg bg-[#D3DCCB] group hover:bg-mint-800"
                    >
                        <img src="/fixed/expertise/expertise-{{$key + 1}}.1.svg" class="absolute {{$item['bg-class']}} transition group-hover:opacity-0" alt="">
                        <img src="/fixed/expertise/expertise-{{$key + 1}}.2.svg" class="absolute {{$item['bg-class']}} transition group-hover:opacity-0" alt="">

                        <img src="/fixed/expertise/expertise-{{$key + 1}}.1_hover.svg" class="absolute {{$item['bg-class']}} opacity-0 transition group-hover:opacity-100" alt="">
                        <img src="/fixed/expertise/expertise-{{$key + 1}}.2_hover.svg" class="absolute {{$item['bg-class']}} opacity-0 transition group-hover:opacity-100" alt="">
                        <button
                                    class="gradient-border-circle-about absolute right-4 top-4 flex h-12 w-12 md:h-10 md:w-10 items-center justify-center rounded-full bg-mint-800/10">
                            <img src="/fixed/plus.svg" alt="" class="transition group-hover:hidden">
                            <svg class="transition hidden group-hover:block" width="24" height="2" viewBox="0 0 24 2" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <rect y="2" width="2" height="24" transform="rotate(-90 0 2)" fill="white"/>
                            </svg>

                        </button>

                        <h3 class="max-w-sm text-4xl min-w-full leading-[110%] font-medium text-mint-900 md:text-xl relative md:leading-[110%] z-20 group-hover:hidden transition">
                            {!! $item['title'] !!}
                        </h3>
                        <div class="flex-col relative z-40 text-white text-lg hidden group-hover:flex transition md:pt-16">
                            <ul class='list-disc space-y-4 pl-4 leading-[110%] md:leading-[110%]  mb-6 md:text-sm'>
                                {!! $item['description'] !!}
                            </ul>

                            <a
                                href="{{ $mailto }}"
                                class="w-full py-4 rounded-[26px] text-base leading-[100%] md:leading-3 bg-white font-medium text-center text-azure-600 md:text-sm"
                            >
                                {{ __('portal.request_consultation') }}
                            </a>

                        </div>
                    </article>
                @endforeach
            </div>
        </div>
    </div>
</section>
