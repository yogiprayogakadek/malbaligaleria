<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreJobVacancyRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title'            => 'required|string|max:255',
            'slug'             => 'required|string|max:255|unique:job_vacancies,slug',
            'department'       => 'required|string|max:100',
            'type'             => 'required|in:full-time,part-time,contract,internship',
            'location'         => 'required|string|max:255',
            'description'      => 'required|string',
            'requirements'     => 'required|string',
            'responsibilities' => 'nullable|string',
            'salary_range'     => 'nullable|string|max:100',
            'deadline'         => 'nullable|date|after:today',
            'closing_date'     => 'nullable|date|after:today',
            'is_active'        => 'boolean',
            'sort_order'       => 'integer|min:0',
            'flyer'            => 'nullable|image|mimes:png,jpg,jpeg,jfif,webp|max:5120',
        ];
    }
}
