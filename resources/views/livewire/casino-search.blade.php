<div
    x-show="searchOpen"
    style="display: none"
    class="fixed top-0 inset-x-0"
>
    <div class="bg-primary-600 flex items-center h-20">
        <button
            @click="searchOpen = !searchOpen; $wire.set('search', '')"
            class="text-white z-50 p-1 rounded-md hover:bg-white/10 transition-colors duration-300 cursor-pointer absolute left-4"
        >
            <x-icons.menu-close class="w-12 h-12 p-2"/>
        </button>

        <x-layouts.container class="max-w-full ms-18 [@media(min-width:1130px)]:ms-0">
            <div class="relative max-w-full lg:max-w-240 mx-auto">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    <x-icons.search class="w-6 h-6 stroke-secondary-500"/>
                </div>

                <input
                    wire:model.live.debounce-300ms="search"
                    type="text"
                    class="block w-full ps-12 pe-12 h-13.5 rounded text-gray-900 border border-secondary-300 bg-secondary-50 focus:ring-primary-600 focus:border-primary-700 outline-none transition-colors"
                    placeholder="Search casinos..."
                    required
                />
            </div>
        </x-layouts.container>
    </div>

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
                            <img src="{{ $casino->getFirstMediaUrl('logos', 'thumb') }}" alt="{{ $casino->name . ' logo' }}" class="w-full">

                            <p class="font-bold text-center text-xs uppercase">{{ $casino->name }}</p>

                            <div
                                class="absolute flex shrink flex-col items-center justify-center inset-0 p-4 gap-2 transition-opacity duration-300 opacity-0 pointer-events-none lg:group-hover:opacity-100 lg:group-hover:pointer-events-auto"
                                :class="open ? 'opacity-100! pointer-events-auto!' : ''"
                            >
                                <x-button-link href="{{ $casino->link }}" variant="green" class="w-full px-2!" target="_blank">
                                    Visit casino
                                    <span><x-icons.chevron-right class="w-4 h-4 ms-0 md:ms-2 stroke-3"/></span>
                                </x-button-link>

                                <x-button-link href="{{ route('casino.detail', $casino->slug) }}" variant="secondary" class="w-full px-2!">
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
                        <x-icons.loader class="w-6 h-6 animate-spin"/>Searching...
                    </div>

                    <div wire:target="search" wire:loading.remove>
                        @if($search == '')
                            Start typing to search casinos.
                        @else
                            No results found for <span class="font-medium italic text-primary-600">'{{ $search }}'</span>.
                        @endif
                    </div>
                </div>
            @endif
        </x-layouts.container>
    </div>
</div>
