<?php

namespace App\Nova\Metrics;

use App\Models\Category;
use Illuminate\Http\Request;
use Laravel\Nova\Metrics\Partition;

class ProductsPerCategory extends Partition
{
    /**
     * Calculate the value of the metric.
     *
     * @param  \Illuminate\Http\Request $request
     * @return mixed
     */
    public function calculate(Request $request)
    {
        $result = Category::withCount('products')
            ->get()
            ->mapWithKeys(function (Category $category) {
                return [$category->name => $category->products_count];
            })
            ->toArray();

        return $this->result($result);
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
        return 'products-per-category';
    }
}
