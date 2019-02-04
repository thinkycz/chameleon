<?php

namespace App\Models;

use App\Traits\ModelHasDateFormatted;
use App\Traits\ModelHasMedia;
use App\Traits\ModelHasSlug;
use App\Traits\ModelIsTableColumnsAware;
use App\Traits\Product\ProductCanBeSearched;
use App\Traits\Product\ProductHasAttributes;
use App\Traits\Product\ProductHasEligibilities;
use App\Traits\Product\ProductHasPrices;
use App\Traits\Product\ProductHasRecommendations;
use App\Traits\Product\ScopeOnlyAvailable;
use App\Traits\Product\ScopeOnlyWithPrice;
use App\Traits\Product\ScopeProcessFilters;
use App\Traits\Product\ScopeProcessSorting;
use App\Traits\ReusableScopes\ScopeWhereLike;
use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;
use Laravel\Nova\Actions\Actionable;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\Tags\HasTags;

class Product extends Model implements HasMedia
{
    use HasTags;
    use NodeTrait;
    use Actionable;

    use ModelHasSlug;
    use ModelIsTableColumnsAware;
    use ModelHasDateFormatted;
    use ModelHasMedia;

    use ScopeProcessSorting;
    use ScopeProcessFilters;
    use ScopeWhereLike;
    use ScopeOnlyAvailable;
    use ScopeOnlyWithPrice;

    use ProductHasAttributes;
    use ProductHasEligibilities;
    use ProductHasRecommendations;
    use ProductHasPrices;
    use ProductCanBeSearched;

    protected $appends = [
        'thumb',
        'purchasable',
        'show_path',
        'formatted_price',
    ];

    protected $fillable = [
        'name',
        'description',
        'details',
        'catalogue_number',
        'barcode',
        'quantity_in_stock',
        'minimum_order_quantity',
    ];

    protected $with = [
        'prices',
        'media',
    ];

    public function availability()
    {
        return $this->belongsTo(Availability::class);
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function orderedItems()
    {
        return $this->hasMany(OrderedItem::class);
    }

    public function prices()
    {
        return $this->hasMany(Price::class);
    }

    public function properties()
    {
        return $this->hasMany(Property::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
