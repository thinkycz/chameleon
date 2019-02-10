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
        $categories = Category::withCount('products')->whereEnabled(true)->whereNull('parent_id')->get();

        $firstCategory = Category::findBySlugOrId($homepage['category_1']);
        $secondCategory = Category::findBySlugOrId($homepage['category_2']);

        return view('home.index', compact('homepage', 'categories', 'firstCategory', 'secondCategory'));
    }
}
