<div
    x-data="{
        menuOpen: false,
        searchOpen: false,
        isScrolled: false,
        headerHeight: 0,
    }"
    x-init="$nextTick(() => { headerHeight = $refs.header.offsetHeight })"
    @scroll.window="isScrolled = (window.pageYOffset >= (headerHeight - 80))"
    class="z-50"
>
    <header x-ref="header" class="relative bg-primary-600 transition-all duration-300">
        <x-layouts.container
            class="flex flex-col items-center justify-center space-y-8 py-10 md:py-16">
            <a href="{{url('/')}}">
                <img
                    class="w-36 md:w-44 lg:w-56"
                    src="{{ app(\App\Settings\SiteSettings::class)->getSiteLogoUrl() }}"
                    alt="CasinoDudes logo"
                >
            </a>

            <div class="px-2 py-1 bg-amber-400 text-primary-600 w-56 md:w-72 transform -rotate-3">
                <h2 class="uppercase font-bold text-base lg:text-lg text-center leading-[1.2]">Online Casinon Med Svensk Spellicens</h2>
            </div>
        </x-layouts.container>

        <x-layouts.header-top-bar />
    </header>

    <x-layouts.aside/>
</div>
