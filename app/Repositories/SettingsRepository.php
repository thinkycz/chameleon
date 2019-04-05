<?php

namespace App\Repositories;

use App\Enums\CurrencyConversionMethod;
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
        return $this->get('company_details', 'name');
    }

    public function getCompanyAbout()
    {
        return $this->get('company_details', 'about');
    }

    public function getCompanyGoogleMap()
    {
        return $this->get('company_details', 'google_map');
    }

    public function getCompanyId()
    {
        return $this->get('company_details', 'id');
    }

    public function getCompanyVatId()
    {
        return $this->get('company_details', 'vatid');
    }

    public function getCompanyAddress()
    {
        return $this->get('company_details', 'street') . ' ' . $this->get('company_details', 'city');
    }

    public function getLogo()
    {
        return $this->get('store_settings', 'logo') ?: asset('images/chameleon.png');
    }

    public function getFaviconImage()
    {
        return $this->get('store_settings', 'favicon') ?: asset('favicon.ico');
    }

    public function getCurrencyConversionMethod()
    {
        return $this->get('exchange_rate_multiply') ? CurrencyConversionMethod::MULTIPLY_BY_EXCHANGE_RATE : CurrencyConversionMethod::DIVIDE_BY_EXCHANGE_RATE;
    }

    public function getCustomLink1()
    {
        return $this->configuration('custom_footer_link_1');
    }

    public function getCustomLink2()
    {
        return $this->configuration('custom_footer_link_2');
    }

    public function get($code, $key = 'value')
    {
        return $this->getOrFetch(__CLASS__, "{$code}.{$key}", function () use ($key, $code) {
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
