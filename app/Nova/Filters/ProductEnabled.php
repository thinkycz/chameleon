<?php

namespace App\Nova\Filters;

use Illuminate\Http\Request;
use Laravel\Nova\Filters\Filter;

class ProductEnabled extends Filter
{
    /**
     * Get the displayable name of the filter.
     *
     * @return string
     */
    public function name()
    {
        return __('filters.enabled');
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
            ->when(str_is('enabled', $value), function ($query) {
                return $query->whereEnabled(true);
            })
            ->when(str_is('disabled', $value), function ($query) {
                return $query->whereEnabled(false);
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
            __('filters.enabled')  => 'enabled',
            __('filters.disabled') => 'disabled'
        ];
    }
}
