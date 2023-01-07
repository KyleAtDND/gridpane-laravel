<?php

namespace KyleAtDND\GridPane\Providers;

use Illuminate\Support\ServiceProvider;
use KyleAtDND\GridPane\Services\GridPaneService;
use KyleAtDND\GridPane\Services\NullService;

class GridPaneServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Register the service provider and merge config.
     *
     * @return void
     */
    public function register()
    {
        $packageName = 'gridpane-laravel';
        $configPath = __DIR__.'/../../config/gridpane-laravel.php';

        $this->mergeConfigFrom(
            $configPath, $packageName
        );

        $this->publishes([
            $configPath => config_path(sprintf('%s.php', $packageName)),
        ]);
    }

    /**
     * Bind service to 'GridPane' for use with Facade.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind('GridPane', function () {
            $driver = config('gridpane-laravel.driver', 'api');
            if (is_null($driver) || $driver === 'log') {
                return new NullService($driver === 'log');
            }

            return new GridPaneService;
        });
    }
}
