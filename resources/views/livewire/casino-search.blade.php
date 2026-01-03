<div
    x-show="searchOpen"
    style="display: none"
    class="fixed top-0 inset-x-0"
>
    <x-layouts.container class="max-w-full p-0! border-b border-b-secondary-200">
        <div class="relative flex items-center">
            <button
                @click="searchOpen = !searchOpen; $wire.set('search', '')"
                class="absolute top-0 left-0 flex items-center justify-center w-16 h-16 z-50 cursor-pointer"
            >
                <x-icons.menu-close class="w-8 h-8 stroke-primary-600"/>
            </button>

            <input
                wire:model.live.debounce-300ms="search"
                type="text"
                class="relative block w-full h-16 px-18 text-secondary-950 bg-white outline-none z-40"
                placeholder="Search casinos..."
                required
            />

            <div class="absolute top-0 right-0 flex items-center justify-center w-16 h-16 z-50">
                <x-icons.search class="w-8 h-8 stroke-primary-600"/>
            </div>
        </div>
    </x-layouts.container>

    <div class="w-full h-dvh bg-white overflow-y-auto pb-24">
        <x-layouts.container>
            @if (strlen($search) >= 3 && $casinos->isNotEmpty())
                <div class="cd-casino-grid grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 overflow-hidden">
                    @foreach ($casinos as $casino)
                        <div
                            wire:key="casino-{{ $casino->id }}"
                            x-data="{ open: false }"
                            @click.outside="open = false"
                            @click="if(window.innerWidth < 1024) open = true"
                            class="cd-casino-grid__item group aspect-square p-4 min-w-0"
                        >
                            <img src="{{ $casino->getFirstMediaUrl('logos', 'thumb') }}"
                                 alt="{{ $casino->name . ' logo' }}" class="w-full">

                            <p class="font-bold text-center text-xs uppercase">{{ $casino->name }}</p>

                            <div
                                class="absolute flex shrink flex-col items-center justify-center inset-0 p-4 gap-2 transition-opacity duration-300 opacity-0 pointer-events-none lg:group-hover:opacity-100 lg:group-hover:pointer-events-auto"
                                :class="open ? 'opacity-100! pointer-events-auto!' : ''"
                            >
                                <x-button-link href="{{ $casino->link }}" variant="green" class="w-full px-2!"
                                               target="_blank">
                                    Visit casino
                                    <span><x-icons.chevron-right class="w-4 h-4 ms-0 md:ms-2 stroke-3"/></span>
                                </x-button-link>

                                <x-button-link href="{{ route('casino.detail', $casino->slug) }}" variant="secondary"
                                               class="w-full px-2!">
                                    Read more
                                    <span><x-icons.chevron-right class="w-4 h-4 ms-0 md:ms-2 stroke-3"/></span>
                                </x-button-link>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="flex items-center justify-center text-center py-12">
                    <div wire:target="search" wire:loading.flex class="flex items-center gap-2">
                        <x-icons.loader class="w-6 h-6 animate-spin"/>
                        Searching...
                    </div>

                    <div wire:target="search" wire:loading.remove>
                        @if($search !== '')
                            No results found for <span class="font-medium italic text-primary-600">'{{ $search }}'</span>.
                        @endif
                    </div>
                </div>
            @endif
        </x-layouts.container>
    </div>
</div>
