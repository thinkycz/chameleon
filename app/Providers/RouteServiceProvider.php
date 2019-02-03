<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Page;
use App\Models\Product;
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
        Route::bind('product', function ($value) {
            return Product::where('slug', $value)->firstOr(function () use ($value) {
                return Product::find($value);
            });
        });

        Route::bind('category', function ($value) {
            return Category::where('slug', $value)->firstOr(function () use ($value) {
                return Category::find($value);
            });
        });

        Route::bind('page', function ($value) {
            return Page::where('slug', $value)->firstOr(function () use ($value) {
                return Page::find($value);
            });
        });

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

        $this->mapAjaxRoutes();

        $this->mapAuthRoutes();

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

    protected function mapAjaxRoutes()
    {
        Route::middleware('web')
            ->namespace("$this->namespace\Ajax")
            ->prefix('ajax')
            ->group(base_path('routes/ajax.php'));
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
