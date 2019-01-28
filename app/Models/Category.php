<?php

namespace App\Models;

use App\Traits\ModelHasMedia;
use App\Traits\ModelHasSlug;
use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\Translatable\HasTranslations;

class Category extends Model implements HasMedia
{
    use HasTranslations;
    use NodeTrait;
    use ModelHasSlug;

    use ModelHasMedia;

    public $fillable = [
        'name',
    ];

    public $translatable = [
        'name',
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }
}
