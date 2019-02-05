<?php

namespace App\Models;

use App\Traits\ReusableScopes\ScopeWhereLike;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Unit extends Model
{
    use HasTranslations;
    use ScopeWhereLike;

    public $translatable = [
        'name',
        'abbr',
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
