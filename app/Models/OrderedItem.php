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

    public function getVatrateAttribute()
    {
        return $this->product ? $this->product->vatrate : config('config.default_vat_rate_percentage');
    }

    public function getPriceExclVatAttribute()
    {
        return getPriceExclVat($this->price, $this->vatrate, currentCurrency());
    }

    public function getFormattedPriceExclVatAttribute()
    {
        return showPriceWithCurrency($this->price_excl_vat, currentCurrency());
    }

    public function getTotalPriceExclVatAttribute()
    {
        return $this->quantity * $this->price_excl_vat;
    }

    public function getFormattedTotalPriceExclVatAttribute()
    {
        return showPriceWithCurrency($this->total_price_excl_vat, currentCurrency());
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
