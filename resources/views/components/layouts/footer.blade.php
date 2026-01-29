@if(request()->is('/'))
    <x-layouts.container class="flex flex-col md:flex-row justify-center gap-8 px-4 lg:px-8 max-w-full py-12">
        <x-info-box
            :background-image="asset('/images/cd-box-bg-black.jpg')"
            title="Online Casino News"
            description="News and insights from the online casino industry"
            :route="route('posts.list')"
        />

        <x-info-box
            :background-image="asset('/images/cd-box-bg-blue.jpg')"
            title="Online Slot Reviews"
            description="Reviews of popular and new slots from top game providers"
            :route="route('slot-reviews.list')"
        />

        <x-info-box
            :background-image="asset('/images/cd-box-bg-blue.jpg')"
            title="Got Questions?"
            description="We are always here to help"
            route="mailto:slotdudes.com@gmail.com"
            button-label="Email Us"
        />
    </x-layouts.container>

    <livewire:latest-posts />

    <section class="bg-primary-600 py-12 border-b border-white/10">
        <x-layouts.container class="prose prose-invert prose-lg px-6 lg:px-4">
            {!! app(\App\Settings\SiteSettings::class)->footerText !!}
        </x-layouts.container>
    </section>
@endif

<footer class="bg-primary-600 text-white/70 text-sm text-center py-6 space-y-4">
    <x-layouts.container class="mb-8">
        <livewire:subscription-form />
    </x-layouts.container>

    <div class="flex items-center justify-center gap-6">
        <a href="https://instagram.com/slotdudes_com" target="_blank" rel="nofollow">
            <img src="{{ asset('/images/cd-instagram-logo.webp') }}" alt="instagram logo" class="w-8">
        </a>

        <a href="https://www.gambleaware.org/" target="_blank" rel="nofollow">
            <img src="{{ asset('/images/cd-gamble-aware-logo.webp') }}" alt="gamble aware logo" class="w-40">
        </a>

        <a href="https://instagram.com/slotdudes_com" target="_blank" rel="nofollow">
            <img src="{{ asset('/images/cd-18-plus-logo.webp') }}" alt="18+ logo" class="w-8">
        </a>
    </div>

    <div>
        {!! app(\App\Settings\SiteSettings::class)->copyrightText !!}
    </div>
</footer>

@if(request()->is('/'))
    <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/js/splide.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/css/splide.min.css" rel="stylesheet">
@endif
