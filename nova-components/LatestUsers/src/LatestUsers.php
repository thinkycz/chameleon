<?php

namespace Nulisec\LatestUsers;

use Laravel\Nova\Card;

class LatestUsers extends Card
{
    /**
     * The width of the card (1/3, 1/2, or full).
     *
     * @var string
     */
    public $width = 'full';

    /**
     * Indicates that the analytics should show current visitors.
     *
     * @return $this
     */
    public function orders()
    {
        $orders = Order::whereNotNull('placed_at')->latest()->take(6);

        return $this->withMeta(['orders' => $orders]);
    }

    /**
     * Get the component name for the element.
     *
     * @return string
     */
    public function component()
    {
        return 'latest-users';
    }
}
