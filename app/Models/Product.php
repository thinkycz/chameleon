<?php

namespace App\Models;

use App\Traits\ModelHasDateFormatted;
use App\Traits\ModelIsTableColumnsAware;
use App\Traits\Product\ProductHasAttributes;
use App\Traits\Product\ProductHasEligibilities;
use App\Traits\Product\ProductHasRecommendations;
use App\Traits\Product\ScopeOnlyAvailable;
use App\Traits\Product\ScopeOnlyWithPrice;
use App\Traits\Product\ScopeProcessFilters;
use App\Traits\Product\ScopeProcessSorting;
use App\Traits\ReusableScopes\ScopeWhereLike;
use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;
use Laravel\Scout\Searchable;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Spatie\Tags\HasTags;

class Product extends Model implements HasMedia
{
    use HasTags;
    use HasSlug;
    use NodeTrait;
    use HasMediaTrait;
    use Searchable;

    use ModelIsTableColumnsAware;
    use ModelHasDateFormatted;
    use ScopeProcessSorting;
    use ScopeProcessFilters;
    use ScopeWhereLike;
    use ScopeOnlyAvailable;
    use ScopeOnlyWithPrice;
    use ProductHasAttributes;
    use ProductHasEligibilities;
    use ProductHasRecommendations;

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

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }

    public function registerMediaConversions(Media $media = null)
    {
        $this->addMediaConversion('thumb')
            ->width(300)
            ->height(300)
            ->optimize()
            ->keepOriginalImageFormat()
            ->nonQueued();

        $this->addMediaConversion('optimized')
            ->width(800)
            ->height(800)
            ->optimize()
            ->keepOriginalImageFormat()
            ->nonQueued();
    }

    public function toSearchableArray()
    {
        return [
            $this->getKeyName() => $this->getKey(),
            'name'              => $this->name,
            'description'       => $this->description,
            'details'           => $this->details,
            'catalogue_number'  => (string) $this->catalogue_number,
            'barcode'           => (string) $this->barcode,
        ];
    }

    public function searchableFields()
    {
        return ['name^3', 'barcode^2', 'catalogue_number^2', 'description', 'details'];
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function getPrice(?PriceLevel $priceLevel = null)
    {
        $priceLevel = $priceLevel ?? currentUser()->getPriceLevel();

        return $this->prices->where('price_level_id', $priceLevel->id)->first();
    }

    public function hasCategory()
    {
        return $this->categories->isNotEmpty();
    }

    public function getFirstCategory()
    {
        return $this->categories->first();
    }

    public function getPriceAttribute()
    {
        return optional($this->getPrice())->price;
    }

    public function getFormattedPriceAttribute()
    {
        return showPriceWithCurrency($this->price, currentCurrency());
    }

    public function getPriceExclVatAttribute()
    {
        return getPriceExclVat($this->price, $this->vatrate, currentCurrency());
    }

    public function getFormattedPriceExclVatAttribute()
    {
        return showPriceWithCurrency($this->price_excl_vat, currentCurrency());
    }

    public function getPurchasableAttribute()
    {
        return auth()->check() && $this->hasPrice() && $this->productIsAvailable() && $this->productIsInStock();
    }

    public function getShowPathAttribute()
    {
        return route('products.show', $this);
    }

    public function getImagesAttribute()
    {
        return $this->getMedia('images');
    }

    public function getThumbAttribute()
    {
        return $this->images->isNotEmpty() ? $this->getFirstMediaUrl('images', 'thumb') : placeholderImage();
    }

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
