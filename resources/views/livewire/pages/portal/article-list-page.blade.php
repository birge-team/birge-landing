@push('body-class')
    bg-azure-500
@endpush

<section class="flex-1 container mt-32">
    <div class="fixed min-w-[100vw]">
        <img src="/fixed/welcome-vector-1.svg"
             class="pointer-events-none absolute left-[56%] top-0 -translate-x-1/2 blur-[200px]"
             alt="">

        <img src="/fixed/welcome-vector-2.svg"
             class="pointer-events-none absolute right-[12%] top-[45vh] z-10 blur-[200px]"
             alt="">
    </div>
    <h2 class="text-white mb-8">{{ __('portal.analytics_title') }}</h2>
    @php
        $filterItems = collect([
            [
                'id' => null,
                'title' => __('portal.article_filters.all'),
                'active' => empty($activeCategoryIds),
                'action' => 'showAllArticles',
            ],
        ])->merge(
            $categories->map(fn ($category) => [
                'id' => $category->id,
                'title' => $category->localizedName(),
                'active' => in_array($category->id, $activeCategoryIds, true),
                'action' => 'toggleCategory(' . $category->id . ')',
            ])
        );

        $activeTitle = $filterItems->firstWhere('active', true)['title'] ?? __('portal.article_filters.all');
    @endphp

    @php
        $selectedCount = count($activeCategoryIds);

        if ($selectedCount === 0) {
            $activeTitle = __('portal.article_filters.all');
        } elseif ($selectedCount === 1) {
            $activeTitle = $categories
                ->firstWhere('id', $activeCategoryIds[0])
                ?->localizedName() ?? __('portal.article_filters.all');
        } else {
            $activeTitle = __('portal.article_filters.selected', ['count' => $selectedCount]);
        }
    @endphp

    <div
        x-data="{ open: false }"
        class="relative z-40 mb-16"
    >
        {{-- Desktop --}}
        <div class="flex flex-wrap gap-2 transition-all duration-700 ease-out md:hidden">
            @foreach($filterItems as $i => $item)
                <button
                    type="button"
                    wire:click="{{ $item['action'] }}"
                    @if($i > 0)
                        x-data="revealOnScroll({{ ($i - 1) * 70 }})"
                    :class="shown ? 'translate-y-0 opacity-100' : 'translate-y-10 opacity-0'"
                    @endif
                    @class([
                        'font-medium text-nowrap lg:py-2 leading-none py-3 border-gradient relative z-40 !rounded-3xl p-5 transition-all duration-700 ease-out',
                        'bg-bright-40 text-azure-400' => $item['active'],
                        'bg-white/5 hover:bg-white/10 text-white' => !$item['active'],
                    ])
                >
                    {{ $item['title'] }}
                </button>
            @endforeach
        </div>

        {{-- Mobile dropdown --}}
        <div class="hidden md:block">
            <button
                type="button"
                @click="open = !open"
                class="border-gradient relative z-40 flex w-full text-sm items-center justify-between bg-white/5 px-5 py-4 md:py-3 font-medium text-white !rounded-3xl"
            >
                <span class="text-nowrap">{{ $activeTitle }}</span>

                <svg
                    :class="open ? 'rotate-180' : 'rotate-0'"
                    class="h-4 w-4 transition-transform duration-300"
                    viewBox="0 0 12 12"
                    fill="none"
                >
                    <path
                        d="M3 4.5L6 7.5L9 4.5"
                        stroke="currentColor"
                        stroke-width="1.5"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                    />
                </svg>
            </button>

            <div
                x-cloak
                x-show="open"
                @click.outside="open = false"
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 -translate-y-3"
                x-transition:enter-end="opacity-100 translate-y-0"
                x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100 translate-y-0"
                x-transition:leave-end="opacity-0 -translate-y-3"
                class="absolute left-0 top-full z-50 mt-3 w-full overflow-hidden text-azure-500 rounded-3xl border bg-white p-2  shadow-2xl backdrop-blur-xl"
            >
                @foreach($filterItems as $item)
                    <div wire:click="{{ $item['action'] }}" @click="open = false" class="flex items-center gap-1 px-4">
                        @if($item['active'])
                            <div class="h-[6px] w-[6px] bg-mint-600 rounded-full"></div>
                        @endif
                        <button
                            type="button"
                            @class([
                                'block w-full rounded-2xl py-[10px] text-left font-medium transition',
                                'text-mint-600' => $item['active'],
                                'text-azure-500' => !$item['active'],
                            ])
                        >
                            {{ $item['title'] }}
                        </button>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <div
        class="transition-all duration-700 ease-out flex flex-col gap-4 pb-[180px] md:pb-[80px] border-b border-bright-40/40 mb-6 md:w-full">
        <div class="grid grid-cols-3 gap-x-4 gap-y-16 xl:grid-cols-2 md:flex-col md:flex md:gap-y-12">
            @foreach($articles as $i => $article)
                <div
                    x-data="revealOnScroll({{ $i * 70 }})"
                    :class="shown ? 'translate-y-0 opacity-100' : 'translate-y-10 opacity-0'"
                    class="transition-all duration-700 ease-out"
                    wire:key="article-wrapper-{{ $article->id }}"
                >
                    <x-article-card :article="$article"/>
                </div>
            @endforeach
        </div>
    </div>
</section>
