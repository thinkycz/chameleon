<?php

namespace Nulisec\LatestOrders\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Nulisec\LatestOrders\Http\Resources\OrderResource;

class OrderResourceController extends Controller
{
    public function latest()
    {
        $orders = Order::whereNotNull('placed_at')->latest()->take(6)->get();

        return OrderResource::collection($orders);
    }
}
