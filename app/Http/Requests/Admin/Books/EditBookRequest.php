<?php

namespace App\Http\Requests\Admin\Books;

use Illuminate\Foundation\Http\FormRequest;

class EditBookRequest extends FormRequest
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
                'max:255'
            ],
            'description' => [
                'nullable',
                'string'
            ],
            'price' => [
                'required',
                'numeric'
            ],
            'quantity' => [
                'required',
                'integer'
            ],
            'image' => [
                'nullable',
                'image'
            ],
            'status' => [
                'nullable',
            ],
            'publisher_id' => [
                'nullable',
                'numeric'
            ],
            'authors' => [
                'nullable',
                'array'
            ],
            'authors.*' => [
                'numeric'
            ],
            'categories' => [
                'nullable',
                'array'
            ],
            'categories.*' => [
                'numeric'
            ],
        ];
    }
}
