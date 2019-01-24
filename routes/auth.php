<?php

Route::post('basket/empty-basket', 'BasketController@emptyBasket')->name('basket.empty_basket');
Route::post('basket/update-quantities', 'BasketController@updateQuantities')->name('basket.quantities.update');
Route::get('basket', 'BasketController@show')->name('basket.show');
Route::resource('confirmation', 'ConfirmationController')->only('index');

Route::post('checkout/addresses/store', 'CheckoutController@storeAddress')->name('checkout.addresses.store');
Route::post('checkout/confirm', 'CheckoutController@confirm')->name('checkout.confirm');
Route::get('checkout', 'CheckoutController@show')->name('checkout.show');

Route::post('products/{product}/basket', 'ProductController@basket')->name('products.basket');

Route::post('ordered-items/{orderedItem}/update', 'OrderedItemController@update');
Route::delete('ordered-items/{orderedItem}/remove', 'OrderedItemController@remove');
