<?php

namespace App\Http\Requests\Admin\Authors;

use Illuminate\Foundation\Http\FormRequest;

class EditAuthorRequest extends FormRequest
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
            'address' => [
                'nullable',
                'max:255'
            ],
            'image' => [
                'nullable',
                'image',
            ],
            'publishers' => [
                'nullable',
                'array'
            ],
            'publishers.*' => [
                'numeric'
            ],
        ];
    }
}
