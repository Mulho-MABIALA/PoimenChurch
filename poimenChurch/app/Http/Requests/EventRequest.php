<?php

namespace App\Http\Requests;

use App\Models\Event;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EventRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $eventId = $this->route('event')?->id;

        return [
            'title' => 'required|string|max:255',
            'slug' => [
                'nullable',
                'string',
                'max:255',
                Rule::unique('events', 'slug')->ignore($eventId),
            ],
            'description' => 'nullable|string|max:500',
            'content' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'location' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:500',
            'city' => 'nullable|string|max:255',
            'type' => ['required', Rule::in(array_keys(Event::TYPES))],
            'registration_fee' => 'nullable|numeric|min:0',
            'max_participants' => 'nullable|integer|min:1',
            'is_featured' => 'boolean',
            'is_published' => 'boolean',
            'registration_required' => 'boolean',
            'branch_id' => 'nullable|exists:branches,id',
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Le titre est obligatoire.',
            'title.max' => 'Le titre ne doit pas dépasser 255 caractères.',
            'start_date.required' => 'La date de début est obligatoire.',
            'start_date.date' => 'La date de début doit être une date valide.',
            'end_date.after_or_equal' => 'La date de fin doit être postérieure ou égale à la date de début.',
            'type.required' => 'Le type d\'événement est obligatoire.',
            'type.in' => 'Le type d\'événement sélectionné n\'est pas valide.',
            'image.image' => 'Le fichier doit être une image.',
            'image.max' => 'L\'image ne doit pas dépasser 2 Mo.',
            'registration_fee.numeric' => 'Le frais d\'inscription doit être un nombre.',
            'registration_fee.min' => 'Le frais d\'inscription ne peut pas être négatif.',
            'max_participants.integer' => 'Le nombre maximum de participants doit être un entier.',
            'max_participants.min' => 'Le nombre maximum de participants doit être au moins 1.',
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'is_featured' => $this->boolean('is_featured'),
            'is_published' => $this->boolean('is_published'),
            'registration_required' => $this->boolean('registration_required'),
        ]);
    }
}
