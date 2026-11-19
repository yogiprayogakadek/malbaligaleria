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
            'allows_pets' => ['required', 'boolean'],
            'note' => ['nullable', 'string', 'max:300'],
        ];
    }

    public function messages(): array
    {
        return [
            'tenant_id.required' => 'Pilih tenant Anda terlebih dahulu.',
            'tenant_id.exists' => 'Tenant tidak ditemukan atau sedang tidak aktif.',
            'allows_pets.required' => 'Pilih salah satu keputusan (mengizinkan atau tidak).',
            'allows_pets.boolean' => 'Pilihan keputusan tidak valid.',
            'note.max' => 'Catatan maksimal 300 karakter.',
        ];
    }
}
