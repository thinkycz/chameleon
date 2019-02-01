<?php

namespace App\Listeners;

use App\Notifications\ContactFormSubmitted;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Notification;

class HandleContactFormSubmitted
{
    public function handle($event)
    {
        Notification::send(UserRepository::admins(), new ContactFormSubmitted($event->name, $event->email, $event->message));
    }
}
