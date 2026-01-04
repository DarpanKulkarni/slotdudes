@props(['slot_review', 'full' => false, 'featured' => false, 'link' => true])

@php
    $aspectRatio = $featured ? 'aspect-[16/9]' : 'aspect-[16/9] lg:aspect-[3/2]';
    $conversion = $full ? 'featured-image-full' : 'featured-image-small';
    $featuredImageUrl = $slotReview->getFirstMediaUrl('featured-images', $conversion);
    $fallbackImageUrl = $full ? asset('images/post-featured-image-full.webp') : asset('images/post-featured-image-small.webp');
@endphp

<figure>
    @if($link)
        <a class="group" href="{{ route('posts.detail', $slotReview->slug) }}">
            <img
                class="w-full group-hover:brightness-80 transition duration-300 object-cover {{ $aspectRatio }}"
                src="{{ $slotReview->hasMedia('featured-images') ? $featuredImageUrl : $fallbackImageUrl }}"
                alt="Featured image for {{ $slotReview->title }}"
            >
        </a>
    @else
        <img
            class="w-full group-hover:brightness-80 transition duration-300 object-cover {{ $aspectRatio }}"
            src="{{ $slotReview->hasMedia('featured-images') ? $featuredImageUrl : $fallbackImageUrl }}"
            alt="Featured image for {{ $slotReview->title }}"
        >
    @endif
</figure>
