<?php

use App\Models\Order;
use App\Models\OrderedItem;
use App\Models\PaymentMethod;
use App\Models\ShippingDetail;
use App\Models\Status;
use App\Models\User;
use App\Nova\BillingDetail;
use App\Nova\DeliveryMethod;
use Carbon\Carbon;
use Faker\Generator as Faker;

$factory->define(Order::class, function (Faker $faker) {
    return [
        'order_completed_at' => Carbon::yesterday(),
        'tax_date'           => Carbon::today()->addDays(5),
        'due_date'           => Carbon::today()->addDays(12),
        'email'              => $faker->email,
        'phone'              => $faker->phoneNumber,
    ];
});

$factory->afterCreating(Order::class, function (Order $order, Faker $faker) {
    $order->shippingDetail()->associate(factory(ShippingDetail::class)->create());
    $order->billingDetail()->associate(factory(BillingDetail::class)->create());
    $order->deliveryMethod()->associate(DeliveryMethod::first());
    $order->paymentMethod()->associate(PaymentMethod::first());
    $order->user()->associate(User::inRandomOrder()->first());
    $order->status()->associate(Status::inRandomOrder()->first());
    factory(OrderedItem::class, random_int(3, 5))->create(['order_id' => $order->id]);
});
