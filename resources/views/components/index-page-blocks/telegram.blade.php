<section id="platform" class="pt-[90px] text-white sm:px-4 relative md:mt-auto overflow-visible">
    <div class="mx-auto container">
        <div
            x-data="revealOnScroll()"
            :class="shown ? 'translate-y-0 opacity-100' : 'translate-y-10 opacity-0'"
            class="mb-10 flex items-center justify-between transition-all duration-700 ease-out md:flex-col md:items-start md:gap-4"
        >
            <h2 class="">
                {{ __('portal.telegram_title') }}
            </h2>

            <x-Ui.link :navigate="false" href="https://t.me/birge_team" target="_blank" type="mint" class=" px-8 py-4 md:hidden !text-azure-500 fill-azure-500 z-40 relative">
                <x-slot:icon>
                    <svg class="" width="19" height="18" viewBox="0 0 19 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M9.99868 17.4867L9.98853 17.4886L9.92299 17.5209L9.90453 17.5246L9.89161 17.5209L9.82608 17.4886C9.81623 17.4855 9.80885 17.487 9.80392 17.4932L9.80023 17.5024L9.78454 17.8975L9.78916 17.9159L9.79839 17.9279L9.89438 17.9962L9.90822 17.9999L9.9193 17.9962L10.0153 17.9279L10.0264 17.9131L10.0301 17.8975L10.0144 17.5033C10.0119 17.4935 10.0067 17.4879 9.99868 17.4867ZM10.2433 17.3824L10.2313 17.3843L10.0605 17.4701L10.0513 17.4793L10.0485 17.4895L10.0651 17.8864L10.0698 17.8975L10.0771 17.9039L10.2627 17.9898C10.2744 17.9928 10.2833 17.9904 10.2894 17.9824L10.2931 17.9695L10.2617 17.4027C10.2587 17.3916 10.2525 17.3849 10.2433 17.3824ZM9.58333 17.3843C9.57926 17.3818 9.5744 17.381 9.56975 17.382C9.56511 17.3831 9.56105 17.3858 9.5584 17.3898L9.55287 17.4027L9.52148 17.9695C9.5221 17.9805 9.52733 17.9879 9.53718 17.9916L9.55102 17.9898L9.73654 17.9039L9.74578 17.8965L9.74947 17.8864L9.76516 17.4895L9.76239 17.4784L9.75316 17.4692L9.58333 17.3843Z" fill="#112E3B"/>
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M16.6297 0.108421C16.8578 0.01242 17.1075 -0.0206901 17.3527 0.0125366C17.5979 0.0457632 17.8298 0.144112 18.0241 0.297347C18.2184 0.450582 18.3681 0.653101 18.4576 0.883824C18.5471 1.11455 18.5731 1.36504 18.533 1.60923L16.4396 14.307C16.2365 15.5319 14.8926 16.2343 13.7693 15.6242C12.8297 15.1138 11.4341 14.3274 10.1788 13.5068C9.55118 13.0961 7.62855 11.7808 7.86484 10.8448C8.06791 10.0446 11.2984 7.03744 13.1444 5.24957C13.869 4.54716 13.5386 4.14196 12.6829 4.78807C10.5582 6.39226 7.14674 8.83177 6.01883 9.51848C5.02383 10.124 4.5051 10.2274 3.88484 10.124C2.75323 9.93568 1.70377 9.64401 0.847218 9.28866C-0.310234 8.80869 -0.253931 7.21743 0.846295 6.75408L16.6297 0.108421Z" fill="#112E3B"/>
                    </svg>
                </x-slot:icon>

                {{ __('portal.subscribe') }}
            </x-Ui.link>
        </div>

        <div id="card-vertical-slider" class=" border-b border-bright-40/40 md:border-none grid grid-cols-3 gap-3 lg:grid-cols-2 md:!grid-cols-1  pb-[180px] md:pb-[80px]">
            @foreach($telegramPosts as $i => $post)
                <article
                    x-data="{
        ...revealOnScroll({{ $i * 70 }}),

        hover: false,
        x: 0,
        y: 0,

        move(e) {
            const rect = this.$el.getBoundingClientRect()

            this.x = e.clientX - rect.left
            this.y = e.clientY - rect.top
        }
    }"
                    x-cloak
                    @click="$refs.link.click()"
                    @mouseenter="hover = true; move($event)"
                    @mouseleave="hover = false"
                    @mousemove="move($event)"
                    :class="shown ? 'translate-y-0 opacity-100' : 'translate-y-10 opacity-0'"
                    class="{{ $i >= 3 ? 'md:hidden' : '' }} cursor-pointer hover:cursor-none border-gradient min-h-[165px] md:min-h-[149px]
           flex group flex-col relative z-40 justify-between rounded-lg bg-white/5 p-5
           transition-all duration-700 ease-out hover:bg-white/10 overflow-hidden"
                >
                    <a
                        x-ref="link"
                        href="/"
                        wire:navigate
                        :style="`transform: translate(${x}px, ${y}px) translate(-50%, -50%)`"
                        :class="hover ? 'opacity-100 scale-100' : 'opacity-0 scale-75'"
                        class="absolute left-0 top-0 z-50
               bg-azure-500 px-4 py-3 rounded-3xl text-white whitespace-nowrap
               pointer-events-none
               transition-[transform,opacity,scale]
               duration-75 ease-out"
                    >
                        {{ __('portal.read_article') }}
                    </a>

                    <h3 class="text-xl z-40 md:text-base leading-[120%] font-normal">
                        {!! $post['text'] !!}
                    </h3>

                    <p class="mt-5 text-base font-light text-white/60 md:text-sm">
                        {{ \Carbon\Carbon::parse($post['published_at'])->format('d.m.Y') }}
                    </p>
                </article>
            @endforeach
                <x-Ui.link :navigate="false" href="https://t.me/birge_team" target="_blank" type="mint" class="text-center hidden mt-6 py-4 md:block md:flex w-full !text-azure-500 fill-azure-500 z-40 relative">
                    <x-slot:icon>
                        <svg class="mr-[10px]" width="19" height="18" viewBox="0 0 19 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M9.99868 17.4867L9.98853 17.4886L9.92299 17.5209L9.90453 17.5246L9.89161 17.5209L9.82608 17.4886C9.81623 17.4855 9.80885 17.487 9.80392 17.4932L9.80023 17.5024L9.78454 17.8975L9.78916 17.9159L9.79839 17.9279L9.89438 17.9962L9.90822 17.9999L9.9193 17.9962L10.0153 17.9279L10.0264 17.9131L10.0301 17.8975L10.0144 17.5033C10.0119 17.4935 10.0067 17.4879 9.99868 17.4867ZM10.2433 17.3824L10.2313 17.3843L10.0605 17.4701L10.0513 17.4793L10.0485 17.4895L10.0651 17.8864L10.0698 17.8975L10.0771 17.9039L10.2627 17.9898C10.2744 17.9928 10.2833 17.9904 10.2894 17.9824L10.2931 17.9695L10.2617 17.4027C10.2587 17.3916 10.2525 17.3849 10.2433 17.3824ZM9.58333 17.3843C9.57926 17.3818 9.5744 17.381 9.56975 17.382C9.56511 17.3831 9.56105 17.3858 9.5584 17.3898L9.55287 17.4027L9.52148 17.9695C9.5221 17.9805 9.52733 17.9879 9.53718 17.9916L9.55102 17.9898L9.73654 17.9039L9.74578 17.8965L9.74947 17.8864L9.76516 17.4895L9.76239 17.4784L9.75316 17.4692L9.58333 17.3843Z" fill="#112E3B"/>
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M16.6297 0.108421C16.8578 0.01242 17.1075 -0.0206901 17.3527 0.0125366C17.5979 0.0457632 17.8298 0.144112 18.0241 0.297347C18.2184 0.450582 18.3681 0.653101 18.4576 0.883824C18.5471 1.11455 18.5731 1.36504 18.533 1.60923L16.4396 14.307C16.2365 15.5319 14.8926 16.2343 13.7693 15.6242C12.8297 15.1138 11.4341 14.3274 10.1788 13.5068C9.55118 13.0961 7.62855 11.7808 7.86484 10.8448C8.06791 10.0446 11.2984 7.03744 13.1444 5.24957C13.869 4.54716 13.5386 4.14196 12.6829 4.78807C10.5582 6.39226 7.14674 8.83177 6.01883 9.51848C5.02383 10.124 4.5051 10.2274 3.88484 10.124C2.75323 9.93568 1.70377 9.64401 0.847218 9.28866C-0.310234 8.80869 -0.253931 7.21743 0.846295 6.75408L16.6297 0.108421Z" fill="#112E3B"/>
                        </svg>
                    </x-slot:icon>
                    {{ __('portal.subscribe') }}
                </x-Ui.link>
        </div>
    </div>
</section>
