<?php

namespace Kazakevic\Settings;

use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Support\ServiceProvider;

class SettingsServiceProvider extends ServiceProvider
{
    /**
     * Register services
     *
     * @throws BindingResolutionException
     */
    public function register()
    {
        $this->app->make('Kazakevic\Settings\Http\Controllers\Api\SettingsController');
        $this->app->make('Kazakevic\Settings\Http\Controllers\OfficeController');
        $this->app->make('Kazakevic\Settings\Models\Setting');
        $this->loadMigrationsFrom(__DIR__.'/Database/migrations');
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadViewsFrom(__DIR__.'/resources/views', 'settings');
        $this->publishes([
            __DIR__.'/public' => public_path('kazakevic/settings'),
        ], 'public');

        # load the routes when the app is booted (core routes.php is booted)
        $this->app->booted(function () {
            include __DIR__.'/routes.php';
        });
    }
}
