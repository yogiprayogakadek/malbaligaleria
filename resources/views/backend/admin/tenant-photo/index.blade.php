@extends('templates.backend.master')

@section('page-title', 'Tenant Photo')
@section('page-link', route('admin.tenant.photo.index'))

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
                    <div class="table-responsive">
                        <table id="table" class="table table-striped table-bordered text-nowrap align-middle">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Name</th>
                                    <th>Display Image</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tenantPhotos as $tenantPhoto)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $tenantPhoto->tenant->name }}</td>
                                        <td>
                                            <img src="{{ asset('storage/' . $tenantPhoto->path) }}"
                                                alt="{{ $tenantPhoto->caption }}" class="rounded-1"
                                                style="width: 200px; height: 200px">
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.tenant.photo.edit', $tenantPhoto->id) }}">
                                                <button type="button"
                                                    class="justify-content-center w-80 btn mb-1 bg-primary-subtle text-primary">
                                                    <i class="ti ti-pencil fs-4 me-2"></i>
                                                    Edit
                                                </button>
                                            </a>
                                            <button type="button"
                                                class="justify-content-center w-80 btn mb-1 bg-danger-subtle text-danger btn-delete"
                                                data-id="{{ $tenantPhoto->id }}">
                                                <i class="ti ti-trash fs-4 me-2"></i>
                                                Delete
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
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
            $('#table').DataTable();
        });

        $('body').on('click', '.btn-delete', function() {
            let tenantPhotoId = $(this).data('id');

            Swal.fire({
                title: 'Delete this data?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '/admin/tenant-photo/delete/' + tenantPhotoId,
                        type: 'DELETE',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            toastr.success(
                                "Data deleted successfully.",
                                "Success", {
                                    showMethod: "slideDown",
                                    hideMethod: "slideUp",
                                    timeOut: 2000
                                }
                            );
                            location.reload();
                        },
                        error: function(xhr) {
                            toastr.error(
                                "An error occurred while deleting the image.",
                                "Error", {
                                    showMethod: "slideDown",
                                    hideMethod: "slideUp",
                                    timeOut: 2000
                                }
                            );
                        }
                    });
                }
            });
        });
    </script>
@endpush
