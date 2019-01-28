<?php

namespace App\Models;

use Spatie\MediaLibrary\Models\Media as BaseMedia;

class Media extends BaseMedia
{
    protected $appends = [
        'url',
        'thumb',
        'optimized',
    ];

    public function getUrlAttribute(): string
    {
        return $this->getUrl();
    }

    public function getThumbAttribute(): string
    {
        return $this->getUrl('thumb');
    }

    public function getOptimizedAttribute(): string
    {
        return $this->getUrl('optimized');
    }
}
