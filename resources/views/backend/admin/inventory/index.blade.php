@extends('templates.inventory.master')

@section('page-title', 'Asset Management')
@section('page-subtitle', 'Kelola semua aset hardware, CCTV, network dan lainnya')

@push('css')
    <link rel="stylesheet" href="{{ asset('assets/backend/css/dataTables.bootstrap5.min.css') }}">
    <style>
        .filter-card {
            background: #f8f9fa;
            border: 1px solid #e9ecef;
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 20px;
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

    <div class="row mb-4 align-items-center">
        <div class="col">
            <h4 class="mb-0 text-dark fw-bold">Inventory Assets</h4>
            <p class="text-muted mb-0">Manage hardware, network, CCTV, and other assets</p>
        </div>
        <div class="col-auto d-flex gap-2">
            <a href="{{ route('inventory.categories.index') }}" class="btn btn-outline-primary hstack gap-2">
                <i class="ti ti-folders fs-4"></i> Manage Categories
            </a>
            <button type="button" class="btn btn-outline-success hstack gap-2" data-bs-toggle="modal" data-bs-target="#printModal">
                <i class="ti ti-printer fs-4"></i> Print / Cetak
            </button>
            <a href="{{ route('inventory.assets.create') }}" class="btn btn-primary hstack gap-2">
                <i class="ti ti-plus fs-4"></i> Add Asset
            </a>
        </div>
    </div>

    <!-- Filters -->
    <div class="card filter-card">
        <div class="card-body p-0">
            <h5 class="fw-semibold mb-3"><i class="ti ti-filter fs-5 me-1 text-primary"></i> Filters</h5>
            <form id="filter-form" class="row g-3">
                <div class="col-md-4">
                    <label for="category_id" class="form-label small fw-semibold text-muted">Category</label>
                    <select id="filter_category_id" class="form-select">
                        <option value="">All Categories</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="status" class="form-label small fw-semibold text-muted">Status</label>
                    <select id="filter_status" class="form-select">
                        <option value="">All Statuses</option>
                        <option value="active">Active</option>
                        <option value="maintenance">Maintenance</option>
                        <option value="broken">Broken</option>
                        <option value="stored">Stored</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="location" class="form-label small fw-semibold text-muted">Location</label>
                    <select id="filter_location" class="form-select">
                        <option value="">All Locations</option>
                        @foreach($locations as $loc)
                            <option value="{{ $loc }}">{{ $loc }}</option>
                        @endforeach
                    </select>
                </div>
            </form>
        </div>
    </div>

    <!-- Table -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="table" class="table table-striped table-bordered text-nowrap align-middle">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Image</th>
                                    <th>Asset Name</th>
                                    <th>Category</th>
                                    <th>Parent Asset</th>
                                    <th>Brand / Model</th>
                                    <th>Serial Number</th>
                                    <th>Location</th>
                                    <th>Qty</th>
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

    <!-- Print Modal -->
    <div class="modal fade" id="printModal" tabindex="-1" aria-labelledby="printModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold" id="printModalLabel"><i class="ti ti-printer me-2 text-primary"></i> Print Asset Document</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('inventory.assets.print') }}" method="GET" target="_blank">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="print_layout" class="form-label fw-semibold">Layout Format</label>
                            <select name="layout" id="print_layout" class="form-select" required>
                                <option value="table">Table List (Tabel Biasa)</option>
                                <option value="hierarchy">Visual Hierarchy Tree (Bentuk Hirarki)</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="print_category_id" class="form-label fw-semibold">Category Filter</label>
                            <select name="category_id" id="print_category_id" class="form-select">
                                <option value="">All Categories</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="print_status" class="form-label fw-semibold">Status Filter</label>
                            <select name="status" id="print_status" class="form-select">
                                <option value="">All Statuses</option>
                                <option value="active">Active</option>
                                <option value="maintenance">Maintenance</option>
                                <option value="broken">Broken</option>
                                <option value="stored">Stored</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="print_location" class="form-label fw-semibold">Location Filter</label>
                            <select name="location" id="print_location" class="form-select">
                                <option value="">All Locations</option>
                                @foreach($locations as $loc)
                                    <option value="{{ $loc }}">{{ $loc }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary hstack gap-2">
                            <i class="ti ti-printer"></i> Generate & Print
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script src="{{ asset('assets/backend/js/jquery.dataTables.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function() {
            var table = $('#table').DataTable({
                processing: true,
                serverSide: true,
                searchDelay: 500,
                ajax: {
                    url: "{{ route('inventory.assets.index') }}",
                    data: function(d) {
                        d.category_id = $('#filter_category_id').val();
                        d.status = $('#filter_status').val();
                        d.location = $('#filter_location').val();
                    }
                },
                columns: [
                    {
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'image',
                        name: 'image',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'category',
                        name: 'category.name'
                    },
                    {
                        data: 'parent',
                        name: 'parent.name'
                    },
                    {
                        data: 'brand',
                        name: 'brand',
                        render: function(data, type, row) {
                            var brand = row.brand || '-';
                            var model = row.model || '';
                            return model ? brand + ' / ' + model : brand;
                        }
                    },
                    {
                        data: 'serial_number',
                        name: 'serial_number',
                        render: function(data) {
                            return data || '<span class="text-muted">-</span>';
                        }
                    },
                    {
                        data: 'location',
                        name: 'location',
                        render: function(data) {
                            return data || '<span class="text-muted">-</span>';
                        }
                    },
                    {
                        data: 'quantity',
                        name: 'quantity'
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

            // Re-draw table on filter change
            $('#filter_category_id, #filter_status, #filter_location').on('change', function() {
                table.draw();
            });

            // Delete functionality
            $('#table').on('click', '.btn-delete', function() {
                const id = $(this).data('id');
                const name = $(this).data('name');

                Swal.fire({
                    title: 'Delete Asset?',
                    text: `Are you sure you want to delete "${name}"? This action will move it to trash.`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Yes, Delete',
                    cancelButtonText: 'Cancel',
                    showLoaderOnConfirm: true,
                    preConfirm: () => {
                        return $.ajax({
                            url: "{{ route('inventory.assets.index') }}/" + id,
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
                            'The asset has been deleted.',
                            'success'
                        );
                        table.ajax.reload();
                    }
                });
            // Prefill print modal filters from active page filters when modal is shown
            $('#printModal').on('show.bs.modal', function () {
                $('#print_category_id').val($('#filter_category_id').val());
                $('#print_status').val($('#filter_status').val());
                $('#print_location').val($('#filter_location').val());
            });
        });
    </script>
@endpush
