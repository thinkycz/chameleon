<?php

namespace App\Nova\Metrics;

use App\Models\Category;
use Illuminate\Http\Request;
use Laravel\Nova\Metrics\Value;

class NumberOfCategories extends Value
{
    /**
     * Get the displayable name of the metric.
     *
     * @return string
     */
    public function name()
    {
        return __('metrics.number_of_categories');
    }

    /**
     * Calculate the value of the metric.
     *
     * @param  \Illuminate\Http\Request $request
     * @return mixed
     */
    public function calculate(Request $request)
    {
        return $this->count($request, Category::class);
    }

    /**
     * Get the ranges available for the metric.
     *
     * @return array
     */
    public function ranges()
    {
        return [
            30    => __('metrics.30_days'),
            60    => __('metrics.60_days'),
            365   => __('metrics.365_days'),
            'MTD' => __('metrics.month_to_date'),
            'QTD' => __('metrics.quarter_to_date'),
            'YTD' => __('metrics.year_to_date'),
        ];
    }

    /**
     * Determine for how many minutes the metric should be cached.
     *
     * @return  \DateTimeInterface|\DateInterval|float|int
     */
    public function cacheFor()
    {
        // return now()->addMinutes(5);
    }

    /**
     * Get the URI key for the metric.
     *
     * @return string
     */
    public function uriKey()
    {
        return 'number-of-categories';
    }
}
