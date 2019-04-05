<?php

use App\Models\BillingDetail;
use App\Models\DeliveryMethod;
use App\Models\Order;
use App\Models\OrderedItem;
use App\Models\PaymentMethod;
use App\Models\ShippingDetail;
use App\Models\Status;
use App\Models\User;
use Carbon\Carbon;
use Faker\Generator as Faker;

$factory->define(Order::class, function (Faker $faker) {
    return [
        'placed_at' => Carbon::yesterday(),
        'tax_date'  => Carbon::today()->addDays(5),
        'due_date'  => Carbon::today()->addDays(12),
        'email'     => $faker->email,
        'phone'     => $faker->phoneNumber,
    ];
});

$factory->afterCreating(Order::class, function (Order $order, Faker $faker) {
    $user = User::inRandomOrder()->first();
    $order->user()->associate($user);
    $order->shippingDetail()->associate(factory(ShippingDetail::class)->create(['user_id' => $user->id]));
    $order->billingDetail()->associate(factory(BillingDetail::class)->create(['user_id' => $user->id]));
    $order->deliveryMethod()->associate(DeliveryMethod::first());
    $order->paymentMethod()->associate(PaymentMethod::first());
    $order->status()->associate(Status::inRandomOrder()->first());
    $order->save();
    factory(OrderedItem::class, $faker->numberBetween(3, 5))->create(['order_id' => $order->id]);
    $order->save();
});
