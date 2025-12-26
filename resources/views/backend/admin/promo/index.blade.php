@extends('templates.backend.master')

@section('page-title', 'Promo Management')
@section('page-link', route('admin.promo.index'))

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
                                    <th>Tenant</th>
                                    <th>Promo Name</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($promos as $promo)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $promo->tenant->name }}</td>
                                        <td>{{ $promo->name }}</td>
                                        <td>{{ date_format(date_create($promo->start_date), 'd M Y') }}</td>
                                        <td>{{ date_format(date_create($promo->end_date), 'd M Y') }}</td>
                                        <td>{!! $promo->is_active == true
                                            ? '<span class="badge bg-primary">Active</span>'
                                            : '<span class="badge bg-danger">Not Active</span>' !!}</td>
                                        <td>
                                            <a href="{{ route('admin.promo.edit', $promo->uuid) }}">
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
