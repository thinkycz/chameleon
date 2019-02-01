<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class PaymentMethod extends Model
{
    use HasTranslations;

    public $translatable = [
        'name',
    ];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function deliveryMethod()
    {
        return $this->belongsTo(DeliveryMethod::class);
    }

    public function getFormattedPriceAttribute()
    {
        return intval($this->price) ? showPriceWithCurrency($this->price, currentCurrency()) : trans('global.free');
    }
}
