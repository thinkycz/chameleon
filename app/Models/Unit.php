<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Unit extends Model
{
    use HasTranslations;

    public $translatable = [
        'name',
        'abbr',
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
