@extends('templates.backend.master')

@section('page-title', 'Add Frontend Menu')
@section('page-link', route('admin.menu.index'))

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin.menu.store') }}" method="POST">
                        @csrf

                        <div class="mb-4 row align-items-center">
                            <label for="name" class="form-label col-sm-3 col-form-label">Menu Name</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                                    name="name" value="{{ old('name') }}" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-4 row align-items-center">
                            <label for="url" class="form-label col-sm-3 col-form-label">URL / Path</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control @error('url') is-invalid @enderror" id="url"
                                    name="url" value="{{ old('url') }}" placeholder="https://example.com or /promotion" required>
                                <small class="text-muted">Use a full external URL (https://...), an internal path (/promotion), or an anchor (/#about).</small>
                                @error('url')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-4 row align-items-center">
                            <label for="order" class="form-label col-sm-3 col-form-label">Order</label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control @error('order') is-invalid @enderror" id="order"
                                    name="order" value="{{ old('order', $nextOrder) }}" min="0">
                                <small class="text-muted">Lower numbers appear first.</small>
                                @error('order')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-4 row align-items-center">
                            <label for="is_active" class="form-label col-sm-3 col-form-label">Active Status</label>
                            <div class="col-sm-9">
                                <select class="form-control @error('is_active') is-invalid @enderror" id="is_active" name="is_active">
                                    <option value="1" {{ old('is_active', '1') == '1' ? 'selected' : '' }}>Active (Visible if permissions match)</option>
                                    <option value="0" {{ old('is_active') == '0' ? 'selected' : '' }}>Inactive (Hidden completely)</option>
                                </select>
                                @error('is_active')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-4 row">
                            <label class="form-label col-sm-3 col-form-label">Allowed Roles</label>
                            <div class="col-sm-9">
                                <small class="text-muted d-block mb-2">If no roles are checked, the menu item is visible to everyone (guests and logged-in users).</small>
                                @foreach ($roles as $role)
                                    <div class="form-check form-check-inline mb-2">
                                        <input class="form-check-input @error('roles') is-invalid @enderror" type="checkbox"
                                            name="roles[]" id="role_{{ $role->id }}" value="{{ $role->name }}"
                                            {{ is_array(old('roles')) && in_array($role->name, old('roles')) ? 'checked' : '' }}>
                                        <label class="form-check-label text-capitalize" for="role_{{ $role->id }}">
                                            {{ $role->name }}
                                        </label>
                                    </div>
                                @endforeach
                                @error('roles')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-3"></div>
                            <div class="col-sm-9">
                                <button type="submit" class="btn btn-primary me-2">Create Menu</button>
                                <a href="{{ route('admin.menu.index') }}" class="btn btn-danger-subtle text-danger">Cancel</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
