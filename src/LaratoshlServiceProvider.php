<?php

namespace Laratoshl;

use Illuminate\Support\ServiceProvider;
use Laratoshl\Report\ToshlCategoryReport;

/**
 * Class LaratoshlServiceProvider
 * @author Daniel Schmelz
 * @package Laratoshl
 */
class LaratoshlServiceProvider extends ServiceProvider
{

    /**
     * 
     */
    public function boot()
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
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        // TODO: Implement register() method.
    }
    
    


}