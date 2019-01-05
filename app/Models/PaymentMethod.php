<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;
use Spatie\Translatable\HasTranslations;

class PaymentMethod extends Model implements HasMedia
{
    use HasTranslations;
    use HasMediaTrait;

    public $translatable = ['name'];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function registerMediaConversions(Media $media = null)
    {
        $this->addMediaConversion('thumb')
            ->width(150)
            ->height(150)
            ->optimize()
            ->keepOriginalImageFormat()
            ->nonQueued();
    }

    public function getLogoAttribute()
    {
        return $this->getMedia('logo')->isNotEmpty() ? $this->getFirstMediaUrl('logo', 'thumb') : placeholderImage();
    }
}
