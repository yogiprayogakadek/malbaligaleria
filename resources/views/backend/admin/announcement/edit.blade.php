@extends('templates.backend.master')

@section('page-title', 'Edit Announcement')
@section('page-link', route('admin.announcement.edit', $announcement->id))

@push('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" href="{{ asset('assets/backend/css/select2.css') }}">
    <style>
        .ck-editor__editable {
            min-height: 200px;
        }
        /* Custom Select2 invalid styling to match Bootstrap 5 */
        .select2-container--default .select2-selection--multiple {
            border-color: #dee2e6;
            min-height: 38px;
        }
        .is-invalid + .select2-container .select2-selection--multiple {
            border-color: #dc3545;
        }
    </style>
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

                        {{-- Target Page --}}
                        <div class="mb-4 row">
                            <label for="target_page" class="form-label col-sm-3 col-form-label">Target Display Page</label>
                            <div class="col-sm-12">
                                <select name="target_page[]" id="target_page" class="form-select @error('target_page') is-invalid @enderror" multiple required>
                                    <option value="all" {{ is_array(old('target_page', $announcement->target_page)) && in_array('all', old('target_page', $announcement->target_page)) ? 'selected' : '' }}>All Pages</option>
                                    <option value="homepage" {{ is_array(old('target_page', $announcement->target_page)) && in_array('homepage', old('target_page', $announcement->target_page)) ? 'selected' : '' }}>Homepage Only (Landing 2)</option>
                                    <option value="directory" {{ is_array(old('target_page', $announcement->target_page)) && in_array('directory', old('target_page', $announcement->target_page)) ? 'selected' : '' }}>Directory List Page</option>
                                    <option value="promo" {{ is_array(old('target_page', $announcement->target_page)) && in_array('promo', old('target_page', $announcement->target_page)) ? 'selected' : '' }}>Promotion Pages</option>
                                    <option value="new_store" {{ is_array(old('target_page', $announcement->target_page)) && in_array('new_store', old('target_page', $announcement->target_page)) ? 'selected' : '' }}>New Store Page</option>
                                    <option value="event" {{ is_array(old('target_page', $announcement->target_page)) && in_array('event', old('target_page', $announcement->target_page)) ? 'selected' : '' }}>Event Pages</option>
                                    <option value="career" {{ is_array(old('target_page', $announcement->target_page)) && in_array('career', old('target_page', $announcement->target_page)) ? 'selected' : '' }}>Career Pages</option>
                                    <option value="gallery" {{ is_array(old('target_page', $announcement->target_page)) && in_array('gallery', old('target_page', $announcement->target_page)) ? 'selected' : '' }}>Gallery Page</option>
                                </select>
                                <span class="form-text text-muted">You can select one or more pages. If "All Pages" is selected, the announcement will be active globally.</span>
                                @error('target_page')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- Display Frequency --}}
                        <div class="mb-4 row">
                            <label for="frequency" class="form-label col-sm-3 col-form-label">Display Frequency</label>
                            <div class="col-sm-12">
                                <select name="frequency" id="frequency" class="form-select @error('frequency', $announcement->frequency ?? 'always') is-invalid @enderror" required>
                                    <option value="always" {{ old('frequency', $announcement->frequency ?? 'always') == 'always' ? 'selected' : '' }}>Always Show (Every Page Load)</option>
                                    <option value="once_session" {{ old('frequency', $announcement->frequency ?? 'always') == 'once_session' ? 'selected' : '' }}>Once per Browser Session</option>
                                    <option value="once_day" {{ old('frequency', $announcement->frequency ?? 'always') == 'once_day' ? 'selected' : '' }}>Once per Day (24 Hours)</option>
                                    <option value="once_week" {{ old('frequency', $announcement->frequency ?? 'always') == 'once_week' ? 'selected' : '' }}>Once per Week (7 Days)</option>
                                </select>
                                @error('frequency')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- Date Configuration Type --}}
                        <div class="mb-4 row">
                            <label for="date_type" class="form-label col-sm-3 col-form-label">Date Schedule Type</label>
                            <div class="col-sm-12">
                                <select name="date_type" id="date_type" class="form-select @error('date_type') is-invalid @enderror" required>
                                    <option value="range" {{ old('date_type', !empty($announcement->active_dates) ? 'multiple' : 'range') == 'range' ? 'selected' : '' }}>Date Range (Rentang Tanggal)</option>
                                    <option value="multiple" {{ old('date_type', !empty($announcement->active_dates) ? 'multiple' : 'range') == 'multiple' ? 'selected' : '' }}>Specific Dates (Beberapa Tanggal Pilihan)</option>
                                </select>
                                @error('date_type')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- Range Dates Group --}}
                        <div id="range-dates-group">
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
                        </div>

                        {{-- Multiple Dates Group --}}
                        <div id="multiple-dates-group" style="display: none;">
                            <div class="mb-4 row">
                                <label class="form-label col-sm-3 col-form-label">Select Active Dates / Ranges</label>
                                <div class="col-sm-12">
                                    <div id="date-ranges-container">
                                        @if(!empty($announcement->active_dates) && is_array($announcement->active_dates))
                                            @foreach($announcement->active_dates as $index => $range)
                                                @php
                                                    $val = '';
                                                    if (is_array($range) && isset($range['start']) && isset($range['end'])) {
                                                        $val = $range['start'] === $range['end'] ? $range['start'] : ($range['start'] . ' to ' . $range['end']);
                                                    } elseif (is_string($range)) {
                                                        $val = $range;
                                                    }
                                                @endphp
                                                <div class="date-range-row d-flex align-items-center mb-2">
                                                    <input type="text" name="active_date_ranges[]" class="form-control flatpickr-range me-2" placeholder="Select date range" value="{{ $val }}" required>
                                                    <button type="button" class="btn btn-danger btn-remove-date-range">
                                                        <i class="ti ti-trash"></i>
                                                    </button>
                                                </div>
                                            @endforeach
                                        @else
                                            <div class="date-range-row d-flex align-items-center mb-2">
                                                <input type="text" name="active_date_ranges[]" class="form-control flatpickr-range me-2" placeholder="Select date range" required>
                                                <button type="button" class="btn btn-danger btn-remove-date-range" style="display: none;">
                                                    <i class="ti ti-trash"></i>
                                                </button>
                                            </div>
                                        @endif
                                    </div>
                                    <button type="button" class="btn btn-sm btn-secondary mt-2" id="btn-add-date-range">
                                        <i class="ti ti-plus"></i> Add Date / Range
                                    </button>
                                    <div class="form-text text-muted">Click start date and end date on calendar. Click twice for a single day. You can add multiple date ranges.</div>
                                    @error('active_date_ranges')
                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        {{-- Display Hours --}}
                        <div class="mb-4 row">
                            <label class="form-label col-sm-3 col-form-label">Daily Display Hours (Optional)</label>
                            <div class="col-sm-12">
                                <div class="row">
                                    <div class="col-6">
                                        <label for="start_time" class="form-label small text-muted">Start Time</label>
                                        <input type="text" class="form-control @error('start_time') is-invalid @enderror"
                                            id="start_time" name="start_time" placeholder="HH:MM"
                                            value="{{ old('start_time', $announcement->start_time ? date('H:i', strtotime($announcement->start_time)) : '') }}">
                                        @error('start_time')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-6">
                                        <label for="end_time" class="form-label small text-muted">End Time</label>
                                        <input type="text" class="form-control @error('end_time') is-invalid @enderror"
                                            id="end_time" name="end_time" placeholder="HH:MM"
                                            value="{{ old('end_time', $announcement->end_time ? date('H:i', strtotime($announcement->end_time)) : '') }}">
                                        @error('end_time')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <span class="form-text text-muted">Specify the daily active time window (e.g. 10:00 to 22:00). Leave empty to display all day.</span>
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

                        {{-- Submit & Preview --}}
                        <div class="col-12 mt-4 d-flex justify-content-end gap-2">
                            <button type="button" class="btn btn-info hstack gap-2" id="btn-preview">
                                <i class="ti ti-eye fs-4"></i> Preview
                            </button>
                            <button type="submit" class="btn btn-primary hstack gap-2">
                                <i class="ti ti-send fs-4"></i> Update
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Announcement Preview Modal -->
    <div id="announcementPreviewModal" class="announcement-modal-overlay" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.6); z-index: 10000; align-items: center; justify-content: center; font-family: 'Plus Jakarta Sans', Montserrat, sans-serif; padding: 20px; box-sizing: border-box; backdrop-filter: blur(4px); transition: all 0.3s ease-in-out;">
        <div class="announcement-modal-content" style="background: #fff; width: 100%; max-width: 600px; border-radius: 16px; overflow: hidden; box-shadow: 0 15px 30px rgba(0,0,0,0.3); display: flex; flex-direction: column; max-height: 90vh;">
            <!-- Header -->
            <div id="previewHeader" style="background: #0d6efd; color: #fff; padding: 20px; display: flex; justify-content: space-between; align-items: center;">
                <h5 id="previewTitle" style="margin: 0; font-size: 18px; font-weight: 700;">Announcement Preview</h5>
                <button type="button" onclick="closeAnnouncementPreviewModal()" style="background: transparent; border: none; color: inherit; font-size: 24px; cursor: pointer; line-height: 1; padding: 0 5px; opacity: 0.8;">&times;</button>
            </div>
            <!-- Body -->
            <div style="padding: 24px; overflow-y: auto; flex: 1;">
                <div id="previewImageWrapper" style="margin-bottom: 20px; text-align: center; border-radius: 8px; overflow: hidden; display: none;">
                    <img id="previewImage" src="" alt="Announcement" style="max-width: 100%; height: auto; display: block; margin: 0 auto; box-shadow: 0 4px 12px rgba(0,0,0,0.1);">
                </div>
                <div id="previewMessage" class="announcement-content" style="font-size: 15px; line-height: 1.6; color: #4a5568;">
                    Announcement message goes here...
                </div>
            </div>
            <!-- Footer -->
            <div style="padding: 16px 24px; border-top: 1px solid #edf2f7; display: flex; align-items: center; justify-content: space-between; background: #f7fafc;">
                <!-- Left side: Don't show again checkbox (disabled in preview) -->
                <div style="display: flex; align-items: center;">
                    <input type="checkbox" style="width: 16px; height: 16px; margin-right: 8px;" disabled>
                    <span style="font-size: 13px; color: #a0aec0; user-select: none;">Jangan tampilkan lagi</span>
                </div>
                <!-- Right side: CTA & Close button -->
                <div style="display: flex; gap: 12px; align-items: center;">
                    <a id="previewLinkBtn" href="#" target="_blank" style="background: #0d6efd; color: #fff; text-decoration: none; padding: 10px 20px; border-radius: 8px; font-weight: 600; font-size: 14px; display: none; align-items: center; justify-content: center;">
                        Kunjungi Tautan
                    </a>
                    <button type="button" onclick="closeAnnouncementPreviewModal()" style="background: #4a5568; color: #fff; border: none; padding: 10px 20px; border-radius: 8px; font-weight: 600; cursor: pointer; font-size: 14px;">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Preview Modal CSS styles for lists -->
    <style>
        .announcement-content p { margin-bottom: 12px; }
        .announcement-content ul, .announcement-content ol { padding-left: 20px; margin-bottom: 12px; }
        .announcement-content ul { list-style-type: disc !important; }
        .announcement-content ol { list-style-type: decimal !important; }
        .announcement-content blockquote { border-left: 4px solid #cbd5e1; padding-left: 12px; color: #64748b; font-style: italic; margin-bottom: 12px; }
        .announcement-content a { color: #0d6efd; text-decoration: underline; }
    </style>
@endsection

@push('script')
    <script src="{{ asset('assets/backend/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('assets/backend/js/select2.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>
    <script>
        function closeAnnouncementPreviewModal() {
            var modal = document.getElementById('announcementPreviewModal');
            if (modal) {
                modal.style.display = 'none';
            }
        }

        // Close preview modal on overlay click
        window.addEventListener('click', function(e) {
            var modal = document.getElementById('announcementPreviewModal');
            if (e.target === modal) {
                closeAnnouncementPreviewModal();
            }
        });

        $(document).ready(function() {
            // Initialize Select2 for multiple pages selection
            $('#target_page').select2({
                placeholder: "Select target display pages",
                allowClear: true
            });

            // Prevent selecting other options when 'all' is selected
            $('#target_page').on('change', function() {
                var selected = $(this).val();
                if (selected && selected.includes('all') && selected.length > 1) {
                    $(this).val(['all']).trigger('change.select2');
                }
            });

            // Initialize Flatpickr for range dates
            flatpickr("#start_date, #end_date", {
                enableTime: true,
                dateFormat: "Y-m-d H:i:S",
                altInput: true,
                altFormat: "F j, Y H:i",
            });

            // Initialize Flatpickr for start_time & end_time
            flatpickr("#start_time, #end_time", {
                enableTime: true,
                noCalendar: true,
                dateFormat: "H:i",
                time_24hr: true
            });

            // Initialize Flatpickr range helper
            function initFlatpickrRange(element) {
                flatpickr(element, {
                    mode: "range",
                    dateFormat: "Y-m-d",
                    altInput: true,
                    altFormat: "F j, Y",
                    conjunction: " to "
                });
            }

            // Initialize on existing range input
            $('.flatpickr-range').each(function() {
                initFlatpickrRange(this);
            });

            // Add date range row
            $('#btn-add-date-range').on('click', function() {
                var rowHtml = `
                    <div class="date-range-row d-flex align-items-center mb-2 animate__animated animate__fadeIn">
                        <input type="text" name="active_date_ranges[]" class="form-control flatpickr-range me-2" placeholder="Select date range" required>
                        <button type="button" class="btn btn-danger btn-remove-date-range">
                            <i class="ti ti-trash"></i>
                        </button>
                    </div>
                `;
                var $row = $(rowHtml);
                $('#date-ranges-container').append($row);
                initFlatpickrRange($row.find('.flatpickr-range')[0]);
                toggleDeleteButtons();
            });

            // Remove date range row
            $(document).on('click', '.btn-remove-date-range', function() {
                $(this).closest('.date-range-row').remove();
                toggleDeleteButtons();
            });

            function toggleDeleteButtons() {
                var rows = $('#date-ranges-container .date-range-row');
                if (rows.length <= 1) {
                    rows.find('.btn-remove-date-range').hide();
                } else {
                    rows.find('.btn-remove-date-range').show();
                }
            }
            toggleDeleteButtons();

            // Date Type Toggle Functionality
            function toggleDateFields() {
                var dateType = $('#date_type').val();
                if (dateType === 'range') {
                    $('#range-dates-group').show();
                    $('#multiple-dates-group').hide();
                } else {
                    $('#range-dates-group').hide();
                    $('#multiple-dates-group').show();
                }
            }

            $('#date_type').on('change', toggleDateFields);
            toggleDateFields(); // Run on page load/old input restoration

            var editorInstance = CKEDITOR.replace('message', {
                allowedContent: true, // Allow all HTML tags like iconify-icon
                height: 250,
                toolbar: [
                    { name: 'document', items: [ 'Source' ] },
                    { name: 'basicstyles', items: [ 'Bold', 'Italic', 'Underline', 'Strike', '-', 'RemoveFormat' ] },
                    { name: 'paragraph', items: [ 'NumberedList', 'BulletedList', '-', 'Blockquote' ] },
                    { name: 'links', items: [ 'Link', 'Unlink' ] },
                    { name: 'undo', items: [ 'Undo', 'Redo' ] }
                ]
            });

            // Live Preview Click Handler
            $('#btn-preview').on('click', function() {
                var title = $('#title').val() || 'Preview Title';
                var type = $('#type').val() || 'info';
                var link = $('#link').val();
                
                // Get CKEditor message
                var message = editorInstance ? editorInstance.getData() : $('#message').val();

                // Colors mapping
                var bgColors = {
                    danger: '#dc3545',
                    warning: '#ffc107',
                    success: '#198754',
                    primary: '#c9a96e',
                    info: '#0d6efd'
                };
                var textColors = {
                    danger: '#ffffff',
                    warning: '#212529',
                    success: '#ffffff',
                    primary: '#ffffff',
                    info: '#ffffff'
                };

                var bgColor = bgColors[type] || bgColors.info;
                var textColor = textColors[type] || textColors.info;

                // Update preview elements
                $('#previewTitle').text(title);
                $('#previewHeader').css({
                    background: bgColor,
                    color: textColor
                });
                $('#previewHeader button').css('color', textColor);
                $('#previewMessage').html(message || '<p style="color:#a0aec0; font-style:italic;">No detailed message entered.</p>');

                // Link button
                if (link) {
                    $('#previewLinkBtn').attr('href', link).css({
                        background: bgColor,
                        color: textColor,
                        display: 'inline-flex'
                    });
                } else {
                    $('#previewLinkBtn').hide();
                }

                // Image preview
                var imageInput = document.getElementById('image');
                if (imageInput && imageInput.files && imageInput.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $('#previewImage').attr('src', e.target.result);
                        $('#previewImageWrapper').show();
                        // Open modal
                        $('#announcementPreviewModal').css('display', 'flex');
                    };
                    reader.readAsDataURL(imageInput.files[0]);
                } else {
                    // Check if edit view has existing image preview
                    var existingImg = $('.img-thumbnail').attr('src');
                    if (existingImg) {
                        $('#previewImage').attr('src', existingImg);
                        $('#previewImageWrapper').show();
                    } else {
                        $('#previewImageWrapper').hide();
                    }
                    // Open modal
                    $('#announcementPreviewModal').css('display', 'flex');
                }
            });
        });
    </script>
@endpush
