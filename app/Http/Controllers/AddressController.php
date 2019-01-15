<?php

namespace App\Http\Controllers;

use App\Http\Requests\Address\StoreAddressRequest;
use App\Models\Address;
use App\Models\User;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAddressRequest $request, User $user)
    {
        $user->addresses()->create($request->all());

        snackbar()->success(trans('profiles.address_created'));

        return redirect()->back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User $user
     * @param  \App\Models\Address $address
     * @return \Illuminate\Http\Response
     */
    public function update(StoreAddressRequest $request, User $user, Address $address)
    {
        $address->update($request->all());

        snackbar()->success(trans('profiles.address_updated'));

        return redirect()->route('profiles.show', ['user' => $user, 'current' => 'address_book']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user, Address $address)
    {
        $address->delete();

        snackbar()->success(trans('profiles.address_deleted'));

        return $this->ajaxOrRedirect(route('profiles.show', ['user' => $user, 'current' => 'address_book']));
    }
}
