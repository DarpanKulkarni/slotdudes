<section class="space-y-8">
    @if($this->casinos->isNotEmpty())
        <x-layouts.container class="flex justify-end mt-8">
            <div x-data="{ open: false }" class="relative z-20">
                <x-button-link
                    tag="button" variant="ghost" size="sm"
                    @click="open = !open"
                    @click.outside="open = false"
                    class="flex items-center gap-1 cursor-pointer"
                >
                    <span class="font-bold text-gray-800 flex items-center gap-1">
                        @switch($sort)
                            @case('recent') Last added @break
                            @case('alphabetical') Alphabetical @break
                            @default Featured
                        @endswitch
                        <span class="inline-block transition-transform duration-300 rotate-90" x-bind:class="{ 'rotate-90': !open, '-rotate-90': open }">
                            <x-icons.chevron-right class="w-4 h-4 stroke-2"/>
                        </span>
                    </span>
                </x-button-link>

                <div
                    x-show="open"
                    x-cloak
                    x-transition.origin.top.right
                    class="absolute right-0 top-full mt-2 w-40 bg-white shadow-xl rounded-lg border border-gray-100 overflow-hidden"
                >
                    <button wire:click="setSort('featured'); open = false"
                            class="w-full text-left px-4 py-2.5 text-sm hover:bg-gray-50 {{ $sort === 'featured' ? 'text-primary-600 font-bold bg-gray-50' : 'text-gray-600' }}">
                        Featured
                    </button>
                    <button wire:click="setSort('recent'); open = false"
                            class="w-full text-left px-4 py-2.5 text-sm hover:bg-gray-50 {{ $sort === 'recent' ? 'text-primary-600 font-bold bg-gray-50' : 'text-gray-600' }}">
                        Last added
                    </button>
                    <button wire:click="setSort('alphabetical'); open = false"
                            class="w-full text-left px-4 py-2.5 text-sm hover:bg-gray-50 {{ $sort === 'alphabetical' ? 'text-primary-600 font-bold bg-gray-50' : 'text-gray-600' }}">
                        Alphabetical
                    </button>
                </div>
            </div>
        </x-layouts.container>

        <x-layouts.container class="relative">
            <div class="overflow-hidden">
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 -mb-px *:border-b *:border-r *:border-gray-200 [&>*:nth-child(2n)]:border-r-transparent md:[&>*:nth-child(2n)]:border-r-gray-200 md:[&>*:nth-child(3n)]:border-r-transparent lg:[&>*:nth-child(3n)]:border-r-gray-200 lg:[&>*:nth-child(4n)]:border-r-transparent">
                    @foreach ($this->casinos as $casino)
                        <div
                            wire:key="casino-{{ $casino->id }}"
                            x-data="{ open: false }"
                            @click.outside="open = false"
                            @click="if(window.innerWidth < 1024) open = true"
                            class="group aspect-square p-4 min-w-0 relative"
                        >
                            <img src="{{ $casino->getFirstMediaUrl('logos', 'thumb') }}" alt="{{ $casino->name . ' logo' }}" class="w-full">

                            <div
                                class="absolute flex shrink flex-col items-center justify-center inset-0 p-4 gap-2 transition-opacity duration-300 opacity-0 pointer-events-none lg:group-hover:opacity-100 lg:group-hover:pointer-events-auto"
                                x-bind:class="{ 'opacity-100! pointer-events-auto!': open }"
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
            </div>

            <div wire:loading.flex wire:target="setSort" class="absolute inset-0 z-10 justify-center pt-20 bg-white/70 backdrop-blur-[1px] transition-all duration-300">
                <div class="flex flex-col items-center gap-2 sticky top-40">
                    <x-icons.loader class="w-10 h-10 text-primary-600 animate-spin"/>
                    <span class="text-primary-800 font-medium text-sm tracking-wide">Please wait...</span>
                </div>
            </div>
        </x-layouts.container>

        <x-layouts.container class="flex justify-center">
            @if($this->casinos->count() < $this->totalCasinos)
                <x-button-link tag="button" variant="secondary-outline" wire:click="loadMore" wire:loading.attr="disabled" class="cursor-pointer">
                    <span wire:loading.remove wire:target="loadMore">Load more</span>
                    <span wire:loading.flex wire:target="loadMore" class="items-center gap-1.5">
                        <x-icons.loader class="w-4 h-4 animate-spin"/>
                        Loading...
                    </span>
                </x-button-link>
            @endif
        </x-layouts.container>
    @else
        <x-layouts.container class="py-12">
            <x-empty>No casinos/slots found.</x-empty>
        </x-layouts.container>
    @endif

    <x-layouts.container class="flex flex-col md:flex-row justify-center gap-8">
        <x-info-box
            :background-image="asset('/images/cd-box-bg-black.jpg')"
            title="Online Casino News"
            description="News and insights from the online casino industry"
            :route="route('posts.list')"
        />

        <x-info-box
            :background-image="asset('/images/cd-box-bg-blue.jpg')"
            title="Slot Reviews"
            description="Reviews of popular and new slots from top game providers"
            :route="route('slot-reviews.list')"
        />
    </x-layouts.container>

    <x-layouts.container>
        <livewire:faq/>
    </x-layouts.container>

    <x-button-link
        tag="button"
        variant="primary"
        class="aspect-square p-1.5! md:p-2! fixed right-4 bottom-10 cursor-pointer shadow-lg shadow-gray-800/40 z-50"
        x-data="{ show: false }"
        @scroll.window="show = (window.scrollY > 100)"
        x-show="show"
        x-cloak
        @click="window.scrollTo({ top: 0, behavior: 'smooth' })"
    >
        <x-icons.chevron-right class="w-9 md:w-10 h-9 md:h-10 -rotate-90"/>
    </x-button-link>
</section>
