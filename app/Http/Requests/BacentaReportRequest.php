<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BacentaReportRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'bacenta_id' => 'required|exists:bacentas,id',
            'report_date' => 'required|date|before_or_equal:today',
            'report_type' => 'required|in:bacenta_meeting,sunday_service',
            'attendance_count' => 'required|integer|min:0',
            'offering_amount' => 'required|numeric|min:0',
            'notes' => 'nullable|string|max:1000',
        ];
    }

    public function messages(): array
    {
        return [
            'bacenta_id.required' => __('app.validation.required'),
            'report_date.required' => __('app.validation.required'),
            'report_date.before_or_equal' => 'La date ne peut pas être dans le futur.',
            'report_type.required' => __('app.validation.required'),
            'attendance_count.required' => __('app.validation.required'),
            'attendance_count.min' => 'Le nombre de présents doit être positif.',
            'offering_amount.required' => __('app.validation.required'),
            'offering_amount.min' => 'Le montant doit être positif.',
        ];
    }
}
