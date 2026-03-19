<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ZoneRequest extends FormRequest
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
            'branch_id' => 'nullable|exists:branches,id',
            'leader_id' => 'nullable|exists:users,id',
            'assistant_leader_id' => 'nullable|exists:users,id|different:leader_id',
            'is_active' => 'boolean',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => __('app.validation.required'),
            'assistant_leader_id.different' => 'L\'assistant doit être différent du leader.',
        ];
    }
}
