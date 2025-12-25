<?php

namespace App\Filament\Widgets;

use App\Models\Post;
use Filament\Facades\Filament;
use Filament\Support\Icons\Heroicon;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class PostsOverviewWidget extends StatsOverviewWidget
{
    protected static ?int $sort = 1;

    protected int|array|null $columns = [
        'default' => 2,
        'md' => 2,
        'lg' => 4,
    ];

    protected function getStats(): array
    {
        $totalPosts = Post::count();
        $publishedPosts = Post::where('status', 'published')->count();
        $draftPosts = Post::where('status', 'draft')->count();
        $thisMonthPosts = Post::whereMonth('created_at', now()->month)->count();
        $url = Filament::getResourceUrl(Post::class);

        return [
            Stat::make('Total Posts', $totalPosts)
                ->description('All posts in the blog')
                ->icon(HeroIcon::OutlinedDocumentText)
                ->color('primary')
                ->url($url),

            Stat::make('Published Posts', $publishedPosts)
                ->description('Live posts')
                ->icon(HeroIcon::OutlinedNewspaper)
                ->color('success')
                ->url($url.'?filters[status][value]=published'),

            Stat::make('Draft Posts', $draftPosts)
                ->description('Unpublished posts')
                ->icon(HeroIcon::OutlinedPencilSquare)
                ->color('warning')
                ->url($url.'?filters[status][value]=draft'),

            Stat::make('This Month', $thisMonthPosts)
                ->description('Posts created this month')
                ->icon(HeroIcon::OutlinedCalendar)
                ->color('info')
                ->url($url.'?filters[date_filter][preset]=this_month'),
        ];
    }
}
