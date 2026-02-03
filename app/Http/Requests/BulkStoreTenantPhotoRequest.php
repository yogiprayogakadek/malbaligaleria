<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BulkStoreTenantPhotoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'id' => 'required|array|min:1',
            'id.*' => 'required|numeric|distinct|exists:tenants,id',
            'path' => 'required|array|min:1',
            'path.*' => 'required|image|mimes:png,jpg,jpeg,webp,jfif,heic|max:2048',
            'caption' => 'nullable|array',
            'caption.*' => 'nullable|string',
        ];
    }

    public function messages()
    {
        return [
            'id.*.distinct' => 'Tenant cannot be selected more than once.',
            'id.*.exists' => 'The selected tenant is invalid.',
            'path.*.required' => 'The image is required for each row.',
            'path.*.image' => 'The file must be an image.',
            'path.*.max' => 'Each image must not exceed 2MB.',
        ];
    }
}
