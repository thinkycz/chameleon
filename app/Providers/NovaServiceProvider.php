<?php

namespace App\Providers;

use App\Enums\Locale;
use App\Nova\Metrics\NumberOfUsers;
use App\Nova\Metrics\OrdersPerDay;
use App\Nova\Metrics\ProductsPerCategory;
use Laravel\Nova\Events\ServingNova;
use Laravel\Nova\Nova;
use Illuminate\Support\Facades\Gate;
use Laravel\Nova\NovaApplicationServiceProvider;
use Laravel\Nova\Tools\Dashboard;
use Laravel\Nova\Tools\ResourceManager;
use Nulisec\Store\Store;

class NovaServiceProvider extends NovaApplicationServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        Nova::serving(function (ServingNova $event) {
            Nova::provideToScript([
                'locales' => Locale::all(),
                'currentLocale' => Locale::current(),
                'flagsPath' => asset('/images/flags')
            ]);
        });
    }

    /**
     * Register the Nova routes.
     *
     * @return void
     */
    protected function routes()
    {
        Nova::routes()
                ->withAuthenticationRoutes()
                ->withPasswordResetRoutes()
                ->register();
    }

    /**
     * Register the Nova gate.
     *
     * This gate determines who can access Nova in non-local environments.
     *
     * @return void
     */
    protected function gate()
    {
        Gate::define('viewNova', function ($user) {
            return in_array($user->email, [
                //
            ]);
        });
    }

    /**
     * Get the cards that should be displayed on the Nova dashboard.
     *
     * @return array
     */
    protected function cards()
    {
        return [
            (new NumberOfUsers),
            (new OrdersPerDay),
            (new ProductsPerCategory),
        ];
    }

    /**
     * Get the tools that should be listed in the Nova sidebar.
     *
     * @return array
     */
    public function tools()
    {
        Nova::$tools = [];

        return [
            (new Dashboard),
            (new Store),
            (new ResourceManager)
        ];
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
