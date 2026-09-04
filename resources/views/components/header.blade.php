@php
    $menu = [
        [
            'key' => 'about',
            'title' => __('portal.menu.about'),
            'href' => route('portal.index') . '#about',
            'anchor' => true,
        ],
        [
            'key' => 'team',
            'title' => __('portal.menu.team'),
            'href' => route('portal.index') . '#team',
            'anchor' => true,
        ],
        [
            'key' => 'services',
            'title' => __('portal.menu.services'),
            'href' => route('portal.index') . '#articles',
            'anchor' => true,
        ],
        [
            'key' => 'articles',
            'title' => __('portal.menu.articles'),
            'href' => route('portal.article_list'),
            'navigate' => true,
        ],
        [
            'key' => 'platform',
            'title' => __('portal.menu.platform'),
            'href' => 'https://login.birgeteam.com/login/',
            'anchor' => false,
        ],
    ];
@endphp

<header
    x-data="{
    menuOpen: false,
    scrollY: 0,

    lockScroll() {
        this.scrollY = window.scrollY;

        document.body.style.position = 'fixed';
        document.body.style.top = `-${this.scrollY}px`;
        document.body.style.left = '0';
        document.body.style.right = '0';
        document.body.style.width = '100%';
        document.body.style.overflow = 'hidden';

        document.documentElement.style.overflow = 'hidden';
    },

    unlockScroll() {
        document.body.style.position = '';
        document.body.style.top = '';
        document.body.style.left = '';
        document.body.style.right = '';
        document.body.style.width = '';
        document.body.style.overflow = '';

        document.documentElement.style.overflow = '';

        window.scrollTo(0, this.scrollY);
    },

    isHome: @js(request()->routeIs('portal.index') || request()->routeIs('portal.article_list')),
    ...( @js(request()->routeIs('portal.index'))
        ? revealOnScroll()
        : { shown: true }
    )
}"
    x-effect="menuOpen ? lockScroll() : unlockScroll()"

    @destroy.window="
    document.documentElement.classList.remove('overflow-hidden');
    document.body.classList.remove('overflow-hidden');
"
    @keydown.escape.window="menuOpen = false; unlockScroll()"
    :class="[
        shown ? 'translate-y-0 opacity-100' : 'translate-y-6 opacity-0',
        isHome ? 'absolute bg-transparent' : 'relative bg-mint-200'
    ]"
    class="z-50 mx-auto flex w-full py-5 transition-[opacity,transform] duration-700 ease-out"
