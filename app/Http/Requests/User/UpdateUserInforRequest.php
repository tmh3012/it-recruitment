<?php

namespace App\Http\Requests\User;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateUserInforRequest extends FormRequest
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
            'name'=>[
                'required',
                'string',
                'max:255',
            ],
            'phone'=>[
                'required',
                'max:12',
            ],
            'city'=>[
                'required',
                'string',
                'max:255',
            ],
            'link'=>[
                'required',
                'string',
                'max:255',
            ],
            'position'=>[
                'required',
                'string',
                'max:255',
            ],
            'bio'=>[
                'required',
                'string',
            ],
        ];
    }
    public function failedValidation(Validator $validator)
    {
        $errors = $validator->errors();

        $response = response()->json([
            'success' => false,
            'message' => $errors->messages(),
        ], 422);

        throw new HttpResponseException($response);
    }
}
