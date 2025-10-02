<?php

namespace App\Providers;

use Illuminate\Support\Facades\Vite;
use Laravel\Passport\Passport;

class AppServiceProvider extends \Illuminate\Foundation\Support\Providers\AuthServiceProvider 
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->registerPolicies();

        Passport::tokensExpireIn(now()->addDays(15));
        Passport::refreshTokensExpireIn(now()->addDays(30));
        Passport::personalAccessTokensExpireIn(now()->addMonths(6));
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Vite::prefetch(concurrency: 3);
    }
}
