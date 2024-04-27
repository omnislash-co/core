<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Database\Eloquent\Relations\Relation;
use \Livewire\Livewire;
use Illuminate\Routing\Router;

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
        Livewire::forceAssetInjection();

        Paginator::defaultView('components.pagination');
        Paginator::defaultSimpleView('components.simple-pagination');

        Relation::morphMap([
            'review' => 'App\Review',
            'recommendation' => 'App\Recommendation',
        ]);
        
        Router::macro('isWith', function ($name, $parameters) {
            return url()->current() === route($name, $parameters);
        });
    }
}
