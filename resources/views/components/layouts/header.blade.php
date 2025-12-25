<div
    x-data="{
        menuOpen: false,
        isScrolled: false,
        headerHeight: 0,
    }"
    x-init="$nextTick(() => { headerHeight = $refs.header.offsetHeight })"
    @scroll.window="isScrolled = (window.pageYOffset >= (headerHeight - 80))"
    class="z-50"
>
    <header x-ref="header" class="relative bg-primary-600 transition-all duration-300">
        <x-layouts.container
            class="flex items-center justify-center aspect-3/1 py-20">
            <a href="{{url('/')}}">
                <img
                    class="w-68"
                    src="{{ app(\App\Settings\SiteSettings::class)->getSiteLogoUrl() }}"
                    alt="CasinoDudes logo"
                >
            </a>
        </x-layouts.container>

        <div
            class="fixed top-0 inset-x-0 flex justify-between items-center h-20 px-4"
            :class="isScrolled ? 'bg-primary-600' : 'bg-transparent'"
        >
            <a href="{{url('/')}}">
                <img
                    class="w-20"
                    :class="isScrolled ? 'inline-block' : 'hidden'"
                    src="{{ app(\App\Settings\SiteSettings::class)->getSiteLogoUrl() }}"
                    alt="CasinoDudes logo"
                >
            </a>

            <button
                @click="menuOpen = !menuOpen"
                class="text-white z-50 p-1 rounded-md hover:bg-white/10 transition-colors duration-300 cursor-pointer ms-auto"
                :class="{ 'text-gray-800': menuOpen }"
            >
                <x-icons.menu-toggle class="w-12 h-12"/>
            </button>
        </div>
    </header>

    <x-layouts.aside/>
</div>
