<?php

namespace App\Http\Requests\Admin\Authors;

use Illuminate\Foundation\Http\FormRequest;

class CreateAuthorRequest extends FormRequest
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
                'max:255'
            ],
            'email' => [
                'email',
                'required',
                'max:255',
            ],
            'password' => [
                'required',
                'between:3,64',
                // 'confirmed'
            ],
            // 'password_confirmation' => [
            //     'required',
            //     'between:3,64'
            // ],
            'address' => [
                'nullable',
                'max:255'
            ],
            'image' => [
                'required',
                'image',
            ],
            'publishers' => [
                'required',
                'array'
            ],
            'publishers.*' => [
                'numeric'
            ],
        ];
    }
}
