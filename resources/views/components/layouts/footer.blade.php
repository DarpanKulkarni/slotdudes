<section class="bg-primary-600 py-12 border-b border-white/10">
    <x-layouts.container class="prose prose-invert prose-lg px-6 lg:px-4">
        {!! app(\App\Settings\SiteSettings::class)->footerText !!}
    </x-layouts.container>
</section>

<footer class="bg-primary-600 text-white/70 text-sm text-center py-6">
    {!! app(\App\Settings\SiteSettings::class)->copyrightText !!}
</footer>
