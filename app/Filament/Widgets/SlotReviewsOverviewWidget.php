<?php

namespace App\Filament\Widgets;

use App\Models\SlotReview;
use Filament\Facades\Filament;
use Filament\Support\Icons\Heroicon;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class SlotReviewsOverviewWidget extends StatsOverviewWidget
{
    protected static ?int $sort = 2;

    protected int|array|null $columns = [
        'default' => 2,
        'md' => 2,
        'lg' => 4,
    ];

    protected function getStats(): array
    {
        $totalSlotReviews = SlotReview::count();
        $publishedSlotReviews = SlotReview::where('status', 'published')->count();
        $draftSlotReviews = SlotReview::where('status', 'draft')->count();
        $thisMonthSlotReviews = SlotReview::whereMonth('created_at', now()->month)->count();
        $url = Filament::getResourceUrl(SlotReview::class);

        return [
            Stat::make('Total Slot Reviews', $totalSlotReviews)
                ->description('All slot reviews in the blog')
                ->icon(HeroIcon::OutlinedDocumentText)
                ->color('primary')
                ->url($url),

            Stat::make('Published Slot Reviews', $publishedSlotReviews)
                ->description('Live slot reviews')
                ->icon(HeroIcon::OutlinedNewspaper)
                ->color('success')
                ->url($url.'?filters[status][value]=published'),

            Stat::make('Draft Slot Reviews', $draftSlotReviews)
                ->description('Unpublished slot reviews')
                ->icon(HeroIcon::OutlinedPencilSquare)
                ->color('warning')
                ->url($url.'?filters[status][value]=draft'),

            Stat::make('This Month', $thisMonthSlotReviews)
                ->description('Slot reviews created this month')
                ->icon(HeroIcon::OutlinedCalendar)
                ->color('info')
                ->url($url.'?filters[date_filter][preset]=this_month'),
        ];
    }
}
