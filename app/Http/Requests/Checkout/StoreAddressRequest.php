<?php

namespace App\Http\Requests\Checkout;

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
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'company_id' => 'required',
            'first_name' => 'required',
            'last_name'  => 'required',
            'street'     => 'required',
            'city'       => 'required',
            'zipcode'    => 'required',
            'phone'      => 'required',
            'country_id' => 'required|exists:countries,id',
        ];
    }

    public function mergeDefaultAddress()
    {
        $this->merge([
            'is_default' => !$this->user()->addresses()->count(),
        ]);

        return $this;
    }
}
