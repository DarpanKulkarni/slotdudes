<?php

namespace App\Filament\Widgets;

use App\Models\Category;
use App\Models\Post;
use Filament\Facades\Filament;
use Filament\Support\Icons\Heroicon;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class CategoriesOverviewWidget extends StatsOverviewWidget
{
    protected static ?int $sort = 2;

    protected int|array|null $columns = [
        'default' => 2,
        'md' => 2,
        'lg' => 4,
    ];

    protected function getStats(): array
    {
        $totalCategories = Category::count();
        $activeCategories = Category::has('posts')->count();
        $emptyCategories = Category::doesntHave('posts')->count();
        $avgPostsPerCategory = $totalCategories > 0 ? round(Post::count() / $totalCategories, 1) : 0;
        $url = Filament::getResourceUrl(Category::class);

        return [
            Stat::make('Total Categories', $totalCategories)
                ->description('All categories')
                ->icon(Heroicon::OutlinedSquaresPlus)
                ->color('primary')
                ->url($url),

            Stat::make('Active Categories', $activeCategories)
                ->description('Categories with posts')
                ->icon(Heroicon::OutlinedCheckCircle)
                ->color('success')
                ->url($url.'?filters[status][value]=active'),

            Stat::make('Empty Categories', $emptyCategories)
                ->description('Categories without posts')
                ->icon(Heroicon::OutlinedXCircle)
                ->color('danger')
                ->url($url.'?filters[status][value]=inactive'),

            Stat::make('Posts / Category', $avgPostsPerCategory)
                ->description('Average posts per category')
                ->icon(Heroicon::OutlinedChartBar)
                ->color('info')
                ->url($url),
        ];
    }
}
