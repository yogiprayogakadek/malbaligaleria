@extends('templates.backend.master')

@section('page-title', 'Gallery Management')
@section('page-link', route('admin.gallery.index'))

@push('css')
    <link rel="stylesheet" href="{{ asset('assets/backend/css/dataTables.bootstrap5.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/backend/css/sweetalert2.min.css') }}">
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
                <div class="card-body">
                    <div class="mb-3 d-flex justify-content-between align-items-center flex-wrap gap-2">
                        <div class="d-flex gap-2">
                            <button type="button" class="btn btn-danger-subtle text-danger btn-batch-action" data-active="0" disabled>
                                <i class="ti ti-x me-1"></i> Batch Disable
                            </button>
                            <button type="button" class="btn btn-success-subtle text-success btn-batch-action" data-active="1" disabled>
                                <i class="ti ti-check me-1"></i> Batch Enable
                            </button>
                            <button type="button" class="btn btn-warning-subtle text-warning btn-batch-clear-title" disabled>
                                <i class="ti ti-trash-x me-1"></i> Batch Clear Title
                            </button>
                            <button type="button" class="btn btn-info-subtle text-info btn-batch-clear-sort" disabled>
                                <i class="ti ti-arrows-sort me-1"></i> Batch Reset Sort Order
                            </button>
                        </div>
                        <a href="{{ route('admin.gallery.create') }}" class="btn btn-primary">
                            <i class="ti ti-plus me-1"></i> Add New Photo
                        </a>
                    </div>
                    <div class="table-responsive">
                        <table id="table" class="table table-striped table-bordered text-nowrap align-middle">
                            <thead>
                                <tr>
                                    <th style="width: 30px;" class="text-center">
                                        <input type="checkbox" id="select-all" class="form-check-input">
                                    </th>
                                    <th>No.</th>
                                    <th>Image</th>
                                    <th>Title</th>
                                    <th>Sort Order</th>
                                    <th>Status</th>
                                    <th>Action</th>
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
        $(document).ready(function() {
            let table = $('#table').DataTable({
                processing: true,
                serverSide: true,
                searchDelay: 500,
                ajax: "{{ route('admin.gallery.index') }}",
                columns: [
                    {
                        data: 'checkbox',
                        name: 'checkbox',
                        orderable: false,
                        searchable: false,
                        className: 'text-center'
                    },
                    {
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'photo',
                        name: 'photo',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'title',
                        name: 'title'
                    },
                    {
                        data: 'sort_order',
                        name: 'sort_order'
                    },
                    {
                        data: 'status',
                        name: 'status'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ]
            });

            // Handle check/uncheck all
            $('#select-all').on('click', function() {
                let checked = this.checked;
                $('.select-photo').prop('checked', checked);
                toggleBatchButtons();
            });

            // Handle individual check/uncheck
            $('#table').on('change', '.select-photo', function() {
                let allChecked = $('.select-photo:checked').length === $('.select-photo').length;
                $('#select-all').prop('checked', allChecked);
                toggleBatchButtons();
            });

            // Enable or disable batch buttons
            function toggleBatchButtons() {
                let selectedCount = $('.select-photo:checked').length;
                if (selectedCount > 0) {
                    $('.btn-batch-action, .btn-batch-clear-title, .btn-batch-clear-sort').prop('disabled', false);
                } else {
                    $('.btn-batch-action, .btn-batch-clear-title, .btn-batch-clear-sort').prop('disabled', true);
                    $('#select-all').prop('checked', false);
                }
            }

            // On redraw table, reset checkboxes
            table.on('draw', function() {
                $('#select-all').prop('checked', false);
                toggleBatchButtons();
            });

            // Batch disable/enable action
            $('.btn-batch-action').on('click', function() {
                let isActive = $(this).data('active');
                let actionText = isActive == 1 ? 'enable' : 'disable';
                let selectedIds = [];

                $('.select-photo:checked').each(function() {
                    selectedIds.push($(this).val());
                });

                Swal.fire({
                    title: 'Confirm batch ' + actionText + '?',
                    text: 'You are going to update ' + selectedIds.length + ' photos.',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, update them!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "{{ route('admin.gallery.batch-status') }}",
                            type: "POST",
                            data: {
                                _token: "{{ csrf_token() }}",
                                ids: selectedIds,
                                is_active: isActive
                            },
                            success: function(response) {
                                toastr.success(response.message, "Success");
                                table.ajax.reload(null, false);
                            },
                            error: function(xhr) {
                                toastr.error("Failed to perform batch update.", "Error");
                            }
                        });
                    }
                });
            });

            // Batch clear title action
            $('.btn-batch-clear-title').on('click', function() {
                let selectedIds = [];

                $('.select-photo:checked').each(function() {
                    selectedIds.push($(this).val());
                });

                Swal.fire({
                    title: 'Clear all titles?',
                    text: 'You are going to clear the title/caption of ' + selectedIds.length + ' selected photos.',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, clear them!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "{{ route('admin.gallery.batch-clear-title') }}",
                            type: "POST",
                            data: {
                                _token: "{{ csrf_token() }}",
                                ids: selectedIds
                            },
                            success: function(response) {
                                toastr.success(response.message, "Success");
                                table.ajax.reload(null, false);
                            },
                            error: function(xhr) {
                                toastr.error("Failed to perform batch update.", "Error");
                            }
                        });
                    }
                });
            });

            // Batch clear sort action
            $('.btn-batch-clear-sort').on('click', function() {
                let selectedIds = [];

                $('.select-photo:checked').each(function() {
                    selectedIds.push($(this).val());
                });

                Swal.fire({
                    title: 'Reset sort order?',
                    text: 'You are going to reset the sort order to 0 for ' + selectedIds.length + ' selected photos.',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, reset them!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "{{ route('admin.gallery.batch-clear-sort') }}",
                            type: "POST",
                            data: {
                                _token: "{{ csrf_token() }}",
                                ids: selectedIds
                            },
                            success: function(response) {
                                toastr.success(response.message, "Success");
                                table.ajax.reload(null, false);
                            },
                            error: function(xhr) {
                                toastr.error("Failed to perform batch update.", "Error");
                            }
                        });
                    }
                });
            });

            // Toggle individual status
            $('#table').on('click', '.btn-toggle-status', function() {
                let photoId = $(this).data('id');
                let url = "{{ route('admin.gallery.toggle-active', ':id') }}".replace(':id', photoId);

                $.ajax({
                    url: url,
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        _method: "PUT"
                    },
                    success: function(response) {
                        toastr.success(response.message, "Success");
                        table.ajax.reload(null, false);
                    },
                    error: function(xhr) {
                        toastr.error("Failed to update status.", "Error");
                    }
                });
            });
        });

        $('body').on('click', '.btn-delete', function() {
            let galleryId = $(this).data('id');

            Swal.fire({
                title: 'Delete this data?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '/dashboard/gallery/delete/' + galleryId,
                        type: 'DELETE',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            toastr.success(
                                "Data deleted successfully.",
                                "Success", {
                                    showMethod: "slideDown",
                                    hideMethod: "slideUp",
                                    timeOut: 2000
                                }
                            );
                            location.reload();
                        },
                        error: function(xhr) {
                            toastr.error(
                                "An error occurred while deleting the image.",
                                "Error", {
                                    showMethod: "slideDown",
                                    hideMethod: "slideUp",
                                    timeOut: 2000
                                }
                            );
                        }
                    });
                }
            });
        });
    </script>
@endpush
