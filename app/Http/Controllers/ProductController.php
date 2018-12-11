<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function addToBasket(Request $request, Product $product)
    {
        $basket = activeBasket();
        $quantity = $request->get('quantity');
        $options = iterable($request->get('options'));

        // TODO:: check eligibility
        $basket->addProduct($product, $quantity ?? 1, $options);

        return redirect()->back();

        /* return $this->ajaxWithPayload([
    'basket' => $basket->fresh(),
    ]); */
    }
}
