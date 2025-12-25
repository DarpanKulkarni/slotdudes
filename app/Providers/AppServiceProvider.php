<?php

namespace App\Providers;

use App\Models\Casino;
use App\Models\Page;
use App\Models\Post;
use App\Models\User;
use App\Observers\CasinoObserver;
use App\Observers\PageObserver;
use App\Observers\PostObserver;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\CreateRecord;
use Filament\Support\Facades\FilamentColor;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Observers
        Page::observe(PageObserver::class);
        Post::observe(PostObserver::class);
        Casino::observe(CasinoObserver::class);

        // Disable create and create another actions
        CreateRecord::disableCreateAnother();
        CreateAction::configureUsing(fn(CreateAction $action) => $action->createAnother(false));

        // Enable backup create, download and delete
        Gate::define('create-backup', function () {
            return true;
        });

        Gate::define('download-backup', function () {
            return true;
        });

        Gate::define('delete-backup', function () {
            return true;
        });
    }
}
