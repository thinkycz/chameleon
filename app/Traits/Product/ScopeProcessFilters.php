<?php

namespace App\Traits\Product;

use App\Models\Category;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

trait ScopeProcessFilters
{
    public function scopeProcessCategoryClient(Builder $query, Category $category)
    {
        $query->whereHas('categories', function ($query) use ($category) {
            return $query->whereIn('categories.id', $category->descendants()->pluck('id')->merge($category->id));
        });

        return $query;
    }

    public function scopeProcessTagsClient(Builder $query, Request $request)
    {
        $query->when($request->get('tag'), function ($query, $tag) {
            return $query->whereHas('tags', function ($query) use ($tag) {
                return $query->where('id', $tag);
            });
        });

        return $query;
    }

    public function scopeProcessPropertiesClient(Builder $query, Request $request)
    {
        $query->when($request->get('properties'), function ($query, $properties) {
            return $query->whereHas('properties', function ($query) use ($properties) {
                return $query->whereIn('id', explode('_', $properties));
            });
        });

        return $query;
    }

    public function scopeProcessPriceRangeClient(Builder $query, Request $request)
    {
        $query->when($request->get('price_max'), function ($query, $max) {
            return $query->whereHas('prices', function ($query) use ($max) {
                return $query->where('price', '<=', $max);
            });
        });

        $query->when($request->get('price_min'), function ($query, $min) {
            return $query->whereHas('prices', function ($query) use ($min) {
                return $query->where('price', '>=', $min);
            });
        });

        return $query;
    }
}
