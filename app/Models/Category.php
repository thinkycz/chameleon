<?php

namespace App\Models;

use App\Enums\Locale;
use App\Traits\ModelHasMedia;
use App\Traits\ModelHasSlug;
use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;
use Laravel\Nova\Actions\Actionable;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\Translatable\HasTranslations;

class Category extends Model implements HasMedia
{
    use Actionable;
    use HasTranslations;
    use NodeTrait;
    use ModelHasSlug;

    use ModelHasMedia;

    public $fillable = [
        'name',
        'enabled',
    ];

    public $translatable = [
        'name',
    ];

    public $attributes = [
        'position' => 0,
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }

    public static function findBySlugOrId($value)
    {
        if (!$value) {
            return null;
        }

        return static::where('slug', $value)
            ->orWhere('id', $value)
            ->first();
    }

    public static function firstOrCreateByName($name)
    {
        $locale = Locale::fallback();
        if ($category = static::where("name->{$locale}", $name)->first()) {
            return $category;
        }

        return static::create(compact('name'));
    }

    public static function getShowcaseCategories()
    {
        return static::with('products')
            ->whereEnabled(true)
            ->whereNull('parent_id')
            ->get();
    }
}
