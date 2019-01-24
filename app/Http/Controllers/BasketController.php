<?php

namespace App\Http\Controllers;

use Illuminate\Support\MessageBag;

class BasketController extends Controller
{
    public function show()
    {
        $basket = activeBasket();

        return view('basket.show', compact('basket'));
    }

    public function updateQuantities(Request $request)
    {
        $basket = activeBasket();
        $errors = new MessageBag();

        foreach ($request->get('quantities') as $basketItemId => $quantity) {
            if ($basketItem = $basket->basketItems->firstWhere('id', $basketItemId)) {
                $basket->updateOrderedItemQuantity($basketItem, $quantity);

                // TODO:: check eligibility
                // $result = $basketItem->checkEligibility($quantity);
                // $result->successful() ? $basket->updateBasketItemQuantity($basketItem, $quantity) : $errors->add("quantities-{$basketItemId}", $result->message());
            }
        }

        if ($errors->count()) {
            snackbar()->error(trans('basket.basket_quantity_update_err'));
        }

        return redirect()->route('basket.show')->withErrors($errors);
    }

    public function emptyBasket()
    {
        activeBasket()->orderedItems()->delete();

        snackbar()->success(trans('basket.basket_emptied'));

        return $this->ajaxOrRedirect(route('basket.show'));
    }
}
