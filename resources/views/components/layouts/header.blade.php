<div
    x-data="{
        menuOpen: false,
        searchOpen: false,
        isScrolled: false,
        headerHeight: 0,
        get overlayOpen() {
            return this.searchOpen || this.menuOpen
        }
    }"
    x-effect="document.body.classList.toggle('overflow-hidden', overlayOpen)"
    x-init="$nextTick(() => { headerHeight = $refs.header.offsetHeight })"
    @scroll.window="isScrolled = (window.pageYOffset >= (headerHeight - 80))"
    class="z-40"
>
    <header x-ref="header" class="relative bg-primary-600 transition-all duration-300 shadow-lg shadow-gray-800/40">
        <x-layouts.container
            class="flex flex-col items-center justify-center space-y-8 pt-10 md:pt-16 pb-10 md:pb-16"
            x-bind:class="searchOpen ? 'pt-26 md:pt-32' : 'pt-10 md:pt-16'"
        >
            <a href="{{url('/')}}">
                <img class="w-52 md:w-60" src="{{ app(\App\Settings\SiteSettings::class)->getSiteLogoUrl() }}" alt="CasinoDudes logo">
            </a>

            <h2 class="text-white text-2xl lg:text-3xl font-bold uppercase">TOP CASINOS WE RECOMMEND 👇</h2>
        </x-layouts.container>

        <div
            class="fixed top-0 inset-x-0 flex justify-between items-center h-20 px-4"
            :class="isScrolled ? 'bg-primary-600 shadow-lg shadow-gray-800/40' : 'bg-transparent shadow-none'"
        >
            <button
                @click="searchOpen = !searchOpen"
                class="text-white z-50 p-1 rounded-md hover:bg-white/10 transition-colors duration-300 cursor-pointer"
            >
                <x-icons.search class="w-12 h-12 p-2"/>
            </button>

            <a href="{{url('/')}}">
                <img
                    class="w-20 hidden"
                    :class="isScrolled ? 'inline-block' : 'hidden'"
                    src="{{ app(\App\Settings\SiteSettings::class)->getSiteLogoUrl() }}"
                    alt="CasinoDudes logo"
                >
            </a>

            <button
                @click="menuOpen = !menuOpen"
                class="text-white z-50 p-1 rounded-md hover:bg-white/10 transition-colors duration-300 cursor-pointer"
            >
                <x-icons.menu-toggle class="w-12 h-12"/>
            </button>
        </div>

        <livewire:casino-search />
    </header>

    <!-- ASIDE MENU -->
    <x-layouts.aside/>
</div>
