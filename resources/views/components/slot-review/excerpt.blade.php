@props(['content'])

@php
    $content = html_entity_decode($content);
@endphp

<p class="text-gray-500 line-clamp-2 lg:line-clamp-1 lg:hidden">{{ str($content)->stripTags() }}</p>
