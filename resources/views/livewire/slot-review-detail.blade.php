<section class="py-8" aria-labelledby="page-title">
    <x-layouts.container class="space-y-8">
        <div class="space-y-4">
            <x-slot-review.meta :slot-review="$slotReview"/>
            <x-slot-review.title :slot-review="$slotReview" tag="h1" :link="false"/>
        </div>
        <x-slot-review.featured-image :slot-review="$slotReview" :featured="true" :link="false" :full="true"/>
        <div class="prose prose-xl lg:prose-[23px] max-w-full">
            {!! $slotReview->content !!}
        </div>
    </x-layouts.container>
</section>
