<div
    x-show="menuOpen"
    x-transition:enter="transition-opacity ease-out duration-200"
    x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-50"
    x-transition:leave="transition-opacity ease-in duration-200"
    x-transition:leave-start="opacity-50"
    x-transition:leave-end="opacity-0"
    @click="menuOpen = false"
    class="fixed inset-0 z-40"
    style="display: none;"
></div>

<aside
    x-show="menuOpen"
    x-transition:enter="transform transition ease-out duration-200"
    x-transition:enter-start="-translate-x-full"
    x-transition:enter-end="translate-x-0"
    x-transition:leave="transform transition ease-in duration-200"
    x-transition:leave-start="translate-x-0"
    x-transition:leave-end="-translate-x-full"
    class="fixed top-0 left-0 h-full w-full md:w-115 bg-black/90 shadow-xl z-50 overflow-y-auto"
    style="display: none;"
>
    <div class="flex items-center justify-between py-6 px-8 md:px-12 border-b border-white/10">
        <a href="url('/)">
            <img class="w-20" src="{{ app(\App\Settings\SiteSettings::class)->getSiteLogoUrl() }}" alt="CasinoDudes logo">
        </a>

        <button
            @click="menuOpen = false"
            class="p-1 ms-auto rounded-md hover:bg-primary-700 transition-colors duration-300 cursor-pointer"
        >
            <x-icons.menu-close class="w-10 h-10 stroke-secondary-50"/>
        </button>
    </div>

    <div class="py-8 px-8 md:px-12">
        <nav class="flex flex-col items-center justify-center space-y-6 my-16">
            @php
                use App\Models\Page;

                // Get the home page (assuming there's a scope or column for it)
                $homePage = Page::whereIsHomePage(true)->first();

                // Get only the pages that should appear in the menu
                $menuPages = Page::select('title', 'slug', 'order', 'show_in_menu')
                    ->where('show_in_menu', true)
                    ->orderBy('order')
                    ->get();

                $currentPath = request()->path();
                $currentSlug = $currentPath === '/' ? optional($homePage)->slug : $currentPath;
            @endphp

            @foreach($menuPages as $page)
                @php
                    if ($page->slug === optional($homePage)->slug) {
                        $url = url('/');
                    } else {
                        $url = url('/' . $page->slug);
                    }

                    $isActive = ($page->slug === $currentSlug) || ($currentPath === '/' && $page->slug === optional($homePage)->slug);
                @endphp

                <a href="{{ $url }}"
                    @class([
                        // 1. Base classes (always applied)
                        'text-2xl md:text-3xl font-bold',

                        // 2. Active state classes
                        'text-secondary-50 border-b-3 border-secondary-50' => $isActive,

                        // 3. Inactive state classes
                        'text-secondary-50' => ! $isActive,
                    ])>
                    {{ $page->title }}
                </a>
            @endforeach
        </nav>
    </div>
</aside>