>
    <div class="flex justify-between container">
        <x-logo/>

        <div class="flex gap-10">
            {{-- Desktop nav --}}
            <nav
                :class="isHome ? 'text-white' : 'text-azure-500'"
                x-data="{ hovered: null }"
                class="flex items-center  gap-10 lg:hidden"
            >
                @foreach($menu as $item)
                    <a
                        href="{{ $item['href'] }}"
                        @if(!empty($item['anchor'])) data-anchor-link @endif
                        @mouseenter="hovered = '{{ $item['key'] }}'"
                        @mouseleave="hovered = null"
                        :class="hovered && hovered !== '{{ $item['key'] }}' ? 'opacity-40' : 'opacity-100'"
                        @if(!empty($item['navigate'])) wire:navigate @endif
                        class="{{ !empty($item['navigate']) ? 'js-page-transition' : '' }} transition-opacity duration-500 font-semibold"
                    >
                        {{ $item['title'] }}
                    </a>
                @endforeach
            </nav>

            @php
                $subject = __('portal.email_subject');
                $body = __('portal.email_body', ['service' => '']);

                $mailto = 'mailto:info@birgeteam.com?subject='
                    . rawurlencode($subject)
                    . '&body='
                    . rawurlencode(strip_tags($body));
            @endphp

            <div class="flex items-center gap-8 lg:gap-5">
                <x-Ui.link
                    :href="$mailto"
                    :navigate="false"
                    class="lg:hidden px-4 py-3"
                    type="teal"
                >
                    {{ __('portal.contact_us') }}
                </x-Ui.link>

                {{-- Lang --}}
                <div
                    x-data="languageSwitcher('{{ session('locale', 'ru') }}')"
                    class="relative"
                >
                    <button
                        type="button"
                        @click="open = !open"
                        :class="isHome ? 'text-white' : 'text-azure-500'"
                        class="flex items-center gap-1 text-base transition"
                    >
                        <span x-text="lang"></span>

                        <svg
                            :class="open ? 'rotate-180' : 'rotate-0'"
                            class="h-3 w-3 transition-transform duration-200 ease-out"
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
                        x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0 -translate-y-2 scale-95"
                        x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                        x-transition:leave="transition ease-in duration-150"
                        x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                        x-transition:leave-end="opacity-0 -translate-y-2 scale-95"
                        :class="isHome
    ? 'border-white/60 bg-black/30 text-white'
    : 'border-azure-500/15 bg-white text-azure-500'"
                        class="absolute right-0 top-full z-50 mt-3 flex w-[51px] flex-col gap-4 rounded-[8px] p-4 shadow-[0_8px_30px_rgba(0,0,0,.25)] backdrop-blur-md"
                    >
                        <template x-for="item in otherLangs()" :key="item">
                            <button
                                type="button"
                                @click="changeLanguage(item)"
                                :class="isHome
                            ? 'hover:text-[#8dd5c2]'
                            : 'hover:text-mint-500'"
                                class="text-left text-base font-medium transition"
                                x-text="item"
                            ></button>
                        </template>
                    </div>
                </div>

                {{-- Burger --}}
                <button
                    type="button"
                    @click="menuOpen = true"
                    :class="isHome ? 'text-white' : 'text-azure-500'"
                    class="hidden h-10 w-10 flex-col items-center justify-center gap-1.5 lg:flex"
                    aria-label="{{ __('portal.open_menu') }}"
                >
                    <span class="block h-[2px] w-7 rounded-full bg-current"></span>
                    <span class="block h-[2px] w-7 rounded-full bg-current"></span>
                    <span class="block h-[2px] w-7 rounded-full bg-current"></span>
                </button>
            </div>
        </div>
    </div>

    {{-- Mobile menu --}}
    <div
        x-cloak
        x-show="menuOpen"
        @touchmove.prevent
        @wheel.prevent
        class="fixed inset-0 z-[999] hidden lg:block"
    >
        <div
            x-show="menuOpen"
            x-transition.opacity.duration.300ms
            class="absolute inset-0 bg-black/30"
            @click="menuOpen = false; unlockScroll()"
        ></div>

        <div
            x-show="menuOpen"
            x-transition:enter="transition-transform duration-500 ease-[cubic-bezier(.16,1,.3,1)]"
            x-transition:enter-start="translate-x-full"
            x-transition:enter-end="translate-x-0"
            x-transition:leave="transition-transform duration-400 ease-[cubic-bezier(.7,0,.84,0)]"
            x-transition:leave-start="translate-x-0"
            x-transition:leave-end="translate-x-full"
            class="absolute right-0 top-0 flex h-[100dvh] w-full flex-col bg-mint-200 px-4 pb-5 pt-12 text-azure-500 shadow-2xl"
        >
            <button
                type="button"
                @click="menuOpen = false; unlockScroll()"
                class="absolute right-4 top-12 h-8 w-8"
                aria-label="{{ __('portal.close_menu') }}"
            >
                <span class="absolute left-1/2 top-1/2 block h-[2px] w-8 -translate-x-1/2 -translate-y-1/2 rotate-45 bg-azure-500"></span>
                <span class="absolute left-1/2 top-1/2 block h-[2px] w-8 -translate-x-1/2 -translate-y-1/2 -rotate-45 bg-azure-500"></span>
            </button>

            <nav class="mt-16 flex flex-col gap-8 text-[22px] font-medium leading-none">
                @foreach($menu as $item)
                    <a
                        href="{{ $item['href'] }}"
                        @if(!empty($item['anchor'])) data-anchor-link @endif
                        @click="menuOpen = false; unlockScroll()"
                        @if(!empty($item['navigate'])) wire:navigate @endif
                        class="{{ !empty($item['navigate']) ? 'js-page-transition' : '' }} transition-opacity hover:opacity-60"
                    >
                        {{ $item['title'] }}
                    </a>
                @endforeach
            </nav>

            <div class="mt-auto mb-8">
                <x-Ui.link
                    :href="$mailto"
                    :navigate="false"
                    class="w-full py-3 justify-center"
                    type="teal"
                >
                    {{ __('portal.contact_us') }}
                </x-Ui.link>
            </div>
        </div>
    </div>
</header>


<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('languageSwitcher', (currentLocale = 'ru') => ({
            open: false,

            lang: currentLocale === 'kk'
                ? 'Kz'
                : currentLocale === 'en'
                    ? 'En'
                    : 'Ru',

            langs: ['Ru', 'Kz', 'En'],

            otherLangs() {
                return this.langs.filter(item => item !== this.lang)
            },

            async changeLanguage(newLang) {
                const localeMap = {
                    Ru: 'ru',
                    Kz: 'kk',
                    En: 'en',
                };

                const locale = localeMap[newLang];

                const response = await fetch('/language', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    },
                    body: JSON.stringify({ locale }),
                });

                if (response.ok) {
                    this.lang = newLang;
                    this.open = false;
                    window.location.reload();
                }
            },
        }));
    });
</script>
