<?php

Route::resource('basket', 'BasketController')->only('index');

Route::post('/checkout/addresses/store', 'CheckoutController@storeAddress')->name('checkout.addresses.store');
Route::resource('checkout', 'CheckoutController')->only('index');

Route::post('products/{product}/basket', 'ProductController@basket')->name('products.basket');

Route::post('ordered-items/{orderedItem}/update', 'OrderedItemController@update');
Route::delete('ordered-items/{orderedItem}/remove', 'OrderedItemController@remove');
