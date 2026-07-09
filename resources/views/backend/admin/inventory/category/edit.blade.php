@extends('templates.backend.master')

@section('page-title', 'Edit Inventory Category')
@section('page-link', route('admin.inventory.categories.edit', $category->id))

@section('content')
    <div class="row mb-4 align-items-center">
        <div class="col">
            <h4 class="mb-0 text-dark fw-bold">Edit Category: {{ $category->name }}</h4>
            <p class="text-muted mb-0">Modify category classification details</p>
        </div>
        <div class="col-auto">
            <a href="{{ route('admin.inventory.categories.index') }}" class="btn btn-outline-secondary hstack gap-2">
                <i class="ti ti-arrow-left fs-4"></i> Back to Categories
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin.inventory.categories.update', $category->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label for="name" class="form-label fw-semibold">Category Name <span class="text-danger">*</span></label>
                            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" placeholder="e.g. CCTV" value="{{ old('name', $category->name) }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="description" class="form-label fw-semibold">Description</label>
                            <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror" rows="4" placeholder="Brief description...">{{ old('description', $category->description) }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary px-4 hstack gap-2">
                                <i class="ti ti-device-floppy"></i> Save Changes
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
