<?php

namespace App\Listeners;

use App\Notifications\OrderStatusChanged;

class HandleOrderStatusChanged
{
    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        $order = $event->order;

        Notification::send($order->user->email, new OrderStatusChanged($order));
    }
}
