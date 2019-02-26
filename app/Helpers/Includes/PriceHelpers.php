<?php

use App\Models\Currency;
use Illuminate\Support\Facades\Request;

/**
 * @return float
 */
if (!function_exists('getPriceExclVat')) {
    function getPriceExclVat($priceWithVat, $vatrate, Currency $currency)
    {
        return $priceWithVat - getVatFromPrice($priceWithVat, $vatrate, $currency);
    }
}

/**
 * @return float
 */
if (!function_exists('getVatFromPrice')) {
    function getVatFromPrice($priceWithVat, $vatrate, Currency $currency)
    {
        $coefficient = $vatrate / ($vatrate + 100);

        if ($currency->isocode == 'CZK') {
            $coefficient = round($coefficient, 4);
        }

        return $priceWithVat * $coefficient;
    }
}

if (!function_exists('showPriceWithCurrency')) {
    function showPriceWithCurrency($price, Currency $currency = null, $noPrice = null)
    {
        $noPrice = !is_null($noPrice) ? $noPrice : trans('global.no_price');

        if (!$price) {
            return $noPrice;
        }

        $currency = $currency ?: preferenceRepository()->getDefaultCurrency();

        $formattedPrice = str_replace(',00', '', number_format($price, 2, ',', ' '));

        return formatPrice($currency, $formattedPrice);

    }
}

/*
 * @return string
 */
if (!function_exists('isActive')) {
    function isActive($route, $text = 'active', $wildcard = true, ...$parameters)
    {
        $r = preg_replace('/^\//', '', route($route, $parameters, false));

        $r .= $wildcard ? '*' : '';

        return isActiveString($r, $text);
    }
}

/*
 * @return string
 */
if (!function_exists('isActiveString')) {
    function isActiveString($string, $text = 'active')
    {
        $r = preg_replace('/^\//', '', $string);

        return Request::is($r) ? $text : '';
    }
}

/**
 * @return string
 */
if (!function_exists('formatPrice')) {
    function formatPrice(Currency $currency = null, $price)
    {
        if ($currency->symbol) {
            $result = $currency->symbol_is_before ? "{$currency->symbol} {$price}" : "{$price} {$currency->symbol}";
        } else {
            $result = "{$price} {$currency->isocode}";
        }

        return $result;
    }
}
