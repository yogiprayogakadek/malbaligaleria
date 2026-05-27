@extends('templates.backend.master')

@section('page-title', 'Create Announcement')
@section('page-link', route('admin.announcement.create'))

@push('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <style>
        .ck-editor__editable {
            min-height: 200px;
        }
    </style>
@endpush

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin.announcement.store') }}" method="POST" enctype="multipart/form-data"
                        id="form">
                        @csrf

                        {{-- Title --}}
                        <div class="mb-4 row">
                            <label for="title" class="form-label col-sm-3 col-form-labelfw-bold">Title (Short Text for Banner)</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control @error('title') is-invalid @enderror"
                                    id="title" name="title" placeholder="Enter announcement title"
                                    value="{{ old('title') }}" required>
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
                                    <option value="info" {{ old('type') == 'info' ? 'selected' : '' }}>Info (Blue)</option>
                                    <option value="warning" {{ old('type') == 'warning' ? 'selected' : '' }}>Warning (Yellow)</option>
                                    <option value="danger" {{ old('type') == 'danger' ? 'selected' : '' }}>Danger (Red)</option>
                                    <option value="success" {{ old('type') == 'success' ? 'selected' : '' }}>Success (Green)</option>
                                    <option value="primary" {{ old('type') == 'primary' ? 'selected' : '' }}>Primary (Gold/Theme)</option>
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
                                <select name="target_page" id="target_page" class="form-select @error('target_page') is-invalid @enderror" required>
                                    <option value="all" {{ old('target_page') == 'all' ? 'selected' : '' }}>All Pages</option>
                                    <option value="homepage" {{ old('target_page') == 'homepage' ? 'selected' : '' }}>Homepage Only (Landing 2)</option>
                                    <option value="career" {{ old('target_page') == 'career' ? 'selected' : '' }}>Career Pages</option>
                                    <option value="promo" {{ old('target_page') == 'promo' ? 'selected' : '' }}>Promotion Pages</option>
                                    <option value="event" {{ old('target_page') == 'event' ? 'selected' : '' }}>Event Pages</option>
                                </select>
                                @error('target_page')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- Display Frequency --}}
                        <div class="mb-4 row">
                            <label for="frequency" class="form-label col-sm-3 col-form-label">Display Frequency</label>
                            <div class="col-sm-12">
                                <select name="frequency" id="frequency" class="form-select @error('frequency') is-invalid @enderror" required>
                                    <option value="always" {{ old('frequency') == 'always' ? 'selected' : '' }}>Always Show (Every Page Load)</option>
                                    <option value="once_session" {{ old('frequency') == 'once_session' ? 'selected' : '' }}>Once per Browser Session</option>
                                    <option value="once_day" {{ old('frequency') == 'once_day' ? 'selected' : '' }}>Once per Day (24 Hours)</option>
                                    <option value="once_week" {{ old('frequency') == 'once_week' ? 'selected' : '' }}>Once per Week (7 Days)</option>
                                </select>
                                @error('frequency')
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
                                    value="{{ old('start_date') }}">
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
                                    value="{{ old('end_date') }}">
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
                                    value="{{ old('link') }}">
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
                                <input type="file" class="form-control @error('image') is-invalid @enderror"
                                    id="image" name="image" accept="image/*">
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
                                    rows="6" placeholder="Enter detailed message to show inside the details modal popup...">{{ old('message') }}</textarea>
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
                                    <option value="1" {{ old('is_active', '1') == '1' ? 'selected' : '' }}>Active</option>
                                    <option value="0" {{ old('is_active') == '0' ? 'selected' : '' }}>Inactive</option>
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
                                <i class="ti ti-send fs-4"></i> Submit
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
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
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
            flatpickr("#start_date, #end_date", {
                enableTime: true,
                dateFormat: "Y-m-d H:i:S",
                altInput: true,
                altFormat: "F j, Y H:i",
            });

            var editorInstance;
            ClassicEditor
                .create(document.querySelector('#message'), {
                    toolbar: [ 'heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote', 'undo', 'redo' ]
                })
                .then(editor => {
                    editorInstance = editor;
                })
                .catch(error => {
                    console.error(error);
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
                    $('#previewImageWrapper').hide();
                    // Open modal
                    $('#announcementPreviewModal').css('display', 'flex');
                }
            });
        });
    </script>
@endpush
