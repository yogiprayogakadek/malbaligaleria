@extends('templates.backend.master')

@section('page-title', 'Add New User')
@section('page-link', route('admin.user.index'))

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin.user.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        {{-- Name --}}
                        <div class="mb-4 row align-items-center">
                            <label for="name" class="form-label col-sm-3 col-form-label">Name</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    id="name" name="name" placeholder="Enter user name" value="{{ old('name') }}">
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- Email --}}
                        <div class="mb-4 row align-items-center">
                            <label for="email" class="form-label col-sm-3 col-form-label">Email</label>
                            <div class="col-sm-9">
                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                    id="email" name="email" placeholder="Enter user email" value="{{ old('email') }}">
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- Phone --}}
                        <div class="mb-4 row align-items-center">
                            <label for="phone" class="form-label col-sm-3 col-form-label">Phone</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control @error('phone') is-invalid @enderror"
                                    id="phone" name="phone" placeholder="Enter phone number" value="{{ old('phone') }}">
                                @error('phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- Tenant --}}
                        <div class="mb-4 row align-items-center">
                            <label for="tenant_id" class="form-label col-sm-3 col-form-label">Tenant</label>
                            <div class="col-sm-9">
                                <select class="form-control @error('tenant_id') is-invalid @enderror" id="tenant_id"
                                    name="tenant_id">
                                    <option value="">-- Select Tenant (Optional) --</option>
                                    @foreach ($tenants as $tenant)
                                        <option value="{{ $tenant->id }}"
                                            {{ old('tenant_id') == $tenant->id ? 'selected' : '' }}>
                                            {{ $tenant->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <small class="text-muted">Select a tenant if this user belongs to one.</small>
                                @error('tenant_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- Password --}}
                        <div class="mb-4 row align-items-center">
                            <label for="password" class="form-label col-sm-3 col-form-label">Password</label>
                            <div class="col-sm-9">
                                <input type="password" class="form-control @error('password') is-invalid @enderror"
                                    id="password" name="password" placeholder="Enter password (min. 8 characters)">
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- Confirm Password --}}
                        <div class="mb-4 row align-items-center">
                            <label for="password_confirmation" class="form-label col-sm-3 col-form-label">Confirm
                                Password</label>
                            <div class="col-sm-9">
                                <input type="password" class="form-control" id="password_confirmation"
                                    name="password_confirmation" placeholder="Confirm password">
                            </div>
                        </div>

                        {{-- Submit Button --}}
                        <div class="row">
                            <div class="col-sm-3"></div>
                            <div class="col-sm-9">
                                <button type="submit" class="btn btn-primary">
                                    <i class="ti ti-plus me-2"></i> Create User
                                </button>
                                <a href="{{ route('admin.user.index') }}" class="btn btn-danger-subtle text-danger">Cancel</a>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
