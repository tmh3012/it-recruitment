<?php

namespace App\Http\Requests;

use App\Models\Config;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateConfigRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
//        return auth()->check();
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
            'key' => [
                'required',
                'string',
                'filled',
                'alpha_dash',
            ],
            'value' => [
                'required',
                'filled',
                'string'
            ],
            'value2' => [
                'nullable',
                'string'
            ],
            'description' => [
                'nullable',
                'string'
            ],
        ];
    }
}
