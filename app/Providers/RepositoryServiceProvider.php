<?php

namespace App\Providers;

use App\Repositories\OrderRepository;
use App\Repositories\PreferenceRepository;
use App\Repositories\SettingsRepository;
use App\Services\InstanceCache;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->singleton('OrderRepository', function () {
            return new OrderRepository();
        });

        $this->app->singleton('InstanceCache', function () {
            return new InstanceCache();
        });

        $this->app->singleton('PreferenceRepository', function () {
            return new PreferenceRepository();
        });

        $this->app->singleton('SettingsRepository', function () {
            return new SettingsRepository();
        });
    }
}
