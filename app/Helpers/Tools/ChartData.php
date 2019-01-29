<?php

namespace App\Helpers\Tools;

use Carbon\Carbon;
use Illuminate\Support\Collection;

class ChartData
{
    public static function make($stats, $interval, $type = 'daily')
    {

        return (new static())->{$type}($stats, $interval);
    }

    /**
     * @param Collection $stats
     * @param Collection $interval
     * @return Collection
     */
    public function daily(Collection $stats, Collection $interval)
    {
        $result = Collection::make();

        /** @var Carbon $day */
        for ($day = $interval->get('from'); $day <= $interval->get('to'); $day->addDay()) {
            $stat = $stats->where('point', $day->toDateString())->first();

            $result->push([
                'point' => $day->format(config('config.chart_date_format')),
                'value' => $stat ? $stat->value : 0,
            ]);
        }

        return $result;
    }

    /**
     * @param Collection $stats
     * @param Collection $interval
     * @return Collection
     */
    public function weekly(Collection $stats, Collection $interval)
    {
        $result = Collection::make();

        /** @var Carbon $day */
        for ($day = $interval->get('from'); $day <= $interval->get('to'); $day->addWeek()) {
            $stat = $stats->where('point', $day->weekOfYear)->first();

            $result->push([
                'point' => "Week {$day->weekOfYear} / {$day->year}",
                'value' => $stat ? $stat->value : 0,
            ]);
        }

        return $result;
    }

    /**
     * @param Collection $stats
     * @param Collection $interval
     * @return Collection
     */
    public function monthly(Collection $stats, Collection $interval)
    {
        $result = Collection::make();

        /** @var Carbon $day */
        for ($day = $interval->get('from'); $day <= $interval->get('to'); $day->addMonth()) {
            $stat = $stats->where('point', $day->month)->first();

            $result->push([
                'point' => "Month {$day->month} / {$day->year}",
                'value' => $stat ? $stat->value : 0,
            ]);
        }

        return $result;
    }

    /**
     * @param Collection $stats
     * @param Collection $interval
     * @return Collection
     */
    public function yearly(Collection $stats, Collection $interval)
    {
        $result = Collection::make();

        /** @var Carbon $day */
        for ($day = $interval->get('from'); $day <= $interval->get('to'); $day->addYear()) {
            $stat = $stats->where('point', $day->year)->first();

            $result->push([
                'point' => "Year {$day->year}",
                'value' => $stat ? $stat->value : 0,
            ]);
        }

        return $result;
    }
}
