<?php

namespace App\Providers;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\ServiceProvider;

class MacroServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Collection::macro('paginate', function ($perPage = null) {
            $page = request()->input('page', 1);
            $perPage = $perPage ?: config('config.products_default_pagination');
            $offset = ($page * $perPage) - $perPage;

            return new LengthAwarePaginator(
                $this->slice($offset, $perPage),
                $this->count(),
                $perPage,
                $page,
                ['path' => request()->url(), 'query' => request()->query()]
            );
        });
    }
}
