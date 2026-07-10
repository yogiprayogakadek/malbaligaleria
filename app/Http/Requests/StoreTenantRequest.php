<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreTenantRequest extends FormRequest
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
            'type'              => 'required|string|in:tenant,island,gate',
            'category_id'       => 'required_if:type,tenant,island|exists:categories,id',
            'name'              => [
                'required',
                'string',
                'max:255',
                Rule::unique('tenants', 'name')->whereNull('deleted_at'),
            ],
            'phone'             => 'nullable|string|max:20',
            'email'             => 'nullable|email|max:255',
            'website'           => 'nullable|url|max:255',
            'logo'              => 'required_if:type,tenant,island|image|mimes:png,jpg,jpeg,jfif|max:2048',
            'description'       => 'nullable|string',
            'position_x'        => 'required|numeric',
            'position_y'        => 'required|numeric',
            'floor'             => 'required|numeric|between:1,2',
            'unit'              => 'required|string|max:20',
            'launched_at'       => 'nullable|date',
            'is_new'            => 'nullable|required_with:launched_at|boolean',
            'path_coords'       => 'nullable|string', // JSON string from frontend
        ];
    }

    public function messages()
    {
        return [
            'is_new.required_with' => 'The new store field is required when launched at is present.'
        ];
    }
}
