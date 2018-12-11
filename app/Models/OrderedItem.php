<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderedItem extends Model
{
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
}
