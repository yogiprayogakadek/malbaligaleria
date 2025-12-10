@extends('templates.backend.master')

@section('page-title', 'Update Event - ' . $event->name)
@section('page-link', route('admin.event.edit', $event->uuid))

@push('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
@endpush

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin.event.update', $event->uuid) }}" method="POST" id="form">
                        @method('PUT')
                        @csrf
                        {{-- Event Name --}}
                        <div class="mb-4 row align-items-center">
                            <label for="name" class="form-label col-sm-3 col-form-label">Name</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    id="name" name="name" placeholder="Enter event name"
                                    value="{{ $event->name }}">
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- Date --}}
                        <div class="mb-4 row align-items-center">
                            <div class="row">
                                <div class="col-sm-6">
                                    <label for="start_date">Start Date</label>
                                    <input type="text" class="form-control @error('start_date') is-invalid @enderror"
                                        id="start_date" name="start_date" placeholder="Enter start date event"
                                        value="{{ $event->start_date }}">
                                    @error('start_date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-sm-6">
                                    <label for="end_date">Start Date</label>
                                    <input type="text" class="form-control @error('end_date') is-invalid @enderror"
                                        id="end_date" name="end_date" placeholder="Enter end date event"
                                        value="{{ $event->end_date }}">
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
                                        value="{{ $event->start_time }}">
                                    @error('start_time')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-sm-6">
                                    <label for="end_time">Start Date</label>
                                    <input type="text" class="form-control @error('end_time') is-invalid @enderror"
                                        id="end_time" name="end_time" placeholder="Enter end time event"
                                        value="{{ $event->end_time }}">
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
                                    rows="10" id="description" name="description" placeholder="Enter event description">{{ $event->description }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- Event Status --}}
                        <div class="mb-4 row align-items-center">
                            <label for="is_active" class="form-label col-sm-3 col-form-label">Status</label>
                            <div class="col-sm-12">
                                <select name="is_active" id="is_active"
                                    class="form-control @error('is_active') is-invalid @enderror">
                                    <option value="1" {{ $event->is_active == 1 ? 'selected' : '' }}>Active</option>
                                    <option value="0" {{ $event->is_active == 0 ? 'selected' : '' }}>Not Active
                                    </option>
                                </select>
                                @error('is_active')
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
        });
    </script>
@endpush
