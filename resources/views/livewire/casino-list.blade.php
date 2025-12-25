<section>
    <x-layouts.container class="flex flex-wrap py-12">
        @foreach ($this->casinos as $casino)
            <div
                wire:key="casino-{{ $casino->id }}"
                x-data="{ open: false }"
                @click.outside="open = false"
                @click="if(window.innerWidth < 1024) open = true"
                class="group cd-box-shadow relative w-1/2 lg:w-1/4 aspect-square p-4"
            >
                <img src="{{ $casino->getFirstMediaUrl('logos', 'thumb') }}" alt="{{ $casino->name . ' logo' }}" class="w-full">

                <div
                    class="absolute flex flex-col items-center justify-center inset-0 p-4 gap-4 bg-primary-600 transition-opacity duration-300
                           opacity-0 pointer-events-none lg:group-hover:opacity-100 lg:group-hover:pointer-events-auto"
                    :class="open ? 'opacity-100! pointer-events-auto!' : ''"
                >
                    <x-button-link href="{{ route('casino.detail', $casino->slug) }}" variant="white-outline" class="w-full">
                        Read More
                        <span><x-icons.chevron-right class="w-4 h-4 ms-2"/></span>
                    </x-button-link>

                    <x-button-link href="{{ $casino->link }}" variant="white-outline" class="w-full">
                        Visit Casino
                        <span><x-icons.chevron-right class="w-4 h-4 ms-2"/></span>
                    </x-button-link>
                </div>
            </div>
        @endforeach

        @if($this->casinos->count() < $this->totalCasinos)
            <div x-intersect.full="$wire.loadMore()" class="w-full flex justify-center items-center mt-8">
                <x-icons.loader wire:loading wire:target="loadMore" class="w-4 h-4 animate-spin" /> <span class="text-sm text-secondary-600 ms-2">Loading...</span>
            </div>
        @endif
    </x-layouts.container>
</section>
