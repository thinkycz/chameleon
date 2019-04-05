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
        $categories = Category::withCount('products')
            ->whereEnabled(true)
            ->whereIsRoot()
            ->get();

        $locales = Locale::all();

        $currencies = Currency::whereEnabled(true)->get();

        $view->with(compact('categories', 'currencies', 'locales'));
    }
}
