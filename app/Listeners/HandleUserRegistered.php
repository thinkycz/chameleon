<?php

namespace App\Listeners;

use App\Notifications\UserRegistered;
use App\Repositories\UserRepository;

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

        Notification::send(UserRepository::admins(), new UserRegistered($user));
    }
}
