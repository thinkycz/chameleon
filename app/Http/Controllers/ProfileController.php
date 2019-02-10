<?php

namespace App\Http\Controllers;

use App\Helpers\Tools\ChartData;
use App\Http\Requests\Profile\UpdateProfileRequest;
use App\Jobs\ExportUserData;
use App\Repositories\StatsRepository;

class ProfileController extends Controller
{
    public function show(StatsRepository $statsRepository)
    {
        $user = currentUser(false);

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

        return view('profiles.show', compact('orderStats', 'user'));
    }

    public function update(UpdateProfileRequest $request)
    {
        currentUser()->update($request->except('password'));
        currentUser()->processImage($request->file('image'));
        currentUser()->changePassword($request->get('password'));

        snackbar()->success(trans('profiles.profile_updated'));

        return redirect()->route('profiles.show', ['current' => $request->get('current')]);
    }

    public function downloadAccountData()
    {
        $this->dispatch(new ExportUserData(currentUser(false)));

        snackbar()->success(trans('profiles.preparing_your_data'));

        return $this->ajaxOrRedirect(back()->getTargetUrl());
    }
}
