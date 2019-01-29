<?php

Route::get('search', 'SearchController@search');
Route::get('ares', 'AresController@get')->name('ares.get');
