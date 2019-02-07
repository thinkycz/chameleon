<?php

use App\Http\Controllers\Ajax\AresController;
use App\Http\Controllers\Ajax\ProductImageController;
use App\Http\Controllers\Ajax\SearchController;

Route::get('search', [SearchController::class, 'search']);
Route::get('ares', [AresController::class, 'get'])->name('ares.get');

Route::post('products/images/upload/{product}', [ProductImageController::class, 'upload']);
Route::delete('products/images/destroy/{product}/{image}', [ProductImageController::class, 'destroy']);
