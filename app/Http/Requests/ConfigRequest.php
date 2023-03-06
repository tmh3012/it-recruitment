<?php

namespace App\Http\Requests;

use App\Enums\AppConfigTypeEnum;
use App\Models\Config;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ConfigRequest extends FormRequest
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
    public function rules()
    {
        return [
            'key' => [
                'required',
                'string',
                'filled',
                'alpha_dash',
                Rule::unique(Config::class,)
            ],
            'value' => [
                'required',
                'filled',
                'string'
            ],
            'type' => [
                'required',
                'numeric',
                Rule::in(AppConfigTypeEnum::getvalues()),
            ],
            'description' => [
                'nullable',
                'string'
            ],
        ];
    }
}
