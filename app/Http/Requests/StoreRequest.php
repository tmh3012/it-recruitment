<?php

namespace App\Http\Requests;

use App\Enums\PostCurrencySalaryEnum;
use App\Models\Post;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreRequest extends FormRequest
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
    public function rules(): array
    {
        $rules = [
            'company' => [
                'required',
                'string',
            ],
            'language' => [
                'required',
                'array',
                'filled',
            ],
            'province' => [
                'required',
                'filled',
                'string',
            ],
            'district' => [
                'nullable',
                'string',
            ],
            'currency_salary' => [
                'required',
                'numeric',
                Rule::in(PostCurrencySalaryEnum::getValues()),
            ],
            'number_applicants' => [
                'nullable',
                'numeric',
                'min:1',
            ],
            'start_date' => [
                'nullable',
                'date',
                'before:end_date',
            ],
            'end_date' => [
                'nullable',
                'date',
                'after:start_date',
            ],
            'job_title' => [
                'required',
                'sting',
                'filled',
                'min:3',
                'max:255',
                'after:start_date',
            ],
            'slug' => [
                'required',
                'sting',
                'filled',
                'min:3',
                'max:255',
                Rule::unique(Post::class),
            ],
        ];

        $rules['min_salary'] = [
            'required',
            'numeric',
        ];

        $rules['max_salary'] = [
            'required',
            'numeric',
        ];
        if (!empty($this->max_salary)) {
            $rules['min_salary'][] = 'lt:max_salary';
        }
        if (!empty($this->min_salary)) {
            $rules['max_salary'][] = 'gt:min_salary';
        }
        return $rules;

    }
}
