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
    public function handle($event, UserRepository $userRepository)
    {
        $order = $event->order;

        Notification::send($order->email, new OrderPlacedToCustomer($order));
        Notification::send($userRepository->admins(), new OrderPlacedToAdmins($order));
    }
}
