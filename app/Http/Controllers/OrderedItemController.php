<?php

namespace App\Http\Controllers;

use App\Models\OrderedItem;
use Illuminate\Http\Request;

class OrderedItemController extends Controller
{
    public function update(Request $request, OrderedItem $orderedItem)
    {
        $basket = activeBasket();
        $result = $orderedItem->checkEligibility($request->get('quantity'));

        if ($result->successful()) {
            $basket->updateOrderedItemQuantity($orderedItem, $request->get('quantity'));
        }

        return $this->ajaxWithPayload([
            'basket' => $basket->fresh(),
        ], $result->successful(), $result->message());

    }

    public function remove(OrderedItem $orderedItem)
    {
        $basket = activeBasket();

        $basket->removeOrderedItem($orderedItem);

        return $this->ajaxWithPayload([
            'basket' => $basket->fresh(),
        ]);
    }
}
