<?php

namespace Nulisec\GoogleSheetsImporter;

use App\Models\Setting;
use App\Repositories\ScheduledTasksRepository;
use Laravel\Nova\Nova;
use Laravel\Nova\Events\ServingNova;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Nulisec\GoogleSheetsImporter\Http\Middleware\Authorize;
use Nulisec\GoogleSheetsImporter\Jobs\SyncFromGoogleSheets;

class ToolServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'google-sheets-importer');
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'google-sheets-importer');

        $this->app->booted(function () {
            $this->routes();
        });

        $this->app->make(ScheduledTasksRepository::class)->registerWhen(
            stringToBoolean(Setting::fetch('google_sheets_importer', 'run_daily')),
            new SyncFromGoogleSheets()
        );

        Nova::serving(function (ServingNova $event) {
            //
        });
    }

    /**
     * Register the tool's routes.
     *
     * @return void
     */
    protected function routes()
    {
        if ($this->app->routesAreCached()) {
            return;
        }

        Route::middleware(['nova', Authorize::class])
                ->prefix('nova-vendor/google-sheets-importer')
                ->group(__DIR__.'/../routes/api.php');
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
