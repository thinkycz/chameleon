<?php

namespace App\Repositories;

use App\Models\Setting;
use App\Services\InstanceCache;

class SettingsRepository extends InstanceCache
{
    public function getCompanyPhoneNumber()
    {
        return $this->get('company_details', 'phone');
    }

    public function getCompanyEmail()
    {
        return $this->get('company_details', 'email');
    }

    public function getLogo()
    {
        return $this->get('store_settings', 'logo');
    }

    public function get($code, $key)
    {
        return $this->getOrFetch(__CLASS__, $key, function () use ($key, $code) {
            $configuration = $this->configuration($code);

            return $configuration[$key] ?? null;
        });
    }

    public function configuration($code)
    {
        return $this->getOrFetch(__CLASS__, $code, function () use ($code) {
            return Setting::loadConfiguration($code);
        });
    }
}