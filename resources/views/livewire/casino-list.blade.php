<section>
    <x-layouts.container class="py-12">
        <div class="cd-casino-grid grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 overflow-hidden">
            @foreach ($this->casinos as $casino)
                <div
                    wire:key="casino-{{ $casino->id }}"
                    x-data="{ open: false }"
                    @click.outside="open = false"
                    @click="if(window.innerWidth < 1024) open = true"
                    class="cd-casino-grid__item group aspect-square p-4 min-w-0"
                >
                    <img src="{{ $casino->getFirstMediaUrl('logos', 'thumb') }}" alt="{{ $casino->name . ' logo' }}" class="w-full">

                    <div
                        class="absolute flex shrink flex-col items-center justify-center inset-0 p-4 gap-2 transition-opacity duration-300 opacity-0 pointer-events-none lg:group-hover:opacity-100 lg:group-hover:pointer-events-auto"
                        :class="open ? 'opacity-100! pointer-events-auto!' : ''"
                    >
                        <x-button-link href="{{ $casino->link }}" variant="green" class="w-full px-2!" target="_blank">
                            Besök casino
                            <span><x-icons.chevron-right class="w-4 h-4 ms-0.5 md:ms-2 stroke-3"/></span>
                        </x-button-link>

                        <x-button-link href="{{ route('casino.detail', $casino->slug) }}" variant="secondary" class="w-full px-2!">
                            Läs mer
                            <span><x-icons.chevron-right class="w-4 h-4 ms-0.5 md:ms-2 stroke-3"/></span>
                        </x-button-link>
                    </div>
                </div>
            @endforeach
        </div>
    </x-layouts.container>

    <x-layouts.container>
        @if($this->casinos->count() < $this->totalCasinos)
            <div x-intersect.full="$wire.loadMore()" class="w-full flex justify-center items-center pb-12">
                <x-icons.loader wire:loading wire:target="loadMore" class="w-4 h-4 animate-spin"/>
                <span class="text-sm text-secondary-600 ms-2">Loading...</span>
            </div>
        @endif
    </x-layouts.container>

    <x-button-link
        tag="button"
        variant="primary"
        class="aspect-square p-1.5! md:p-2! fixed right-4 bottom-9 cursor-pointer shadow-lg shadow-gray-800/40 z-50"
        x-data="{ show: false }"
        @scroll.window="show = (window.scrollY > 100)"
        x-show="show"
        x-cloak
        @click="window.scrollTo({ top: 0, behavior: 'smooth' })"
    >
        <x-icons.chevron-right class="w-10 h-10 -rotate-90"/>
    </x-button-link>
</section>
