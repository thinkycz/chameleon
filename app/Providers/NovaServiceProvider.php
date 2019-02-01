<?php

namespace App\Providers;

use App\Enums\Locale;
use App\Models\User;
use App\Nova\Metrics\NumberOfUsers;
use App\Nova\Metrics\OrdersPerDay;
use App\Nova\Metrics\ProductsPerCategory;
use Illuminate\Support\Facades\Gate;
use Kristories\Novassport\Novassport;
use Laravel\Nova\Events\ServingNova;
use Laravel\Nova\Nova;
use Laravel\Nova\NovaApplicationServiceProvider;
use Laravel\Nova\Tools\Dashboard;
use MadWeb\NovaHorizonLink\HorizonLink;
use Nulisec\BulkImageUpload\BulkImageUpload;
use Nulisec\GoogleSheetsImporter\GoogleSheetsImporter;
use Nulisec\JetsoftShopconnector\JetsoftShopconnector;
use Silvanite\NovaToolPermissions\NovaToolPermissions;

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
                'locales'       => Locale::all(),
                'currentLocale' => Locale::current(),
                'flagsPath'     => asset('/images/flags'),
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
        Gate::define('viewNova', function (User $user) {
            return $user->hasRoleWithPermission('viewNova');
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
        return [
            (new JetsoftShopconnector),
            (new Novassport),
            (new HorizonLink),
            (new NovaToolPermissions),
            (new GoogleSheetsImporter),
            (new BulkImageUpload),
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
