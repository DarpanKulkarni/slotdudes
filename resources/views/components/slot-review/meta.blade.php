@props(['slot-review'])
@php
    use Illuminate\Support\Carbon;

    $categories = $slotReview->categories;
    $displayedCategories = $categories->take(2);
    $remainingCount = $categories->count() - $displayedCategories->count();
@endphp

<p class="flex items-center text-sm text-gray-500 font-medium uppercase">
    @if($categories->isNotEmpty())
        @foreach($displayedCategories as $index => $category)
            <a class="text-primary-700 hover:text-primary-600 transition duration-300" href="{{ route('slot-reviews.categories.list', $category->slug) }}">{{ $category->name }}</a>
            @if($index < $displayedCategories->count() - 1)
                <span class="me-1">,</span>
            @endif
        @endforeach

        @if($remainingCount > 0)
            <span class="ms-1">+ {{ $remainingCount }}</span>
        @endif

        <span class="mx-1">/</span>
    @endif

    <time>{{ Carbon::parse($slotReview->published_at)->format('M j, Y') }}</time>
</p>
