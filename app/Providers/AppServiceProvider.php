<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL; // <--- Pastikan baris ini ada

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
        // Paksa HTTPS jika aplikasi berjalan di environment production (Railway)
        // Ini penting agar aset CSS/JS dimuat dengan https:// dan tidak diblokir browser
        if ($this->app->environment('production')) {
            URL::forceScheme('https');
        }
    }
}
