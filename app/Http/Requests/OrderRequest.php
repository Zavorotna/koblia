<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
                'max:100'
            ],
            'userPhone' => [
                'required',
                'string',
                'regex: #^(\+\d{1,4})?(\(?\d{1,3}\)?)\s?\-?\s?(\d[\s-]?){6}\d$#'
            ],
            'comment' => [
                'string',
                'max:255'
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Ім\'я обов\'язкове',
            'name.max' => 'Максимально символів 10',
            'userPhone.required' => 'Телефон обов\'язковий',
            'userPhone.regex' => 'Введіть правильний формат номеру',
            'comment.max' => 'Максимально символів 255',
        ];
    }
}
