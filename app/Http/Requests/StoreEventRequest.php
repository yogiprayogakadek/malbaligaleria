<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEventRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name'  => 'required|string|unique:events,name',
            'start_date'    => 'required|date|after_or_equal:today',
            'end_date'  => 'required|date|after_or_equal:today|after_or_equal:start_date',
            'start_time'    => 'required',
            'end_time'  => 'required',
            'description'   => 'required|string',
            'location' => 'required|string|max:255',
            'organizer' => 'nullable|string|max:255',
            'is_paid' => 'required|boolean',
            'price' => 'nullable|numeric|min:0|required_if:is_paid,1',
            'target_audience' => 'nullable|string|max:255',
            'highlights' => 'nullable|string|max:255',
        ];
    }
}
