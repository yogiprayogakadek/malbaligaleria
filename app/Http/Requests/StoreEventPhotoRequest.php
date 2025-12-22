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

            'album' => 'required|array|min:1|max:5',
            'album.*' => [
                'required',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
            ],
        ];
    }

    public function messages()
    {
        return [
            'event_id.required' => 'The tenant field is required.',
            'path.required'      => 'The primary image display field is required.',

            'album.required' => 'Please upload at least one photo.',
            'album.array' => 'Invalid file format submitted.',
            'album.min' => 'You must upload at least :min photo.',
            'album.max' => 'You cannot upload more than :max photos.',

            'album.*.image' => 'The file must be an image.',
            'album.*.mimes' => 'Only JPG, JPEG, PNG, and WEBP formats are allowed.',
            'album.*.max' => 'Each image must not exceed 2MB in size.',
        ];
    }
}
