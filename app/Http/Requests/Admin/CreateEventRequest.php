<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CreateEventRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->role == 'admin';
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:255',
            'location' => 'required|string|max:255',
            'max_participants' => 'required|integer|min:1',
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after_or_equal:start_date',
            'owner.name' => 'required|string|max:255',
            'owner.email' => 'required|email|max:255', 
        ];
    }

    public function messages(): array
{
    return [
        'name.required' => 'O nome do evento é obrigatório.',
        'owner.name.required' => 'O nome do organizador é obrigatório.',
    ];
}
}
