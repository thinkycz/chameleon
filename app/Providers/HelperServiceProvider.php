<?php

namespace App\Providers;

use App\Helpers\Tools\Generator;
use App\Helpers\Tools\Snackbar;
use Illuminate\Support\ServiceProvider;

class HelperServiceProvider extends ServiceProvider
{
    /**
     * Register the application services.
     */
    public function register()
    {
        $this->app->singleton('Generator', function () {
            return new Generator();
        });

        $this->app->singleton('Snackbar', function () {
            return new Snackbar();
        });
    }
}
