<?php

namespace App\Listeners;

use App\Notifications\UserRegistered;

class HandleUserRegistered
{
    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        $user = $event->user;

        Notification::send(userRepository()->admins(), new UserRegistered($user));
    }
}
