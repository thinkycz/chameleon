<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Preference extends Model
{
    public $timestamps = false;

    public function preferable()
    {
        return $this->morphTo();
    }

    public function getValueAttribute()
    {
        return $this->preferable->name;
    }

    public function getNameAttribute()
    {
        return __("preferences.{$this->code}");
    }

    public function getDescriptionAttribute()
    {
        return __("preferences.{$this->code}.description");
    }
}
