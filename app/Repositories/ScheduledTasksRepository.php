<?php

namespace App\Repositories;

use Illuminate\Console\Scheduling\Schedule;

class ScheduledTasksRepository
{
    protected $tasks;

    public function __construct()
    {
        $this->tasks = collect();
    }

    public function register($task)
    {
        return $this->tasks->push($task);
    }

    public function registerWhen($condition, $task)
    {
        return $condition ? $this->tasks->push($task) : null;
    }

    public function dispatch()
    {
        return $this->tasks->each(function ($task) {
            dispatch($task);
        });
    }

    public function schedule(Schedule $schedule)
    {
        return $this->tasks->each(function ($task) use ($schedule) {
            $schedule->job($task)->daily();
        });
    }
}
