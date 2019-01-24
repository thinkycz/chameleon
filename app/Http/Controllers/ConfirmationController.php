<?php

namespace App\Http\Controllers;

class ConfirmationController extends Controller
{
    public function __construct()
    {
        $this->middleware('basket_is_not_empty');
    }

    public function index()
    {
        $basket = activeBasket();

        return view('confirmation.index', compact('basket'));
    }
}
