<?php

namespace App\Http\Requests;

use App\Enums\TimelineTypeEnum;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class StoreTimeLineRequest extends FormRequest
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
            'title' => [
                'required',
                'string',
                'max:255',
            ],
            'description' => [
                'required',
            ],
            'type' => [
                'required',
                'numeric',
                Rule::in(TimelineTypeEnum::getValues())
            ],
            'start_date' => [
                'required',
                'date',
                'before:end_date',
            ],
            'end_date' => [
                'required',
                'date',
                'after:start_date',
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
