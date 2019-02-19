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
        $categories = Category::whereHas('products')->with(['products' => function ($q) {
            $q->inRandomOrder()->take(4);
        }])->inRandomOrder()
            ->whereEnabled(true)
            ->whereNull('parent_id')
            ->take(config('config.category_showcase_count'))
            ->get();

        $firstCategory = Category::findBySlugOrId($homepage['category_1']);
        $secondCategory = Category::findBySlugOrId($homepage['category_2']);

        return view('home.index', compact('homepage', 'categories', 'firstCategory', 'secondCategory'));
    }
}
