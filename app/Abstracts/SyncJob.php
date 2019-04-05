<?php

namespace App\Abstracts;

use App\Models\Store;
use App\Notifications\JobFailed;
use App\Services\SyncStatus;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Foundation\Bus\Dispatchable;

abstract class SyncJob
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var string
     */
    public static $jobName = '';

    /**
     * @var string
     */
    protected $statusCode = '';

    /**
     * Max 60 minutes
     *
     * @var int
     */
    public $timeout = 3600;

    /**
     * Max 1 try
     *
     * @var int
     */
    public $tries = 1;

    public function log()
    {
        SyncStatus::log($this->statusCode, $this->job->getJobId());
    }

    protected function prepare()
    {
        $this->log();
    }

    protected function logJobSucceeded()
    {

    }

    protected function logJobFailed()
    {

    }
}
