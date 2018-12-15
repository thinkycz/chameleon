<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Preference extends Model
{
    use HasTranslations;

    public $translatable = ['name', 'description'];

    public $timestamps = false;

    public function preferable()
    {
        return $this->morphTo();
    }

    public function getValueAttribute()
    {
        return $this->preferable->name;
    }
}
