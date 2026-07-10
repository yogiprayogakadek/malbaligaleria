@extends('templates.backend.master')

@section('page-title', 'Subdomain Access')
@section('page-link', route('admin.subdomain-access.index'))

@push('css')
    <link rel="stylesheet" href="{{ asset('assets/backend/css/dataTables.bootstrap5.min.css') }}">
@endpush

@section('content')
<div class="row mb-4 align-items-center">
    <div class="col">
        <h5 class="fw-semibold mb-1">Subdomain Access Management</h5>
        <p class="text-muted mb-0">Kelola siapa yang dapat mengakses subdomain sistem (Inventory, dll.)</p>
    </div>
    <div class="col-auto">
        <a href="{{ route('admin.subdomain-access.create') }}" class="btn btn-primary hstack gap-2">
            <i class="ti ti-user-plus fs-4"></i> Tambah Akses
        </a>
    </div>
</div>

{{-- Alert status --}}
@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show mb-4">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

{{-- Filter --}}
<div class="card mb-4">
    <div class="card-body py-3">
        <div class="row g-3 align-items-end">
            <div class="col-md-4">
                <label class="form-label mb-1 small fw-medium">Filter Subdomain</label>
                <select id="filter_subdomain" class="form-select form-select-sm">
                    <option value="">Semua Subdomain</option>
                    @foreach($subdomains as $sd)
                        <option value="{{ $sd }}">{{ $sd }}</option>
                    @endforeach
                    <option value="inventory">inventory</option>
                </select>
            </div>
            <div class="col-auto">
                <button id="btn-filter" class="btn btn-primary btn-sm">Filter</button>
                <button id="btn-reset" class="btn btn-outline-secondary btn-sm ms-1">Reset</button>
            </div>
        </div>
    </div>
</div>

{{-- DataTable --}}
<div class="card">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table id="table-access" class="table table-hover mb-0" style="width:100%">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Nama User</th>
                        <th>Email</th>
                        <th>Subdomain</th>
                        <th>Status</th>
                        <th>Expired</th>
                        <th>Diberikan Oleh</th>
                        <th>Catatan</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@push('script')
<script src="{{ asset('assets/backend/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/backend/js/dataTables.bootstrap5.min.js') }}"></script>
<script src="{{ asset('assets/backend/js/sweetalert2.all.min.js') }}"></script>
<script>
let table;

function initTable() {
    if (table) table.destroy();

    table = $('#table-access').DataTable({
        processing: true, serverSide: true,
        ajax: {
            url: "{{ route('admin.subdomain-access.index') }}",
            data: d => { d.subdomain = $('#filter_subdomain').val(); }
        },
        columns: [
            { data: 'DT_RowIndex', orderable: false, searchable: false, width: '50px' },
            { data: 'user_name' },
            { data: 'user_email' },
            { data: 'subdomain' },
            { data: 'is_active', orderable: false },
            { data: 'expires_at', orderable: false },
            { data: 'granted_by_name' },
            { data: 'note', defaultContent: '-' },
            { data: 'action', orderable: false, searchable: false, className: 'text-center' },
        ],
        order: [[0, 'asc']],
        language: { emptyTable: 'Belum ada data akses subdomain.' }
    });
}

$(function() {
    initTable();

    $('#btn-filter').on('click', () => initTable());
    $('#btn-reset').on('click', () => { $('#filter_subdomain').val(''); initTable(); });

    // Toggle
    $(document).on('click', '.btn-toggle', function() {
        const id = $(this).data('id');
        $.ajax({
            url: `/dashboard/subdomain-access/${id}/toggle`,
            type: 'PATCH',
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            success: () => table.ajax.reload(null, false)
        });
    });

    // Revoke
    $(document).on('click', '.btn-revoke', function() {
        const id = $(this).data('id'), name = $(this).data('name');
        Swal.fire({
            title: 'Cabut akses?',
            text: `Cabut akses subdomain untuk "${name}"?`,
            icon: 'warning', showCancelButton: true,
            confirmButtonColor: '#e3342f', confirmButtonText: 'Ya, Cabut',
            cancelButtonText: 'Batal'
        }).then(result => {
            if (!result.isConfirmed) return;
            $.ajax({
                url: `/dashboard/subdomain-access/${id}/destroy`,
                type: 'DELETE',
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                success: () => { Swal.fire('Dicabut!', 'Akses berhasil dicabut.', 'success'); table.ajax.reload(null, false); }
            });
        });
    });
});
</script>
@endpush
