@extends('templates.backend.master')

@section('page-title', 'IP Whitelist')
@section('page-link', route('admin.ip-whitelist.index'))

@push('css')
    <link rel="stylesheet" href="{{ asset('assets/backend/css/dataTables.bootstrap5.min.css') }}">
@endpush

@section('content')
<div class="row mb-4 align-items-center">
    <div class="col">
        <h5 class="fw-semibold mb-1">IP Whitelist Management</h5>
        <p class="text-muted mb-0">Kelola daftar IP yang diizinkan untuk mengakses subdomain tertentu.</p>
    </div>
    <div class="col-auto">
        <a href="{{ route('admin.ip-whitelist.create') }}" class="btn btn-primary hstack gap-2">
            <i class="ti ti-plus fs-4"></i> Tambah IP Whitelist
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

<div class="row mb-4">
    <div class="col-md-3">
        <div class="card card-body bg-light-primary text-primary border-0 mb-0">
            <div class="d-flex align-items-center">
                <span class="round-40 text-bg-primary d-flex align-items-center justify-content-center rounded-circle">
                    <i class="ti ti-shield fs-6"></i>
                </span>
                <div class="ms-3">
                    <h4 class="mb-0 fw-semibold">{{ $activeCount }} IP</h4>
                    <p class="mb-0 small text-muted">Aktif untuk Inventory</p>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-9">
        <div class="card mb-0">
            <div class="card-body py-3">
                <div class="row g-3 align-items-end">
                    <div class="col-md-5">
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
    </div>
</div>

{{-- DataTable --}}
<div class="card">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table id="table-ip" class="table table-hover mb-0" style="width:100%">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Subdomain</th>
                        <th>IP Address</th>
                        <th>Label / Nama Lokasi</th>
                        <th>Status</th>
                        <th>Ditambahkan Oleh</th>
                        <th>Tanggal Dibuat</th>
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

    table = $('#table-ip').DataTable({
        processing: true, serverSide: true,
        ajax: {
            url: "{{ route('admin.ip-whitelist.index') }}",
            data: d => { d.subdomain = $('#filter_subdomain').val(); }
        },
        columns: [
            { data: 'DT_RowIndex', orderable: false, searchable: false, width: '50px' },
            { data: 'subdomain' },
            { data: 'ip_address' },
            { data: 'label', defaultContent: '-' },
            { data: 'is_active', orderable: false },
            { data: 'added_by' },
            { data: 'created_at', render: data => data ? new Date(data).toLocaleDateString('id-ID', {day: '2-digit', month: 'short', year: 'numeric'}) : '-' },
            { data: 'action', orderable: false, searchable: false, className: 'text-center', width: '150px' },
        ],
        order: [[0, 'asc']],
        language: { emptyTable: 'Belum ada IP yang terdaftar.' }
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
            url: `/dashboard/ip-whitelist/${id}/toggle`,
            type: 'PATCH',
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            success: () => table.ajax.reload(null, false)
        });
    });

    // Delete
    $(document).on('click', '.btn-delete', function() {
        const id = $(this).data('id'), ip = $(this).data('ip');
        Swal.fire({
            title: 'Hapus IP?',
            text: `Hapus IP "${ip}" dari whitelist?`,
            icon: 'warning', showCancelButton: true,
            confirmButtonColor: '#e3342f', confirmButtonText: 'Ya, Hapus',
            cancelButtonText: 'Batal'
        }).then(result => {
            if (!result.isConfirmed) return;
            $.ajax({
                url: `/dashboard/ip-whitelist/${id}/destroy`,
                type: 'DELETE',
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                success: () => { Swal.fire('Dihapus!', 'IP berhasil dihapus dari whitelist.', 'success'); table.ajax.reload(null, false); }
            });
        });
    });
});
</script>
@endpush
