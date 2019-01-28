<?php

namespace App\Providers;

use App\Events\OrderPlaced;
use App\Events\OrderStatusChanged;
use App\Listeners\HandleOrderPlaced;
use App\Listeners\HandleOrderStatusChanged;
use App\Listeners\HandleUserRegistered;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class         => [
            SendEmailVerificationNotification::class,
            HandleUserRegistered::class,
        ],

        OrderPlaced::class        => [
            HandleOrderPlaced::class,
        ],

        OrderStatusChanged::class => [
            HandleOrderStatusChanged::class,
        ],

    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
