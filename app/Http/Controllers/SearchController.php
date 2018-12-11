<?php

namespace App\Http\Controllers;

use App\Models\Product;

class SearchController extends Controller
{
    public function index()
    {
        // TODO:: Change this with real params
        $products = Product::inRandomOrder()->take(6)->get();

        return view('search.index', compact('products'));
    }
}
