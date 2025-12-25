<?php

namespace App\Filament\Pages;

use App\Models\Post;
use App\Models\Category;
use App\Filament\Widgets\PostsOverviewWidget;
use App\Filament\Widgets\CategoriesOverviewWidget;
use App\Filament\Widgets\PostsChartWidget;
use App\Filament\Widgets\CategoriesDistributionWidget;
use Filament\Pages\Page;
use Filament\Support\Icons\Heroicon;

class Dashboard extends Page
{
    protected static string | \BackedEnum | null $navigationIcon = Heroicon::OutlinedHome;

    public function getView(): string
    {
        return 'filament.pages.dashboard';
    }

    protected static ?string $title = 'Dashboard';

    protected static ?string $navigationLabel = 'Dashboard';

    protected static ?int $navigationSort = 1;

    public function getExtraBodyAttributes(): array
    {
        return ['class' => 'custom-dashboard'];
    }

    public function getWidgets(): array
    {
        return [
            PostsOverviewWidget::class,
            CategoriesOverviewWidget::class,
            PostsChartWidget::class,
            CategoriesDistributionWidget::class,
        ];
    }

    public function getColumns(): int | string | array
    {
        return [
            'sm' => 1,
            'md' => 2,
            'lg' => 3,
            'xl' => 4,
        ];
    }

    public function getWidgetData(): array
    {
        return [
            'postsCount' => Post::count(),
            'categoriesCount' => Category::count(),
            'publishedPosts' => Post::where('status', 'published')->count(),
            'draftPosts' => Post::where('status', 'draft')->count(),
        ];
    }
}
