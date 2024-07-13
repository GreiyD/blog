<?php

namespace App\Providers;

use App\Actions\RegisterUserAction;
use App\Contracts\RegisterActionContract;
use Illuminate\Support\ServiceProvider;

class ActionServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(RegisterActionContract::class, RegisterUserAction::class);
    }

    public function boot(): void
    {
        //
    }
}
