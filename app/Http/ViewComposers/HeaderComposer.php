<?php

namespace App\Http\ViewComposers;

use App\Models\Category;
use Illuminate\View\View;

class HeaderComposer
{
    public function compose(View $view)
    {
        $categories = Category::withCount('products')
            ->whereEnabled(true)
            ->whereIsRoot()
            ->get();

        $view->with('categories', $categories);
    }
}
