<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Carbon;

class UpdatePetPollRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:80'],
            'question' => ['required', 'string', 'max:200'],
            'pet_scope' => ['required', 'string', 'max:300'],
            'sender_email' => ['nullable', 'email', 'max:150'],
            'sender_name' => ['nullable', 'string', 'max:100'],
            'mail_host' => ['nullable', 'string', 'max:150'],
            'mail_port' => ['nullable', 'integer', 'between:1,65535'],
            'mail_username' => ['nullable', 'string', 'max:150'],
            'mail_password' => ['nullable', 'string', 'max:255'],
            'mail_encryption' => ['nullable', 'in:tls,ssl'],
            'closes_at' => ['nullable', 'date'],
        ];
    }

    protected function prepareForValidation(): void
    {
        if ($this->filled('closes_at')) {
            try {
                $converted = Carbon::parse($this->input('closes_at'), 'Asia/Makassar')->utc()->format('Y-m-d H:i:s');
                $this->merge(['closes_at' => $converted]);
            } catch (\Throwable $e) {
                // Biarkan validasi date gagal secara normal
            }
        }
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Judul survei wajib diisi.',
            'title.max' => 'Judul survei maksimal 80 karakter.',
            'question.required' => 'Pertanyaan wajib diisi.',
            'question.max' => 'Pertanyaan maksimal 200 karakter.',
            'pet_scope.required' => 'Cakupan pet wajib diisi.',
            'pet_scope.max' => 'Cakupan pet maksimal 300 karakter.',
            'sender_email.email' => 'Format email pengirim tidak valid.',
            'sender_email.max' => 'Email pengirim maksimal 150 karakter.',
            'sender_name.max' => 'Nama pengirim maksimal 100 karakter.',
            'mail_host.max' => 'Host SMTP maksimal 150 karakter.',
            'mail_port.integer' => 'Port SMTP harus berupa angka.',
            'mail_port.between' => 'Port SMTP harus antara 1 sampai 65535.',
            'mail_username.max' => 'Username SMTP maksimal 150 karakter.',
            'mail_password.max' => 'Password SMTP maksimal 255 karakter.',
            'mail_encryption.in' => 'Jenis enkripsi SMTP tidak valid.',
            'closes_at.date' => 'Format tenggat waktu tidak valid.',
        ];
    }
}
