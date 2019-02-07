<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PriceLevel extends Model
{
    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function prices()
    {
        return $this->hasMany(Price::class);
    }

    public function getImportCodeAttribute()
    {
        return str_slug($this->name, '_');
    }
}
