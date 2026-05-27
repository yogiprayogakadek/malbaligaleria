@extends('templates.backend.master')

@section('page-title', 'Edit Announcement')
@section('page-link', route('admin.announcement.edit', $announcement->id))

@push('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
@endpush

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin.announcement.update', $announcement->id) }}" method="POST" enctype="multipart/form-data"
                        id="form">
                        @csrf
                        @method('PUT')

                        {{-- Title --}}
                        <div class="mb-4 row">
                            <label for="title" class="form-label col-sm-3 col-form-label fw-bold">Title (Short Text for Banner)</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control @error('title') is-invalid @enderror"
                                    id="title" name="title" placeholder="Enter announcement title"
                                    value="{{ old('title', $announcement->title) }}" required>
                                @error('title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- Type --}}
                        <div class="mb-4 row">
                            <label for="type" class="form-label col-sm-3 col-form-label">Alert Type (Style)</label>
                            <div class="col-sm-12">
                                <select name="type" id="type" class="form-select @error('type') is-invalid @enderror" required>
                                    <option value="info" {{ old('type', $announcement->type) == 'info' ? 'selected' : '' }}>Info (Blue)</option>
                                    <option value="warning" {{ old('type', $announcement->type) == 'warning' ? 'selected' : '' }}>Warning (Yellow)</option>
                                    <option value="danger" {{ old('type', $announcement->type) == 'danger' ? 'selected' : '' }}>Danger (Red)</option>
                                    <option value="success" {{ old('type', $announcement->type) == 'success' ? 'selected' : '' }}>Success (Green)</option>
                                    <option value="primary" {{ old('type', $announcement->type) == 'primary' ? 'selected' : '' }}>Primary (Gold/Theme)</option>
                                </select>
                                @error('type')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- Start Date --}}
                        <div class="mb-4 row">
                            <label for="start_date" class="form-label col-sm-3 col-form-label">Start Date & Time (Optional)</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control @error('start_date') is-invalid @enderror"
                                    id="start_date" name="start_date" placeholder="Select start date & time"
                                    value="{{ old('start_date', $announcement->start_date ? $announcement->start_date->format('Y-m-d H:i:s') : '') }}">
                                @error('start_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- End Date --}}
                        <div class="mb-4 row">
                            <label for="end_date" class="form-label col-sm-3 col-form-label">End Date & Time (Optional)</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control @error('end_date') is-invalid @enderror"
                                    id="end_date" name="end_date" placeholder="Select end date & time"
                                    value="{{ old('end_date', $announcement->end_date ? $announcement->end_date->format('Y-m-d H:i:s') : '') }}">
                                @error('end_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- Link --}}
                        <div class="mb-4 row">
                            <label for="link" class="form-label col-sm-3 col-form-label">Redirect Link (Optional)</label>
                            <div class="col-sm-12">
                                <input type="url" class="form-control @error('link') is-invalid @enderror"
                                    id="link" name="link" placeholder="https://example.com/some-page"
                                    value="{{ old('link', $announcement->link) }}">
                                <div class="form-text text-muted">If filled, clicking the banner will open this link directly instead of showing details modal.</div>
                                @error('link')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- Image --}}
                        <div class="mb-4 row">
                            <label for="image" class="form-label col-sm-3 col-form-label">Popup Banner Image (Optional)</label>
                            <div class="col-sm-12">
                                @if ($announcement->image)
                                    <div class="mb-2">
                                        <img src="{{ asset('storage/' . $announcement->image) }}" alt="Announcement Image" class="img-thumbnail" style="max-height: 200px;">
                                    </div>
                                @endif
                                <input type="file" class="form-control @error('image') is-invalid @enderror"
                                    id="image" name="image" accept="image/*">
                                <div class="form-text text-muted">Leave empty to keep current image.</div>
                                @error('image')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- Compress Toggle --}}
                        <div class="mb-4 row">
                            <div class="col-sm-12">
                                <input type="hidden" name="compress_image_submitted" value="1">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" name="compress_image" id="compress_image" value="1" checked>
                                    <label class="form-check-label" for="compress_image">Compress image on upload</label>
                                </div>
                            </div>
                        </div>

                        {{-- Detailed Message --}}
                        <div class="mb-4 row">
                            <label for="message" class="form-label col-sm-3 col-form-label">Detailed Message / Announcement Content (Optional)</label>
                            <div class="col-sm-12">
                                <textarea name="message" id="message" class="form-control @error('message') is-invalid @enderror"
                                    rows="6" placeholder="Enter detailed message to show inside the details modal popup...">{{ old('message', $announcement->message) }}</textarea>
                                @error('message')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- Status --}}
                        <div class="mb-4 row">
                            <label for="is_active" class="form-label col-sm-3 col-form-label">Status</label>
                            <div class="col-sm-12">
                                <select name="is_active" id="is_active" class="form-select @error('is_active') is-invalid @enderror">
                                    <option value="1" {{ old('is_active', $announcement->is_active ? '1' : '0') == '1' ? 'selected' : '' }}>Active</option>
                                    <option value="0" {{ old('is_active', $announcement->is_active ? '1' : '0') == '0' ? 'selected' : '' }}>Inactive</option>
                                </select>
                                @error('is_active')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- Submit --}}
                        <div class="col-12 mt-4">
                            <button type="submit" class="btn btn-primary hstack gap-6 float-end">
                                <i class="ti ti-send fs-4 me-2"></i> Update
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        $(document).ready(function() {
            flatpickr("#start_date, #end_date", {
                enableTime: true,
                dateFormat: "Y-m-d H:i:S",
                altInput: true,
                altFormat: "F j, Y H:i",
            });
        });
    </script>
@endpush
