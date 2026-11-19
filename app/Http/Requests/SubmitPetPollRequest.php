<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SubmitPetPollRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'tenant_id' => [
                'required',
                'integer',
                Rule::exists('tenants', 'id')->where(function ($query) {
                    return $query->where('is_active', true)
                        ->where('type', 'tenant')
                        ->whereNull('deleted_at');
                }),
            ],
            'pic_name' => ['required', 'string', 'max:100'],
            'allows_pets' => ['required', 'boolean'],
            'note' => ['nullable', 'string', 'max:300'],
            'email' => ['nullable', 'email', 'max:150'],
            'token' => ['nullable', 'string', 'max:64'],
        ];
    }

    public function messages(): array
    {
        return [
            'tenant_id.required' => 'Pilih tenant Anda terlebih dahulu.',
            'tenant_id.exists' => 'Tenant tidak ditemukan atau sedang tidak aktif.',
            'pic_name.required' => 'Nama PIC atau penanggung jawab wajib diisi.',
            'pic_name.max' => 'Nama PIC maksimal 100 karakter.',
            'allows_pets.required' => 'Pilih salah satu keputusan (mengizinkan atau tidak).',
            'allows_pets.boolean' => 'Pilihan keputusan tidak valid.',
            'note.max' => 'Catatan maksimal 300 karakter.',
            'email.email' => 'Format email tidak valid.',
            'email.max' => 'Email maksimal 150 karakter.',
        ];
    }
}
