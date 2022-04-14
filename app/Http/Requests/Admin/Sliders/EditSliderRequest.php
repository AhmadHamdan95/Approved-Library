<?php

namespace App\Http\Requests\Admin\Sliders;

use Illuminate\Foundation\Http\FormRequest;

class EditSliderRequest extends FormRequest
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
            'title' => [
                'required',
                'string',
                'min:3',
                'max:191'
            ],
            'description' => [
                'required',
                'string',
                'min:3',
                'max:191'
            ],
            'url' => [
                'required',
                'string',
                'min:3',
                'max:191'
            ],
            'status' => [
                'required',
                'boolean',
            ],
            'image' => [
                'nullable',
                'image',
            ],
        ];
    }
}
