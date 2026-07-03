<style>
    .article-row {
        position: relative;
        z-index: 1;
    }

    .article-row::before {
        content: "";
        position: absolute;
        top: 0;
        bottom: 0;
        left: 50%;
        width: 100vw;
        transform: translateX(-50%);
        background: #D3DCCB;
        opacity: 0;
        transition: opacity 300ms ease;
        z-index: -1;
        pointer-events: none;
    }

    .article-row:hover::before {
        opacity: 1;
    }
</style>

<section id="articles" class="bg-mint-200 bg-transparent pb-20 relative z-40">
    <div class="mx-auto container">
        <h2
            x-data="revealOnScroll()"
            :class="shown ? 'translate-y-0 opacity-100' : 'translate-y-10 opacity-0'"
            class="mb-11 text-azure-500 transition-all duration-700 ease-out"
        >
            {{ __('portal.analytics_title') }}
        </h2>

        <div
            x-data="articlesPreview()"
            @mouseenter="inside = true"
            @mouseleave="leave()"
            @mousemove="move($event)"
            @touchstart="show(0)"
            @hide-articles-preview.window="hideNow()"
            class="mb-10"
        >
            {{-- Preview --}}
            <template x-teleport="body">
                <div
                    id="articles-preview-card"
                    x-show="visible"
                    :style="`
        left:${x}px;
        top:${y}px;
        opacity:${active ? 1 : 0};
        height:${active ? 174 : 0}px;
    `"
                    class="md:hidden pointer-events-none fixed z-[9999]
           w-[260px]
           -translate-x-1/2 -translate-y-1/2
           overflow-hidden rounded-lg bg-white shadow-2xl
           transition-[opacity,height] duration-500 ease-out"
                >
                    <div
                        class="h-[174px] transition-transform duration-1000 ease-[cubic-bezier(.16,1,.3,1)] will-change-transform"
                        :style="`transform: translate3d(0, -${activeIndex * 174}px, 0)`"
                    >
                        @foreach($articles as $article)
                            <div class="h-[174px] w-[300px] overflow-hidden">
                                <img
                                    src="{{ $article->getFirstMediaUrl('cover') }}"
                                    class="h-full w-full object-cover"
                                    draggable="false"
                                    alt=""
                                >
                            </div>
                        @endforeach
                    </div>

                    <div class="absolute inset-0 flex items-center justify-center">
            <span class="rounded-full bg-mint-500 px-4 py-2 font-semibold text-lg text-black backdrop-blur">
                {{ __('portal.read') }}
            </span>
                    </div>
                </div>
            </template>


            @foreach($articles as $i => $article)
                <a
                    href="{{ route('portal.article', $article->id) }}"
                    wire:navigate
                    x-data="revealOnScroll({{ $i * 70 }})"
                    @mouseenter="show({{ $i }})"
                    :class="shown ? 'translate-y-0 opacity-100' : 'translate-y-10 opacity-0'"
                    class="article-row relative grid grid-cols-[150px_1fr_1.15fr] gap-10 border-y border-[#082329]/15 !border-t-0 last:!border-b-0 py-5
           transition-all duration-700 ease-out first:border-t-0
           lg:grid-cols-[110px_1fr] lg:gap-6 md:grid-cols-1 md:flex-col md:flex md:!gap-4"
                >
                    <time class="text-lg text-[#1E1E1E]/50 md:text-[13px]">
                        {{ \Carbon\Carbon::parse($article['date'])->format('d.m.Y') }}
                    </time>

                    <h3 class="line-clamp-2 text-2xl leading-[110%] max-w-[520px] font-semibold md:text-[17px] text-azure-600">
                        {{ $article->getLocalizedValue('title') }}
                    </h3>

                    <p class="line-clamp-3 ml-auto text-lg leading-[130%] max-w-[523px]  md:text-sm text-azure-600 lg:col-start-2 md:col-start-auto">
                        {{ $article->getLocalizedValue('description') }}
                    </p>
                </a>
            @endforeach
        </div>

        <x-Ui.link href="{{route('portal.article_list')}}" class="md:w-full md:py-[13px] px-8 py-4" type="teal">{{ __('portal.view_all_articles') }}</x-Ui.link>
    </div>
</section>

@push('scripts')
    <script>
        function articlesPreview() {
            return {
                visible: false,
                active: false,
                inside: false,

                activeIndex: 0,

                x: 0,
                y: 0,

                targetX: 0,
                targetY: 0,

                raf: null,
                hideTimeout: null,

                show(index) {
                    clearTimeout(this.hideTimeout)

                    this.activeIndex = index

                    if (!this.visible) {
                        this.active = false
                        this.visible = true

                        requestAnimationFrame(() => {
                            requestAnimationFrame(() => {
                                this.active = true
                            })
                        })

                        return
                    }

                    this.active = true
                },

                leave() {
                    this.inside = false
                    this.active = false

                    clearTimeout(this.hideTimeout)

                    this.hideTimeout = setTimeout(() => {
                        this.visible = false
                    }, 500)
                },

                hideNow() {
                    clearTimeout(this.hideTimeout)

                    this.active = false
                    this.visible = false
                    this.inside = false

                    if (this.raf) {
                        cancelAnimationFrame(this.raf)
                        this.raf = null
                    }
                },

                move(e) {
                    this.inside = true

                    this.targetX = e.clientX
                    this.targetY = e.clientY

                    if (!this.visible) {
                        this.x = e.clientX
                        this.y = e.clientY
                        this.visible = true
                    }

                    if (!this.raf) {
                        this.animate()
                    }
                },

                animate() {
                    this.x += (this.targetX - this.x) * 0.15
                    this.y += (this.targetY - this.y) * 0.15

                    if (
                        Math.abs(this.targetX - this.x) < 0.5 &&
                        Math.abs(this.targetY - this.y) < 0.5 &&
                        !this.active
                    ) {
                        this.raf = null
                        return
                    }

                    this.raf = requestAnimationFrame(() => this.animate())
                },
            }
        }
    </script>
@endpush
