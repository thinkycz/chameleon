<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Status extends Model
{
    use HasTranslations;

    public $translatable = [
        'name',
        'description',
    ];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
