@extends('templates.backend.master')

@section('page-title', 'Recycle Bin')
@section('page-link', route('admin.recycle-bin.index'))

@push('css')
    <link rel="stylesheet" href="{{ asset('assets/backend/css/dataTables.bootstrap5.min.css') }}">
    <style>
        .nav-tabs-custom {
            border-bottom: 2px solid #ebeef2;
        }
        .nav-tabs-custom .nav-link {
            border: none;
            color: #7a828a;
            font-weight: 600;
            padding: 12px 20px;
            position: relative;
            background: transparent;
            transition: all 0.2s ease;
        }
        .nav-tabs-custom .nav-link:hover {
            color: #5d87ff;
        }
        .nav-tabs-custom .nav-link.active {
            color: #5d87ff;
            background: transparent;
        }
        .nav-tabs-custom .nav-link.active::after {
            content: "";
            position: absolute;
            bottom: -2px;
            left: 0;
            right: 0;
            height: 2px;
            background-color: #5d87ff;
        }
        .btn-bulk-restore {
            background-color: #13deb9;
            color: white;
        }
        .btn-bulk-restore:hover {
            background-color: #0ed0ad;
            color: white;
        }
        .btn-bulk-delete {
            background-color: #fa896b;
            color: white;
        }
        .btn-bulk-delete:hover {
            background-color: #f87451;
            color: white;
        }
    </style>
