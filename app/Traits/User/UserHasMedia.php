<?php

namespace App\Traits\User;

use Illuminate\Http\UploadedFile;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;

trait UserHasMedia
{
    use HasMediaTrait;

    public function registerMediaConversions(Media $media = null)
    {
        $this->addMediaConversion('thumb')
            ->width(300)
            ->height(300)
            ->optimize()
            ->keepOriginalImageFormat()->nonQueued();

        $this->addMediaConversion('optimized')
            ->width(800)
            ->height(800)
            ->optimize()
            ->keepOriginalImageFormat()->nonQueued();
    }

    public function processImage(UploadedFile $image = null)
    {
        if ($image) {
            $this->clearMediaCollection('images');
            $this->addMedia($image)->toMediaCollection('images');
        }
    }

    public function getThumbAttribute()
    {
        $images = $this->getMedia('images');

        return $images->isNotEmpty() ? $this->getFirstMediaUrl('images', 'thumb') : placeholderImage();
    }
}
