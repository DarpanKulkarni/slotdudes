<section class="py-10 space-y-10">
    <x-layouts.container>
        <div class="flex flex-col lg:flex-row lg:items-center items-center lg:justify-between text-center lg:text-start text-sm bg-gray-100 rounded space-y-1 lg:space-y-0 py-2 px-3">
            <p>Showing slot reviews with category <strong>"{{ $this->category->name }}"</strong></p>
            <a href="{{ route('slot-reviews.list') }}" class="text-primary-500 hover:text-primary-600 underline transition duration-300">Show all</a>
        </div>
    </x-layouts.container>

    <x-layouts.container class="space-y-12">
        @forelse($this->slotReviews as $slotReview)
            <article class="flex flex-col lg:flex-row items-center gap-6">
                <div class="w-full lg:w-[320px] shrink-0">
                    <x-slot-review.featured-image :slot-review="$slotReview"/>
                </div>
                <div class="w-full space-y-4">
                    <x-slot-review.meta :slot-review="$slotReview"/>
                    <x-slot-review.title :slot-review="$slotReview"/>
                    <x-slot-review.excerpt :content="$slotReview->excerpt"/>
                    <x-button-link href="{{ route('slot-reviews.detail', $slotReview->slug) }}" class="mt-2">Read more</x-button-link>
                </div>
            </article>
        @empty
            <x-empty>No slot reviews found.</x-empty>
        @endforelse
    </x-layouts.container>

    <x-slot-review.pagination :slot-reviews="$this->slotReviews"/>
</section>
