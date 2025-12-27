<div
    x-data="{
        menuOpen: false,
    }"
    class="sticky top-0 inset-x-0 z-40"
>
    <header class=" flex justify-between items-center h-20 px-4 bg-primary-600 transition-all duration-300 shadow-lg shadow-gray-800/40">
        <button
            @click="searchOpen = !searchOpen"
            class="text-white z-50 p-1 rounded-md hover:bg-white/10 transition-colors duration-300 cursor-pointer"
            :class="{ 'text-gray-800': searchOpen }"
        >
            <x-icons.search class="w-12 h-12 p-2"/>
        </button>

        <a href="{{url('/')}}">
            <img
                class="w-20"
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
    </header>

    <!-- ASIDE MENU -->
    <x-layouts.aside/>
</div>
