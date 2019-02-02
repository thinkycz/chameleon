<?php

namespace App\Nova\Filters;

use App\Models\DeliveryMethod;
use Illuminate\Http\Request;
use Laravel\Nova\Filters\Filter;

class OrderDeliveryMethod extends Filter
{
    public $name = 'Delivery Method';

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
        return $query->where('delivery_method_id', $value);
    }

    /**
     * Get the filter's available options.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function options(Request $request)
    {
        return DeliveryMethod::all()->pluck('id', 'name')->toArray();
    }
}
