<?php

namespace App\Http\Requests\Admin\Categories;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
        $id = request('id');
        $rules = [
            'name' => [
                'required',
                'max:255'
            ],
            'description' => [
                'nullable',
                'max:255'
            ],
            'image' => [
                'required',
                'image',
            ],
        ];
        if(!is_null($id)) {
            $rules['image'] = [
                'nullable',
                'image',
            ];
        }
        return $rules;
    }

    public function all($keys = null): array
    {
        return parent::all();
    }
}
