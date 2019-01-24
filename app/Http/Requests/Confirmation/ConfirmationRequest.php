<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ConfirmationRequest extends FormRequest
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
        $rules = [
            'billing_address_id' => 'required',
            'delivery_method_id' => 'required',
            'payment_method_id'  => 'required',
            'email'              => 'required|email',
            'phone'              => 'required',
        ];

        $shippingSame = stringToBoolean($this->get('shipping_same'));

        if (!$shippingSame) {
            $rules = array_merge($rules, [
                'shipping_address_id' => 'required',
            ]);
        }

        return $rules;
    }
}
