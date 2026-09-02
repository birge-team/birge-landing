@props([
    'article',
    'color' => 'white'
])
@php
    $classes = match ($color) {
        'white' => [
            'category' => 'text-white/60',
            'text' => 'text-white',
        ],
        'dark' => [
            'category' => 'text-black/40',
            'text' => 'text-black',
        ],
    };
@endphp
<a {{ $attributes->merge(['class' => 'lg:max-w-full flex flex-col h-full']) }} href="{{route('portal.article', $article->id)}}" wire:navigate>
    <img src="{{$article->getFirstMediaUrl('cover')}}" alt="Blog article" class="w-[443px] h-[296px] lg:min-w-0 lg:min-h-0 lg:w-full lg:h-[219px] min-w-[443px] min-h-[296px] object-cover rounded-lg"/>

    <!-- Content -->
    <div class="pt-4 flex flex-col gap-4 flex-1">
            <span
                class="leading-[130%] text-sm {{$classes['category']}} uppercase w-fit md:text-[11px] md:mb-3">
            {{ $article->category->localizedName() }} / {{ $article['date'] }}
        </span>
        <h3 class="{{$classes['text']}} text-[22px] leading-[110%] font-semibold max-w-[443px] line-clamp-2 md:text-[17px]">
            {{$article->getLocalizedValue('title')}}
        </h3>
        <p class="{{$classes['text']}} text-base leading-[130%] font-normal mt-auto">{{$article->getLocalizedValue('description')}}</p>
    </div>
</a>
