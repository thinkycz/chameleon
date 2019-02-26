<?php

namespace App\Models;

use App\Enums\CurrencyConversionMethod;
use Illuminate\Database\Eloquent\Model;

class Price extends Model
{
    protected $fillable = [
        'price_level_id',
        'price',
        'old_price'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function priceLevel()
    {
        return $this->belongsTo(PriceLevel::class);
    }

    public function convertToCurrency(Currency $currency)
    {
        return static::make(array_merge($this->attributes, [
            'old_price' => $this->convertPriceValue($this->old_price, $currency),
            'price' => $this->convertPriceValue($this->price, $currency),
            'currency_id' => $currency->id,
        ]));
    }

    private function convertPriceValue($price, Currency $currency)
    {
        switch (settingsRepository()->getCurrencyConversionMethod()) {
            case CurrencyConversionMethod::DIVIDE_BY_EXCHANGE_RATE:
                $result = $price / $currency->exchange_rate;
                break;
            case CurrencyConversionMethod::MULTIPLY_BY_EXCHANGE_RATE:
                $result = $price * $currency->exchange_rate;
                break;
            default:
                $result = $price;
        }

        return $result;
    }
}
