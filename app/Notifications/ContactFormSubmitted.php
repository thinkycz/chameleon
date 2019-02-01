<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Channels\MailChannel;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ContactFormSubmitted extends Notification implements ShouldQueue
{
    use Queueable;

    private $name;
    private $email;
    private $message;

    public function __construct($name, $email, $message)
    {
        $this->name = $name;
        $this->email = $email;
        $this->message = $message;
    }

    public function via($notifiable)
    {
        return [MailChannel::class];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject(trans('notifications.new_contact_form_request'))
            ->replyTo($this->email)
            ->line(trans('notifications.new_contact_form_request_description'))
            ->line(trans('notifications.name_wrote', ['name' => $this->name]))
            ->line($this->message)
            ->line(trans('notifications.reply_to_mail', ['mail' => $this->email]));
    }
}
