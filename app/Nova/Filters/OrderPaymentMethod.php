<?php

namespace App\Nova\Filters;

use App\Models\PaymentMethod;
use Illuminate\Http\Request;
use Laravel\Nova\Filters\Filter;

class OrderPaymentMethod extends Filter
{
    public $name = 'Payment Method';

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
        return $query->where('payment_method_id', $value);
    }

    /**
     * Get the filter's available options.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function options(Request $request)
    {
        return PaymentMethod::all()->pluck('id', 'name')->toArray();
    }
}
