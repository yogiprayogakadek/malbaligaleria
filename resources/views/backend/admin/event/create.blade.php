@extends('templates.backend.master')

@section('page-title', 'Create Event')
@section('page-link', route('admin.event.create'))

@push('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <style>
        .day-pills { display: flex; flex-wrap: wrap; gap: 8px; }
        .day-pill { display: none; }
        .day-pill + label {
            cursor: pointer;
            padding: 6px 14px;
            border-radius: 50px;
            border: 1.5px solid #dee2e6;
            font-size: 13px;
            font-weight: 500;
            transition: all 0.2s;
            user-select: none;
            color: #555;
        }
        .day-pill:checked + label {
            background: #c9a96e;
            border-color: #c9a96e;
            color: #fff;
        }
        .recurring-section { display: none; }
        .date-section { }
        #regularToggle:checked ~ .card-body .recurring-section,
        .show-recurring { display: block; }
    </style>
@endpush

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin.event.store') }}" method="POST" id="form">
                        @csrf

                        {{-- Event Name --}}
                        <div class="mb-4 row align-items-center">
                            <label for="name" class="form-label col-sm-3 col-form-label">Name</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    id="name" name="name" placeholder="Enter event name"
                                    value="{{ old('name') }}">
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- Event Category Selection --}}
                        <div class="mb-4 row">
                            <label class="form-label col-sm-12 fw-bold fs-4">Event Category</label>
                            <div class="col-sm-12">
                                <div class="row g-3">
                                    {{-- Regular Event --}}
                                    <div class="col-md-3">
                                        <input type="radio" class="btn-check" name="type" id="type_regular" value="regular" {{ old('type') == 'regular' ? 'checked' : '' }}>
                                        <label class="btn btn-outline-primary w-100 py-3 d-flex flex-column align-items-center gap-2" for="type_regular">
                                            <i class="ti ti-repeat fs-7"></i>
                                            <span>Regular Event</span>
                                        </label>
                                    </div>
                                    {{-- Special Event --}}
                                    <div class="col-md-3">
                                        <input type="radio" class="btn-check" name="type" id="type_special" value="special" {{ old('type', 'special') == 'special' ? 'checked' : '' }}>
                                        <label class="btn btn-outline-warning w-100 py-3 d-flex flex-column align-items-center gap-2" for="type_special">
                                            <i class="ti ti-star fs-7"></i>
                                            <span>Special Event</span>
                                        </label>
                                    </div>
                                    {{-- Exhibition --}}
                                    <div class="col-md-3">
                                        <input type="radio" class="btn-check" name="type" id="type_exhibition" value="exhibition" {{ old('type') == 'exhibition' ? 'checked' : '' }}>
                                        <label class="btn btn-outline-info w-100 py-3 d-flex flex-column align-items-center gap-2" for="type_exhibition">
                                            <i class="ti ti-building-store fs-7"></i>
                                            <span>Exhibition</span>
                                        </label>
                                    </div>
                                    {{-- Upcoming Event --}}
                                    <div class="col-md-3">
                                        <input type="radio" class="btn-check" name="type" id="type_upcoming" value="upcoming" {{ old('type') == 'upcoming' ? 'checked' : '' }}>
                                        <label class="btn btn-outline-secondary w-100 py-3 d-flex flex-column align-items-center gap-2" for="type_upcoming">
                                            <i class="ti ti-calendar-event fs-7"></i>
                                            <span>Upcoming Event</span>
                                        </label>
                                    </div>
                                </div>
                                @error('type')
                                    <div class="text-danger small mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- Recurring Details (Only for Regular) --}}
                        <div id="recurringSection" class="mb-4 card border" style="background: #fffbf4; border-color: #f0ddb8 !important; display: none;">
                            <div class="card-body">
                                <h5 class="card-title mb-3" style="color:#c9a96e;"><i class="ti ti-repeat me-1"></i>Jadwal Rutin</h5>
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Hari Pelaksanaan</label>
                                    <div class="day-pills">
                                        @php
                                            $days = ['0' => 'Minggu', '1' => 'Senin', '2' => 'Selasa', '3' => 'Rabu', '4' => 'Kamis', '5' => 'Jumat', '6' => 'Sabtu'];
                                            $oldDays = old('recurring_days', []);
                                        @endphp
                                        @foreach($days as $val => $label)
                                            <input type="checkbox" class="day-pill" id="day_{{ $val }}"
                                                name="recurring_days[]" value="{{ $val }}"
                                                {{ in_array($val, $oldDays) ? 'checked' : '' }}>
                                            <label for="day_{{ $val }}">{{ $label }}</label>
                                        @endforeach
                                    </div>
                                    @error('recurring_days')
                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3 pt-3 border-top">
                                    <label class="form-label fw-semibold" for="recurring_label">Label Jadwal <small class="text-muted fw-normal">(ditampilkan ke pengunjung)</small></label>
                                    <input type="text" class="form-control @error('recurring_label') is-invalid @enderror"
                                        id="recurring_label" name="recurring_label"
                                        placeholder="Contoh: Setiap Jum'at, Sabtu & Minggu"
                                        value="{{ old('recurring_label') }}">
                                    @error('recurring_label')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mt-4 mb-0 pt-3 border-top">
                                    <label class="form-label fw-semibold" for="specific_dates">Tanggal Spesifik <small class="text-muted fw-normal">(Pilih tanggal tertentu jika event tidak rutin setiap minggu)</small></label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="ti ti-calendar"></i></span>
                                        <input type="text" class="form-control @error('specific_dates') is-invalid @enderror"
                                            id="specific_dates" name="specific_dates"
                                            placeholder="Klik untuk pilih tanggal-tanggal spesifik..."
                                            value="{{ is_array(old('specific_dates')) ? implode(', ', old('specific_dates')) : old('specific_dates') }}">
                                    </div>
                                    <small class="form-text text-muted">Abaikan pilihan hari di atas jika menggunakan tanggal spesifik ini.</small>
                                    @error('specific_dates')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        {{-- Date --}}
                        <div id="dateSection" class="mb-4 row align-items-center">
                            <div class="row">
                                <div class="col-sm-6">
                                    <label for="start_date">Start Date</label>
                                    <input type="text" class="form-control @error('start_date') is-invalid @enderror"
                                        id="start_date" name="start_date" placeholder="Enter start date event"
                                        value="{{ old('start_date') }}">
                                    @error('start_date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-sm-6">
                                    <label for="end_date">End Date <small class="text-muted fw-normal">(Kosongkan jika event berlangsung terus-menerus/tanpa batas)</small></label>
                                    <input type="text" class="form-control @error('end_date') is-invalid @enderror"
                                        id="end_date" name="end_date" placeholder="Enter end date event"
                                        value="{{ old('end_date') }}">
                                    @error('end_date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        {{-- Time --}}
                        <div class="mb-4 row align-items-center">
                            <div class="row">
                                <div class="col-sm-6">
                                    <label for="start_time">Start Time</label>
                                    <input type="text" class="form-control @error('start_time') is-invalid @enderror"
                                        id="start_time" name="start_time" placeholder="Enter start time event"
                                        value="{{ old('start_time') }}">
                                    @error('start_time')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-sm-6">
                                    <label for="end_time">End Time</label>
                                    <input type="text" class="form-control @error('end_time') is-invalid @enderror"
                                        id="end_time" name="end_time" placeholder="Enter end time event"
                                        value="{{ old('end_time') }}">
                                    @error('end_time')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        {{-- Event Description --}}
                        <div class="mb-4 row align-items-center">
                            <label for="description" class="form-label col-sm-3 col-form-label">Description</label>
                            <div class="col-sm-12">
                                <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror"
                                    rows="10" placeholder="Enter event description">{{ old('description') }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- Location --}}
                        <div class="mb-4 row align-items-center">
                            <label for="location" class="form-label col-sm-3 col-form-label">Location</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control @error('location') is-invalid @enderror"
                                    id="location" name="location" placeholder="Enter event location (e.g. Main Atrium)"
                                    value="{{ old('location') }}">
                                @error('location')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- Entrance Fee & Price --}}
                        <div class="mb-4 row align-items-center">
                            <div class="row">
                                <div class="col-sm-12" id="entrance_fee_col">
                                    <label for="is_paid">Entrance Fee</label>
                                    <select class="form-select @error('is_paid') is-invalid @enderror" id="is_paid"
                                        name="is_paid">
                                        <option value="0" {{ old('is_paid') == '0' ? 'selected' : '' }}>Free</option>
                                        <option value="1" {{ old('is_paid') == '1' ? 'selected' : '' }}>Paid</option>
                                    </select>
                                    @error('is_paid')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-sm-6" id="price_col" style="display: none;">
                                    <label for="price">Price</label>
                                    <input type="text" class="form-control @error('price') is-invalid @enderror"
                                        id="price" name="price" placeholder="Enter price amount"
                                        value="{{ old('price') }}">
                                    @error('price')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        {{-- Organizer --}}
                        <div class="mb-4 row align-items-center">
                            <label for="organizer" class="form-label col-sm-3 col-form-label">Organizer</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control @error('organizer') is-invalid @enderror"
                                    id="organizer" name="organizer" placeholder="Enter organizer name"
                                    value="{{ old('organizer') }}">
                                @error('organizer')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- Target Audience --}}
                        <div class="mb-4 row align-items-center">
                            <label for="target_audience" class="form-label col-sm-3 col-form-label">Target Audience</label>
                            <div class="col-sm-12">
                                <select class="form-select @error('target_audience') is-invalid @enderror"
                                    id="target_audience" name="target_audience">
                                    <option value="">Select Target Audience</option>
                                    <option value="General" {{ old('target_audience') == 'General' ? 'selected' : '' }}>General</option>
                                    <option value="Family" {{ old('target_audience') == 'Family' ? 'selected' : '' }}>Family</option>
                                    <option value="Kids" {{ old('target_audience') == 'Kids' ? 'selected' : '' }}>Kids</option>
                                    <option value="Adults" {{ old('target_audience') == 'Adults' ? 'selected' : '' }}>Adults</option>
                                    <option value="Teenagers" {{ old('target_audience') == 'Teenagers' ? 'selected' : '' }}>Teenagers</option>
                                </select>
                                @error('target_audience')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- Highlights --}}
                        <div class="mb-4 row align-items-center">
                            <label for="highlights" class="form-label col-sm-3 col-form-label">Highlights</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control @error('highlights') is-invalid @enderror"
                                    id="highlights" name="highlights"
                                    placeholder="Enter highlights (e.g. Live Music & Sale)"
                                    value="{{ old('highlights') }}">
                                @error('highlights')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- Submit --}}
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary hstack gap-6 float-end">
                                <i class="ti ti-send fs-4"></i> Submit
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    <script>
        $(document).ready(function() {
            flatpickr("#start_date, #end_date", {
                dateFormat: "Y-m-d",
                altInput: true,
                altFormat: "F j, Y",
            });
            flatpickr("#start_time, #end_time", {
                enableTime: true,
                noCalendar: true,
                dateFormat: "H:i",
                altInput: true,
                altFormat: "h:i K"
            });
            flatpickr("#specific_dates", {
                mode: "multiple",
                dateFormat: "Y-m-d",
                altInput: true,
                altFormat: "F j, Y",
                conjunction: ", "
            });

            // Toggle event sections based on type
            function toggleType() {
                const type = $('input[name="type"]:checked').val();
                if (type === 'regular') {
                    $('#recurringSection').slideDown(250);
                    // No longer hiding date section, but could adjust specific fields if needed
                } else {
                    $('#recurringSection').slideUp(250);
                }
            }
            $('input[name="type"]').on('change', toggleType);
            toggleType();

            // Handle Entrance Fee Change
            $('#is_paid').change(function() {
                if ($(this).val() == '1') {
                    $('#entrance_fee_col').removeClass('col-sm-12').addClass('col-sm-6');
                    $('#price_col').show();
                } else {
                    $('#entrance_fee_col').removeClass('col-sm-6').addClass('col-sm-12');
                    $('#price_col').hide();
                    $('#price').val('');
                }
            });

            $('#is_paid').trigger('change');
        });
    </script>
@endpush
