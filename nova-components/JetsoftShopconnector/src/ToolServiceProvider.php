<?php

namespace Nulisec\JetsoftShopconnector;

use App\Models\Setting;
use App\Repositories\ScheduledTasksRepository;
use Laravel\Nova\Nova;
use Laravel\Nova\Events\ServingNova;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Nulisec\JetsoftShopconnector\Http\Middleware\Authorize;
use Nulisec\JetsoftShopconnector\Jobs\SyncronizeProducts;

class ToolServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'jetsoft-shopconnector');
        $this->loadTranslationsFrom(__DIR__ . '/../resources/lang', 'jetsoft-shopconnector');

        $this->app->booted(function () {
            $this->routes();
            $this->database();
        });

        if (stringToBoolean(Setting::fetch('shopconnector', 'run_daily'))) {
            $this->app->make(ScheduledTasksRepository::class)->register(new SyncronizeProducts());
        }

        Nova::serving(function (ServingNova $event) {
            //
        });
    }

    protected function database()
    {
        $config = Setting::loadConfiguration('shopconnector');

        \Config::set("database.connections.shopconnector", [
            'driver' => 'sqlsrv',
            'host' => $config['host'] ?? '',
            'port' => $config['port'] ?? '',
            'database' => $config['database'] ?? '',
            'username' => $config['username'] ?? '',
            'password' => $config['password'] ?? '',
            'charset' => 'utf8',
            'prefix' => '',
            'options' => [
                \PDO::DBLIB_ATTR_STRINGIFY_UNIQUEIDENTIFIER => true
            ]
        ]);
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
                ->prefix('nova-vendor/jetsoft-shopconnector')
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
