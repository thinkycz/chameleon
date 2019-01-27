<?php

namespace App\Traits\Product;

trait ProductHasRecommendations
{
    public function getRelatedRecommendations()
    {
        return static::query()
            ->whereHas('categories', function ($q) {
                return $q->whereIn('category_id', $this->categories->pluck('id'));
            })
            ->whereEnabled(true)
            ->inRandomOrder()
            ->take(8)
            ->get();
    }
}
