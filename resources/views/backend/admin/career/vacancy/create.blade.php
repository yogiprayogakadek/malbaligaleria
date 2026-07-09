@extends('templates.backend.master')

@section('page-title', 'Add Job Vacancy')
@section('page-link', route('admin.career.vacancy.create'))

@section('content')
    <div class="row justify-content-center">
        <div class="col-12 col-xl-10">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="mb-0">Add New Vacancy</h5>
                        <p class="text-muted small mb-0">Fill in the details of the position to be opened</p>
                    </div>
                    <a href="{{ route('admin.career.vacancy.index') }}" class="btn btn-outline-secondary btn-sm">
                        <i class="ti ti-arrow-left me-1"></i> Back
                    </a>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.career.vacancy.store') }}" method="POST" id="vacancyForm" enctype="multipart/form-data">
                        @csrf

                        <div class="row g-3">
                            {{-- Posisi / Title --}}
                            <div class="col-md-6">
                                <label for="title" class="form-label fw-semibold">Position Name <span class="text-danger">*</span></label>
                                <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror"
                                    value="{{ old('title') }}" placeholder="Example: Marketing Staff" required>
                                @error('title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Slug --}}
                            <div class="col-md-6">
                                <label for="slug" class="form-label fw-semibold">Slug <span class="text-danger">*</span></label>
                                <input type="text" name="slug" id="slug" class="form-control @error('slug') is-invalid @enderror"
                                    value="{{ old('slug') }}" placeholder="Will be automatically generated" readonly required>
                                @error('slug')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Tipe --}}
                            <div class="col-md-4">
                                <label for="type" class="form-label fw-semibold">Job Type <span class="text-danger">*</span></label>
                                <select name="type" id="type" class="form-select @error('type') is-invalid @enderror" required>
                                    <option value="full-time" {{ old('type') == 'full-time' ? 'selected' : '' }}>Full Time</option>
                                    <option value="part-time" {{ old('type') == 'part-time' ? 'selected' : '' }}>Part Time</option>
                                    <option value="contract" {{ old('type') == 'contract' ? 'selected' : '' }}>Contract</option>
                                    <option value="internship" {{ old('type') == 'internship' ? 'selected' : '' }}>Internship</option>
                                </select>
                                @error('type')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Departemen --}}
                            <div class="col-md-6">
                                <label for="department" class="form-label fw-semibold">Department <span class="text-danger">*</span></label>
                                <input type="text" name="department" id="department" class="form-control @error('department') is-invalid @enderror"
                                    value="{{ old('department') }}" placeholder="Example: Marketing, IT, HR" required>
                                @error('department')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Lokasi --}}
                            <div class="col-md-6">
                                <label for="location" class="form-label fw-semibold">Location <span class="text-danger">*</span></label>
                                <input type="text" name="location" id="location" class="form-control @error('location') is-invalid @enderror"
                                    value="{{ old('location', 'Kuta, Bali') }}" placeholder="Kuta, Bali" required>
                                @error('location')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Rentang Gaji --}}
                            <div class="col-md-4">
                                <label for="salary_range" class="form-label fw-semibold">Salary Range <small class="text-muted">(optional)</small></label>
                                <input type="text" name="salary_range" id="salary_range" class="form-control @error('salary_range') is-invalid @enderror"
                                    value="{{ old('salary_range') }}" placeholder="Example: Rp 4,000,000 – Rp 6,000,000">
                                @error('salary_range')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Deadline --}}
                            <div class="col-md-4">
                                <label for="deadline" class="form-label fw-semibold">Application Deadline <small class="text-muted">(optional)</small></label>
                                <input type="date" name="deadline" id="deadline" class="form-control @error('deadline') is-invalid @enderror"
                                    value="{{ old('deadline') }}">
                                @error('deadline')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Closing Date --}}
                            <div class="col-md-4">
                                <label for="closing_date" class="form-label fw-semibold">Closing Date <small class="text-muted">(optional)</small></label>
                                <input type="date" name="closing_date" id="closing_date" class="form-control @error('closing_date') is-invalid @enderror"
                                    value="{{ old('closing_date') }}">
                                @error('closing_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Flyer --}}
                            <div class="col-md-8">
                                <label for="flyer" class="form-label fw-semibold">Vacancy Flyer <small class="text-muted">(optional, Image format)</small></label>
                                <input type="file" name="flyer" id="flyer" class="form-control @error('flyer') is-invalid @enderror">
                                @error('flyer')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Compression Toggle --}}
                            <div class="col-md-4 d-flex align-items-end">
                                <div class="mb-2 w-100">
                                    <input type="hidden" name="compress_image_submitted" value="1">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="compress_image" id="compress_image" value="1" checked>
                                        <label class="form-check-label fw-semibold" for="compress_image">Compress flyer image</label>
                                    </div>
                                </div>
                            </div>

                            {{-- Deskripsi --}}
                            <div class="col-12">
                                <label for="description" class="form-label fw-semibold">Job Description <span class="text-danger">*</span></label>
                                <textarea name="description" id="description" rows="5"
                                    class="form-control @error('description') is-invalid @enderror"
                                    placeholder="Write job description (one per line)..." required>{{ old('description') }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Kualifikasi/Requirements --}}
                            <div class="col-12">
                                <label for="requirements" class="form-label fw-semibold">Required Qualifications <span class="text-danger">*</span></label>
                                <textarea name="requirements" id="requirements" rows="5"
                                    class="form-control @error('requirements') is-invalid @enderror"
                                    placeholder="Write qualifications (one per line)..." required>{{ old('requirements') }}</textarea>
                                @error('requirements')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Tanggung Jawab --}}
                            <div class="col-12">
                                <label for="responsibilities" class="form-label fw-semibold">Responsibilities <small class="text-muted">(optional)</small></label>
                                <textarea name="responsibilities" id="responsibilities" rows="5"
                                    class="form-control @error('responsibilities') is-invalid @enderror"
                                    placeholder="Write responsibilities for this position (one per line)...">{{ old('responsibilities') }}</textarea>
                                @error('responsibilities')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Sort Order & Status --}}
                            <div class="col-md-6">
                                <label for="sort_order" class="form-label fw-semibold">Display Order</label>
                                <input type="number" name="sort_order" id="sort_order" class="form-control"
                                    value="{{ old('sort_order', 0) }}" min="0">
                                <div class="form-text">Smaller number = show earlier</div>
                            </div>

                            <div class="col-md-6 d-flex align-items-end">
                                <div class="form-check form-switch mb-2">
                                    <input class="form-check-input" type="checkbox" name="is_active" id="is_active"
                                        value="1" {{ old('is_active', 1) ? 'checked' : '' }}>
                                    <label class="form-check-label fw-semibold" for="is_active">
                                        Activate Vacancy
                                    </label>
                                </div>
                            </div>
                        </div>

                        <hr class="my-4">
                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('admin.career.vacancy.index') }}" class="btn btn-outline-secondary">
                                Cancel
                            </a>
                            <button type="submit" class="btn btn-primary px-4">
                                <i class="ti ti-check me-1"></i> Save Vacancy
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        $(document).ready(function() {
            $('#title').on('keyup change input', function() {
                let title = $(this).val();
                let slug = title.toLowerCase()
                    .replace(/[^a-z0-9\s-]/g, '') // remove invalid chars
                    .replace(/\s+/g, '-')         // collapse whitespace and replace by -
                    .replace(/-+/g, '-');         // collapse dashes
                $('#slug').val(slug);
            });
        });
    </script>
@endpush
