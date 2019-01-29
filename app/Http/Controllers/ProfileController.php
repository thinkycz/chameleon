<?php

namespace App\Http\Controllers;

use App\Helpers\Tools\ChartData;
use App\Http\Requests\Profile\UpdateProfileRequest;
use App\Models\User;
use App\Repositories\StatsRepository;

class ProfileController extends Controller
{
    public function show(User $user, StatsRepository $statsRepository)
    {
        $user->load('addresses',
            'priceLevel',
            'orders.orderedItems.product',
            'orders.status',
            'orders.deliveryMethod',
            'orders.billingDetail',
            'orders.paymentMethod',
            'orders.shippingDetail');

        $stats = $statsRepository->daily('orders');
        $orderStats = ChartData::make($stats->getResult(), $stats->getInterval());

        return view('profiles.show', compact('user', 'orderStats'));
    }

    public function update(UpdateProfileRequest $request, User $user)
    {
        $user->update($request->except('password'));
        $user->processImage($request->file('image'));
        $user->changePassword($request->get('password'));

        snackbar()->success(trans('profiles.profile_updated'));

        return redirect()->route('profiles.show', ['user' => $user, 'current' => $request->get('current')]);
    }
}
