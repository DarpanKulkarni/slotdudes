@props(['post', 'full' => false, 'featured' => false, 'link' => true])

@php
    $aspectRatio = $featured ? 'aspect-[16/9]' : 'aspect-[16/9] lg:aspect-[3/2]';
    $conversion = $full ? 'featured-image-full' : 'featured-image-small';
    $featuredImageUrl = $post->getFirstMediaUrl('featured-images', $conversion);
    $fallbackImageUrl = $full ? asset('images/post-featured-image-full.webp') : asset('images/post-featured-image-small.webp');
@endphp

<figure>
    @if($link)
        <a class="group" href="{{ route('posts.detail', $post->slug) }}">
            <img
                class="w-full group-hover:brightness-80 transition duration-300 object-cover {{ $aspectRatio }}"
                src="{{ $post->hasMedia('featured-images') ? $featuredImageUrl : $fallbackImageUrl }}"
                alt="Featured image for {{ $post->title }}"
            >
        </a>
    @else
        <img
            class="w-full group-hover:brightness-80 transition duration-300 object-cover {{ $aspectRatio }}"
            src="{{ $post->hasMedia('featured-images') ? $featuredImageUrl : $fallbackImageUrl }}"
            alt="Featured image for {{ $post->title }}"
        >
    @endif
</figure>