@endpush

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card mb-4 shadow-sm border-0">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">
                        <div>
                            <h5 class="fw-bold mb-1 text-dark"><i class="ti ti-trash me-2 text-danger"></i>Recycle Bin Dashboard</h5>
                            <p class="text-muted mb-0 small">Manage and restore or permanently delete soft-deleted records from the database.</p>
                        </div>
                        <div class="d-flex gap-2">
                            <button id="btn-restore" class="btn btn-bulk-restore px-3 py-2 fw-semibold rounded d-flex align-items-center gap-1" disabled>
                                <i class="ti ti-rotate-clockwise fs-5"></i> Restore Selected
                            </button>
                            <button id="btn-delete" class="btn btn-bulk-delete px-3 py-2 fw-semibold rounded d-flex align-items-center gap-1" disabled>
                                <i class="ti ti-trash-x fs-5"></i> Delete Permanently
                            </button>
                        </div>
                    </div>

                    <!-- Custom Nav Tabs -->
                    <ul class="nav nav-tabs nav-tabs-custom mb-4" id="recycleTabs" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="tenants-tab" data-bs-toggle="tab" data-bs-target="#tenants" type="button" role="tab" data-type="tenants"><i class="ti ti-building-store me-1"></i>Tenants</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="categories-tab" data-bs-toggle="tab" data-bs-target="#categories" type="button" role="tab" data-type="categories"><i class="ti ti-category me-1"></i>Category Tenants</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="events-tab" data-bs-toggle="tab" data-bs-target="#events" type="button" role="tab" data-type="events"><i class="ti ti-calendar-event me-1"></i>Events</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="event_photos-tab" data-bs-toggle="tab" data-bs-target="#event_photos" type="button" role="tab" data-type="event_photos"><i class="ti ti-photo me-1"></i>Event Photos</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="promos-tab" data-bs-toggle="tab" data-bs-target="#promos" type="button" role="tab" data-type="promos"><i class="ti ti-ticket me-1"></i>Promos</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="galleries-tab" data-bs-toggle="tab" data-bs-target="#galleries" type="button" role="tab" data-type="galleries"><i class="ti ti-photo-album me-1"></i>Gallery</button>
                        </li>
                    </ul>

                    <!-- Tab Contents -->
                    <div class="tab-content" id="recycleTabsContent">
                        <!-- Tenants Tab -->
                        <div class="tab-pane fade show active" id="tenants" role="tabpanel">
                            <div class="table-responsive">
                                <table id="table-tenants" class="table table-striped table-bordered text-nowrap align-middle w-100">
                                    <thead>
                                        <tr>
                                            <th width="30"><input type="checkbox" class="form-check-input select-all"></th>
                                            <th>No.</th>
                                            <th>Name</th>
                                            <th>Type</th>
                                            <th>Category</th>
                                            <th>Deleted At</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                        </div>

                        <!-- Categories Tab -->
                        <div class="tab-pane fade" id="categories" role="tabpanel">
                            <div class="table-responsive">
                                <table id="table-categories" class="table table-striped table-bordered text-nowrap align-middle w-100">
                                    <thead>
                                        <tr>
                                            <th width="30"><input type="checkbox" class="form-check-input select-all"></th>
                                            <th>No.</th>
                                            <th>Name</th>
                                            <th>Color Zone</th>
                                            <th>Deleted At</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                        </div>

                        <!-- Events Tab -->
                        <div class="tab-pane fade" id="events" role="tabpanel">
                            <div class="table-responsive">
                                <table id="table-events" class="table table-striped table-bordered text-nowrap align-middle w-100">
                                    <thead>
                                        <tr>
                                            <th width="30"><input type="checkbox" class="form-check-input select-all"></th>
                                            <th>No.</th>
                                            <th>Name</th>
                                            <th>Type</th>
                                            <th>Start Date</th>
                                            <th>End Date</th>
                                            <th>Deleted At</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                        </div>

                        <!-- Event Photos Tab -->
                        <div class="tab-pane fade" id="event_photos" role="tabpanel">
                            <div class="table-responsive">
                                <table id="table-event_photos" class="table table-striped table-bordered text-nowrap align-middle w-100">
                                    <thead>
                                        <tr>
                                            <th width="30"><input type="checkbox" class="form-check-input select-all"></th>
                                            <th>No.</th>
                                            <th>Photo</th>
                                            <th>Event</th>
                                            <th>Caption</th>
                                            <th>Deleted At</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                        </div>

                        <!-- Promos Tab -->
                        <div class="tab-pane fade" id="promos" role="tabpanel">
                            <div class="table-responsive">
                                <table id="table-promos" class="table table-striped table-bordered text-nowrap align-middle w-100">
                                    <thead>
                                        <tr>
                                            <th width="30"><input type="checkbox" class="form-check-input select-all"></th>
                                            <th>No.</th>
                                            <th>Tenant</th>
                                            <th>Promo Name</th>
                                            <th>Start Date</th>
                                            <th>End Date</th>
                                            <th>Deleted At</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                        </div>

                        <!-- Gallery Tab -->
                        <div class="tab-pane fade" id="galleries" role="tabpanel">
                            <div class="table-responsive">
                                <table id="table-galleries" class="table table-striped table-bordered text-nowrap align-middle w-100">
                                    <thead>
                                        <tr>
                                            <th width="30"><input type="checkbox" class="form-check-input select-all"></th>
                                            <th>No.</th>
                                            <th>Photo</th>
                                            <th>Title</th>
                                            <th>Deleted At</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script src="{{ asset('assets/backend/js/jquery.dataTables.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function() {
            let activeTab = 'tenants';
            let tables = {};

            const tableConfigs = {
                tenants: {
                    columns: [
                        { data: 'checkbox', name: 'checkbox', orderable: false, searchable: false },
                        { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                        { data: 'name', name: 'name' },
                        { data: 'type', name: 'type' },
                        { data: 'category', name: 'category' },
                        { data: 'deleted_at', name: 'deleted_at' }
                    ]
                },
                categories: {
                    columns: [
                        { data: 'checkbox', name: 'checkbox', orderable: false, searchable: false },
                        { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                        { data: 'name', name: 'name' },
                        { data: 'color_zone', name: 'color_zone' },
                        { data: 'deleted_at', name: 'deleted_at' }
                    ]
                },
                events: {
                    columns: [
                        { data: 'checkbox', name: 'checkbox', orderable: false, searchable: false },
                        { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                        { data: 'name', name: 'name' },
                        { data: 'type', name: 'type' },
                        { data: 'start_date', name: 'start_date' },
                        { data: 'end_date', name: 'end_date' },
                        { data: 'deleted_at', name: 'deleted_at' }
                    ]
                },
                event_photos: {
                    columns: [
                        { data: 'checkbox', name: 'checkbox', orderable: false, searchable: false },
                        { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                        { data: 'photo', name: 'photo', orderable: false, searchable: false },
                        { data: 'event', name: 'event' },
                        { data: 'caption', name: 'caption', defaultContent: '-' },
                        { data: 'deleted_at', name: 'deleted_at' }
                    ]
                },
                promos: {
                    columns: [
                        { data: 'checkbox', name: 'checkbox', orderable: false, searchable: false },
                        { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                        { data: 'tenant', name: 'tenant' },
                        { data: 'name', name: 'name' },
                        { data: 'start_date', name: 'start_date' },
                        { data: 'end_date', name: 'end_date' },
                        { data: 'deleted_at', name: 'deleted_at' }
                    ]
                },
                galleries: {
                    columns: [
                        { data: 'checkbox', name: 'checkbox', orderable: false, searchable: false },
                        { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                        { data: 'photo', name: 'photo', orderable: false, searchable: false },
                        { data: 'title', name: 'title', defaultContent: '-' },
                        { data: 'deleted_at', name: 'deleted_at' }
                    ]
                }
            };

            function initTable(tabName) {
                if (tables[tabName]) return;

                tables[tabName] = $(`#table-${tabName}`).DataTable({
                    processing: true,
                    serverSide: true,
                    searchDelay: 500,
                    ajax: {
                        url: "{{ route('admin.recycle-bin.data') }}",
                        data: { type: tabName }
                    },
                    columns: tableConfigs[tabName].columns,
                    drawCallback: function() {
                        updateActionButtons();
                        // Reset header checkbox on draw
                        $(`#table-${tabName} .select-all`).prop('checked', false);
                    }
                });
            }

            // Initialize default tab
            initTable(activeTab);

            // Tab switch handler
            $('button[data-bs-toggle="tab"]').on('shown.bs.tab', function(e) {
                activeTab = $(e.target).data('type');
                initTable(activeTab);
                updateActionButtons();
            });

            // Master checkbox (Select All) logic
            $(document).on('change', '.select-all', function() {
                const checked = $(this).prop('checked');
                $(`#table-${activeTab} tbody .select-item`).prop('checked', checked);
                updateActionButtons();
            });

            // Child checkbox click logic
            $(document).on('change', '.select-item', function() {
                const allCheckboxCount = $(`#table-${activeTab} tbody .select-item`).length;
                const checkedCount = $(`#table-${activeTab} tbody .select-item:checked`).length;
                $(`#table-${activeTab} .select-all`).prop('checked', allCheckboxCount === checkedCount);
                updateActionButtons();
            });

            function getSelectedIds() {
                let ids = [];
                $(`#table-${activeTab} tbody .select-item:checked`).each(function() {
                    ids.push($(this).val());
                });
                return ids;
            }

            function updateActionButtons() {
                const checkedCount = $(`#table-${activeTab} tbody .select-item:checked`).length;
                $('#btn-restore, #btn-delete').prop('disabled', checkedCount === 0);
            }

            // Bulk Restore Action
            $('#btn-restore').on('click', function() {
                const ids = getSelectedIds();
                if (ids.length === 0) return;

                Swal.fire({
                    title: 'Restore Selected?',
                    text: `You are restoring ${ids.length} selected item(s).`,
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#13deb9',
                    cancelButtonColor: '#7a828a',
                    confirmButtonText: 'Yes, restore!',
                    cancelButtonText: 'Cancel',
                    showLoaderOnConfirm: true,
                    preConfirm: () => {
                        return $.ajax({
                            url: "{{ route('admin.recycle-bin.restore') }}",
                            type: 'POST',
                            data: {
                                type: activeTab,
                                ids: ids
                            },
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
                        Swal.fire('Restored!', result.value.message, 'success');
                        tables[activeTab].ajax.reload();
                    }
                });
            });

            // Bulk Permanent Delete Action
            $('#btn-delete').on('click', function() {
                const ids = getSelectedIds();
                if (ids.length === 0) return;

                Swal.fire({
                    title: 'Delete Permanently?',
                    text: `Are you sure you want to permanently delete ${ids.length} selected item(s)? This action cannot be undone and will permanently erase files!`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#fa896b',
                    cancelButtonColor: '#7a828a',
                    confirmButtonText: 'Yes, delete permanently!',
                    cancelButtonText: 'Cancel',
                    showLoaderOnConfirm: true,
                    preConfirm: () => {
                        return $.ajax({
                            url: "{{ route('admin.recycle-bin.force-delete') }}",
                            type: 'POST',
                            data: {
                                type: activeTab,
                                ids: ids
                            },
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
                        Swal.fire('Deleted!', result.value.message, 'success');
                        tables[activeTab].ajax.reload();
                    }
                });
            });
        });
    </script>
@endpush
