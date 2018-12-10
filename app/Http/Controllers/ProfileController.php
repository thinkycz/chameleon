<?php

namespace App\Http\Controllers;

use App\Http\Requests\Profile\UpdateProfileRequest;
use App\Models\User;

class ProfileController extends Controller
{
    public function show(User $user)
    {
        $user->load('addresses', 'priceLevel');

        return view('profiles.show', compact('user'));
    }

    public function update(UpdateProfileRequest $request, User $user)
    {
        $user->update($request->except('password'));
        $user->processImage($request->file('image'));
        $user->changePassword($request->get('password'));

        // snackbar()->success(trans('profiles.profile_updated'));

        return redirect()->route('profiles.show', ['user' => $user, 'current' => $request->get('current')]);
    }
}
