<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class PropertyType extends Model
{
    use HasTranslations;

    public $translatable = ['name'];

    public function properties()
    {
        return $this->hasMany(Property::class);
    }
}
