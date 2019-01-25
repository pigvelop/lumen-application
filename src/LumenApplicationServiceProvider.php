<?php

namespace Pigvelop\LumenApplication;

use Illuminate\Support\ServiceProvider;

class LumenApplicationServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        // $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'pigvelop');
        // $this->loadViewsFrom(__DIR__.'/../resources/views', 'pigvelop');
        // $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        // $this->loadRoutesFrom(__DIR__.'/routes.php');

        // Publishing is only necessary when using the CLI.
        if ($this->app->runningInConsole()) {
            $this->bootForConsole();
        }
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
        require_once __DIR__.'/helper.php';

        $this->mergeConfigFrom(__DIR__.'/../config/lumen-application.php', 'app');

        // Register the service the package provides.
        // $this->app->singleton('lumen-application', function ($app) {
        //     return new LumenApplication;
        // });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['lumen-application'];
    }
    
    /**
     * Console-specific booting.
     *
     * @return void
     */
    protected function bootForConsole()
    {
        // Publishing the configuration file.
        // $this->publishes([
        //     __DIR__.'/../config/lumen-application.php' => config_path('lumen-application.php'),
        // ], 'lumen-application.config');

        // Publishing the views.
        /*$this->publishes([
            __DIR__.'/../resources/views' => base_path('resources/views/vendor/pigvelop'),
        ], 'lumenapplication.views');*/

        // Publishing assets.
        /*$this->publishes([
            __DIR__.'/../resources/assets' => public_path('vendor/pigvelop'),
        ], 'lumenapplication.views');*/

        // Publishing the translation files.
        /*$this->publishes([
            __DIR__.'/../resources/lang' => resource_path('lang/vendor/pigvelop'),
        ], 'lumenapplication.views');*/

        // Registering package commands.
        $this->commands([
            Commands\KeyGenerateCommand::class
        ]);
    }
}
