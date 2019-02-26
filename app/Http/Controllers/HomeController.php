<?php

namespace App\Http\Controllers;

use App\Models\Category;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::whereHas('products')
            ->whereNull('parent_id')
            ->withCount('products')
            ->orderByDesc('products_count')
            ->take(10)
            ->get();

        return view('home.index', compact('categories'));
    }
}
