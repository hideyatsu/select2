<?php

namespace Hideyatsu\Select2\Providers;

use Hideyatsu\Select2\Builder;
use Illuminate\Support\ServiceProvider;

class Select2ServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'select2-template');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('select2', function() {
            return new Builder();
        });
    }
}
