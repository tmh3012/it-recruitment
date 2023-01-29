<?php

namespace App\Http\Requests;

use App\Models\Blog;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreBlogRequest extends FormRequest
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
                'filled',
                'max:255',
            ],
            'description' => [
                'required',
                'string',
            ],
            'content' => [
                'required',
                'string',
            ],
            'image' => [
                'nullable',
                'file',
                'image',
                'max:3000',
            ],
            'alt_images' => [
                'nullable',
                'string',
                'max:255',
            ],
            'slug' => [
                'required',
                'string',
                'max:255',
                Rule::unique(Blog::class),
            ],
        ];
    }
}
