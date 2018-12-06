<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class DeliveryMethod extends Model
{
    use HasTranslations;

    public $translatable = ['name'];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
