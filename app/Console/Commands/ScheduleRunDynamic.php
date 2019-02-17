<?php

namespace App\Console\Commands;

use App\Repositories\ScheduledTasksRepository;
use Illuminate\Console\Command;

class ScheduleRunDynamic extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'schedule:run-dynamic';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run dynamically scheduled tasks';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        app(ScheduledTasksRepository::class)->dispatch();

        return true;
    }
}
