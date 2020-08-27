<?php

namespace Gegosoft\Dashcoin\Providers;

use Gegosoft\Dashcoin\Client as DashcoinClient;
use Illuminate\Support\ServiceProvider as IlluminateServiceProvider;

class ServiceProvider extends IlluminateServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $path = realpath(__DIR__.'/../../config/config.php');

        $this->publishes([$path => config_path('dashcoind.php')], 'config');
        $this->mergeConfigFrom($path, 'dashcoind');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerAliases();

        $this->registerClient();
    }

    /**
     * Register aliases.
     *
     * @return void
     */
    protected function registerAliases()
    {
        $aliases = [
            'dashcoind' => 'Gegosoft\Dashcoin\Client',
        ];

        foreach ($aliases as $key => $aliases) {
            foreach ((array) $aliases as $alias) {
                $this->app->alias($key, $alias);
            }
        }
    }

    /**
     * Register client.
     *
     * @return void
     */
    protected function registerClient()
    {
        $this->app->singleton('dashcoind', function ($app) {
            return new DashcoinClient([
                'scheme' => $app['config']->get('dashcoind.scheme', 'http'),
                'host'   => $app['config']->get('dashcoind.host', 'localhost'),
                'port'   => $app['config']->get('dashcoind.port', 8332),
                'user'   => $app['config']->get('dashcoind.user'),
                'pass'   => $app['config']->get('dashcoind.password'),
                'ca'     => $app['config']->get('dashcoind.ca'),
            ]);
        });
    }
}
