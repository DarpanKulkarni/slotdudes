<div
    x-show="menuOpen"
    x-transition:enter="transition-opacity ease-out duration-200"
    x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-50"
    x-transition:leave="transition-opacity ease-in duration-200"
    x-transition:leave-start="opacity-50"
    x-transition:leave-end="opacity-0"
    @click="menuOpen = false"
    class="fixed inset-0 bg-black opacity-50 z-40"
    style="display: none;"
></div>

<aside
    x-show="menuOpen"
    x-transition:enter="transform transition ease-out duration-200"
    x-transition:enter-start="translate-x-full"
    x-transition:enter-end="translate-x-0"
    x-transition:leave="transform transition ease-in duration-200"
    x-transition:leave-start="translate-x-0"
    x-transition:leave-end="translate-x-full"
    class="fixed top-0 right-0 h-full w-80 bg-white shadow-xl z-50 overflow-y-auto"
    style="display: none;"
>
    <div class="p-6 border-b border-gray-200">
        <button
            @click="menuOpen = false"
            class="p-1 rounded-md hover:bg-gray-100 transition-colors duration-300 cursor-pointer"
        >
            <x-icons.menu-close class="w-6 h-6"/>
        </button>
    </div>

    <div class="p-6">
        <nav class="space-y-4">
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
                   class="block py-3 px-4 rounded-lg transition-colors duration-200 {{ $isActive ? 'bg-primary-50 text-primary-600 font-medium' : 'text-gray-600 hover:bg-gray-100' }}">
                    {{ $page->title }}
                </a>
            @endforeach
        </nav>
    </div>
</aside>
