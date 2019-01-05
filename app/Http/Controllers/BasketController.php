<?php

namespace App\Http\Controllers;

use App\Models\DeliveryMethod;
use App\Models\PaymentMethod;

class BasketController extends Controller
{
    public function index()
    {
        $basket = activeBasket();
        $deliveryMethods = DeliveryMethod::whereEnabled(true)->get();
        $paymentMethods = PaymentMethod::whereEnabled(true)->get();

        return view('basket.index', compact('basket', 'deliveryMethods', 'paymentMethods'));
    }
}
