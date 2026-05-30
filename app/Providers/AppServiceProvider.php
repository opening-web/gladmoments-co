<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;

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
        // Memaksa Laravel menggunakan HTTPS jika APP_ENV di set ke 'production'
        if (config('app.env') === 'production') {
            URL::forceScheme('https');
        }
    }
}