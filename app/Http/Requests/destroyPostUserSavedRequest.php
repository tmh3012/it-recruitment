<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class destroyPostUserSavedRequest extends FormRequest
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
                'exists:posts,id',
            ],
            'user_id' => [
                'nullable',
                'exists:users,id',
            ],
        ];
    }
}
