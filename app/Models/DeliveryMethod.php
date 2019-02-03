<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class DeliveryMethod extends Model
{
    use HasTranslations;

    public $translatable = ['name'];

    public $appends = ['formatted_price', 'available_payment_methods'];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function paymentMethods()
    {
        return $this->hasMany(PaymentMethod::class);
    }

    public function getFormattedPriceAttribute()
    {
        return intval($this->price) ? showPriceWithCurrency($this->price, currentCurrency()) : trans('global.free');
    }

    public function getAvailablePaymentMethodsAttribute()
    {
        return $this->paymentMethods->where('enabled', true);
    }
}
