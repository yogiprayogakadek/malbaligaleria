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
                                    <label for="end_date">End Date</label>
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
                                    <label for="end_time">End Time</label>
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

                        {{-- Location --}}
                        <div class="mb-4 row align-items-center">
                            <label for="location" class="form-label col-sm-3 col-form-label">Location</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control @error('location') is-invalid @enderror"
                                    id="location" name="location" placeholder="Enter event location (e.g. Main Atrium)"
                                    value="{{ $event->location }}">
                                @error('location')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- Entrance Fee & Price --}}
                        <div class="mb-4 row align-items-center">
                            <div class="row">
                                {{-- Entrance Fee --}}
                                <div class="col-sm-12" id="entrance_fee_col">
                                    <label for="is_paid">Entrance Fee</label>
                                    <select class="form-select @error('is_paid') is-invalid @enderror" id="is_paid" name="is_paid">
                                        <option value="0" {{ $event->is_paid == 0 ? 'selected' : '' }}>Free</option>
                                        <option value="1" {{ $event->is_paid == 1 ? 'selected' : '' }}>Paid</option>
                                    </select>
                                    @error('is_paid')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                {{-- Price (Conditional) --}}
                                <div class="col-sm-6" id="price_col" style="display: none;">
                                    <label for="price">Price</label>
                                    <input type="text" class="form-control @error('price') is-invalid @enderror"
                                        id="price" name="price" placeholder="Enter price amount"
                                        value="{{ $event->price }}">
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
                                    value="{{ $event->organizer }}">
                                @error('organizer')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- Target Audience --}}
                        <div class="mb-4 row align-items-center">
                            <label for="target_audience" class="form-label col-sm-3 col-form-label">Target Audience</label>
                            <div class="col-sm-12">
                                <select class="form-select @error('target_audience') is-invalid @enderror" id="target_audience" name="target_audience">
                                    <option value="">Select Target Audience</option>
                                    <option value="General" {{ $event->target_audience == 'General' ? 'selected' : '' }}>General</option>
                                    <option value="Family" {{ $event->target_audience == 'Family' ? 'selected' : '' }}>Family</option>
                                    <option value="Kids" {{ $event->target_audience == 'Kids' ? 'selected' : '' }}>Kids</option>
                                    <option value="Adults" {{ $event->target_audience == 'Adults' ? 'selected' : '' }}>Adults</option>
                                    <option value="Teenagers" {{ $event->target_audience == 'Teenagers' ? 'selected' : '' }}>Teenagers</option>
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
                                    id="highlights" name="highlights" placeholder="Enter highlights (e.g. Live Music & Sale)"
                                    value="{{ $event->highlights }}">
                                @error('highlights')
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

            // Handle Entrance Fee Change
            $('#is_paid').change(function() {
                if ($(this).val() == '1') {
                    $('#entrance_fee_col').removeClass('col-sm-12').addClass('col-sm-6');
                    $('#price_col').show();
                } else {
                    $('#entrance_fee_col').removeClass('col-sm-6').addClass('col-sm-12');
                    $('#price_col').hide();
                    $('#price').val(''); // Clear price if free
                }
            });

            // Trigger on load
            $('#is_paid').trigger('change');
        });
    </script>
@endpush
