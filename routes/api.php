<?php

use App\Http\Controllers\Api\NulisecController;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['middleware' => 'auth:api', 'prefix' => 'nulisec'], function () {
    Route::get('preferences', [NulisecController::class, 'preferences'])->name('api_nulisec_preferences');
    Route::get('products', [NulisecController::class, 'products'])->name('api_nulisec_products');
    Route::get('categories', [NulisecController::class, 'categories'])->name('api_nulisec_categories');
    Route::get('price-levels', [NulisecController::class, 'priceLevels'])->name('api_nulisec_price_levels');
});
