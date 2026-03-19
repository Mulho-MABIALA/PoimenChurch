<?php

namespace App\Http\Requests;

use App\Models\FinancialTransaction;
use Illuminate\Foundation\Http\FormRequest;

class FinancialTransactionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $rules = [
            'category' => 'required|in:income,expense',
            'branch_id' => 'nullable|exists:branches,id',
            'zone_id' => 'nullable|exists:zones,id',
            'amount' => 'required|numeric|min:0.01',
            'currency' => 'nullable|string|size:3',
            'payment_method' => 'required|in:cash,mobile_money,bank_transfer,check,other',
            'payment_reference' => 'nullable|string|max:255',
            'transaction_date' => 'required|date|before_or_equal:today',
            'description' => 'nullable|string|max:500',
        ];

        // Rules for income
        if ($this->input('category') === 'income') {
            $rules['user_id'] = 'nullable|exists:users,id';
            $rules['transaction_type'] = 'required|in:tithe,offering,special_offering';
        }

        // Rules for expense
        if ($this->input('category') === 'expense') {
            $expenseCategories = implode(',', array_keys(FinancialTransaction::EXPENSE_CATEGORIES));
            $rules['expense_category'] = 'required|in:' . $expenseCategories;
            $rules['funding_source'] = 'required|in:treasury,external';
            $rules['vendor'] = 'nullable|string|max:255';
            $rules['invoice_number'] = 'nullable|string|max:100';
        }

        return $rules;
    }

    public function messages(): array
    {
        return [
            'category.required' => 'La catégorie est obligatoire.',
            'transaction_type.required' => 'Le type de transaction est obligatoire.',
            'expense_category.required' => 'La catégorie de dépense est obligatoire.',
            'funding_source.required' => 'La source de financement est obligatoire.',
            'amount.required' => 'Le montant est obligatoire.',
            'amount.min' => 'Le montant doit être supérieur à 0.',
            'payment_method.required' => 'Le mode de paiement est obligatoire.',
            'transaction_date.required' => 'La date est obligatoire.',
            'transaction_date.before_or_equal' => 'La date ne peut pas être dans le futur.',
        ];
    }
}
