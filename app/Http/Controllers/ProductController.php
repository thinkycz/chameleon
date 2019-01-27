<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function show(Product $product)
    {
        $product->load('tags', 'availability', 'properties', 'categories', 'unit');
        $relatedProducts = $product->getRelatedRecommendations();

        return view('products.show', compact('product', 'relatedProducts'));
    }

    public function basket(Request $request, Product $product)
    {
        $basket = activeBasket();
        $quantity = $request->get('quantity');
        $options = $request->get('options') ? iterable($request->get('options')) : [];

        // TODO:: check eligibility
        $basket->addOrUpdateProduct($product, $quantity ?? 1, $options);

        return $this->ajaxWithPayload([
            'basket' => $basket->fresh(),
        ]);
    }
}
