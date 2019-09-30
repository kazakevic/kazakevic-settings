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
        include __DIR__.'/routes.php';
        $this->loadViewsFrom(__DIR__.'/resources/views', 'settings');
        $this->publishes([
            __DIR__.'/public' => public_path('kazakevic/settings'),
        ], 'public');
    }
}
