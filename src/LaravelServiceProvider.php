<?php

namespace Xyu\Sand;

use Illuminate\Support\ServiceProvider;
use Laravel\Lumen\Application;

/**
 * Class LaravelServiceProvider
 *
 * @package Xyu\BaiduAIP
 */
class LaravelServiceProvider extends ServiceProvider
{
    /**
     * Setup the config.
     */
    protected function setupConfig()
    {
        $source = dirname(__DIR__).'/config/sand-pay.php';
        if ($this->app->runningInConsole()) {
            $this->publishes([$source => base_path('config/sand-pay.php')], 'sand-pay');
        }

        if ($this->app instanceof Application) {
            $this->app->configure('sand-pay');
        }

        $this->mergeConfigFrom($source, 'sand-pay');
    }

    public function register()
    {
        $this->setupConfig();

        $this->app->singleton(SandApp::class, function ($app) {
            return app(Factory::class)->make();
        });

        $this->app->singleton(Factory::class, function ($app) {
            return new Factory(config('sand-pay'));
        });

        $this->app->alias(Factory::class, 'sand.factory');
        $this->app->alias(SandApp::class, 'sand.pay');
    }
}