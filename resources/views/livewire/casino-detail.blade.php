<section class="py-8" aria-labelledby="page-title">
    <x-layouts.container class="space-y-8">
        <h1 class="text-4xl font-bold border-b border-secondary-300 pb-8">{{ $casino->name }}</h1>

        <img
            class="w-full object-cover aspect-video bg-secondary-100"
            src="{{ $casino->hasMedia('logos') ? $casino->getFirstMediaUrl('logos', 'full') : asset('images/post-featured-image-full.webp') }}"
            alt="Featured image for {{ $casino->name }}"
        >

        <div class="prose prose-xl lg:prose-[23px] max-w-full">
            {!! $casino->description !!}

            @php
                $visibleHighlights = collect($casino->highlights)->filter(fn ($h) => !empty($h['is_visible']));
            @endphp

            @if($visibleHighlights->isNotEmpty())
                <div class="space-y-4 border-t border-secondary-300 pt-8">
                    @foreach($visibleHighlights as $highlight)
                        @if($highlight['is_visible'])
                            <div class="flex items-center gap-2">
                                <x-icons.check class="w-8 h-8 stroke-green-600" />
                                <span class="ms-2">{{ $highlight['title'] }}</span>
                            </div>
                        @endif
                    @endforeach
                </div>
            @endif
        </div>
    </x-layouts.container>
</section>
