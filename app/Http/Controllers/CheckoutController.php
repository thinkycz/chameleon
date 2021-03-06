<?php

namespace App\Http\Controllers;

use App\Events\OrderPlaced;
use App\Http\Requests\Checkout\StoreAddressRequest;
use App\Http\Requests\Confirmation\ConfirmationRequest;
use App\Models\Country;
use App\Models\DeliveryMethod;

class CheckoutController extends Controller
{
    public function __construct()
    {
        $this->middleware('basket_is_not_empty');
    }

    public function show()
    {
        $basket = activeBasket();
        $countries = Country::whereEnabled(true)->get();
        $deliveryMethods = DeliveryMethod::whereEnabled(true)->get();
        $addresses = currentUser()->addresses()->orderBy('is_default', 'desc')->get();

        return view('checkout.show', compact('addresses', 'basket', 'countries', 'deliveryMethods'));
    }

    public function confirm(ConfirmationRequest $request)
    {
        $basket = activeBasket();

        $basket->processBillingDetail($request);
        $basket->processShippingDetail($request);
        $basket->update($request->only('email', 'phone', 'customer_note', 'delivery_method_id', 'payment_method_id'));

        return view('confirmation.show', compact('basket'));
    }

    public function complete()
    {
        $basket = activeBasket();
        $order = $basket->complete();

        event(new OrderPlaced($order));

        snackbar()->success(trans('checkout.order_was_placed'));

        return redirect()->route('profiles.show', ['order' => $order->id]);
    }

    public function storeAddress(StoreAddressRequest $request)
    {
        $address = currentUser()->addresses()->create($request->mergeDefaultAddress()->all());

        return response([
            'address' => $address,
            'message' => trans('profiles.address_created'),
        ]);
    }
}
