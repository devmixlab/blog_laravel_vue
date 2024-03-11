<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Auth;
use Inertia\Inertia;

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

//        view()->share('authUser', Auth::user());
        Inertia::share('response_time', time());

    }
}
