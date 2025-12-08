<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateTenantRequest extends FormRequest
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
            'name'              => [
                'required',
                'string',
                'max:255',
                Rule::unique('tenants', 'name')->ignore($this->uuid, 'uuid')
            ],
            'phone'             => 'required|string|max:20',
            'email'             => 'required|email|max:255',
            'website'           => 'required|url|max:255',
            'logo'              => 'nullable|image|mimes:png,jpg,jpeg,jfif|max:2048',
            'description'       => 'required|string',
            'position_x'        => 'required|numeric',
            'position_y'        => 'required|numeric',
            'floor'             => 'required|numeric|between:1,2',
            'unit'              => 'required|string|max:20',
        ];
    }
}
