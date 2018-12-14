<?php

namespace App\Repositories;

use App\Models\Availability;
use App\Models\Country;
use App\Models\Currency;
use App\Models\OrderStatus;
use App\Models\Preference;
use App\Models\StoreStatus;
use App\Models\Unit;
use App\Services\InstanceCache;

class PreferenceRepository extends InstanceCache
{
    /**
     * @return Country
     */
    public function getDefaultCountry()
    {
        return $this->getPreference('default_country');
    }

    /**
     * @return Currency
     */
    public function getDefaultCurrency()
    {
        return $this->getPreference('default_currency');
    }

    /**
     * @return Availability
     */
    public function getDefaultInStockAvailability()
    {
        return $this->getPreference('default_availability_in_stock');
    }

    /**
     * @return Availability
     */
    public function getDefaultOutOfStockAvailability()
    {
        return $this->getPreference('default_availability_out_of_stock');
    }

    /**
     * @return Unit
     */
    public function getDefaultQuantitativeUnit()
    {
        return $this->getPreference('default_quantitative_unit');
    }

    /**
     * @return StoreStatus
     */
    public function getCreatedStoreStatus()
    {
        return $this->getPreference('created_store_status');
    }

    /**
     * @return OrderStatus
     */
    public function getCreatedOrderStatus()
    {
        return $this->getPreference('created_order_status');
    }

    /**
     * @return OrderStatus
     */
    public function getConfirmedOrderStatus()
    {
        return $this->getPreference('confirmed_order_status');
    }

    /**
     * @return OrderStatus
     */
    public function getApprovedOrderStatus()
    {
        return $this->getPreference('approved_order_status');
    }

    /**
     * @return OrderStatus
     */
    public function getCancelledOrderStatus()
    {
        return $this->getPreference('cancelled_order_status');
    }

    /**
     * @return OrderStatus
     */
    public function getCompletedOrderStatus()
    {
        return $this->getPreference('completed_order_status');
    }

    /**
     * @param string $key
     * @return mixed
     */
    public function getPreference(string $key)
    {
        return $this->getOrFetch(__CLASS__, $key, function () use ($key) {
            $preference = Preference::whereCode($key)->first();
            return $preference->preferable()->first();
        });
    }
}
