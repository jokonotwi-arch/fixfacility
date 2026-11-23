<?php

namespace App\Providers;

use Illuminate\Auth\Middleware\Authenticate;
use Illuminate\Auth\Middleware\RedirectIfAuthenticated;
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
        Authenticate::redirectUsing(fn ($request) => route('login'));

        RedirectIfAuthenticated::redirectUsing(function ($request) {
            if ($request->user()?->isAdmin()) {
                return route('admin.dashboard');
            }
            return route('pelapor.dashboard');
        });
    }
}
