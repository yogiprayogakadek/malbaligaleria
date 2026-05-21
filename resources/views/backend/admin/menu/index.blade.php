@extends('templates.backend.master')

@section('page-title', 'Frontend Menus Visibility')
@section('page-link', route('admin.menu.index'))

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
                    <div class="alert alert-info alert-dismissible fade show" role="alert">
                        <iconify-icon icon="solar:info-circle-line-duotone" class="fs-5 me-2 align-middle"></iconify-icon>
                        <span class="align-middle">Configure which frontend navigation menus are active and control which user roles have permission to view them. If no roles are selected, the menu item is visible to everyone (including guests).</span>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    <div class="table-responsive">
                        <table id="table" class="table table-striped table-bordered text-nowrap align-middle">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Menu Name</th>
                                    <th>URL / Route</th>
                                    <th>Visible Roles</th>
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
            $('#table').DataTable({
                processing: true,
                serverSide: true,
                searchDelay: 500,
                ajax: "{{ route('admin.menu.index') }}",
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
                        data: 'url',
                        name: 'url'
                    },
                    {
                        data: 'roles',
                        name: 'roles',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'is_active',
                        name: 'is_active',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ]
            });

            $('body').on('click', '.btn-toggle-active', function(e) {
                let menuId = $(this).data('id');
                let isActive = $(this).data('active');
                let actionText = isActive == 1 ? 'deactivate' : 'activate';
                let message = isActive == 1 ? 'This menu will be hidden from the frontend navigation!' : 'This menu will be shown in the frontend navigation!';
                let color = isActive == 1 ? '#d63939' : '#2fb344';

                let url = "{{ route('admin.menu.toggle-active', ':id') }}";
                url = url.replace(':id', menuId);

                Swal.fire({
                    title: 'Confirm ' + actionText + '?',
                    text: message,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: color,
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, update!',
                    cancelButtonText: 'Cancel'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: "POST",
                            url: url,
                            data: {
                                _token: "{{ csrf_token() }}",
                                _method: "PUT"
                            },
                            success: function(response) {
                                toastr.success(response.message, "Success");
                                $('#table').DataTable().ajax.reload(null, false);
                            },
                            error: function(xhr) {
                                Swal.fire('Error!', 'Something went wrong.', 'error');
                            }
                        });
                    }
                });
            });
        });
    </script>
@endpush
