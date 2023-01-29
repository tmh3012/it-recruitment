<?php

namespace App\Http\Requests\company;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'filled',
                'string',
            ],
            'city' => [
                'required',
                'string',
            ],
            'district' => [
                'nullable',
                'string',
            ],
            'address' => [
                'nullable',
                'string',
            ],
            'address2' => [
                'nullable',
                'string',
            ],
            'phone' => [
                'nullable',
                'string',
            ],
            'number_of_employees' => [
                'nullable',
                'string',
            ],
            'link' => [
                'nullable',
                'string',
                'max:255'
            ],
            'over_view' => [
                'required',
                'string',
            ],
            'mission' => [
                'nullable',
                'string',
            ],
            'introduction' => [
                'nullable',
                'string',
            ],
            'email' => [
                'nullable',
                'email:rfc,dns',
            ],
            'logo' => [
                'nullable',
                'file',
                'image',
                'max:5000',
            ],
            'cover' => [
                'nullable',
                'file',
                'image',
                'max:8000',
            ],

        ];
    }
}
