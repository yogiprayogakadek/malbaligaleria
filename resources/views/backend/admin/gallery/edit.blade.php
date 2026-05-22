@extends('templates.backend.master')

@section('page-title', 'Edit Gallery Photo')
@section('page-link', route('admin.gallery.edit', $gallery->id))

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin.gallery.update', $gallery->id) }}" method="POST" enctype="multipart/form-data" id="form">
                        @method('PUT')
                        @csrf

                        {{-- Current Image Preview --}}
                        <div class="mb-4 row">
                            <label class="form-label col-sm-3 col-form-label">Current Image</label>
                            <div class="col-sm-12">
                                <div class="mb-2">
                                    <img src="{{ asset('storage/' . $gallery->path) }}" alt="{{ $gallery->title ?? 'Gallery Photo' }}" class="rounded shadow-sm" style="max-height: 200px;">
                                </div>
                            </div>
                        </div>

                        {{-- Image File --}}
                        <div class="mb-4 row align-items-center">
                            <label for="image_file" class="form-label col-sm-3 col-form-label">Replace Image (Optional)</label>
                            <div class="col-sm-12">
                                <input type="file" class="form-control @error('image_file') is-invalid @enderror"
                                    id="image_file" name="image_file" accept="image/*">
                                @error('image_file')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- Compress Checkbox --}}
                        <div class="mb-4 row align-items-center">
                            <div class="col-sm-12">
                                <input type="hidden" name="compress_image_submitted" value="1">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" name="compress_image" id="compress_image" value="1" checked>
                                    <label class="form-check-label" for="compress_image">Compress image on upload</label>
                                </div>
                            </div>
                        </div>

                        {{-- Title --}}
                        <div class="mb-4 row align-items-center">
                            <label for="title" class="form-label col-sm-3 col-form-label">Title / Caption (Optional)</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control @error('title') is-invalid @enderror"
                                    id="title" name="title" placeholder="Enter photo title or caption"
                                    value="{{ old('title', $gallery->title) }}">
                                @error('title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- Sort Order --}}
                        <div class="mb-4 row align-items-center">
                            <label for="sort_order" class="form-label col-sm-3 col-form-label">Sort Order</label>
                            <div class="col-sm-12">
                                <input type="number" class="form-control @error('sort_order') is-invalid @enderror"
                                    id="sort_order" name="sort_order" placeholder="Enter sort order (e.g. 0, 1, 2)"
                                    value="{{ old('sort_order', $gallery->sort_order) }}" min="0">
                                @error('sort_order')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- Status --}}
                        <div class="mb-4 row align-items-center">
                            <label for="is_active" class="form-label col-sm-3 col-form-label">Status</label>
                            <div class="col-sm-12">
                                <select name="is_active" id="is_active" class="form-control @error('is_active') is-invalid @enderror">
                                    <option value="1" {{ old('is_active', $gallery->is_active) == '1' ? 'selected' : '' }}>Active</option>
                                    <option value="0" {{ old('is_active', $gallery->is_active) == '0' ? 'selected' : '' }}>Inactive</option>
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
                            <a href="{{ route('admin.gallery.index') }}" class="btn btn-outline-secondary float-end me-2">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
