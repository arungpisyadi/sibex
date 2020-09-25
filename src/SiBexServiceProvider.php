<?php

namespace ArungPIsyadi\SiBex;

use Illuminate\Support\ServiceProvider;

class SiBexServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        // $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'arungpisyadi');
        // $this->loadViewsFrom(__DIR__.'/../resources/views', 'arungpisyadi');
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
        $this->mergeConfigFrom(__DIR__.'/../config/sibex.php', 'sibex');

        // Register the service the package provides.
        $this->app->singleton('sibex', function ($app) {
            return new SiBex;
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['sibex'];
    }
    
    /**
     * Console-specific booting.
     *
     * @return void
     */
    protected function bootForConsole()
    {
        // Publishing the configuration file.
        $this->publishes([
            __DIR__.'/../config/sibex.php' => config_path('sibex.php'),
        ], 'sibex.config');

        // Publishing the views.
        /*$this->publishes([
            __DIR__.'/../resources/views' => base_path('resources/views/vendor/arungpisyadi'),
        ], 'sibex.views');*/

        // Publishing assets.
        /*$this->publishes([
            __DIR__.'/../resources/assets' => public_path('vendor/arungpisyadi'),
        ], 'sibex.views');*/

        // Publishing the translation files.
        /*$this->publishes([
            __DIR__.'/../resources/lang' => resource_path('lang/vendor/arungpisyadi'),
        ], 'sibex.views');*/

        // Registering package commands.
        // $this->commands([]);
    }
}
