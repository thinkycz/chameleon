<?php

namespace App\Nova\Metrics;

use App\Models\Order;
use Illuminate\Http\Request;
use Laravel\Nova\Metrics\Trend;

class OrdersPerDay extends Trend
{
    /**
     * Get the displayable name of the metric.
     *
     * @return string
     */
    public function name()
    {
        return __('metrics.orders_per_day');
    }

    /**
     * Calculate the value of the metric.
     *
     * @param  \Illuminate\Http\Request $request
     * @return mixed
     */
    public function calculate(Request $request)
    {
        return $this->countByDays($request, Order::class)->showLatestValue();
    }

    /**
     * Get the ranges available for the metric.
     *
     * @return array
     */
    public function ranges()
    {
        return [
            30 => __('metrics.30_days'),
            60 => __('metrics.60_days'),
            90 => __('metrics.90_days'),
        ];
    }

    /**
     * Determine for how many minutes the metric should be cached.
     *
     * @return  \DateTimeInterface|\DateInterval|float|int
     */
    public function cacheFor()
    {
        return now()->addMinutes(5);
    }

    /**
     * Get the URI key for the metric.
     *
     * @return string
     */
    public function uriKey()
    {
        return 'orders-per-day';
    }
}
