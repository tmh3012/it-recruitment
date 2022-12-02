<?php

namespace App\Http\Requests\company;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            'distinct' => [
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

        ];
    }
}
