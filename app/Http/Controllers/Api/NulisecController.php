<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\CategoryCollection;
use App\Http\Resources\PriceLevelCollection;
use App\Http\Resources\ProductCollection;
use App\Models\Category;
use App\Models\PriceLevel;
use App\Models\Product;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class NulisecController extends Controller
{
    public function preferences()
    {
        return JsonResponse::create([
            'default_country' => preferenceRepository()->getDefaultCountry(),
            'default_price_level' => preferenceRepository()->getDefaultPriceLevel(),
            'default_currency' => preferenceRepository()->getDefaultCurrency(),
        ]);
    }

    public function products()
    {
        return new ProductCollection(Product::with('prices')->paginate(1000));
    }

    public function priceLevels()
    {
        return new PriceLevelCollection(PriceLevel::paginate(1000));
    }

    public function categories()
    {
        return new CategoryCollection(Category::paginate(1000));
    }
}
