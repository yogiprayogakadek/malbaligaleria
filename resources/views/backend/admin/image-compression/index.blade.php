@extends('templates.backend.master')

@section('page-title', 'Image Compressor')
@section('page-link', route('admin.image-compression.index'))

@push('css')
    <link rel="stylesheet" href="{{ asset('assets/backend/css/dataTables.bootstrap5.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/backend/css/sweetalert2.min.css') }}">
    <style>
        .stats-card {
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }
        .stats-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 25px rgba(0, 0, 0, 0.08);
        }
    </style>
@endpush

@section('content')
    <div class="row mb-4">
        <div class="col-md-6 col-lg-6 col-12">
            <div class="card stats-card bg-primary text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="text-white-50 mb-1">Total Image Files</h5>
                            <h3 class="text-white mb-0">{{ $stats['total_count'] }}</h3>
                        </div>
                        <i class="ti ti-photo fs-1 text-white-50"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-6 col-12">
            <div class="card stats-card bg-success text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="text-white-50 mb-1">Total Images Disk Size</h5>
                            <h3 class="text-white mb-0">{{ $stats['total_size'] }}</h3>
                        </div>
                        <i class="ti ti-device-sdcard fs-1 text-white-50"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title">All Uploaded Website Images</h4>
                    <div class="d-flex align-items-center">
                        <select id="status_filter" class="form-select me-3" style="width: 180px;">
                            <option value="all">All Status</option>
                            <option value="active">Active Only</option>
                            <option value="inactive">Inactive/Orphaned Only</option>
                        </select>
                        <button id="compress_selected" class="btn btn-warning" style="display: none;">
                            <i class="ti ti-minimize me-1"></i> Compress Selected
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="alert alert-info d-flex align-items-center" role="alert">
                        <i class="ti ti-info-circle me-2 fs-5"></i>
                        <div>
                            This panel uses standard PHP GD library to compress uploaded images in-place. Transparent backgrounds for PNGs are preserved, and overall quality is optimized to significantly save server disk space and reduce frontend page loading latency.
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table id="table" class="table table-striped table-bordered text-nowrap align-middle">
                            <thead>
                                <tr>
                                    <th width="30"><input type="checkbox" id="select_all"></th>
                                    <th width="40">No.</th>
                                    <th width="80">Preview</th>
                                    <th>Filename</th>
                                    <th>Category</th>
                                    <th>Resolution</th>
                                    <th>File Size</th>
                                    <th>Status</th>
                                    <th width="100">Action</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script src="{{ asset('assets/backend/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/backend/js/sweetalert2.min.js') }}"></script>

    <script>
        function zoomImage(url) {
            Swal.fire({
                imageUrl: url,
                imageAlt: 'Preview Image',
                showConfirmButton: false,
                showCloseButton: true,
                width: 'auto',
                maxWidth: '90%'
            });
        }

        $(document).ready(function() {
            var table = $('#table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('admin.image-compression.index') }}",
                    data: function(d) {
                        d.status = $('#status_filter').val();
                    }
                },
                columns: [
                    {
                        data: 'checkbox',
                        name: 'checkbox',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'thumbnail',
                        name: 'thumbnail',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'filename',
                        name: 'filename'
                    },
                    {
                        data: 'category',
                        name: 'category'
                    },
                    {
                        data: 'resolution',
                        name: 'resolution'
                    },
                    {
                        data: 'size',
                        name: 'raw_size'
                    },
                    {
                        data: 'status',
                        name: 'status',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    }
                ],
                order: [[6, 'desc']] // Sort by raw size descending
            });

            // Reload table on filter change
            $('#status_filter').on('change', function() {
                table.draw();
                $('#select_all').prop('checked', false);
                toggleCompressSelectedButton();
            });

            // Select All Checkbox
            $('#select_all').on('click', function() {
                var rows = table.rows({ 'search': 'applied' }).nodes();
                $('input[type="checkbox"]', rows).prop('checked', this.checked);
                toggleCompressSelectedButton();
            });

            // Individual Checkbox Click
            $('#table tbody').on('change', 'input[type="checkbox"]', function() {
                if (!this.checked) {
                    var el = $('#select_all').get(0);
                    if (el && el.checked && ('indeterminate' in el)) {
                        el.indeterminate = true;
                    }
                }
                toggleCompressSelectedButton();
            });

            function toggleCompressSelectedButton() {
                var selected = $('input.checkbox:checked').length;
                if (selected > 0) {
                    $('#compress_selected').show();
                } else {
                    $('#compress_selected').hide();
                }
            }

            // Compress Selected (Bulk Action)
            $('#compress_selected').click(function() {
                var paths = [];
                $('input.checkbox:checked').each(function() {
                    paths.push($(this).data('path'));
                });

                if (paths.length === 0) return;

                Swal.fire({
                    title: 'Compress Selected Images?',
                    text: `This will compress ${paths.length} selected images in-place.`,
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'Yes, Compress All!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire({
                            title: 'Compressing...',
                            text: 'Please wait while we process the images.',
                            allowOutsideClick: false,
                            didOpen: () => {
                                Swal.showLoading();
                            }
                        });

                        $.ajax({
                            url: "{{ route('admin.image-compression.compress-selected') }}",
                            type: 'POST',
                            data: {
                                paths: paths,
                                _token: '{{ csrf_token() }}'
                            },
                            success: function(response) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Compressed!',
                                    html: `<p>${response.success}</p>
                                           <ul class="text-start list-group list-group-flush">
                                               <li class="list-group-item"><strong>Original Size:</strong> ${response.original_size}</li>
                                               <li class="list-group-item"><strong>Optimized Size:</strong> ${response.new_size}</li>
                                               <li class="list-group-item text-success"><strong>Savings:</strong> ${response.savings} (${response.percentage})</li>
                                           </ul>`
                                });
                                table.draw();
                                $('#select_all').prop('checked', false);
                                toggleCompressSelectedButton();
                            },
                            error: function() {
                                Swal.fire('Error!', 'Something went wrong while compressing.', 'error');
                            }
                        });
                    }
                });
            });

            // Single Compress Action
            $('body').on('click', '.btn-compress', function() {
                var path = $(this).data('path');

                Swal.fire({
                    title: 'Compress Image?',
                    text: 'This will replace the image file with a compressed version.',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'Yes, Compress!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire({
                            title: 'Compressing...',
                            allowOutsideClick: false,
                            didOpen: () => {
                                Swal.showLoading();
                            }
                        });

                        $.ajax({
                            url: "{{ route('admin.image-compression.compress') }}",
                            type: 'POST',
                            data: {
                                path: path,
                                _token: '{{ csrf_token() }}'
                            },
                            success: function(response) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Compressed!',
                                    html: `<p>${response.success}</p>
                                           <ul class="text-start list-group list-group-flush">
                                               <li class="list-group-item"><strong>Original Size:</strong> ${response.original_size}</li>
                                               <li class="list-group-item"><strong>Optimized Size:</strong> ${response.new_size}</li>
                                               <li class="list-group-item text-success"><strong>Savings:</strong> ${response.savings} (${response.percentage})</li>
                                           </ul>`
                                });
                                table.draw();
                            },
                            error: function(xhr) {
                                let errorMsg = 'Failed to compress image.';
                                if (xhr.responseJSON && xhr.responseJSON.error) {
                                    errorMsg = xhr.responseJSON.error;
                                }
                                Swal.fire('Error!', errorMsg, 'error');
                            }
                        });
                    }
                });
            });
        });
    </script>
@endpush
