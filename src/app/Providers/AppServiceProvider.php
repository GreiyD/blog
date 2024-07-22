<?php

namespace App\Providers;

use App\Contracts\ImageStorageServiceContract;
use App\Services\ImageLocalStorageService;
use App\Services\ReactionService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(ImageStorageServiceContract::class, ImageLocalStorageService::class);
        $this->app->bind(ReactionService::class, ReactionService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
