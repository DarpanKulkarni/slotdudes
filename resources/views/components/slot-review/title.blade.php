@props(['slot-review', 'featured' => false, 'tag' => 'h2', 'link' => true])

<{{ $tag }} @class([
    'text-3xl',
    'text-5xl' => $featured,
])>
@if($link)
    <a class="font-bold hover:text-primary-700 transition duration-300" href="{{ route('slot-reviews.detail', $slotReview->slug) }}">{{ $slotReview->title }}</a>
@else
    <span class="font-bold">{{ $slotReview->title }}</span>
@endif
</{{ $tag }}>
