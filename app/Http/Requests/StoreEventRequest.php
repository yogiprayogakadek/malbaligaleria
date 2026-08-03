<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;

class StoreEventRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $isRegular = $this->type === 'regular';

        return [
            'name'             => [
                'required',
                'string',
                function ($attribute, $value, $fail) {
                    // Cek apakah ada event aktif (is_active = 1) dengan nama yang sama
                    $activeExists = DB::table('events')
                        ->where('name', $value)
                        ->whereNull('deleted_at')
                        ->where('is_active', 1)
                        ->exists();

                    if ($activeExists) {
                        $fail('Nama event sudah digunakan oleh event yang masih aktif. Nonaktifkan event tersebut terlebih dahulu sebelum membuat event dengan nama yang sama.');
                    }
                },
            ],
            'start_date'       => 'required|date',
            'end_date'         => 'nullable|date|after_or_equal:start_date',
            'start_time'       => 'required',
            'end_time'         => 'required',
            'description'      => 'required|string',
            'location'         => 'required|string|max:255',
            'organizer'        => 'nullable|string|max:255',
            'is_paid'          => 'required|boolean',
            'price'            => 'nullable|numeric|min:0|required_if:is_paid,1',
            'target_audience'  => 'nullable|string|max:255',
            'highlights'       => 'nullable|string|max:255',
            'always_show'      => 'required|boolean',
            'type'             => 'required|in:regular,special,exhibition,upcoming',
            'is_regular'       => 'boolean',
            'recurring_days'   => 'nullable|array',
            'recurring_days.*' => 'integer|between:0,6',
            'recurring_label'  => 'nullable|string|max:100|required_if:type,regular',
            'specific_dates'   => 'nullable|string',
        ];
    }

    public function messages(): array
    {
        return [
            'start_date.before_or_equal' => 'Start date tidak boleh melebihi end date.',
            'end_date.after_or_equal'    => 'End date tidak boleh lebih awal dari start date.',
            'recurring_label.required_if' => 'Label jadwal wajib diisi untuk event reguler.',
        ];
    }
}
