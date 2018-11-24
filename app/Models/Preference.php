<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Preference extends Model
{
    public function preferable()
    {
        return $this->morphTo();
    }

    public function getValueAttribute()
    {
        return $this->preferable->name;
    }
}
