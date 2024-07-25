<?php

namespace App\Http\ViewComposers;

use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class HeaderComposer
{
    public function compose(View $view): void
    {
        if (Auth::check()) {
            $view->with('user', Auth::user());
        }
    }
}
