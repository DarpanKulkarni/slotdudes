<?php

namespace App\Filament\Widgets;

use App\Models\Casino;
use Filament\Facades\Filament;
use Filament\Support\Icons\Heroicon;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class CasinosOverviewWidget extends StatsOverviewWidget
{
    protected static ?int $sort = 1;

    protected int|array|null $columns = [
        'default' => 2,
        'md' => 2,
        'lg' => 4,
    ];

    protected function getStats(): array
    {
        $totalCasinos = Casino::count();
        $publishedCasinos = Casino::where('status', 'published')->count();
        $draftCasinos = Casino::where('status', 'draft')->count();
        $thisMonthCasinos = Casino::whereMonth('created_at', now()->month)->count();
        $url = Filament::getResourceUrl(Casino::class);

        return [
            Stat::make('Total Casinos', $totalCasinos)
                ->description('All casinos')
                ->icon(HeroIcon::OutlinedCircleStack)
                ->color('primary')
                ->url($url),

            Stat::make('Published Casinos', $publishedCasinos)
                ->description('Live casinos')
                ->icon(HeroIcon::OutlinedNewspaper)
                ->color('success')
                ->url($url.'?filters[status][value]=published'),

            Stat::make('Draft Casinos', $draftCasinos)
                ->description('Unpublished casinos')
                ->icon(HeroIcon::OutlinedPencilSquare)
                ->color('warning')
                ->url($url.'?filters[status][value]=draft'),

            Stat::make('This Month', $thisMonthCasinos)
                ->description('Casinos added this month')
                ->icon(HeroIcon::OutlinedCalendar)
                ->color('info')
                ->url($url.'?filters[date_filter][preset]=this_month'),
        ];
    }
}
