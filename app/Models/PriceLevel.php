<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class PriceLevel extends Model
{
    use HasTranslations;

    public $translatable = [
        'name',
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function prices()
    {
        return $this->hasMany(Price::class);
    }
}
