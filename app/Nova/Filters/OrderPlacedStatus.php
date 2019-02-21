<?php

namespace App\Nova\Filters;

use Illuminate\Http\Request;
use Laravel\Nova\Filters\Filter;

class OrderPlacedStatus extends Filter
{
    /**
     * Get the displayable name of the filter.
     *
     * @return string
     */
    public function name()
    {
        return __('filters.order_placed');
    }

    /**
     * The filter's component.
     *
     * @var string
     */
    public $component = 'select-filter';

    /**
     * Set the default options for the filter.
     */
    public function default()
    {
        return 'placed';
    }

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
            ->when(str_is('placed', $value), function ($query) {
                return $query->whereNotNull('placed_at');
            })
            ->when(str_is('incomplete', $value), function ($query) {
                return $query->whereNull('placed_at');
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
            'Only Placed Orders'  => 'placed',
            'Only Incomplete Orders' => 'incomplete',
        ];
    }
}
