<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderedItem extends Model
{
    protected $with = [
        'product',
    ];

    protected $appends = [
        'formatted_total_price',
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

    public function getTotalPriceAttribute()
    {
        return $this->quantity_ordered * $this->price;
    }

    public function getFormattedTotalPriceAttribute()
    {
        return showPriceWithCurrency($this->total_price, currentCurrency());
    }

    public function getFormattedPriceAttribute()
    {
        return showPriceWithCurrency($this->price, currentCurrency());
    }
}
