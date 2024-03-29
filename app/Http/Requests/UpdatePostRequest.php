<?php

namespace App\Http\Requests;

use App\Enums\PostCurrencySalaryEnum;
use App\Enums\PostStatusEnum;
use App\Models\Post;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdatePostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if (isAdmin() or isHr()) {
            return true;
        } else {
            return false;
        }
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
                'nullable',
                'string',
            ],
            'languages' => [
                'required',
                'array',
                'filled',
            ],
            'city' => [
                'required',
                'string',
                'filled',
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
            'remote' => [
                'nullable'
            ],
            'can_parttime' => [
                'nullable'
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
            'number_applicants' => [
                'nullable',
                'numeric',

            ],
            'job_description' => [
                'nullable',
                'string',
            ],
            'job_requirement' => [
                'nullable',
                'string',
            ],
            'job_benefit' => [
                'nullable',
                'string',
            ],
            'status' => [
                'nullable',
                'numeric',
                Rule::in(PostStatusEnum::getValues()),
            ],
            'job_title' => [
                'required',
                'string',
                'filled',
                'min:3',
                'max:255',
            ],
            'slug' => [
                'required',
                'string',
                'filled',
                'min:3',
                'max:255',
//                Rule::unique(Post::class)
            ],

        ];

        $rules['min_salary'] = [
            'nullable',
            'numeric',
        ];
        if (!empty($this->max_salary)) {
            $rules['min_salary'][]='lt:max_salary';
        }
        $rules['max_salary'] = [
            'nullable',
            'numeric',
        ];
        if (!empty($this->min_salary)) {
            $rules['max_salary'][]='gt:min_salary';
        }

        return $rules;
    }
}
