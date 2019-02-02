<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;

class AboutController extends Controller
{
    public function index()
    {
        $customers = User::whereHas('orders')->count();
        $orders = Order::whereNotNull('placed_at')->count();
        $products = Product::count();

        return view('about.index', compact('customers', 'orders', 'products'));
    }
}
