<?php

namespace App\Http\Requests;

use App\Models\AttributeValue;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class AttributeValueRequest extends FormRequest
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
        $attributeValueId = $this->route('id') ?? null;
        return [
            'attribute_id' => 'required|exists:attributes,id',
            'value' => [
                'required',
                'string',
                'max:255',
                Rule::unique(AttributeValue::class)->ignore($attributeValueId)
            ],
        ];
    }
}
