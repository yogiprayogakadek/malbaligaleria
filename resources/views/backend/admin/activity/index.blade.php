@extends('templates.backend.master')

@section('page-title', 'Activity Logs')
@section('page-link', route('admin.activity.index'))

@push('css')
    <link rel="stylesheet" href="{{ asset('assets/backend/css/dataTables.bootstrap5.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/backend/css/sweetalert2.min.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
@endpush

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-3">
                            <label for="date_filter" class="form-label">Filter by Date</label>
                            <input type="text" id="date_filter" class="form-control" placeholder="Select Date Range">
                        </div>
                        <div class="col-md-3">
                            <label for="log_name" class="form-label">Filter by Log Name</label>
                            <select id="log_name" class="form-control">
                                <option value="">All Logs</option>
                                @foreach ($logNames as $name)
                                    <option value="{{ $name }}">{{ ucfirst($name) }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 d-flex align-items-end justify-content-between">
                            <div>
                                <button id="filter" class="btn btn-primary me-2"><i class="ti ti-filter"></i>
                                    Filter</button>
                                <button id="reset" class="btn btn-secondary"><i class="ti ti-refresh"></i>
                                    Reset</button>
                            </div>
                            <div>
                                <button id="delete_selected" class="btn btn-danger me-2" style="display: none;"><i
                                        class="ti ti-trash"></i> Delete Selected</button>
                                <button id="delete_all" class="btn btn-danger"><i class="ti ti-trash-x"></i> Delete
                                    All</button>
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table id="table" class="table table-striped table-bordered text-nowrap align-middle">
                            <thead>
                                <tr>
                                    <th><input type="checkbox" id="select_all"></th>
                                    <th>No.</th>
                                    <th>Date</th>
                                    <th>Log Name</th>
                                    <th>Description</th>
                                    <th>User</th>
                                    <th>Properties</th>
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
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    <script>
        $(document).ready(function() {
            flatpickr("#date_filter", {
                mode: "range",
                dateFormat: "Y-m-d",
            });

            var table = $('#table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('admin.activity.index') }}",
                    data: function(d) {
                        d.date_filter = $('#date_filter').val();
                        d.log_name = $('#log_name').val();
                    }
                },
                columns: [{
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
                        data: 'created_at',
                        name: 'created_at'
                    },
                    {
                        data: 'log_name',
                        name: 'log_name'
                    },
                    {
                        data: 'description',
                        name: 'description'
                    },
                    {
                        data: 'causer',
                        name: 'causer_id'
                    },
                    {
                        data: 'properties',
                        name: 'properties',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ],
                order: [
                    [2, 'desc']
                ]
            });

            $('#filter').click(function() {
                table.draw();
            });

            $('#reset').click(function() {
                $('#date_filter').val('');
                $('#log_name').val('');
                table.draw();
            });

            // Select All Checkbox
            $('#select_all').on('click', function() {
                var rows = table.rows({
                    'search': 'applied'
                }).nodes();
                $('input[type="checkbox"]', rows).prop('checked', this.checked);
                toggleDeleteSelectedButton();
            });

            // Individual Checkbox Click
            $('#table tbody').on('change', 'input[type="checkbox"]', function() {
                if (!this.checked) {
                    var el = $('#select_all').get(0);
                    if (el && el.checked && ('indeterminate' in el)) {
                        el.indeterminate = true;
                    }
                }
                toggleDeleteSelectedButton();
            });

            function toggleDeleteSelectedButton() {
                var selected = $('input.checkbox:checked').length;
                if (selected > 0) {
                    $('#delete_selected').show();
                } else {
                    $('#delete_selected').hide();
                }
            }

            // Delete Selected
            $('#delete_selected').click(function() {
                var ids = [];
                $('input.checkbox:checked').each(function() {
                    ids.push($(this).data('id'));
                });

                if (ids.length === 0) return;

                Swal.fire({
                    title: 'Delete Selected?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete ' + ids.length + ' items!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "{{ route('admin.activity.destroySelected') }}",
                            type: 'POST',
                            data: {
                                ids: ids,
                                _token: '{{ csrf_token() }}'
                            },
                            success: function(response) {
                                Swal.fire('Deleted!', response.success, 'success');
                                table.draw();
                                $('#select_all').prop('checked', false);
                                toggleDeleteSelectedButton();
                            },
                            error: function() {
                                Swal.fire('Error!', 'Something went wrong.', 'error');
                            }
                        });
                    }
                });
            });

            // Delete All
            $('#delete_all').click(function() {
                Swal.fire({
                    title: 'Delete ALL Logs?',
                    text: "This will remove EVERY activity log. This action cannot be undone!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete EVERYTHING!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "{{ route('admin.activity.destroyAll') }}",
                            type: 'DELETE',
                            data: {
                                _token: '{{ csrf_token() }}'
                            },
                            success: function(response) {
                                Swal.fire('Deleted!', response.success, 'success');
                                table.draw();
                            },
                            error: function() {
                                Swal.fire('Error!', 'Something went wrong.', 'error');
                            }
                        });
                    }
                });
            });

            // Single Delete
            $('body').on('click', '.btn-delete', function() {
                var id = $(this).data('id');
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        let url = "{{ route('admin.activity.destroy', ':id') }}";
                        url = url.replace(':id', id);

                        $.ajax({
                            url: url,
                            type: 'DELETE',
                            data: {
                                _token: '{{ csrf_token() }}'
                            },
                            success: function(response) {
                                Swal.fire('Deleted!', response.success, 'success');
                                table.draw();
                            },
                            error: function() {
                                Swal.fire('Error!', 'Something went wrong.', 'error');
                            }
                        });
                    }
                });
            });
        });
    </script>
@endpush
