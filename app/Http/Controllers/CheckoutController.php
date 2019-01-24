<?php

namespace App\Http\Controllers;

use App\Http\Requests\ConfirmationRequest;
use App\Models\Country;
use App\Models\DeliveryMethod;
use App\Models\PaymentMethod;
use App\Models\User;

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
        $paymentMethods = PaymentMethod::whereEnabled(true)->get();

        $addresses = User::getAuthenticatedUser()->addresses()->orderBy('is_default', 'desc')->get();

        return view('checkout.show', compact('addresses', 'basket', 'countries', 'deliveryMethods', 'paymentMethods'));
    }

    public function confirm(ConfirmationRequest $request)
    {
        $basket = activeBasket();

        $basket->processBillingDetails($request);
        $basket->processShippingDetails($request);
        $basket->update($request->only('email', 'phone', 'customer_note', 'delivery_method_id', 'payment_method_id'));

        return view('checkout.confirmation', compact('basket'));
    }
}
