<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;
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

    protected $appends = [
        'thumb',
        'purchasable',
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

    public function getPrice()
    {
        // TODO:: implement for current user's price level
        return $this->prices()->first();
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
        // TODO:: implement
        return true;
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
