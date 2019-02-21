<?php

namespace App\Models;

use Spatie\MediaLibrary\Models\Media as BaseMedia;

class Media extends BaseMedia
{
    protected $appends = [
        'url',
        'thumbnail',
        'optimized',
    ];

    public function getUrlAttribute(): string
    {
        return $this->getUrl();
    }

    public function getThumbnailAttribute(): string
    {
        return $this->getUrl('thumbnail');
    }

    public function getOptimizedAttribute(): string
    {
        return $this->getUrl('optimized');
    }
}
