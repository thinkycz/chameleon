<?php

namespace App\Services;

class EligibilityResult
{
    /**
     * @var bool
     */
    protected $success;

    /**
     * @var string
     */
    protected $message;

    public function __construct(bool $success, string $message = '')
    {
        $this->success = $success;
        $this->message = $message;
    }

    public function successful()
    {
        return $this->success;
    }

    public function failed()
    {
        return !$this->success;
    }

    public function message()
    {
        return $this->message;
    }
}
