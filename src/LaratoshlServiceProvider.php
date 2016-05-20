<?php

namespace Elcheffe\Laratoshl;

use Illuminate\Support\ServiceProvider;
use Elcheffe\Laratoshl\Report\ToshlCategoryReport;

/**
 * Class LaratoshlServiceProvider
 * @author Daniel Schmelz
 * @package Laratoshl
 */
class LaratoshlServiceProvider extends ServiceProvider
{

    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function register()
    {
        $token  = env('TOSHL_TOKEN');

        $this->app->bind('ToshlAPI', function () use ($token)  {
            return new ToshlAPI($token);
        });

        $this->app->bind('Toshl', function () {
            return new Toshl();
        });

        $this->app->bind('ToshlCategoryReport', function ($app) {
            return new ToshlCategoryReport($app['Toshl']);
        });
    }

    /**
     *  Register any other events for your application.
     */
    public function boot()
    {
        $configPath = __DIR__ . '/../config/laratoshl.php';
        
        $this->publishes([
            $configPath => config_path('laratoshl.php'),
        ], 'laratoshl');
    }

}