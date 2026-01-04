<?php

namespace App\Filament\Pages;

use App\Models\Post;
use App\Models\SlotReview;
use App\Filament\Widgets\PostsOverviewWidget;
use App\Filament\Widgets\CategoriesOverviewWidget;
use App\Filament\Widgets\SlotReviewsOverviewWidget;
use App\Filament\Widgets\SlotCategoriesOverviewWidget;
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
            SlotReviewsOverviewWidget::class,
            CategoriesOverviewWidget::class,
            SlotCategoriesOverviewWidget::class,
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
            'publishedPosts' => Post::where('status', 'published')->count(),
            'draftPosts' => Post::where('status', 'draft')->count(),
            'slotReviewsCount' => SlotReview::count(),
            'publishedSlotReviews' => SlotReview::where('status', 'published')->count(),
            'draftSlotReviews' => SlotReview::where('status', 'draft')->count(),
        ];
    }
}
