@php use App\Settings\SiteSettings; @endphp
@props([
    'title' => null,
    'description' => null,
    'siteName' => app(SiteSettings::class)->siteTitle,
    'siteDescription' => app(SiteSettings::class)->siteDescription,
    'metaImage' => app(SiteSettings::class)->getMetaImageUrl(),
])

@php
    $metaTitle = $title ? $title . ' - ' . $siteName : $siteName;
    $metaDescription = $description ?: $siteDescription;
@endphp

<title>{{ $metaTitle }}</title>

<meta name="description" content="{{ $metaDescription }}">

{{-- Open Graph tags for social sharing --}}
<meta property="og:title" content="{{ $metaTitle }}">
<meta property="og:description" content="{{ $metaDescription }}">
<meta property="og:type" content="{{ $title ? 'article' : 'website' }}">
<meta property="og:url" content="{{ url()->current() }}">
<meta property="og:image" content="{{ $metaImage }}">
<meta property="og:image:width" content="1200">
<meta property="og:image:height" content="675">
<meta property="og:image:alt" content="{{ $metaTitle }}">

{{-- Twitter Card tags --}}
<meta name="twitter:card" content="summary">
<meta name="twitter:title" content="{{ $metaTitle }}">
<meta name="twitter:description" content="{{ $metaDescription }}">
<meta name="twitter:image" content="{{ $metaImage }}">
<meta name="twitter:image:alt" content="{{ $metaTitle }}">
