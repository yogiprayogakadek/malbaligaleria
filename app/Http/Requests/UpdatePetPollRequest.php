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
            'closes_at.date' => 'Format tenggat waktu tidak valid.',
        ];
    }
}
