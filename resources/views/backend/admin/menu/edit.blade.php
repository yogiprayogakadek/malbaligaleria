@extends('templates.backend.master')

@section('page-title', 'Edit Frontend Menu - ' . $menu->name)
@section('page-link', route('admin.menu.index'))

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin.menu.update', $menu->id) }}" method="POST">
                        @method('PUT')
                        @csrf

                        {{-- Menu Name (Read-Only) --}}
                        <div class="mb-4 row align-items-center">
                            <label for="name" class="form-label col-sm-3 col-form-label">Menu Name</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="name" value="{{ $menu->name }}" readonly>
                                <small class="text-muted">The display name of the menu on the frontend.</small>
                            </div>
                        </div>

                        {{-- URL / Route (Read-Only) --}}
                        <div class="mb-4 row align-items-center">
                            <label for="url" class="form-label col-sm-3 col-form-label">URL / Path</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="url" value="{{ $menu->url }}" readonly>
                                <small class="text-muted">The destination path/anchor link.</small>
                            </div>
                        </div>

                        {{-- Active Status --}}
                        <div class="mb-4 row align-items-center">
                            <label for="is_active" class="form-label col-sm-3 col-form-label">Active Status</label>
                            <div class="col-sm-9">
                                <select class="form-control @error('is_active') is-invalid @enderror" id="is_active" name="is_active">
                                    <option value="1" {{ old('is_active', $menu->is_active) ? 'selected' : '' }}>Active (Visible if permissions match)</option>
                                    <option value="0" {{ !old('is_active', $menu->is_active) ? 'selected' : '' }}>Inactive (Hidden completely)</option>
                                </select>
                                @error('is_active')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- Role Visibility (Checkboxes) --}}
                        <div class="mb-4 row">
                            <label class="form-label col-sm-3 col-form-label">Allowed Roles</label>
                            <div class="col-sm-9">
                                <div class="mb-2">
                                    <small class="text-muted d-block mb-2">Select which user roles are allowed to see this menu item. If no roles are checked, the menu item will be visible to everyone (guests and logged-in users).</small>
                                </div>
                                @foreach ($roles as $role)
                                    <div class="form-check form-check-inline mb-2">
                                        <input class="form-check-input @error('roles') is-invalid @enderror" 
                                               type="checkbox" 
                                               name="roles[]" 
                                               id="role_{{ $role->id }}" 
                                               value="{{ $role->name }}"
                                               {{ is_array(old('roles', $menu->roles)) && in_array($role->name, old('roles', $menu->roles)) ? 'checked' : '' }}>
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

                        {{-- Action Buttons --}}
                        <div class="row">
                            <div class="col-sm-3"></div>
                            <div class="col-sm-9">
                                <button type="submit" class="btn btn-primary me-2">Save Changes</button>
                                <a href="{{ route('admin.menu.index') }}" class="btn btn-danger-subtle text-danger">Cancel</a>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
