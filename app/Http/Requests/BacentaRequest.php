<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BacentaRequest extends FormRequest
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
            'address' => 'nullable|string|max:500',
            'zone_id' => 'required|exists:zones,id',
            'shepherd_id' => 'nullable|exists:users,id',
            'assistant_shepherd_id' => 'nullable|exists:users,id|different:shepherd_id',
            'meeting_day' => 'required|in:monday,tuesday,wednesday,thursday,friday,saturday,sunday',
            'meeting_time' => 'nullable|date_format:H:i',
            'is_active' => 'boolean',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => __('app.validation.required'),
            'zone_id.required' => __('app.validation.required'),
            'meeting_day.required' => __('app.validation.required'),
            'assistant_shepherd_id.different' => 'L\'assistant doit être différent du berger.',
        ];
    }
}
