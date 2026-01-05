@extends('templates.backend.master')

@section('page-title', 'Users Management')
@section('page-link', route('admin.user.index'))

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
                        <span class="align-middle">To activate a user, the user must have already validated their email.</span>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    <div class="table-responsive">
                        <table id="table" class="table table-striped table-bordered text-nowrap align-middle">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Name</th>
                                    <th>Tenant</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Approval Status</th>
                                    <th>Account Status</th>
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
                ajax: "{{ route('admin.user.index') }}",
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
                        data: 'tenant.name',
                        name: 'tenant.name',
                        defaultContent: '-'
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'phone',
                        name: 'phone',
                        defaultContent: '-'
                    },
                    {
                        data: 'status',
                        name: 'status'
                    },
                    {
                        data: 'is_active',
                        name: 'is_active'
                    },
                    {
                        data: 'action',
                        name: 'action'
                    },
                ]
            });

            $('body').on('click', '.btn-approve', function(e) {
                let userId = $(this).data('user-id');
                confirmAction(userId, 'approved', 'Data will approved!', '#2fb344');
            });

            $('body').on('click', '.btn-reject', function(e) {
                let userId = $(this).data('user-id');
                confirmAction(userId, 'rejected', 'Data will rejected!', '#d63939');
            });

            function confirmAction(userId, action, message, color) {
                let url = "{{ route('admin.user.activate', ':id') }}";
                url = url.replace(':id', userId);


                Swal.fire({
                    title: 'Activate this account?',
                    text: message,
                    input: action === 'rejected' ? 'textarea' : null,
                    inputPlaceholder: 'Type your reason here...',
                    icon: action === 'approved' ? 'success' : 'warning',
                    showCancelButton: true,
                    confirmButtonColor: color,
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, update!',
                    cancelButtonText: 'Cancel',
                    inputValidator: (value) => {
                        if (action === 'rejected' && !value) {
                            return 'You must provide a reason for rejection!';
                        }
                    }
                }).then((result) => {
                    let reason = result.value;
                    if (result.isConfirmed || result.isDenied) {

                        $.ajax({
                            type: "POST",
                            url: url,
                            data: {
                                _token: "{{ csrf_token() }}",
                                _method: "PUT",
                                action: action,
                                reason: reason
                            },
                            success: function(response) {
                                Swal.fire(
                                    'Success', 'Status updated.', 'success'
                                ).then(() => location.reload());
                            },
                            error: function(xhr) {
                                Swal.fire('Error!', 'Something went wrong.', 'error');
                            }
                        });
                    }
                })
            };
        });
    </script>
@endpush
