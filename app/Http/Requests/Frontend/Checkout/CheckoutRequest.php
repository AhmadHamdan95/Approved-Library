<?php

namespace App\Http\Requests\Frontend\Checkout;

use Illuminate\Foundation\Http\FormRequest;

class CheckoutRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'first_name'=> [
                'required',
                'string',
                'min:3',
            ],
            'last_name'=> [
                'required',
                'string',
                'min:3',
            ],
            'email'=> [
                'required',
                'email',
                'min:3',
            ],
            'phone'=> [
                'required',
                'string',
                'min:7',
            ],
            'address'=> [
                'required',
                'string',
            ],
            'city'=> [
                'required',
                'string',
            ],
            'postcode'=> [
                'required',
                'string',
            ],
            'country_id' => [
                'required',
                'numeric',
            ],
        ];
    }
}
