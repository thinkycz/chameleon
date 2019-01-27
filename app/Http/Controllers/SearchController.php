<?php

namespace App\Http\Controllers;

use App\Services\SearchService;

class SearchController extends Controller
{
    public function index(SearchService $search)
    {
        $products = $search->fetch()->take(request('per_page', config('config.products_default_pagination')));

        return view('search.index', compact('products'));
    }
}
