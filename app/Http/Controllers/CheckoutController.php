<?php

namespace App\Http\Controllers;

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

    public function index()
    {
        $basket = activeBasket();
        $countries = Country::whereEnabled(true)->get();

        $deliveryMethods = DeliveryMethod::whereEnabled(true)->get();
        $paymentMethods = PaymentMethod::whereEnabled(true)->get();

        $addresses = User::getAuthenticatedUser()->addresses()->orderBy('is_default', 'desc')->get();

        return view('checkout.index', compact('addresses', 'basket', 'countries', 'deliveryMethods', 'paymentMethods'));

    }
}
