<?php

namespace App\Nova\Filters;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Laravel\Nova\Filters\Filter;

class ProductHasImages extends Filter
{
    /**
     * Get the displayable name of the filter.
     *
     * @return string
     */
    public function name()
    {
        return __('filters.has_images');
    }

    /**
     * The filter's component.
     *
     * @var string
     */
    public $component = 'select-filter';

    /**
     * Apply the filter to the given query.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @param  mixed $value
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function apply(Request $request, $query, $value)
    {
        return $query
            ->when($value == 'has_images', function (Builder $query) {
                return $query->whereHas('media', function (Builder $query) {
                    return $query->where('media.collection_name', 'images');
                });
            })
            ->when($value == 'hasnt_images', function (Builder $query) {
                return $query->whereDoesntHave('media', function (Builder $query) {
                    return $query->where('media.collection_name', 'images');
                });
            });
    }

    /**
     * Get the filter's available options.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function options(Request $request)
    {
        return [
            __('filters.has_images')   => 'has_images',
            __('filters.hasnt_images') => 'hasnt_images'
        ];
    }
}
