<section class="py-10 space-y-12">
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
