<?php

namespace App\Http\ViewComposers;

use App\Enums\Locale;
use App\Models\Category;
use App\Models\Currency;
use Illuminate\View\View;

class HeaderComposer
{
    public function compose(View $view)
    {
        $categories = cache()->remember('header_categories', 3600, function () {
            return Category::withCount('products')
                ->whereEnabled(true)
                ->whereIsRoot()
                ->get();
        });

        $locales = Locale::all();

        $currencies = cache()->remember('currencies', 3600, function () {
            return Currency::whereEnabled(true)->get();
        });

        $view->with(compact('categories', 'currencies', 'locales'));
    }
}
