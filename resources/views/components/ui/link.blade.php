@props([
    'type' => 'mint',
    'href' => '#',
    'navigate' => true
])

@php
    $gradients = [
        'mint' => 'bg-[linear-gradient(90deg,#d8f5c7_0%,#57c9c5_100%)] text-[#082329]',
        'teal' => 'bg-[linear-gradient(90deg,#8dd5c2_0%,#1298a8_100%)] text-white',
    ];

    $gradient = $gradients[$type] ?? $gradients['mint'];

    $text = trim((string) $slot);
    $letters = mb_str_split($text);

    $duration = 450;
    $delay = 16;
    $iconDelay = 0;
    $textDelayOffset = isset($icon) ? 1 : 0;
@endphp

<a
    href="{{ $href }}"
    @if($navigate) wire:navigate @endif
    x-data="{ active: false, ready: true }"
    @mouseenter="
        ready = false;
        active = false;

        requestAnimationFrame(() => {
            requestAnimationFrame(() => {
                ready = true;
                active = true;
            });
        });
    "
    {{ $attributes->merge([
        'class' => "
            inline-flex
            items-center
            justify-center
            rounded-full
            font-semibold
            leading-none
            overflow-hidden
            transition-all
            duration-300
            hover:shadow-[0_10px_40px_rgba(0,0,0,.15)]
            {$gradient}
        "
    ]) }}
>
<span class="relative flex h-[1.25em] items-center overflow-hidden leading-none">

        @isset($icon)
            <span class="relative mr-[10px] block h-[1em] overflow-hidden shrink-0">

                <span
                    class="block transform-gpu will-change-transform"
                    :class="[
                        ready
                            ? 'transition-transform duration-[{{ $duration }}ms] ease-[cubic-bezier(.22,1,.36,1)]'
                            : '!transition-none',
                        active
                            ? '-translate-y-[120%]'
                            : 'translate-y-0'
                    ]"
                    style="transition-delay: {{ $iconDelay }}ms"
                >
                    {{ $icon }}
                </span>

                <span
                    class="absolute inset-0 transform-gpu will-change-transform"
                    :class="[
                        ready
                            ? 'transition-transform duration-[{{ $duration }}ms] ease-[cubic-bezier(.22,1,.36,1)]'
                            : '!transition-none',
                        active
                            ? 'translate-y-0'
                            : 'translate-y-[120%]'
                    ]"
                    style="transition-delay: {{ $iconDelay }}ms"
                >
                    {{ $icon }}
                </span>

            </span>
        @endisset

        <span class="relative block h-[1em] overflow-hidden leading-none pr-[0.14em]">

            <span
                class="block whitespace-nowrap tracking-[-0.12em]"
                aria-label="{{ $text }}"
            >
                @foreach($letters as $i => $letter)
                    <span
                        aria-hidden="true"
                        class="inline-block transform-gpu will-change-transform"
                        :class="[
                            ready
                                ? 'transition-transform duration-[{{ $duration }}ms] ease-[cubic-bezier(.22,1,.36,1)]'
                                : '!transition-none',
                            active
                                ? '-translate-y-[120%]'
                                : 'translate-y-0'
                        ]"
                        style="transition-delay: {{ ($i + $textDelayOffset) * $delay }}ms"
                    >{!! $letter === ' ' ? '&nbsp;' : e($letter) !!}</span>
                @endforeach
            </span>

            <span
                class="absolute inset-0 block whitespace-nowrap tracking-[-0.12em]"
                aria-hidden="true"
            >
                @foreach($letters as $i => $letter)
                    <span
                        class="inline-block transform-gpu will-change-transform"
                        :class="[
                            ready
                                ? 'transition-transform duration-[{{ $duration }}ms] ease-[cubic-bezier(.22,1,.36,1)]'
                                : '!transition-none',
                            active
                                ? 'translate-y-0'
                                : 'translate-y-[120%]'
                        ]"
                        style="transition-delay: {{ ($i + $textDelayOffset) * $delay }}ms"
                    >{!! $letter === ' ' ? '&nbsp;' : e($letter) !!}</span>
                @endforeach
            </span>

        </span>

    </span>
</a>
