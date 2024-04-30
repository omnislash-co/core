<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Database\Eloquent\Relations\Relation;
use \Livewire\Livewire;
use Illuminate\Routing\Router;
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
        if($this->app->environment('production')) {
            URL::forceScheme('https');
        }
        
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
