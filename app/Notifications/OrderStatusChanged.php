<?php

namespace App\Notifications;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class OrderStatusChanged extends Notification
{
    use Queueable;

    private $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject(trans('notifications.order_status_has_changed'))
            ->line(trans('notifications.order_status_has_changed'))
            ->line(trans('notifications.order_number', ['number' => $this->order->order_number]))
            ->line(trans('notifications.order_status', ['status' => $this->order->status->name]))
            ->action(trans('notifications.show_order'), route('profiles.show', ['order' => $this->order]));
    }
}
