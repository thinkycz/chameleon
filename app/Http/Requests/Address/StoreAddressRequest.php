<?php

namespace App\Http\Requests\Address;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class StoreAddressRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return User::getAuthenticatedUser()->is($this->user);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'first_name' => 'required',
            'last_name'  => 'required',
            'street'     => 'required',
            'city'       => 'required',
            'zipcode'    => 'required',
            'phone'      => 'required',
            'country_id' => 'required|exists:countries,id',
        ];
    }
}
