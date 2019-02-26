<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use App\Services\SearchService;

class SearchController extends Controller
{
    public function search(SearchService $search)
    {
        $products = $search->take(config('config.autocomplete_results_count'))->fetch();

        return $products;
    }
}
