<?php

namespace App\Http\Controllers;

use App\Http\Requests\Address\StoreAddressRequest;
use App\Models\Address;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    public function store(StoreAddressRequest $request)
    {
        currentUser()->addresses()->create($request->mergeDefaultAddress()->all());

        snackbar()->success(trans('profiles.address_created'));

        return redirect()->back();
    }

    public function update(StoreAddressRequest $request, Address $address)
    {
        $address->update($request->all());

        snackbar()->success(trans('profiles.address_updated'));

        return redirect()->route('profiles.show', ['current' => 'address_book']);
    }

    public function destroy(Address $address)
    {
        $address->delete();

        snackbar()->success(trans('profiles.address_deleted'));

        return $this->ajaxOrRedirect(route('profiles.show', ['current' => 'address_book']));
    }

    public function makeDefault(Address $address)
    {
        currentUser()->setDefaultAddress($address);

        snackbar()->success(trans('profiles.address_updated'));

        return $this->ajaxOrRedirect(route('profiles.show', ['current' => 'address_book']));

    }
}
