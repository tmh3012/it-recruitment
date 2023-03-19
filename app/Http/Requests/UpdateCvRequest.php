<?php

namespace App\Http\Requests;

use App\Http\Controllers\ResponseTrait;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateCvRequest extends FormRequest
{
    use ResponseTrait;
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
            'cv'=>[
                'required',
                'file',
                'mimes:jpeg,jpg,pdf,doc,docx',
                'max:5024',
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
