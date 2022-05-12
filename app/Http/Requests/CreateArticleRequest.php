<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateArticleRequest extends FormRequest
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
            'title' => [
                'required',
                'string',
                'max:100',
                Rule::unique('articles', 'title'),
            ],
            'detail' => 'required',
            'image' => [
                'required',
                'image',
                'max:1024',
                'mimes:jpg,jpeg,png'
            ],
            'category_id' => [
                'required',
                Rule::exists('categories', 'id'),
            ],
            'status' => [
                'sometimes',
                'string',
            ],
            'created_by' => [
                'required',
                Rule::exists('users', 'id'),
            ]
        ];
    }

    public function attributes(){
        return [
            'title' => __('articles.title'),
            'detail' => __('articles.detail'),
            'image' => __('articles.photo'),
            'category_id' => __('articles.category'),
            'status' => __('articles.status'),
            'created_by' => __('articles.created_by'),
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'created_by' => auth()->user()->id,
        ]);
    }
}
