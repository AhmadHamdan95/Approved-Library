<?php

namespace App\Http\Requests\Admin\Users;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateUserRequest extends FormRequest
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
            'username' => [
                'required',
                'max:255',
                Rule::unique('users', 'username'),
            ],
            'password' => [
                'required',
                'between:3,64',
                'confirmed'
            ],
            'password_confirmation' => [
                'required',
                'between:3,64'
            ],
            'email' => [
                'required',
                'max:64',
                Rule::unique('users', 'email')
            ],
            'status' => [
                'required',
                Rule::in(0,1)
            ]
        ];
    }

    public function all($keys = null): array
    {
        return parent::all();
    }
}
