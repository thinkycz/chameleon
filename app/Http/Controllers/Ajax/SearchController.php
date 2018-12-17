<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->get('query');

        // TODO:: implement elastic
        $products = Product::whereLike('name', $query)->take(4)->get();

        return [
            'products' => $products,
        ];
    }
}
