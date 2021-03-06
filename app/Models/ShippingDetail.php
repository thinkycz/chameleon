<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShippingDetail extends Model
{
    protected $fillable = [
        'company_name',
        'first_name',
        'last_name',
        'city',
        'street',
        'zipcode',
        'phone',
    ];

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function getTitleAttribute()
    {
        return "{$this->street}, {$this->zipcode} {$this->city}";
    }
}
