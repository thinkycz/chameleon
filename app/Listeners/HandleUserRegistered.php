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
    public function handle($event, UserRepository $userRepository)
    {
        $user = $event->user;

        Notification::send($userRepository->admins(), new UserRegistered($user));
    }
}
