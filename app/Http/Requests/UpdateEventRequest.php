<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateEventRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $isRegular = $this->boolean('is_regular');

        return [
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('events', 'name')->ignore($this->uuid, 'uuid'),
            ],
            'start_date'       => $isRegular ? 'nullable|date' : 'nullable|date|before_or_equal:end_date',
            'end_date'         => $isRegular ? 'nullable|date' : 'nullable|date|after_or_equal:start_date',
            'start_time'       => 'required',
            'end_time'         => 'required',
            'description'      => 'required|string',
            'location'         => 'required|string|max:255',
            'organizer'        => 'nullable|string|max:255',
            'is_paid'          => 'required|numeric|between:0,1',
            'price'            => 'nullable|numeric|min:0|required_if:is_paid,1',
            'target_audience'  => 'nullable|string|max:255',
            'highlights'       => 'nullable|string|max:255',
            'is_active'        => 'required|numeric|between:0,1',
            'is_regular'       => 'boolean',
            'recurring_days'   => 'nullable|array',
            'recurring_days.*' => 'integer|between:0,6',
            'recurring_label'  => 'nullable|string|max:100|required_if:is_regular,1',
        ];
    }

    public function messages(): array
    {
        return [
            'start_date.before_or_equal' => 'Start date tidak boleh melebihi end date.',
            'end_date.after_or_equal'    => 'End date tidak boleh lebih awal dari start date.',
            'recurring_label.required_if' => 'Label jadwal wajib diisi untuk event reguler.',
        ];
    }
}
