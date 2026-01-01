<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'category_id' => ['required', 'exists:categories,id'],
            'title' => ['required', 'string'],
            'description' => ['nullable', 'string'],
            'price' => ['nullable', 'numeric'],
            'saleprice' => ['nullable', 'numeric'],
            'discount' => ['nullable', 'integer'],
            'main_image' => ['nullable', 'image'],
            'gallery' => ['nullable', 'array'],
            'gallery.*' => ['image'],
            'attributes' => 'nullable|array',
            'attributes.*' => 'nullable|exists:attribute_values,id', 
        ];
    }
}
