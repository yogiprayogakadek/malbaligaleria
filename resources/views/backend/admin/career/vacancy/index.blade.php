@extends('templates.backend.master')

@section('page-title', 'Job Vacancy Management')
@section('page-link', route('admin.career.vacancy.index'))

@push('css')
    <link rel="stylesheet" href="{{ asset('assets/backend/css/dataTables.bootstrap5.min.css') }}">
@endpush

@section('content')
    @if (session('success'))
        <script>
            toastr.success("{{ session('success') }}", "Success", {
                showMethod: "slideDown", hideMethod: "slideUp", timeOut: 2500
            });
        </script>
    @endif

    <div class="row mb-3">
        <div class="col-12 d-flex justify-content-between align-items-center">
            <div>
                <h5 class="mb-1">Vacancy List</h5>
                <p class="text-muted small mb-0">Manage all available job vacancy positions</p>
            </div>
            <div class="d-flex gap-2">
                <a href="{{ route('admin.career.application.index') }}" class="btn btn-outline-info btn-sm">
                    <i class="ti ti-users me-1"></i> View Applicants
                </a>
                <a href="{{ route('admin.career.vacancy.create') }}" class="btn btn-primary btn-sm">
                    <i class="ti ti-plus me-1"></i> Add Vacancy
                </a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="vacancyTable" class="table table-striped table-bordered text-nowrap align-middle">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Position</th>
                                    <th>Department</th>
                                    <th>Type</th>
                                    <th>Deadline</th>
                                    <th>Applicants</th>
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
        $(document).ready(function () {
            $('#vacancyTable').DataTable({
                processing: true,
                serverSide: true,
                searchDelay: 500,
                ajax: "{{ route('admin.career.vacancy.index') }}",
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                    { data: 'title', name: 'title' },
                    { data: 'department', name: 'department' },
                    { data: 'type', name: 'type' },
                    { data: 'deadline', name: 'deadline' },
                    { data: 'applications_count', name: 'applications_count', orderable: false, searchable: false },
                    { data: 'is_active', name: 'is_active' },
                    { data: 'action', name: 'action', orderable: false, searchable: false },
                ]
            });
        });
    </script>
@endpush
