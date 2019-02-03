<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

Auth::routes(['verify' => true]);

Route::get('/', 'HomeController@index')->name('home');
Route::get('/logout', 'Auth\LoginController@logout')->name('logout');

Route::get('search', 'SearchController@index')->name('search');
Route::get('about-us', 'AboutController@index')->name('about');

Route::get('contact', 'ContactController@index')->name('contact.index');
Route::post('contact/contact', 'ContactController@contact')->name('contact.contact');

Route::get('profile', 'ProfileController@show')->name('profiles.show');
Route::patch('profile/update', 'ProfileController@update')->name('profiles.update');
Route::post('profile/download-account-data', 'ProfileController@downloadAccountData')->name('profiles.download_account_data');

Route::post('addresses/{address}/make-default', 'AddressController@makeDefault');
Route::resource('addresses', 'AddressController', ['as' => 'profiles'])->only('store', 'update', 'destroy');

Route::resource('pages', 'PageController')->only('show');
Route::resource('products', 'ProductController')->only('show');
Route::resource('categories', 'CategoryController')->only('index', 'show');
