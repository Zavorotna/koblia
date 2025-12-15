<?php

namespace App\Http\Requests;

use App\Models\Attribute;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class AttributeRequest extends FormRequest
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
        $attributeId = $this->route('id') ?? null;
        return [
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique(Attribute::class)->ignore($attributeId),
            ],
            'type' => 'required|in:text,select,multiselect',
            'is_filterable' => 'boolean',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Назва обовязкова',
            'name.max' => 'Назва не повинна перевищувати 255 символів',
            'name.unique' => 'Назва повинна бути унікальною і не має повторюватися',
        ];
    }
}
