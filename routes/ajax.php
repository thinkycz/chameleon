<?php

use App\Http\Controllers\Ajax\ProductImageController;

Route::get('search', 'SearchController@search');
Route::get('ares', 'AresController@get')->name('ares.get');

Route::post('products/images/upload/{product}', [ProductImageController::class, 'upload']);
Route::delete('products/images/destroy/{product}/{image}', [ProductImageController::class, 'destroy']);
