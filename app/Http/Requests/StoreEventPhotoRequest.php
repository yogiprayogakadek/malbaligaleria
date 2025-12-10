<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEventPhotoRequest extends FormRequest
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
            'event_id'         => 'required|numeric|exists:events,id',
            'path'              => 'required|image|mimes:png,jpg,jpeg|max:2048',
            'caption'           => 'required|string',
        ];
    }

    public function messages()
    {
        return [
            'event_id.required' => 'The tenant field is required.',
            'path.required'      => 'The primary image display field is required.',
        ];
    }
}
