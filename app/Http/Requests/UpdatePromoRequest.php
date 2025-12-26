<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePromoRequest extends FormRequest
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
            'tenant_id' => 'required|exists:tenants,id|numeric',
            'name' => 'required|string',
            'start_date' => [
                'required',
                'date',
                function ($attribute, $value, $fail) {
                    $currentEvent = \DB::table('promos')->where('uuid', $this->uuid)->first();

                    if ($currentEvent && $value !== $currentEvent->start_date && strtotime($value) < strtotime(today())) {
                        $fail('The ' . $attribute . ' must be a date after or equal to today.');
                    }
                },
            ],
            'end_date'  => 'required|date|after_or_equal:today|after_or_equal:start_date',
            'description' => 'required|string',
            'banner' => 'nullable|mimes:png,jpg,jpeg,webp|max:2048',
            'is_active' => 'required|numeric|between:0,1'
        ];
    }

    public function messages()
    {
        return [
            'tenant_id.required' => 'The tenant field is required.',
            'is_active.required' => 'The status field is required.',
        ];
    }
}
