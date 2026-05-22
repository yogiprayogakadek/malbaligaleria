@extends('templates.backend.master')

@section('page-title', 'Create Tenant Photo')
@section('page-link', route('admin.tenant.photo.create'))

@push('css')
    <link rel="stylesheet" href="{{ asset('assets/backend/css/select2.css') }}">

    <link href="https://unpkg.com/filepond/dist/filepond.css" rel="stylesheet">
    <link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/backend/css/sweetalert2.min.css') }}">
    <style>
        .invalid-feedback {
            display: none;
            width: 100%;
            margin-top: 0.25rem;
            font-size: 0.875em;
            color: #fa896b;
        }

        .is-invalid~.invalid-feedback {
            display: block;
        }

        .tenant-select.is-invalid ~ .select2-container .select2-selection {
            border-color: #fa896b !important;
        }

        .rotate {
            animation: rotation 1s infinite linear;
        }

        @keyframes rotation {
            from {
                transform: rotate(0deg);
            }

            to {
                transform: rotate(360deg);
            }
        }
    </style>
@endpush

@section('content')
    @if (session('success'))
        <script>
            toastr.success(
                "{{ session('success') }}",
                "Success", {
                    showMethod: "slideDown",
                    hideMethod: "slideUp",
                    timeOut: 2000
                }
            );
        </script>
    @endif
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-primary-subtle">
                    <h4 class="card-title mb-0">Bulk Upload Tenant Photos</h4>
                </div>
                <div class="card-body">
                    <div class="mb-4 row align-items-end">
                        <div class="col-md-4">
                            <label class="form-label">Initial Row Count</label>
                            <input type="number" id="initialCount" class="form-control" value="5" min="1"
                                max="10">
                            <small class="text-muted">Max: 10 tenants per upload session</small>
                        </div>
                        <div class="col-md-2">
                            <button type="button" id="btnGenerate" class="btn btn-info w-100">
                                <i class="ti ti-list-numbers fs-4 me-1"></i> Generate
                            </button>
                        </div>
                        <div class="col-md-4 text-end">
                            <div class="alert alert-light-info d-inline-block py-2 px-3 mb-0 border">
                                <i class="ti ti-chart-pie fs-5 me-1"></i>
                                Total Size: <span id="totalUploadSize" class="fw-bold">0 KB</span>
                                <span class="text-muted ms-1">(Max Server: ~{{ ini_get('post_max_size') }})</span>
                            </div>
                        </div>
                    </div>

                    <form action="{{ route('admin.tenant.photo.bulk.store') }}" method="POST" enctype="multipart/form-data"
                        id="bulkForm">
                        @csrf

                        {{-- Compress Checkbox --}}
                        <div class="mb-3">
                            <input type="hidden" name="compress_image_submitted" value="1">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="compress_image" id="compress_image" value="1" checked>
                                <label class="form-check-label fw-bold" for="compress_image">Compress images on upload</label>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-bordered align-middle" id="bulkTable">
                                <thead class="table-light">
                                    <tr>
                                        <th width="50">No.</th>
                                        <th width="350">Tenant</th>
                                        <th>Photo</th>
                                        <th>Caption</th>
                                        <th width="50"></th>
                                    </tr>
                                </thead>
                                <tbody id="bulkTableBody">
                                </tbody>
                            </table>
                        </div>

                        <div class="d-flex justify-content-between align-items-center mt-3">
                            <button type="button" id="btnAddRow" class="btn btn-outline-primary">
                                <i class="ti ti-plus fs-4 me-1"></i> Add More Row
                            </button>

                            <button type="submit" class="btn btn-primary px-5">
                                <i class="ti ti-send fs-4 me-1"></i> Submit All Photos
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <template id="rowTemplate">
        <tr class="tenant-row">
            <td class="row-number text-center"></td>
            <td>
                <select name="id[]" class="form-control tenant-select">
                    <option value="">Search tenant...</option>
                    @foreach ($tenants as $tenant)
                        <option value="{{ $tenant->id }}">{{ $tenant->name }}</option>
                    @endforeach
                </select>
                <div class="invalid-feedback">Harap pilih tenant.</div>
            </td>
            <td>
                <input type="file" name="path[]" class="form-control tenant-photo-input" accept="image/*">
                <div class="invalid-feedback">Harap pilih foto untuk tenant ini.</div>
                <small class="text-muted file-size-info" style="display: none;"></small>
            </td>
            <td>
                <input type="text" name="caption[]" class="form-control" placeholder="Optional caption">
            </td>
            <td class="text-center">
                <button type="button" class="btn btn-sm btn-danger btn-remove-row">
                    <i class="ti ti-trash fs-4"></i>
                </button>
            </td>
        </tr>
    </template>
