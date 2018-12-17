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

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

// TODO:: Auth
Route::get('/login', function () {
    return view('auth.login');
})->name('login');
Route::get('/logout', function () {
    return redirect()->back();
})->name('logout');
Route::get('/register', function () {
    return view('auth.register');
})->name('register');

Route::get('search', 'SearchController@index')->name('search');
Route::resource('products', 'ProductController')->only('show');

Route::get('/home', 'HomeController@index')->name('home');
