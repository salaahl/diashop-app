<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\BasketInterfaceRepository;
use App\Repositories\BasketSessionRepository;

class BasketServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(BasketInterfaceRepository::class, BasketSessionRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
