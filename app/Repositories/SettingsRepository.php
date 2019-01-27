<?php

namespace App\Repositories;

use App\Models\Setting;

class SettingsRepository
{
    public function get($code, $key)
    {
        return Setting::fetch($code, $key);
    }

    public function configuration($code)
    {
        return Setting::loadConfiguration($code);
    }
}
