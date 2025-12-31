@extends('templates.backend.master')

@section('page-title', 'Users Management')
@section('page-link', route('admin.user.index'))

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
            <div class="card">
                <div class="card-body">
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
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->tenant->name ?? '' }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->phone }}</td>
                                        <td>{!! $user->status == 'pending'
                                            ? '<span class="badge bg-info">Pending</span>'
                                            : ($user->status == 'approved'
                                                ? '<span class="badge bg-success">Approved</span>'
                                                : '<span class="badge bg-danger">Rejected</span>') !!}</td>
                                        <td>{!! $user->is_active == true
                                            ? '<span class="badge bg-primary">Active</span>'
                                            : '<span class="badge bg-danger">Not Active</span>' !!}</td>
                                        <td>
                                            <a href="{{ route('admin.user.edit', $user->id) }}">
                                                <button type="button"
                                                    class="justify-content-center w-80 btn mb-1 bg-primary-subtle text-primary">
                                                    <i class="ti ti-pencil fs-4 me-2"></i>
                                                    Edit
                                                </button>
                                            </a>
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

    <script>
        $(document).ready(function() {
            $('#table').DataTable();
        });
    </script>
@endpush
