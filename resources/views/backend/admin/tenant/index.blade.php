@extends('templates.backend.master')

@section('page-title', 'Tenant Management')
@section('page-link', route('admin.tenant.index'))

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
                                    <th>Category</th>
                                    <th>Type</th>
                                    <th>Name</th>
                                    <th>Phone</th>
                                    <th>Map Coord</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
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
            $('#table').DataTable({
                processing: true,
                serverSide: true,
                searchDelay: 500,
                ajax: "{{ route('admin.tenant.index') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'category',
                        name: 'category',
                        defaultContent: '-'
                    },
                    {
                        data: 'type',
                        name: 'type',
                        defaultContent: '-'
                    },
                    {
                        data: 'name',
                        name: 'name',
                        defaultContent: '-'
                    },
                    {
                        data: 'phone',
                        name: 'phone',
                        defaultContent: '-'
                    },
                    {
                        data: 'map_coords',
                        name: 'map_coords',
                        defaultContent: '-'
                    },
                    {
                        data: 'is_active',
                        name: 'is_active',
                        defaultContent: '-'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ]
            });
        });
    </script>
@endpush
