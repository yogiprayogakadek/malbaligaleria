@extends('templates.backend.master')

@section('page-title', 'Edit Job Vacancy')
@section('page-link', route('admin.career.vacancy.edit', $vacancy->uuid))

@section('content')
    <div class="row justify-content-center">
        <div class="col-12 col-xl-10">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="mb-0">Edit Vacancy</h5>
                        <p class="text-muted small mb-0">{{ $vacancy->title }} — {{ $vacancy->department }}</p>
                    </div>
                    <a href="{{ route('admin.career.vacancy.index') }}" class="btn btn-outline-secondary btn-sm">
                        <i class="ti ti-arrow-left me-1"></i> Back
                    </a>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.career.vacancy.update', $vacancy->uuid) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="row g-3">
                            <div class="col-md-8">
                                <label for="title" class="form-label fw-semibold">Position Name <span class="text-danger">*</span></label>
                                <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror"
                                    value="{{ old('title', $vacancy->title) }}" required>
                                @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <div class="col-md-4">
                                <label for="type" class="form-label fw-semibold">Job Type <span class="text-danger">*</span></label>
                                <select name="type" id="type" class="form-select @error('type') is-invalid @enderror" required>
                                    <option value="full-time" {{ old('type', $vacancy->type) == 'full-time' ? 'selected' : '' }}>Full Time</option>
                                    <option value="part-time" {{ old('type', $vacancy->type) == 'part-time' ? 'selected' : '' }}>Part Time</option>
                                    <option value="contract" {{ old('type', $vacancy->type) == 'contract' ? 'selected' : '' }}>Contract</option>
                                    <option value="internship" {{ old('type', $vacancy->type) == 'internship' ? 'selected' : '' }}>Internship</option>
                                </select>
                                @error('type')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <div class="col-md-6">
                                <label for="department" class="form-label fw-semibold">Department <span class="text-danger">*</span></label>
                                <input type="text" name="department" id="department" class="form-control @error('department') is-invalid @enderror"
                                    value="{{ old('department', $vacancy->department) }}" required>
                                @error('department')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <div class="col-md-6">
                                <label for="location" class="form-label fw-semibold">Location <span class="text-danger">*</span></label>
                                <input type="text" name="location" id="location" class="form-control @error('location') is-invalid @enderror"
                                    value="{{ old('location', $vacancy->location) }}" required>
                                @error('location')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <div class="col-md-4">
                                <label for="salary_range" class="form-label fw-semibold">Salary Range <small class="text-muted">(optional)</small></label>
                                <input type="text" name="salary_range" id="salary_range" class="form-control @error('salary_range') is-invalid @enderror"
                                    value="{{ old('salary_range', $vacancy->salary_range) }}" placeholder="Example: Rp 4,000,000 – Rp 6,000,000">
                                @error('salary_range')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <div class="col-md-4">
                                <label for="deadline" class="form-label fw-semibold">Application Deadline <small class="text-muted">(optional)</small></label>
                                <input type="date" name="deadline" id="deadline" class="form-control @error('deadline') is-invalid @enderror"
                                    value="{{ old('deadline', $vacancy->deadline ? $vacancy->deadline->format('Y-m-d') : '') }}">
                                @error('deadline')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <div class="col-md-4">
                                <label for="closing_date" class="form-label fw-semibold">Closing Date <small class="text-muted">(optional)</small></label>
                                <input type="date" name="closing_date" id="closing_date" class="form-control @error('closing_date') is-invalid @enderror"
                                    value="{{ old('closing_date', $vacancy->closing_date ? $vacancy->closing_date->format('Y-m-d') : '') }}">
                                @error('closing_date')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <div class="col-12">
                                <label for="description" class="form-label fw-semibold">Job Description <span class="text-danger">*</span></label>
                                <textarea name="description" id="description" rows="5"
                                    class="form-control @error('description') is-invalid @enderror" placeholder="Write job description (one per line)..." required>{{ old('description', $vacancy->description) }}</textarea>
                                @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <div class="col-12">
                                <label for="requirements" class="form-label fw-semibold">Required Qualifications <span class="text-danger">*</span></label>
                                <textarea name="requirements" id="requirements" rows="5"
                                    class="form-control @error('requirements') is-invalid @enderror" placeholder="Write qualifications (one per line)..." required>{{ old('requirements', $vacancy->requirements) }}</textarea>
                                @error('requirements')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <div class="col-12">
                                <label for="responsibilities" class="form-label fw-semibold">Responsibilities <small class="text-muted">(optional)</small></label>
                                <textarea name="responsibilities" id="responsibilities" rows="5"
                                    class="form-control @error('responsibilities') is-invalid @enderror" placeholder="Write responsibilities (one per line)...">{{ old('responsibilities', $vacancy->responsibilities) }}</textarea>
                                @error('responsibilities')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <div class="col-md-6">
                                <label for="sort_order" class="form-label fw-semibold">Display Order</label>
                                <input type="number" name="sort_order" id="sort_order" class="form-control"
                                    value="{{ old('sort_order', $vacancy->sort_order) }}" min="0">
                            </div>

                            <div class="col-md-6 d-flex align-items-end">
                                <div class="form-check form-switch mb-2">
                                    <input class="form-check-input" type="checkbox" name="is_active" id="is_active"
                                        value="1" {{ old('is_active', $vacancy->is_active) ? 'checked' : '' }}>
                                    <label class="form-check-label fw-semibold" for="is_active">Activate Vacancy</label>
                                </div>
                            </div>
                        </div>

                        <hr class="my-4">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <span class="text-muted small">
                                    <i class="ti ti-users me-1"></i>
                                    {{ $vacancy->applications_count ?? $vacancy->applications()->count() }} applicants for this position
                                </span>
                            </div>
                            <div class="d-flex gap-2">
                                <a href="{{ route('admin.career.vacancy.index') }}" class="btn btn-outline-secondary">Batal</a>
                                <button type="submit" class="btn btn-primary px-4">
                                    <i class="ti ti-check me-1"></i> Simpan Perubahan
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
