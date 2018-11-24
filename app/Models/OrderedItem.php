<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderedItem extends Model
{
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
