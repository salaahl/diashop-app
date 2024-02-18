<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\StripePaymentInterfaceRepository;
use App\Repositories\StripePaymentSessionRepository;

class StripePaymentServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(StripePaymentInterfaceRepository::class, StripePaymentSessionRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
