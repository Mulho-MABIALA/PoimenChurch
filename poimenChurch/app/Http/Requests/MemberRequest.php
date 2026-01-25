<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class MemberRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $userId = $this->route('member')?->id;

        $rules = [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users', 'email')->ignore($userId),
            ],
            'phone' => 'nullable|string|max:20',
            'photo' => 'nullable|image|max:2048',
            'date_of_birth' => 'nullable|date|before:today',
            'gender' => 'nullable|in:male,female',
            'address' => 'nullable|string|max:500',
            'occupation' => 'nullable|string|max:255',
            'workplace' => 'nullable|string|max:255',
            'church_class' => 'nullable|string|max:255',
            'school_class' => 'nullable|string|max:255',
            'member_since' => 'nullable|date',
            'baptism_date' => 'nullable|date',
            'is_active' => 'boolean',
            'locale' => 'nullable|in:fr,en',
            'roles' => 'nullable|array',
            'roles.*' => 'exists:roles,name',
            'zone_ids' => 'nullable|array',
            'zone_ids.*' => 'exists:zones,id',
            'bacenta_ids' => 'nullable|array',
            'bacenta_ids.*' => 'exists:bacentas,id',
            'department_ids' => 'nullable|array',
            'department_ids.*' => 'exists:departments,id',
        ];

        // Mot de passe requis uniquement à la création
        if ($this->isMethod('POST')) {
            $rules['password'] = ['nullable', Password::defaults()];
        } else {
            $rules['password'] = ['nullable', Password::defaults()];
        }

        return $rules;
    }

    public function messages(): array
    {
        return [
            'first_name.required' => __('app.validation.required'),
            'last_name.required' => __('app.validation.required'),
            'email.required' => __('app.validation.required'),
            'email.email' => __('app.validation.email'),
            'email.unique' => __('app.validation.unique'),
            'photo.image' => 'Le fichier doit être une image.',
            'photo.max' => 'L\'image ne doit pas dépasser 2 Mo.',
        ];
    }
}
