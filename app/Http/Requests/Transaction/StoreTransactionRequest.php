<?php

namespace App\Http\Requests\Transaction;

use Illuminate\Foundation\Http\FormRequest;

class StoreTransactionRequest extends FormRequest
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
            'property_id' => ['required', 'exists:properties,id'],
            'price' => [
                'required',
                'numeric',
                function ($attribute, $value, $fail) {
                    $property = \App\Models\Property::find($this->property_id);
                    if ($property && $value <= $property->price) {
                        $fail('The :attribute must be greater than the property price.');
                    }
                },
            ],
            'commissions' => 'required|array',
        ];
    }
}
