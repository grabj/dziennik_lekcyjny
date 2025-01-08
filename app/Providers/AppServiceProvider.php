<?php

namespace App\Providers;

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
        Gate::define('0', function ($user) {
            if ($user->role == '0') {
                return true;
            }
            return false;
        });

        Gate::define('1', function ($user) {
            if ($user->role == '1') {
                return true;
            }
            return false;
        });

        Gate::define('2', function ($user) {
            if ($user->role == '2') {
                return true;
            }
            return false;
        });
    }
}
