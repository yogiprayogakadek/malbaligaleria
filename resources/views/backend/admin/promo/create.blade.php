@extends('templates.backend.master')

@section('page-title', 'Create Promo')
@section('page-link', route('admin.promo.create'))

@push('css')
    <link rel="stylesheet" href="{{ asset('assets/backend/css/select2.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
@endpush

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin.promo.store') }}" method="POST" enctype="multipart/form-data"
                        id="form">
                        @csrf

                        {{-- Tenant ID --}}
                        <div class="mb-4 row align-items-center">
                            <label for="tenant" class="form-label col-sm-3 col-form-label">Tenant</label>
                            <div class="col-sm-12">
                                <select name="tenant_id" id="tenantId"
                                    class="form-control @error('tenant_id') is-invalid @enderror">
                                    <option value="">Select tenant...</option>
                                    @foreach ($tenants as $tenant)
                                        <option value="{{ $tenant->id }}"
                                            {{ old('tenant_id') == $tenant->id ? 'selected' : '' }}>
                                            {{ $tenant->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('tenant_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- Promo Name --}}
                        <div class="mb-4 row align-items-center">
                            <label for="name" class="form-label col-sm-3 col-form-label">Name</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    id="name" name="name" placeholder="Enter promo name"
                                    value="{{ old('name') }}">
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- Promo Banner --}}
                        <div class="mb-4 row align-items-center">
                            <label for="banner" class="form-label col-sm-3 col-form-label">Banner</label>
                            <div class="col-sm-12">
                                <input type="file" class="form-control @error('banner') is-invalid @enderror"
                                    id="banner" name="banner" placeholder="Enter promo banner"
                                    value="{{ old('banner') }}">
                                @error('banner')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- Start date --}}
                        <div class="mb-4 row align-items-center">
                            <label for="start_date" class="form-label col-sm-3 col-form-label">Start date</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control @error('start_date') is-invalid @enderror"
                                    id="start_date" name="start_date" placeholder="Enter start date promo"
                                    value="{{ old('start_date') }}">
                                @error('start_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- End date --}}
                        <div class="mb-4 row align-items-center">
                            <label for="end_date" class="form-label col-sm-3 col-form-label">End date</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control @error('end_date') is-invalid @enderror"
                                    id="end_date" name="end_date" placeholder="Enter end date promo"
                                    value="{{ old('end_date') }}">
                                @error('end_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- Promo Description --}}
                        <div class="mb-4 row align-items-center">
                            <label for="description" class="form-label col-sm-3 col-form-label">Description</label>
                            <div class="col-sm-12">
                                <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror"
                                    rows="10" id="description" name="description" placeholder="Enter promo description">{{ old('description') }}</textarea>
                                @error('description')
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
    <script src="{{ asset('assets/backend/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('assets/backend/js/select2.min.js') }}"></script>
    <script>
        flatpickr("#start_date, #end_date", {
            dateFormat: "Y-m-d",
            altInput: true,
            altFormat: "F j, Y",
        });

        $("#tenantId").select2({
            placeholder: "Select a tenant",
            allowClear: true,
        });
    </script>
@endpush
