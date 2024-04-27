<?php

namespace App\Providers;

use App\Game;
use App\Observers\GameObserver;
use Illuminate\Support\ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Game::observe(GameObserver::class);
    }
}
