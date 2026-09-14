<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // Paksa HTTPS untuk asset CSS/JS dan API di environment tunnel/production
        if (request()->header('x-forwarded-proto') == 'https' || request()->isSecure() || config('app.env') !== 'local') {
            URL::forceScheme('https');
        }
    }
}