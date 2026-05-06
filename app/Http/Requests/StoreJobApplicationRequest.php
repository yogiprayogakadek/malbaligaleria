<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreJobApplicationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'         => 'required|string|max:255',
            'email'        => 'required|email|max:255',
            'phone'        => 'required|string|max:20',
            'address'      => 'nullable|string|max:500',
            'cover_letter' => 'nullable|string|max:2000',
            'cv'           => 'required|file|mimes:pdf,doc,docx|max:2048',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required'  => 'Nama lengkap wajib diisi.',
            'email.required' => 'Alamat email wajib diisi.',
            'email.email'    => 'Format email tidak valid.',
            'phone.required' => 'Nomor HP wajib diisi.',
            'cv.required'    => 'File CV wajib diunggah.',
            'cv.mimes'       => 'Format CV harus PDF, DOC, atau DOCX.',
            'cv.max'         => 'Ukuran file CV maksimal 2MB.',
        ];
    }
}
