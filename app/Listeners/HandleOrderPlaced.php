<?php

namespace App\Listeners;

use App\Mail\OrderConfirmation;
use App\Models\Order;
use App\Notifications\OrderPlacedToAdmins;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Mail;
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
        /** @var Order $order */
        $order = $event->order;

        Mail::to($order->email)
            ->locale($order->user->locale)
            ->send(new OrderConfirmation($order));

        Notification::send(UserRepository::admins(), new OrderPlacedToAdmins($order));
    }
}
