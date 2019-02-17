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
        $this->tasks->push($task);
    }

    public function dispatch()
    {
        $this->tasks->each(function ($task) {
            dispatch($task);
        });
    }

    public function schedule(Schedule $schedule)
    {
        $this->tasks->each(function ($task) use ($schedule) {
            $schedule->job($task)->everyMinute();
        });
    }
}
