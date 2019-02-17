<?php

namespace App\Providers;

use App\Repositories\ScheduledTasksRepository;
use Illuminate\Support\ServiceProvider;

class TaskSchedulerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(ScheduledTasksRepository::class, function () {
            return new ScheduledTasksRepository();
        });
    }
}
