<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DepartmentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'leader_id' => 'nullable|exists:users,id',
            'supervisor_id' => 'nullable|exists:users,id|different:leader_id',
            'is_active' => 'boolean',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => __('app.validation.required'),
            'supervisor_id.different' => 'Le superviseur doit être différent du responsable.',
        ];
    }
}
