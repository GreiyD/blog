<?php

namespace App\Providers;

use App\Http\ViewComposers\HeaderComposer;
use Carbon\Laravel\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;

class ViewServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        Paginator::defaultView('components.pagination');
        View::composer('layouts.header', HeaderComposer::class);
    }
}
