<?php

namespace App\Traits;

use Carbon\Carbon;

trait ModelHasDateFormatted
{
    public function getFormattedCreatedAtAttribute()
    {
        return Carbon::parse($this->created_at)->format(config('config.date_format'));
    }

    public function getFormattedUpdatedAtAttribute()
    {
        return Carbon::parse($this->created_at)->format(config('config.date_format'));
    }
}
