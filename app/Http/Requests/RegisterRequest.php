<?php

namespace App\Http\Requests;

use App\Enums\UserRoleEnum;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RegisterRequest extends FormRequest
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
            ],
            'email' => [
                'required',
                'email:rfc,dns',
                Rule::unique(User::class)
            ],
            'role' => [
                'required',
                Rule::in(UserRoleEnum::getRolesForRegister())
            ],
            'password' => [
                'required',
                'min:8',
                'required_with:password_confirmation',
            ],
            'password_confirmation' => [
                'required',
                'min:8',
            ],
        ];
    }
}
