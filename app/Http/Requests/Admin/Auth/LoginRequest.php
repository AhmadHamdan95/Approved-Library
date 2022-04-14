<?php

namespace App\Http\Requests\Admin\Auth;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
            'email' => 'required|email|min:3',
            'password' => 'required|string|between:3,64',
            // 'remember_token' => 'nullable',
        ];
    }

    public function all($keys = null)
    {
        $data = parent::all();
        $data['status'] = 1;
        return $data;
    }

    public function attributes()
    {
        return [
            'username' => trans('username'),
            'password' => trans('password'),
        ];
    }
}
