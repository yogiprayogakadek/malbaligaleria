<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateJobVacancyRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title'            => 'required|string|max:255',
            'department'       => 'required|string|max:100',
            'type'             => 'required|in:full-time,part-time,contract,internship',
            'location'         => 'required|string|max:255',
            'description'      => 'required|string',
            'requirements'     => 'required|string',
            'responsibilities' => 'nullable|string',
            'salary_range'     => 'nullable|string|max:100',
            'deadline'         => 'nullable|date',
            'closing_date'     => 'nullable|date',
            'is_active'        => 'boolean',
            'sort_order'       => 'integer|min:0',
        ];
    }
}
