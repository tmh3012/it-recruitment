<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HandlerSubmitCvRequest extends FormRequest
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
            'post_id' => [
                'required',
                'numeric',
            ],
            'user_id' => [
                'nullable',
                'numeric',
            ],
            'name' => [
                'required',
                'string',
            ],
            'phone' => [
                'required',
                'numeric',
            ],
            'email' => [
                'required',
                'email',
            ],
            'cover_letter' => [
                'required',
                'string',
            ],
            'cv' => [
                'required',
                'file',
                'mimes:jpg,pdf',
                'max:5000',
            ],
        ];
    }
}
