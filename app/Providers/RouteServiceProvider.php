<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        //

        parent::boot();
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapApiRoutes();

        $this->mapWebRoutes();

        $this->mapAuthRoutes();

        $this->mapProfileRoutes();

        $this->mapTestRoutes();
    }

    protected function mapWebRoutes()
    {
        Route::middleware('web')
            ->namespace($this->namespace)
            ->group(base_path('routes/web.php'));
    }

    protected function mapAuthRoutes()
    {
        Route::middleware(['web', 'auth'])
            ->namespace($this->namespace)
            ->group(base_path('routes/auth.php'));
    }

    protected function mapProfileRoutes()
    {
        Route::prefix('profiles/{user}')
            ->middleware(['web', 'auth'])
            ->namespace($this->namespace)
            ->group(base_path('routes/profile.php'));

    }

    protected function mapApiRoutes()
    {
        Route::prefix('api')
            ->middleware('api')
            ->namespace($this->namespace)
            ->group(base_path('routes/api.php'));
    }

    protected function mapTestRoutes()
    {
        if (config('app.env') == 'local' || config('app.debug') == true) {
            Route::middleware('web')
                ->namespace($this->namespace)
                ->group(base_path('routes/test.php'));
        }
    }
}
