<?php

Route::resource('basket', 'BasketController')->only('index');

Route::post('/checkout/addresses/store', 'CheckoutController@storeAddress')->name('checkout.addresses.store');
Route::resource('checkout', 'CheckoutController')->only('index');

Route::post('products/{product}/basket', 'ProductController@basket')->name('products.basket');
Route::post('products/{basketItem}/update-quantity', 'ProductController@updateQuantity')->name('products.update_quantity');
Route::delete('products/{basketItem}/remove-from-basket', 'ProductController@removeFromBasket')->name('products.remove_from_basket');
