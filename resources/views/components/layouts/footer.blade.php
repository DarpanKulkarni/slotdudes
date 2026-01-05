<footer class="bg-primary-600 text-white/70 text-sm text-center py-6 space-y-4">
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
