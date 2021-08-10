<?php

namespace Artisanpay;

use Artisanpay\Commands\InstallCommand;
use Illuminate\Support\ServiceProvider;

class ArtisanpayServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
       
        $this->loadRoutesFrom(__DIR__.'/../routes.php');

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/config.php' => config_path('artisanpay.php'),
            ], 'artisanpay-config');
        }

        if ($this->app->runningInConsole()) {
            $this->commands([
                InstallCommand::class,
            ]);
        }
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        // Automatically apply the package configuration
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'artisanpay');

        // Register the main class to use with the facade
        $this->app->singleton('artisanpay-laravel', function () {
            return new ArtisanpayCharge();
        });
    }
}
