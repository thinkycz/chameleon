<?php

namespace App\Traits\Order;

use App\Models\User;
use Illuminate\Http\Request;

trait OrderHasProcessors
{
    public function processBillingDetails(Request $request)
    {
        $addressId = $request->get('billing_address_id');
        $address = User::getAuthenticatedUser()->addresses()->find($addressId);

        $billingDetails = $this->billingDetails()->updateOrCreate([], $address->toArray());

        $this->billingDetails()->associate($billingDetails);
    }

    public function processShippingDetails(Request $request)
    {
        $addressId = stringToBoolean($request->get('shipping_details'))
        ? $request->get('billing_address_id')
        : $request->get('shipping_address_id');
        $address = User::getAuthenticatedUser()->addresses()->find($addressId);

        $billingDetails = $this->billingDetails()->updateOrCreate([], $address->toArray());

        $this->billingDetails()->associate($billingDetails);
    }
}
