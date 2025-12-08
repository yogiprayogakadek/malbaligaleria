@extends('templates.backend.master')

@section('page-title', 'Create Tenant Photo')
@section('page-link', route('admin.tenant.photo.create'))

@push('css')
    <link rel="stylesheet" href="{{ asset('assets/backend/css/select2.css') }}">
@endpush

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin.tenant.photo.store') }}" method="POST" enctype="multipart/form-data"
                        id="form">
                        @csrf

                        {{-- Tenant ID --}}
                        <div class="mb-4 row align-items-center">
                            <label for="name" class="form-label col-sm-3 col-form-label">Tenant</label>
                            <div class="col-sm-12">
                                <select name="tenant_id" id="tenantId"
                                    class="form-control @error('tenant_id') is-invalid @enderror">
                                    <option value="">Select tenant...</option>
                                    @foreach ($tenants as $tenant)
                                        <option value="{{ $tenant->id }}"
                                            {{ old('tenant_id') == $tenant->id ? 'selected' : '' }}>{{ $tenant->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('tenant_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- Primary Image --}}
                        <div class="mb-4 row align-items-center">
                            <div class="row">
                                <div class="col-sm-8">
                                    <label for="path" class="form-label col-sm-3 col-form-label">Primary Display
                                        Image</label>
                                    <div class="col-sm-12">
                                        <input type="file" class="form-control @error('path') is-invalid @enderror"
                                            id="path" name="path" placeholder="Enter image path"
                                            value="{{ old('path') }}">
                                        @error('path')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <label for="caption" class="form-label col-sm-3 col-form-label">Caption</label>
                                    <input type="text" class="form-control @error('caption') is-invalid @enderror"
                                        id="caption" name="caption" placeholder="Enter image caption"
                                        value="{{ old('caption') }}">
                                    @error('caption')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
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
    <script src="{{ asset('assets/backend/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('assets/backend/js/select2.min.js') }}"></script>
    <script>
        $("#tenantId").select2({
            placeholder: "Select a tenant",
            allowClear: true,
        });
    </script>
@endpush
