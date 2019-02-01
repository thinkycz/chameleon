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

    public function getCompanyName()
    {
        return $this->get('store_settings', 'name');
    }

    public function getCompanyAddress()
    {
        return $this->get('company_details', 'street') . ' ' . $this->get('company_details', 'city');
    }

    public function getLogo()
    {
        return $this->get('store_settings', 'logo') ?: asset('images/chameleon.png');
    }

    public function getCustomLink1()
    {
        return $this->configuration('custom_footer_link_1');
    }

    public function getCustomLink2()
    {
        return $this->configuration('custom_footer_link_2');
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
