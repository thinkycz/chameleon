<?php

namespace Nulisec\XmlImporter;

use App\Models\Setting;
use App\Repositories\ScheduledTasksRepository;
use Laravel\Nova\Nova;
use Laravel\Nova\Events\ServingNova;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Nulisec\XmlImporter\Http\Middleware\Authorize;
use Nulisec\XmlImporter\Jobs\SyncXmlFromEndpoint;
use Nulisec\XmlImporter\Jobs\SyncXmlFromFtp;

class ToolServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'xml-importer');
        $this->loadTranslationsFrom(__DIR__ . '/../resources/lang', 'xml-importer');

        $this->app->booted(function () {
            $this->routes();
        });

        $this->app->make(ScheduledTasksRepository::class)->registerWhen(
            stringToBoolean(Setting::fetch('xml_importer_endpoint_settings', 'run_daily')),
            new SyncXmlFromEndpoint()
        );

        $this->app->make(ScheduledTasksRepository::class)->registerWhen(
            stringToBoolean(Setting::fetch('xml_importer_ftp_settings', 'run_daily')),
            new SyncXmlFromFtp()
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
                ->prefix('nova-vendor/xml-importer')
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
