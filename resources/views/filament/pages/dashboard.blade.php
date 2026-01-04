<x-filament-panels::page>
    <div class="space-y-6">
        <div>
            <h3 class="text-xl text-gray-600 font-medium uppercase mb-2">Casinos</h3>
            @livewire(\App\Filament\Widgets\CasinosOverviewWidget::class)
        </div>

        <div>
            <h3 class="text-xl text-gray-600 font-medium uppercase mb-2">Posts</h3>
            @livewire(\App\Filament\Widgets\PostsOverviewWidget::class)
        </div>

        <div>
            <h3 class="text-xl text-gray-600 font-medium uppercase mb-2">Slot Reviews</h3>
            @livewire(\App\Filament\Widgets\SlotReviewsOverviewWidget::class)
        </div>
    </div>
</x-filament-panels::page>
