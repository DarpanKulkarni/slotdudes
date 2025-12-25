<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <x-meta-tags :title="$metaTitle ?? null" :description="$metaDescription ?? null" :meta-image="$metaImage ?? null"/>

    @php
        $faviconUrl = app(\App\Settings\SiteSettings::class)->getSiteFaviconUrl();
    @endphp

    @if($faviconUrl)
        <link rel="shortcut icon" href="{{ $faviconUrl }}"/>
    @else
        <x-favicons/>
    @endif

    @vite(['resources/css/app.css'])
</head>
<body class="font-sans antialiased text-xl flex flex-col min-h-dvh">
<x-layouts.header/>
<main class="flex flex-col flex-1 grow">
    {{ $slot }}
</main>
<x-layouts.footer/>
@vite(['resources/js/app.js'])
@stack('scripts')
{!! app(\App\Settings\SiteSettings::class)->footerScripts !!}
</body>
</html>
