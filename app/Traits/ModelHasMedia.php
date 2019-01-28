<?php

namespace App\Traits;

use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;

trait ModelHasMedia
{
    use HasMediaTrait;

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

    public function getImagesAttribute()
    {
        return $this->getMedia('images');
    }

    public function getThumbAttribute()
    {
        return $this->images->isNotEmpty() ? $this->getFirstMediaUrl('images', 'thumb') : placeholderImage();
    }
}
