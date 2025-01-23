<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEventRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
        // $event = Event::find($this->route('event'));
        // return $this->user()->role === 'admin' || $this->user()->id === $event->owner_id;
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
            'description' => 'nullable|string',
            'location' => 'required|string|max:255',
            'max_participants' => 'required|integer|unsigned',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'owner_id' => 'required|integer|exists:users,id',
        ];
        // return [
        //     'name' => 'sometimes|required|string|max:255',
        //     'description' => 'nullable|string|max:255',
        //     'location' => 'sometimes|required|string|max:255',
        //     'max_participants' => 'sometimes|required|integer|min:1',
        //     'start_date' => 'sometimes|required|date|after_or_equal:today',
        //     'end_date' => 'sometimes|required|date|after_or_equal:start_date',
        //     'owner.name' => 'sometimes|required|string|max:255',
        //     'owner.email' => 'sometimes|required|email|max:255|exists:users,email',
        // ];
    }
}
