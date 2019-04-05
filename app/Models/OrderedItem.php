<?php

namespace App\Models;

use App\Traits\OrderedItem\OrderedItemHasPrices;
use Illuminate\Database\Eloquent\Model;

class OrderedItem extends Model
{
    use OrderedItemHasPrices;

    protected $with = [
        'product',
    ];

    protected $appends = [
        'formatted_total_price',
        'formatted_total_price_excl_vat',
        'formatted_price_excl_vat',
        'formatted_price',
    ];

    protected $fillable = [
        'name',
        'description',
        'details',
        'price',
        'vatrate',
        'quantity_ordered',
        'barcode',
        'catalogue_number',
        'options',
        'type',
        'product_id',
    ];

    protected $casts = [
        'options' => 'array',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function checkEligibility($quantity)
    {
        return optional($this->product)->checkEligibility($quantity, $this->options);
    }

    public function getTypeInStringAttribute()
    {
        return trans('orders.ordered_item.' . $this->type);
    }
}
