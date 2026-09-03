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
    @if (session('error'))
        <script>
            toastr.error("{{ session('error') }}", "Error", {
                showMethod: "slideDown", hideMethod: "slideUp", timeOut: 3000
            });
        </script>
    @endif

    <div class="row mb-3">
        <div class="col-12 d-flex justify-content-between align-items-center flex-wrap gap-2">
            <div>
                <h5 class="mb-1">All Applicants</h5>
                <p class="text-muted small mb-0">Manage incoming applications for all positions</p>
            </div>
            <div class="d-flex align-items-center gap-2">
                <button type="button" id="btnBulkDownload" class="btn btn-success btn-sm" disabled>
                    <i class="ti ti-download me-1"></i> Bulk Download CV (<span id="selectedCount">0</span>)
                </button>
                <a href="{{ route('admin.career.vacancy.index') }}" class="btn btn-outline-secondary btn-sm">
                    <i class="ti ti-briefcase me-1"></i> Manage Vacancies
                </a>
            </div>
        </div>
    </div>

    <!-- Hidden form for bulk CV download submission -->
    <form id="bulkDownloadForm" action="{{ route('admin.career.application.bulkDownloadCv') }}" method="POST" style="display: none;">
        @csrf
        <div id="bulkDownloadInputs"></div>
    </form>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="applicationTable" class="table table-striped table-bordered text-nowrap align-middle">
                            <thead>
                                <tr>
                                    <th style="width: 35px;" class="text-center">
                                        <input type="checkbox" id="selectAll" class="form-check-input">
                                    </th>
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
            let table = $('#applicationTable').DataTable({
                processing: true,
                serverSide: true,
                searchDelay: 500,
                ajax: "{{ route('admin.career.application.index') }}",
                columns: [
                    { data: 'checkbox', name: 'checkbox', orderable: false, searchable: false, className: 'text-center' },
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

            // Handle Select All
            $('#selectAll').on('click', function () {
                let checked = this.checked;
                $('.select-applicant').prop('checked', checked);
                toggleBulkButton();
            });

            // Handle Individual Checkbox
            $('#applicationTable').on('change', '.select-applicant', function () {
                let totalCheckboxes = $('.select-applicant').length;
                let checkedCheckboxes = $('.select-applicant:checked').length;
                $('#selectAll').prop('checked', totalCheckboxes > 0 && totalCheckboxes === checkedCheckboxes);
                toggleBulkButton();
            });

            // Reset selection state on table redraw (pagination, search, sorting)
            table.on('draw', function () {
                $('#selectAll').prop('checked', false);
                toggleBulkButton();
            });

            function toggleBulkButton() {
                let selectedCount = $('.select-applicant:checked').length;
                $('#selectedCount').text(selectedCount);
                $('#btnBulkDownload').prop('disabled', selectedCount === 0);
            }

            // Handle Bulk Download Click
            $('#btnBulkDownload').on('click', function () {
                let selectedUuids = [];
                $('.select-applicant:checked').each(function () {
                    selectedUuids.push($(this).val());
                });

                if (selectedUuids.length === 0) {
                    toastr.warning('Pilih minimal satu pelamar terlebih dahulu.', 'Peringatan');
                    return;
                }

                let inputsHtml = '';
                selectedUuids.forEach(function (uuid) {
                    inputsHtml += '<input type="hidden" name="uuids[]" value="' + uuid + '">';
                });

                $('#bulkDownloadInputs').html(inputsHtml);
                $('#bulkDownloadForm').submit();
            });
        });
    </script>
@endpush
