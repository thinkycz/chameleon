<?php

namespace App\Traits\Order;

use App\Models\User;
use Illuminate\Http\Request;

trait OrderHasProcessors
{
    public function processBillingDetail(Request $request)
    {
        $addressId = $request->get('billing_detail_id');
        $address = User::getAuthenticatedUser()->addresses()->find($addressId);

        $billingDetail = $this->billingDetail()->updateOrCreate([], $address->toArray());

        $this->billingDetail()->associate($billingDetail);
    }

    public function processShippingDetail(Request $request)
    {
        $addressId = stringToBoolean($request->get('shipping_detail'))
        ? $request->get('billing_detail_id')
        : $request->get('shipping_detail_id');
        $address = User::getAuthenticatedUser()->addresses()->find($addressId);

        $billingDetail = $this->billingDetail()->updateOrCreate([], $address->toArray());

        $this->billingDetail()->associate($billingDetail);
    }
}
