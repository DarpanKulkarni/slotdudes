<?php

namespace App\Filament\Widgets;

use App\Models\SlotCategory;
use App\Models\SlotReview;
use Filament\Facades\Filament;
use Filament\Support\Icons\Heroicon;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class SlotCategoriesOverviewWidget extends StatsOverviewWidget
{
    protected static ?int $sort = 3;

    protected int|array|null $columns = [
        'default' => 2,
        'md' => 2,
        'lg' => 4,
    ];

    protected function getStats(): array
    {
        $totalCategories = SlotCategory::count();
        $activeCategories = SlotCategory::has('slotReviews')->count();
        $emptyCategories = SlotCategory::doesntHave('slotReviews')->count();
        $avgPostsPerCategory = $totalCategories > 0 ? round(SlotReview::count() / $totalCategories, 1) : 0;
        $url = Filament::getResourceUrl(SlotCategory::class);

        return [
            Stat::make('Total Slot Categories', $totalCategories)
                ->description('All slot categories')
                ->icon(Heroicon::OutlinedSquaresPlus)
                ->color('primary')
                ->url($url),

            Stat::make('Active Slot Categories', $activeCategories)
                ->description('Categories with slot reviews')
                ->icon(Heroicon::OutlinedCheckCircle)
                ->color('success')
                ->url($url.'?filters[status][value]=active'),

            Stat::make('Empty Slot Categories', $emptyCategories)
                ->description('Categories without slot reviews')
                ->icon(Heroicon::OutlinedXCircle)
                ->color('danger')
                ->url($url.'?filters[status][value]=inactive'),

            Stat::make('Slot Reviews / Category', $avgPostsPerCategory)
                ->description('Average slot reviews per category')
                ->icon(Heroicon::OutlinedChartBar)
                ->color('info')
                ->url($url),
        ];
    }
}
