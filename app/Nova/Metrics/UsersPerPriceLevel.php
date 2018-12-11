<?php

namespace App\Nova\Metrics;

use App\Models\PriceLevel;
use Illuminate\Http\Request;
use Laravel\Nova\Metrics\Partition;

class UsersPerPriceLevel extends Partition
{
    /**
     * Calculate the value of the metric.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return mixed
     */
    public function calculate(Request $request)
    {
        $result = PriceLevel::withCount('users')
            ->get()
            ->mapWithKeys(function (PriceLevel $priceLevel) {
                return [$priceLevel->name => $priceLevel->users_count];
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
        return 'users-per-price-level';
    }
}
