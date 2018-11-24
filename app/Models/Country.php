<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    public function billingDetails()
    {
        return $this->hasMany(BillingDetail::class);
    }

    public function shippingDetails()
    {
        return $this->hasMany(ShippingDetail::class);
    }

    public function addresses()
    {
        return $this->hasMany(Address::class);
    }
}
