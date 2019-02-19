<?php

namespace App\Http\Controllers;

use App\Models\Category;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $homepage = settingsRepository()->getHomepage();
        $categories = Category::getShowcaseCategories()
            ->filter(function ($category) {
                return $category->products->count() > 3;
            })
            ->map(function ($category) {
                $category->setRelation('products', $category->products->shuffle()->take(3));
                return $category;
            })
            ->shuffle()
            ->take(config('config.category_showcase_count'));

        $firstCategory = Category::findBySlugOrId($homepage['category_1']);
        $secondCategory = Category::findBySlugOrId($homepage['category_2']);

        return view('home.index', compact('homepage', 'categories', 'firstCategory', 'secondCategory'));
    }
}
