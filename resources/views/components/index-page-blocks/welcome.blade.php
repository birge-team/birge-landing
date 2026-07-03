<section class="flex items-center min-h-screen text-white md:pb-0 ">
    <style>
        .welcome-text-line {
            transform: translateY(100%);
        }
        .welcome-expert-item,
        .welcome-cta-button {
            opacity: 0;
            visibility: hidden;
            transform: translateY(100%);
        }
    </style>
    <div
        class="mx-auto flex justify-between container gap-16 transition-all lg:flex-col lg:gap-10 lg:mt-32">
        <div
            class="transition-all duration-900 ease-out z-20 max-w-[883px]"
        >
            <h1 class="text-white min-w-max leading-[100%] lg:leading-none md:!leading-tight xl:!min-w-0 mb-16 welcome-text">
                <div class="overflow-hidden"><span class="welcome-text-line inline-block">{{ __('portal.title.line1') }}</span></div>
                <div class="overflow-hidden"><span class="welcome-text-line inline-block">{{ __('portal.title.line2') }}</span></div>
                <div class="overflow-hidden"><span class="welcome-text-line inline-block">{{ __('portal.title.line3') }}</span></div>
                <div class="overflow-hidden"><span class="welcome-text-line inline-block">{{ __('portal.title.line4') }}</span></div>
            </h1>

            <div class="grid max-w-4xl grid-cols-[max-content_max-content] gap-x-14 gap-y-7 md:grid-cols-1 mb-16">
                @foreach([
                    ['title' => __('portal.stats.experts.title'), 'text' => __('portal.stats.experts.text')],
                    ['title' => __('portal.stats.geography.title'), 'text' => __('portal.stats.geography.text')],
                    ['title' => __('portal.stats.experience.title'), 'text' => __('portal.stats.experience.text')],
                    ['title' => __('portal.stats.partners.title'), 'text' => __('portal.stats.partners.text')],
                ] as $item)
                    <div class="welcome-expert-item flex gap-3">
                        <svg width="18" height="20" viewBox="0 0 18 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M17.9144 10.1815C13.1164 10.3978 9.40165 14.5067 9.61999 19.356L7.87525 19.4346L7.50353 11.1782C7.49122 10.9048 7.26143 10.6926 6.99094 10.7048L0.0796564 11.0164L0.000271887 9.25302C4.79826 9.03671 8.513 4.92789 8.29468 0.0786539L10.0394 -2.97608e-06L10.4111 8.25635C10.4234 8.52973 10.6532 8.74195 10.9237 8.72975L17.835 8.41817L17.9144 10.1815Z"
                                fill="#DEFEC0"/>
                        </svg>
                        <div>
                            <p class="text-xl md:text-sm font-medium leading-tight text-mint-500">
                                {{ $item['title'] }}
                            </p>
                            <p class="mt-px leading-relaxed text-white md:text-sm">
                                {{ $item['text'] }}
                            </p>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="overflow-hidden inline-block md:block">
                <div class="welcome-cta-button">
                    <x-Ui.link type="mint" class="px-8 py-4 md:w-full">
                        {{ __('portal.request_consultation') }}
                    </x-Ui.link>
                </div>
            </div>

        </div>

        <div class="flex justify-end lg:justify-start">
            <article
                x-data="{
    shown: false,
    hover: false,
    expanded: false,
    timer: null,
    x: 0,
    y: 0,

    init() {
        setTimeout(() => this.shown = true, 3000)
    },

    move(e) {
        const rect = this.$el.getBoundingClientRect()
        this.x = e.clientX - rect.left
        this.y = e.clientY - rect.top
    },

    enter(e) {
        this.hover = true
        this.move(e)

        clearTimeout(this.timer)
        this.timer = setTimeout(() => {
            this.expanded = true
        }, 120)
    },

    leave() {
        clearTimeout(this.timer)
        this.expanded = false

        setTimeout(() => {
            this.hover = false
        }, 250)
    }
}"
                x-cloak
                @click="$refs.link.click()"
                @mouseenter="enter($event)"
                @mouseleave="leave()"
                @mousemove="move($event)"
                :class="shown ? 'translate-x-0 opacity-100' : 'translate-x-16 opacity-0'"
                class="relative z-20 -bottom-20 md:bottom-auto md:!min-w-0 self-end max-w-[350px] min-w-[350px]
           flex flex-col gap-4 rounded-lg bg-mint-500/10
           p-4 backdrop-blur transition-all duration-1000 border-gradient ease-out
           lg:max-w-md overflow-hidden hover:cursor-none"
            >
                <a
                    href="{{ route('portal.article', $firstArticle->id) }}"
                    wire:navigate
                    x-ref="link"
                    :style="`transform: translate(${x}px, ${y}px) translate(-50%, -50%)`"
                    class="absolute left-0 top-0 z-30 h-11 w-[170px]
           pointer-events-none"
                >
    <span
        :class="hover ? 'opacity-100' : 'opacity-0'"
        class="absolute left-1/2 top-1/2 h-11
               -translate-x-1/2 -translate-y-1/2
               rounded-full bg-azure-500
               overflow-hidden
               transition-opacity duration-150"
    >
        <span
            :class="expanded ? 'w-[150px]' : 'w-0'"
            class="flex h-full items-center justify-center
                   overflow-hidden whitespace-nowrap
                   transition-[width] duration-50 ease-out"
        >
            <span
                :class="expanded ? 'opacity-100' : 'opacity-0'"
                class="px-5 text-white transition-opacity duration-200 delay-150"
            >
                {{ __('portal.read_article') }}
            </span>
        </span>
    </span>
                </a>
                <div class="aspect-[16/10] overflow-hidden bg-white/10 rounded-lg">
                    <img
                        src="{{ $firstArticle->getFirstMediaUrl('cover') }}"
                        alt=""
                        class="h-full w-full object-cover"
                    >
                </div>

                <h2 class="text-[22px] md:!text-[17px] font-medium leading-[110%] line-clamp-4">
                    {{ $firstArticle->getLocalizedValue('title') }}
                </h2>

                <p class="text-white line-clamp-4 leading-[130%]">
                    {{ $firstArticle->getLocalizedValue('description') }}
                </p>

                <a
                    href="{{ route('portal.article', $firstArticle->id) }}"
                    class="hidden md:block text-white underline text-sm"
                >
                    {{ __('portal.read_article') }}
                </a>
            </article>
        </div>
    </div>
</section>
