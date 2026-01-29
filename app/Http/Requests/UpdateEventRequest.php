<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateEventRequest extends FormRequest
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
            'name'  => [
                'required',
                'string',
                'max:255',
                Rule::unique('events', 'name')->ignore($this->uuid, 'uuid'),
            ],
            // 'start_date'    => 'required|date|after_or_equal:today',
            'start_date' => [
                'required',
                'date',
                function ($attribute, $value, $fail) {
                    $currentEvent = \DB::table('events')->where('uuid', $this->uuid)->first();

                    if ($currentEvent && $value !== $currentEvent->start_date && strtotime($value) < strtotime(today())) {
                        $fail('The ' . $attribute . ' must be a date after or equal to today.');
                    }
                },
            ],
            'end_date'  => 'required|date|after_or_equal:today|after_or_equal:start_date',
            'start_time'    => 'required',
            'end_time'  => 'required',
            'description'   => 'required|string',
            'location' => 'required|string|max:255',
            'organizer' => 'nullable|string|max:255',
            'is_paid' => 'required|numeric|between:0,1',
            'price' => 'nullable|numeric|min:0|required_if:is_paid,1',
            'target_audience' => 'nullable|string|max:255',
            'highlights' => 'nullable|string|max:255',
            'is_active' => 'required|numeric|between:0,1'
        ];
    }
}
