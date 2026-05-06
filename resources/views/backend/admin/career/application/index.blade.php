@extends('templates.backend.master')

@section('page-title', 'Applicant List')
@section('page-link', route('admin.career.application.index'))

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
                <h5 class="mb-1">All Applicants</h5>
                <p class="text-muted small mb-0">Manage incoming applications for all positions</p>
            </div>
            <a href="{{ route('admin.career.vacancy.index') }}" class="btn btn-outline-secondary btn-sm">
                <i class="ti ti-briefcase me-1"></i> Manage Vacancies
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="applicationTable" class="table table-striped table-bordered text-nowrap align-middle">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Applicant Name</th>
                                    <th>Email</th>
                                    <th>Position</th>
                                    <th>Department</th>
                                    <th>Status</th>
                                    <th>Application Date</th>
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
            $('#applicationTable').DataTable({
                processing: true,
                serverSide: true,
                searchDelay: 500,
                ajax: "{{ route('admin.career.application.index') }}",
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                    { data: 'name', name: 'name' },
                    { data: 'email', name: 'email' },
                    { data: 'vacancy.title', name: 'vacancy.title' },
                    { data: 'vacancy.department', name: 'vacancy.department' },
                    { data: 'status', name: 'status' },
                    { data: 'created_at', name: 'created_at' },
                    { data: 'action', name: 'action', orderable: false, searchable: false },
                ]
            });
        });
    </script>
@endpush
