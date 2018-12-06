<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Availability extends Model
{
    use HasTranslations;

    public $translatable = ['name', 'description'];

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
