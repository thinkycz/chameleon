<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function __construct()
    {
        $this->middleware('access_administration');
    }

    public function index(Request $request)
    {
        $orders = explode(',', $request->get('orders'));
        $orders = Order::whereIn('id', $orders)->get();

        return view('invoices.index', compact('orders'));
    }
}
