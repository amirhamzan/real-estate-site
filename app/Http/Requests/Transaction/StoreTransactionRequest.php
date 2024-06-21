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
            'commissions' => [
                'required',
                'array',
                function ($attribute, $value, $fail) {
                    $totalCommission = array_sum($value);
                    if ($totalCommission > 100) {
                        $fail('The total commission percentage cannot exceed 100%.');
                    }
                    foreach ($value as $commission) {
                        if ($commission > 100) {
                            $fail('Each commission percentage cannot exceed 100%.');
                        }
                        if ($commission < 0.01) {
                            $fail('Each commission percentage must be at least 0.01%.');
                        }
                    }
                },
            ],
            'commissions.*' => 'numeric|min:0.01|max:100',
        ];
    }

    public function messages()
    {
        return [
            'property_id.required' => 'The property field is required.',
            'property_id.exists' => 'The selected property is invalid.',
            'price.required' => 'The price field is required.',
            'commissions.required' => 'The commissions field is required.',
            'commissions.array' => 'The commissions field must be an array.',
            'commissions.*.numeric' => 'Each commission must be a number.',
            'commissions.*.min' => 'Each commission must be at least 0.01%.',
            'commissions.*.max' => 'Each commission must not exceed 100%.',
        ];
    }
}
