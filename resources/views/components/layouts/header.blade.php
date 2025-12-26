<div
    x-data="{
        menuOpen: false,
        searchOpen: false,
        isScrolled: false,
        headerHeight: 0
    }"
    x-init="$nextTick(() => { headerHeight = $refs.header.offsetHeight })"
    @scroll.window="isScrolled = (window.pageYOffset >= (headerHeight - 80))"
    class="z-40"
>
    <header x-ref="header" class="relative bg-primary-600 transition-all duration-300 shadow-lg shadow-gray-800/40">
        <x-layouts.container
            class="flex flex-col items-center justify-center space-y-8 pt-10 md:pt-16 pb-10 md:pb-16"
            x-bind:class="searchOpen ? 'pt-26 md:pt-32' : 'pt-10 md:pt-16'"
        >
            <a href="{{url('/')}}"><img class="w-48 md:w-56" src="{{ app(\App\Settings\SiteSettings::class)->getSiteLogoUrl() }}" alt="CasinoDudes logo"></a>

            <div class="px-2 py-1 bg-amber-400 text-primary-600 w-64 md:w-72 transform -rotate-3">
                <h2 class="uppercase font-bold text-xl text-center leading-[1.2]">Online Casinon Med Svensk Spellicens</h2>
            </div>
        </x-layouts.container>

        <div
            class="fixed top-0 inset-x-0 flex justify-between items-center h-20 px-4"
            :class="isScrolled ? 'bg-primary-600 shadow-lg shadow-gray-800/40' : 'bg-transparent shadow-none'"
        >
            <button
                @click="searchOpen = !searchOpen"
                class="text-white z-50 p-1 rounded-md hover:bg-white/10 transition-colors duration-300 cursor-pointer"
                :class="{ 'text-gray-800': searchOpen }"
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
                :class="{ 'text-gray-800': menuOpen }
            ">
                <x-icons.menu-toggle class="w-12 h-12"/>
            </button>
        </div>

        <div
            x-show="searchOpen"
            class="bg-primary-600 fixed top-0 inset-x-0 flex items-center h-20"
            style="display: none"
        >
            <x-layouts.container>
                <div class="relative w-full">

                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <x-icons.search class="w-6 h-6 stroke-secondary-500"/>
                    </div>

                    <input
                        type="text"
                        class="block w-full ps-12 pe-12 h-12 rounded text-gray-900 border border-secondary-300 bg-secondary-50 focus:ring-primary-600 focus:border-primary-700 outline-none transition-colors"
                        placeholder="Search casinos..."
                        required
                    />

                    <button
                        @click="searchOpen = false"
                        type="button"
                        class="absolute inset-y-0 right-0 flex items-center pr-3 cursor-pointer"
                    >
                        <x-icons.menu-close class="w-6 h-6 stroke-secondary-500"/>
                    </button>

                </div>
            </x-layouts.container>
        </div>
    </header>

    <x-layouts.aside/>
</div>
