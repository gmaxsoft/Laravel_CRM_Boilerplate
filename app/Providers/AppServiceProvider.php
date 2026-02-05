<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Rejestracja usług aplikacji.
     */
    public function register(): void
    {
        //
    }

    /**
     * Uruchomienie usług aplikacji.
     */
    public function boot(): void
    {
        app()->setLocale(config('app.locale'));
    }
}
