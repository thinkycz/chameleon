<?php

Route::post('products/{product}/add-to-basket', 'ProductController@addToBasket')->name('products.add_to_basket');
Route::post('products/{basketItem}/update-quantity', 'ProductController@updateQuantity')->name('products.update_quantity');
Route::delete('products/{basketItem}/remove-from-basket', 'ProductController@removeFromBasket')->name('products.remove_from_basket');
