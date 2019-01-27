<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use View;

class ViewComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('layouts.partials.header', '\App\Http\ViewComposers\HeaderComposer@compose');
    }
}
