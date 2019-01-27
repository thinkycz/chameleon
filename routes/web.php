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
Route::resource('pages', 'PageController')->only('show');
Route::resource('products', 'ProductController')->only('show');
Route::resource('categories', 'CategoryController')->only('index', 'show');
