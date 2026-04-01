@extends('templates.backend.master')

@section('page-title', 'Tenant Management')
@section('page-link', route('admin.tenant.index'))

@push('css')
    <link rel="stylesheet" href="{{ asset('assets/backend/css/dataTables.bootstrap5.min.css') }}">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
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
            <div class="card mb-3 shadow-sm border-0" style="background: rgba(255, 255, 255, 0.9); backdrop-filter: blur(10px);">
                <div class="card-body p-3">
                    <div class="row align-items-end g-3">
                        <div class="col-md-3">
                            <label class="form-label fw-bold text-muted small mb-1"><i class="ti ti-layers-intersect me-1"></i>Floor</label>
                            <select id="filter-floor" class="form-select border-0 bg-light-subtle shadow-none">
                                <option value="">All Floors</option>
                                <option value="1">1st Floor</option>
                                <option value="2">2nd Floor</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label fw-bold text-muted small mb-1"><i class="ti ti-toggle-left me-1"></i>Status</label>
                            <select id="filter-status" class="form-select border-0 bg-light-subtle shadow-none">
                                <option value="">All Status</option>
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label fw-bold text-muted small mb-1"><i class="ti ti-sparkles me-1"></i>Is New</label>
                            <select id="filter-new" class="form-select border-0 bg-light-subtle shadow-none">
                                <option value="">All Store</option>
                                <option value="1">New Store</option>
                                <option value="0">Existing Store</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <button id="btn-reset" class="btn btn-outline-secondary w-100 border-dashed">
                                <i class="ti ti-refresh me-1"></i>Reset Filters
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="table" class="table table-striped table-bordered text-nowrap align-middle">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Logo</th>
                                    <th>Category</th>
                                    <th>Type</th>
                                    <th>Name</th>
                                    <th>Phone</th>
                                    <th>Map Coord</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script src="{{ asset('assets/backend/js/jquery.dataTables.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('#table').DataTable({
                processing: true,
                serverSide: true,
                searchDelay: 500,
                ajax: {
                    url: "{{ route('admin.tenant.index') }}",
                    data: function (d) {
                        d.floor = $('#filter-floor').val();
                        d.is_active = $('#filter-status').val();
                        d.is_new = $('#filter-new').val();
                    }
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'logo',
                        name: 'logo',
                    },
                    {
                        data: 'category',
                        name: 'category',
                        defaultContent: '-'
                    },
                    {
                        data: 'type',
                        name: 'type',
                        defaultContent: '-'
                    },
                    {
                        data: 'name',
                        name: 'name',
                        defaultContent: '-'
                    },
                    {
                        data: 'phone',
                        name: 'phone',
                        defaultContent: '-'
                    },
                    {
                        data: 'map_coords',
                        name: 'map_coords',
                        defaultContent: '-'
                    },
                    {
                        data: 'is_active',
                        name: 'is_active',
                        defaultContent: '-'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ]
            });

            // Filter Change Events
            $('#filter-floor, #filter-status, #filter-new').on('change', function() {
                $('#table').DataTable().ajax.reload();
            });

            // Reset Logic
            $('#btn-reset').on('click', function() {
                $('#filter-floor').val('');
                $('#filter-status').val('');
                $('#filter-new').val('');
                $('#table').DataTable().ajax.reload();
            });

            @role('superuser')
                // Delete functionality
                $('#table').on('click', '.delete-btn', function() {
                    const uuid = $(this).data('uuid');
                    const name = $(this).data('name');

                    Swal.fire({
                        title: 'Are you sure?',
                        text: `You are about to delete "${name}". This action cannot be undone and will also remove the store logo!`,
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, delete it!',
                        cancelButtonText: 'Cancel',
                        showLoaderOnConfirm: true,
                        preConfirm: () => {
                            return $.ajax({
                                url: `/dashboard/tenant/destroy/${uuid}`,
                                type: 'DELETE',
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                },
                                success: function(response) {
                                    return response;
                                },
                                error: function(xhr) {
                                    Swal.showValidationMessage(
                                        `Request failed: ${xhr.responseJSON ? xhr.responseJSON.message : xhr.statusText}`
                                    );
                                }
                            });
                        },
                        allowOutsideClick: () => !Swal.isLoading()
                    }).then((result) => {
                        if (result.isConfirmed && result.value.success) {
                            Swal.fire(
                                'Deleted!',
                                'The tenant has been deleted.',
                                'success'
                            );
                            $('#table').DataTable().ajax.reload();
                        }
                    });
                });
            @endrole
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endpush
