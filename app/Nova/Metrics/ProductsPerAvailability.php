<?php

namespace App\Nova\Metrics;

use App\Models\Availability;
use Illuminate\Http\Request;
use Laravel\Nova\Metrics\Partition;

class ProductsPerAvailability extends Partition
{
    /**
     * Calculate the value of the metric.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return mixed
     */
    public function calculate(Request $request)
    {
        $result = Availability::withCount('products')
            ->get()
            ->mapWithKeys(function (Availability $availability) {
                return [$availability->name => $availability->products_count];
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
        // return now()->addMinutes(5);
    }

    /**
     * Get the URI key for the metric.
     *
     * @return string
     */
    public function uriKey()
    {
        return 'products-per-availability';
    }
}
