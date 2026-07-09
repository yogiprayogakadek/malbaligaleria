@extends('templates.backend.master')

@section('page-title', 'Create Inventory Category')
@section('page-link', route('admin.inventory.categories.create'))

@section('content')
    <div class="row mb-4 align-items-center">
        <div class="col">
            <h4 class="mb-0 text-dark fw-bold">Create Category</h4>
            <p class="text-muted mb-0">Add a new category classification for assets</p>
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
                    <form action="{{ route('admin.inventory.categories.store') }}" method="POST">
                        @csrf

                        <div class="mb-4">
                            <label for="name" class="form-label fw-semibold">Category Name <span class="text-danger">*</span></label>
                            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" placeholder="e.g. CCTV, Network Devices, Laptops" value="{{ old('name') }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="description" class="form-label fw-semibold">Description</label>
                            <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror" rows="4" placeholder="Brief explanation of what this category covers...">{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary px-4 hstack gap-2">
                                <i class="ti ti-send"></i> Save Category
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
