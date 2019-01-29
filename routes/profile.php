<?php

Route::get('/', 'ProfileController@show')->name('profiles.show');
Route::patch('update', 'ProfileController@update')->name('profiles.update');

// Addresses
Route::post('addresses/{address}/make-default', 'AddressController@makeDefault');
Route::resource('addresses', 'AddressController', ['as' => 'profiles'])->only('store', 'update', 'destroy');
