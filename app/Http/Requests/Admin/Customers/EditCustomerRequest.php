<?php

namespace App\Http\Requests\Admin\Customers;

use Illuminate\Foundation\Http\FormRequest;

class EditCustomerRequest extends FormRequest
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
            'name' => [
                'required',
                'string',
                'min:3',
                'max:100'
            ],
            'email' => [
                'required',
                'email',
                'max:100'
            ],
            'address' => [
                'nullable',
                'string',
                'min:3',
                'max:191'
            ],
            'image' => [
                'nullable',
                'image'
            ],
        ];
    }
}
