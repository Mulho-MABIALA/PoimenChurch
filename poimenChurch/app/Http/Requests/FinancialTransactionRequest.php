<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FinancialTransactionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'user_id' => 'nullable|exists:users,id',
            'branch_id' => 'nullable|exists:branches,id',
            'zone_id' => 'nullable|exists:zones,id',
            'transaction_type' => 'required|in:tithe,offering,special_offering',
            'amount' => 'required|numeric|min:0',
            'currency' => 'nullable|string|size:3',
            'payment_method' => 'required|in:cash,mobile_money,bank_transfer,check,other',
            'payment_reference' => 'nullable|string|max:255',
            'transaction_date' => 'required|date|before_or_equal:today',
            'description' => 'nullable|string|max:500',
        ];
    }

    public function messages(): array
    {
        return [
            'transaction_type.required' => __('app.validation.required'),
            'amount.required' => __('app.validation.required'),
            'amount.min' => 'Le montant doit être positif.',
            'payment_method.required' => __('app.validation.required'),
            'transaction_date.required' => __('app.validation.required'),
            'transaction_date.before_or_equal' => 'La date ne peut pas être dans le futur.',
        ];
    }
}
