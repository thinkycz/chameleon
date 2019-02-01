<?php

namespace App\Listeners;

use App\Notifications\OrderPlacedToAdmins;
use App\Notifications\OrderPlacedToCustomer;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Notification;

class HandleOrderPlaced
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

        Notification::send($order->email, new OrderPlacedToCustomer($order));
        Notification::send(UserRepository::admins(), new OrderPlacedToAdmins($order));
    }
}
