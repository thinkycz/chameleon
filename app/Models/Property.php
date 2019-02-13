<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    protected $with = [
        'propertyType',
        'propertyValue',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function propertyType()
    {
        return $this->belongsTo(PropertyType::class);
    }

    public function propertyValue()
    {
        return $this->belongsTo(PropertyValue::class);
    }
}
