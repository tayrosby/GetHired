<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\Utility\Logger; 

class LoggingServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
        $this->app->singleton('App\Services\Utility\ILoggerService', function ($app) {
            return new Logger();
        });
    }
}
