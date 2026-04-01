@extends('templates.backend.master')

@section('page-title', 'Event Management')
@section('page-link', route('admin.event.index'))

@push('css')
    <link rel="stylesheet" href="{{ asset('assets/backend/css/dataTables.bootstrap5.min.css') }}">
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
                        <div class="col-md-4">
                            <label class="form-label fw-bold text-muted small mb-1"><i class="ti ti-filter me-1"></i>Event Type</label>
                            <select id="filter-type" class="form-select border-0 bg-light-subtle shadow-none">
                                <option value="">All Types</option>
                                <option value="regular">Regular</option>
                                <option value="special">Special</option>
                                <option value="exhibition">Exhibition</option>
                                <option value="upcoming">Upcoming</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-bold text-muted small mb-1"><i class="ti ti-toggle-left me-1"></i>Status</label>
                            <select id="filter-status" class="form-select border-0 bg-light-subtle shadow-none">
                                <option value="">All Status</option>
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>
                        <div class="col-md-4">
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
                                    <th>Name</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th>Start Time</th>
                                    <th>End Time</th>
                                    <th>Type</th>
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

    <script>
        $(document).ready(function() {
            $('#table').DataTable({
                processing: true,
                serverSide: true,
                searchDelay: 500,
                ajax: {
                    url: "{{ route('admin.event.index') }}",
                    data: function (d) {
                        d.type = $('#filter-type').val();
                        d.is_active = $('#filter-status').val();
                    }
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'start_date',
                        name: 'start_date',
                    },
                    {
                        data: 'end_date',
                        name: 'end_date',
                    },
                    {
                        data: 'start_time',
                        name: 'start_time',
                    },
                    {
                        data: 'end_time',
                        name: 'end_time',
                    },
                    {
                        data: 'type',
                        name: 'type',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'is_active',
                        name: 'is_active'
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
            $('#filter-type, #filter-status').on('change', function() {
                $('#table').DataTable().ajax.reload();
            });

            // Reset Logic
            $('#btn-reset').on('click', function() {
                $('#filter-type').val('');
                $('#filter-status').val('');
                $('#table').DataTable().ajax.reload();
            });
        });
    </script>
@endpush
