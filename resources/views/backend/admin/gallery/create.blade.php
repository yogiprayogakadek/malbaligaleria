@extends('templates.backend.master')

@section('page-title', 'Create Gallery Photo')
@section('page-link', route('admin.gallery.create'))

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin.gallery.store') }}" method="POST" enctype="multipart/form-data" id="form">
                        @csrf

                        {{-- Image File --}}
                        <div class="mb-4 row align-items-center">
                            <label for="image_files" class="form-label col-sm-3 col-form-label">Upload Image(s)</label>
                            <div class="col-sm-12">
                                <input type="file" class="form-control @error('image_files') is-invalid @enderror @error('image_files.*') is-invalid @enderror"
                                    id="image_files" name="image_files[]" accept="image/*" multiple required>
                                <small class="text-muted d-block mt-1">You can select multiple images to perform a batch upload. File names will be used as default titles if custom title is not specified.</small>
                                @error('image_files')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                @error('image_files.*')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- Title --}}
                        <div class="mb-4 row align-items-center">
                            <label for="title" class="form-label col-sm-3 col-form-label">Title / Caption (Optional)</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control @error('title') is-invalid @enderror"
                                    id="title" name="title" placeholder="Enter photo title or caption"
                                    value="{{ old('title') }}">
                                @error('title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- Sort Order --}}
                        <div class="mb-4 row align-items-center">
                            <label for="sort_order" class="form-label col-sm-3 col-form-label">Sort Order (Optional)</label>
                            <div class="col-sm-12">
                                <input type="number" class="form-control @error('sort_order') is-invalid @enderror"
                                    id="sort_order" name="sort_order" placeholder="Leave empty to auto-increment from last value present"
                                    value="{{ old('sort_order') }}" min="0">
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
                                    <option value="1" {{ old('is_active', '1') == '1' ? 'selected' : '' }}>Active</option>
                                    <option value="0" {{ old('is_active') == '0' ? 'selected' : '' }}>Inactive</option>
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
