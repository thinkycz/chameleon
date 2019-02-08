<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Price extends Model
{
    protected $fillable = [
        'price_level_id',
        'price',
        'old_price'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function priceLevel()
    {
        return $this->belongsTo(PriceLevel::class);
    }
}
