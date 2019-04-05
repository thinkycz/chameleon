<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $appends = [
        'title',
    ];

    protected $fillable = [
        'first_name',
        'last_name',
        'city',
        'street',
        'zipcode',
        'country_id',
        'phone',
        'company_id',
        'vat_id',
        'is_default',
        'company_name',
    ];

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getTitleAttribute()
    {
        return "{$this->street}, {$this->zipcode} {$this->city}";
    }
}
