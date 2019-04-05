<?php

use Illuminate\Support\Facades\Route;
use Nulisec\JetsoftShopconnector\Http\Controllers\ShopconnectorController;

/*
|--------------------------------------------------------------------------
| Tool API Routes
|--------------------------------------------------------------------------
|
| Here is where you may register API routes for your tool. These routes
| are loaded by the ServiceProvider of your tool. They are protected
| by your tool's "Authorize" middleware by default. Now, go build!
|
*/

Route::get('settings', [ShopconnectorController::class, 'settings']);
Route::get('status', [ShopconnectorController::class, 'status']);

Route::post('save-configuration', [ShopconnectorController::class, 'saveConfiguration']);
Route::post('sync', [ShopconnectorController::class, 'sync']);
