<?php

namespace App\Http\Requests\Admin\Users;

use Illuminate\Foundation\Http\FormRequest;

class ChangePasswordRequest extends FormRequest
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
            'current_password' => 'required|between:3,64|current_password:admin',
            'password' => 'required|between:3,64|confirmed',
            'password_confirmation' => 'required|between:3,64'
        ];
    }

    public function attributes()
    {
        return [
            'password' => trans('password'),
            'password_confirmation' => trans('password_confirmation'),
        ];
    }
}
