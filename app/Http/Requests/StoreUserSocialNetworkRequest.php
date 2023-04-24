<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreUserSocialNetworkRequest extends FormRequest
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
            'key'=> 'required|string|max:30',
            'value'=> [
                'required',
                'string',
                'max:255',
                function ($field, $value){
                    $data = [$field => $value];
                    $emailValidator = \Illuminate\Support\Facades\Validator::make($data, [$field => 'email']);
                    $urlValidator = \Illuminate\Support\Facades\Validator::make($data, [$field => 'url']);
                    if ($emailValidator->passes() || $urlValidator->passes()) {
                        return true;
                    }

                    $this->validator->getMessageBag()->add($field, $field . ' must be a valid email address or a valid url');
                    return false;
                }
            ]
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
