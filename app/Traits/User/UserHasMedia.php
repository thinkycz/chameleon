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
        $this->addMediaConversion('thumbnail')
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

    public function getThumbnailAttribute()
    {
        $images = $this->getMedia('images');

        return $images->isNotEmpty() ? $this->getFirstMediaUrl('images', 'thumbnail') : placeholderImage();
    }
}
