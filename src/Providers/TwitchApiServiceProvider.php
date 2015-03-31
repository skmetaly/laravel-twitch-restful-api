<?php

namespace Skmetaly\TwitchApi\Providers;

use Illuminate\Support\ServiceProvider;

/**
 * Class TwitchApiServiceProvider
 * @package Skmetaly\TwitchApi\Providers
 */
class TwitchApiServiceProvider extends ServiceProvider  {

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerServices();
    }

    /**
     *  Boot
     */
    public function boot()
    {
       $this->addConfig();
    }

    /**
     *  Registering services
     */
    private function registerServices()
    {
        $this->app->bind('Skmetaly\TwitchApi\Services\TwitchApiService','Skmetaly\TwitchApi\Services\TwitchApiService');

    }

    /**
     *  Config publishing
     */
    private function addConfig()
    {
        $this->publishes([
            __DIR__.'/../../config/twitch-api.php' => config_path('twitch-api.php')
        ]);
    }
}