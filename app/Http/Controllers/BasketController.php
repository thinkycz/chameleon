<?php

namespace App\Http\Controllers;

use App\Models\OrderedItem;
use Illuminate\Http\Request;
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

        foreach ($request->get('quantities') as $orderedItemId => $quantity) {
            if ($orderedItem = $basket->orderedItems->firstWhere('id', $orderedItemId)) {
                $basket->updateOrderedItemQuantity($orderedItem, $quantity);

                // TODO:: check eligibility
                // $result = $basketItem->checkEligibility($quantity);
                // $result->successful() ? $basket->updateBasketItemQuantity($basketItem, $quantity) : $errors->add("quantities-{$basketItemId}", $result->message());
            }
        }

        if ($errors->count()) {
            snackbar()->error(trans('basket.basket_quantity_update_err'));
        } else {
            snackbar()->success(trans('basket.basket_quantity_updated'));
        }

        return redirect()->route('basket.show')->withErrors($errors);
    }

    public function removeOrderedItem(OrderedItem $orderedItem)
    {
        $orderedItem->delete();

        snackbar()->success(trans('basket.ordered_item_removed'));

        return $this->ajaxOrRedirect(route('basket.show'));
    }

    public function emptyBasket()
    {
        activeBasket()->orderedItems()->delete();

        snackbar()->success(trans('basket.basket_emptied'));

        return $this->ajaxOrRedirect(route('basket.show'));
    }
}