@endsection

@push('script')
    <script src="{{ asset('assets/backend/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('assets/backend/js/select2.min.js') }}"></script>
    <script src="{{ asset('assets/backend/js/sweetalert2.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            const $tableBody = $('#bulkTableBody');
            const $rowTemplate = $('#rowTemplate').html();
            const maxTenants = 10;

            function updateRowNumbers() {
                $tableBody.find('.row-number').each(function(index) {
                    $(this).text(index + 1);
                });
            }

            function initSelect2($select) {
                $select.select2({
                    placeholder: "Search tenant...",
                    allowClear: true,
                    width: '100%'
                });

                $select.on('change', function() {
                    const val = $(this).val();
                    if (val) {
                        $(this).removeClass('is-invalid');
                        $(this).siblings('.invalid-feedback').hide();
                    }
                    syncTenants();
                });
            }

            function syncTenants() {
                const selectedIds = [];
                $('.tenant-select').each(function() {
                    const val = $(this).val();
                    if (val) selectedIds.push(val);
                });

                $('.tenant-select').each(function() {
                    const $currentSelect = $(this);
                    const currentVal = $currentSelect.val();

                    $currentSelect.find('option').each(function() {
                        const optVal = $(this).val();
                        if (optVal && optVal !== currentVal) {
                            if (selectedIds.includes(optVal)) {
                                $(this).attr('disabled', 'disabled');
                            } else {
                                $(this).removeAttr('disabled');
                            }
                        }
                    });
                });

                // Refresh select2 to show disabled states
                $('.tenant-select').select2('destroy');
                $('.tenant-select').select2({
                    placeholder: "Search tenant...",
                    allowClear: true,
                    width: '100%'
                });
            }

            function addRow() {
                const currentCount = $tableBody.find('tr').length;
                if (currentCount >= maxTenants) {
                    Swal.fire('Limit Reached', 'You cannot add more rows than available tenants.', 'warning');
                    return;
                }

                const $newRow = $($rowTemplate);
                $tableBody.append($newRow);
                initSelect2($newRow.find('.tenant-select'));
                updateRowNumbers();
                syncTenants();
            }

            $('#btnGenerate').on('click', function() {
                const newCount = parseInt($('#initialCount').val());
                const currentCount = $tableBody.find('tr.tenant-row').length;

                if (isNaN(newCount) || newCount < 1) return;

                const targetCount = Math.min(newCount, maxTenants);

                if (targetCount > currentCount) {
                    const rowsToAdd = targetCount - currentCount;
                    for (let i = 0; i < rowsToAdd; i++) {
                        const $newRow = $($rowTemplate);
                        $tableBody.append($newRow);
                        initSelect2($newRow.find('.tenant-select'));
                    }
                    updateRowNumbers();
                    syncTenants();
                } else if (targetCount < currentCount) {
                    const rowsToDelete = currentCount - targetCount;
                    Swal.fire({
                        title: 'Apakah Anda yakin?',
                        text: `Tindakan ini akan menghapus ${rowsToDelete} baris terakhir yang sudah Anda buat. Data pada baris tersebut akan hilang.`,
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Ya, hapus!',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            for (let i = 0; i < rowsToDelete; i++) {
                                $tableBody.find('tr.tenant-row').last().remove();
                            }
                            updateRowNumbers();
                            syncTenants();
                        } else {
                            $('#initialCount').val(currentCount);
                        }
                    });
                }
            });

            $('#btnAddRow').on('click', function() {
                addRow();
            });


            $('#btnGenerate').trigger('click');

            $('#bulkForm').on('submit', function(e) {
                let isValid = true;
                $tableBody.find('tr.tenant-row').each(function() {
                    const $photoInput = $(this).find('input[name="path[]"]');
                    const $tenantSelect = $(this).find('select[name="id[]"]');

                    $photoInput.removeClass('is-invalid');
                    $tenantSelect.removeClass('is-invalid');
                    $(this).find('.invalid-feedback').hide();

                    if (!$photoInput.val()) {
                        $photoInput.addClass('is-invalid');
                        $photoInput.siblings('.invalid-feedback').text(
                            'Harap pilih foto untuk tenant ini.').show();
                        isValid = false;
                    }

                    if (!$tenantSelect.val()) {
                        $tenantSelect.addClass('is-invalid');
                        $tenantSelect.siblings('.invalid-feedback').text('Harap pilih tenant.').show();
                        isValid = false;
                    }
                });

                if (!isValid) {
                    e.preventDefault();
                    Swal.fire('Validasi Gagal', 'Beberapa field wajib belum diisi dengan benar.', 'error');
                } else {
                    e.preventDefault();
                    uploadWithProgress();
                }
            });

            function uploadWithProgress() {
                const formData = new FormData($('#bulkForm')[0]);
                const $submitBtn = $('#bulkForm button[type="submit"]');

                $submitBtn.prop('disabled', true).html('<i class="ti ti-loader-2 rotate fs-4 me-1"></i> Uploading...');

                Swal.fire({
                    title: 'Memproses Unggahan...',
                    html: `
                        <div class="progress mb-3" style="height: 25px;">
                            <div id="uploadProgressBar" class="progress-bar progress-bar-striped progress-bar-animated bg-primary" 
                                role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">0%</div>
                        </div>
                        <p id="uploadStatusText" class="text-muted mb-0">Menyiapkan data...</p>
                    `,
                    allowOutsideClick: false,
                    showConfirmButton: false,
                    didOpen: () => {
                        $.ajax({
                            url: $('#bulkForm').attr('action'),
                            type: 'POST',
                            data: formData,
                            processData: false,
                            contentType: false,
                            xhr: function() {
                                const xhr = new window.XMLHttpRequest();
                                xhr.upload.addEventListener("progress", function(evt) {
                                    if (evt.lengthComputable) {
                                        const percentComplete = Math.round((evt.loaded / evt.total) * 100);
                                        $('#uploadProgressBar').css('width', percentComplete + '%').attr('aria-valuenow', percentComplete).text(percentComplete + '%');
                                        
                                        if (percentComplete < 100) {
                                            $('#uploadStatusText').text('Mengunggah file (' + percentComplete + '%)');
                                        } else {
                                            $('#uploadStatusText').text('Menyimpan data di server...');
                                        }
                                    }
                                }, false);
                                return xhr;
                            },
                            success: function(response) {
                                Swal.close();
                                if (response.success) {
                                    Swal.fire({
                                        title: 'Berhasil!',
                                        text: response.message,
                                        icon: 'success',
                                        confirmButtonText: 'Lanjutkan'
                                    }).then(() => {
                                        window.location.href = response.redirect;
                                    });
                                } else {
                                    $submitBtn.prop('disabled', false).html('<i class="ti ti-send fs-4 me-1"></i> Submit All Photos');
                                    Swal.fire('Error', response.message || 'Terjadi kesalahan saat menyimpan data.', 'error');
                                }
                            },
                            error: function(xhr) {
                                Swal.close();
                                $submitBtn.prop('disabled', false).html('<i class="ti ti-send fs-4 me-1"></i> Submit All Photos');
                                
                                let errorMsg = 'Gagal mengunggah foto.';
                                if (xhr.status === 413) {
                                    errorMsg = 'Ukuran file terlalu besar untuk server Anda.';
                                } else if (xhr.responseJSON && xhr.responseJSON.message) {
                                    errorMsg = xhr.responseJSON.message;
                                }
                                
                                Swal.fire('Gagal!', errorMsg, 'error');
                            }
                        });
                    }
                });
            }

            function updateTotalSize() {
                let totalBytes = 0;
                $('input[name="path[]"]').each(function() {
                    const files = $(this)[0].files;
                    if (files && files.length > 0) {
                        totalBytes += files[0].size;
                        
                        // Update individual row size if needed (optional)
                        const sizeText = formatBytes(files[0].size);
                        $(this).siblings('.file-size-info').text(`Size: ${sizeText}`).show();
                    } else {
                        $(this).siblings('.file-size-info').hide();
                    }
                });

                $('#totalUploadSize').text(formatBytes(totalBytes));
                
                // Visual warning if total is getting large (example 50MB)
                if (totalBytes > 50 * 1024 * 1024) {
                    $('#totalUploadSize').removeClass('text-dark').addClass('text-danger');
                } else {
                    $('#totalUploadSize').removeClass('text-danger').addClass('text-dark');
                }
            }

            function formatBytes(bytes, decimals = 2) {
                if (bytes === 0) return '0 Bytes';
                const k = 1024;
                const dm = decimals < 0 ? 0 : decimals;
                const sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB'];
                const i = Math.floor(Math.log(bytes) / Math.log(k));
                return parseFloat((bytes / Math.pow(k, i)).toFixed(dm)) + ' ' + sizes[i];
            }

            $(document).on('change', 'input[name="path[]"]', function() {
                if ($(this).val()) {
                    $(this).removeClass('is-invalid');
                    $(this).siblings('.invalid-feedback').hide();
                }
                updateTotalSize();
            });

            $(document).on('click', '.btn-remove-row', function() {
                $(this).closest('tr').remove();
                updateRowNumbers();
                syncTenants();
                updateTotalSize();
            });
        });
    </script>
@endpush
