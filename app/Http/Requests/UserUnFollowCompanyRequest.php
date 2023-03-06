<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserUnFollowCompanyRequest extends FormRequest
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
            'company_id' => [
                'required',
                'numeric',
                'exists:companies,id',
            ],
            'user_id' => [
                'nullable',
                'exists:users,id',
            ],
        ];
    }
}
