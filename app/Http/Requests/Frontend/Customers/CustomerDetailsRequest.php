<?php

namespace App\Http\Requests\Frontend\Customers;

use Illuminate\Foundation\Http\FormRequest;

class CustomerDetailsRequest extends FormRequest
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
            'first_name' => 'required|string|between:3,64',
            'last_name' => 'required|string|between:3,64',
            'email' => 'required|email|between:3,64',
            'phone' => 'nullable|string|between:7,20',
            'address' => 'nullable|string',
            'city' => 'nullable|string',
            'country_id' => 'required|numeric',
            'postcode' => 'nullable|string',
            // 'image' => 'required|image',
        ];
    }
}
