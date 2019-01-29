<?php

namespace App\Repositories;

use App\Helpers\Tools\ChartData;
use Carbon\Carbon;
use DB;
use Illuminate\Database\Query\Builder;

class StatsRepository
{
    /**
     * @var Carbon
     */
    protected $from;

    /**
     * @var Carbon
     */
    protected $to;

    /**
     * @var Builder
     */
    protected $query;

    /**
     * @var ChartData
     */
    protected $chartData;

    /**
     * @var string
     */
    protected $type;

    public function __construct()
    {
        $this->from = Carbon::now()->subDay(5);
        $this->to = Carbon::now();
    }

    public function from($from)
    {
        $this->from = is_null($from) ? Carbon::now()->subDay(5) : $from;

        return $this;
    }

    public function to($to)
    {
        $this->to = is_null($to) ? Carbon::now() : $to;

        return $this;
    }

    public function getInterval()
    {
        return collect([
            'from' => $this->from->copy(),
            'to'   => $this->to->copy(),
        ]);
    }

    public function getQuery()
    {
        return $this->query;
    }

    public function getResult()
    {
        return optional($this->query)->get();
    }

    public function addWhere($column, $operator = null, $value = null, $boolean = 'and')
    {
        $this->query = $this->query->where($column, $operator, $value, $boolean);

        return $this;
    }

    public function daily($table, $aggregate = 'COUNT(id)', $interval = 'DATE(created_at)')
    {
        $this->query = DB::table($table)
            ->selectRaw("{$aggregate} as value, {$interval} as point")
            ->whereBetween('created_at', [$this->from->toDateTimeString(), $this->to->toDateTimeString()])
            ->groupBy('point');

        return $this;
    }

    public function weekly($table, $aggregate = 'COUNT(id)', $interval = 'WEEK(created_at)')
    {
        $this->query = DB::table($table)
            ->selectRaw("{$aggregate} as value, {$interval} as point")
            ->whereBetween('created_at', [$this->from->toDateTimeString(), $this->to->toDateTimeString()])
            ->groupBy('point');

        return $this;
    }

    public function monthly($table, $aggregate = 'COUNT(id)', $interval = 'MONTH(created_at)')
    {
        $this->query = DB::table($table)
            ->selectRaw("{$aggregate} as value, {$interval} as point")
            ->whereBetween('created_at', [$this->from->toDateTimeString(), $this->to->toDateTimeString()])
            ->groupBy('point');

        return $this;
    }

    public function yearly($table, $aggregate = 'COUNT(id)', $interval = 'YEAR(created_at)')
    {
        $this->query = DB::table($table)
            ->selectRaw("{$aggregate} as value, {$interval} as point")
            ->whereBetween('created_at', [$this->from->toDateTimeString(), $this->to->toDateTimeString()])
            ->groupBy('point');

        return $this;
    }
}
