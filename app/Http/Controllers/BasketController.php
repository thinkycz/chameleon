<?php

namespace App\Http\Controllers;

class BasketController extends Controller
{
    public function index()
    {
        $basket = activeBasket();

        return view('basket.index', compact('basket'));
    }
}
