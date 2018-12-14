<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function show(Product $product)
    {
        return view('products.show', compact('product'));
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

    public function removeFromBasket(BasketItem $basketItem)
    {
        $basket = activeBasket();

        $basket->removeBasketItem($basketItem);

        return $this->ajaxWithPayload([
            'basket' => $basket->fresh(),
        ]);
    }
}
