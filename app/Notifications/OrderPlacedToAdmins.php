<?php

namespace App\Notifications;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class OrderPlacedToAdmins extends Notification
{
    use Queueable;

    private $order;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
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
        return (new MailMessage())
            ->subject(trans('notifications.we_received_new_order'))
            ->line(trans('notifications.we_received_new_order_description'))
            ->line(trans('notifications.customer_name', ['name' => $this->order->user->username]))
            ->line(trans('notifications.total_price', ['price' => $this->order->formatted_total_price]))
            ->action(trans('notifications.show_order'), novaResourceAction('orders', $this->order->id));

    }
}
