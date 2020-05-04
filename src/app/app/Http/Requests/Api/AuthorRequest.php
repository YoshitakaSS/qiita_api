<?php

namespace App\Http\Api\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AuthorRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'string|required',
            'count' => 'integer',
            'sort' => 'string'
        ];
    }

    /**
     * Return request error message
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => 'Author name is required',
            'count.nurmeric' => 'Enter a number for count'
        ];
    }
}
