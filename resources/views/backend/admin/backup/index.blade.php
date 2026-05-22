@extends('templates.backend.master')

@section('page-title', 'Database Backups')
@section('page-link', route('admin.backup.index'))

@section('content')
<div class="container-fluid">
    {{-- Header --}}
    <div class="d-flex align-items-center justify-content-between mb-4">
        <div>
            <h4 class="mb-0 fw-semibold">Database Backups</h4>
            <p class="text-muted mb-0">Create, download, and manage secure SQL database dumps.</p>
        </div>
        <div>
            <button type="button" id="btn-run-backup" class="btn btn-primary d-flex align-items-center gap-2">
                <i class="ti ti-database-export"></i> Backup Database Now
            </button>
        </div>
    </div>

    {{-- Database Metrics Cards --}}
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card shadow-none border bg-light-subtle mb-0">
                <div class="card-body p-3">
                    <div class="d-flex align-items-center">
                        <span class="round-40 rounded bg-primary text-white d-flex align-items-center justify-content-center">
                            <i class="ti ti-database fs-6"></i>
                        </span>
                        <div class="ms-3">
                            <h6 class="mb-0 text-muted small">Database Name</h6>
                            <h5 class="mb-0 fw-bold">{{ $dbName }}</h5>
                            <span class="badge bg-primary-subtle text-primary fs-1 text-uppercase">{{ $dbEngine }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-none border bg-light-subtle mb-0">
                <div class="card-body p-3">
                    <div class="d-flex align-items-center">
                        <span class="round-40 rounded bg-success text-white d-flex align-items-center justify-content-center">
                            <i class="ti ti-table fs-6"></i>
                        </span>
                        <div class="ms-3">
                            <h6 class="mb-0 text-muted small">Total Tables</h6>
                            <h4 class="mb-0 fw-bold text-success">{{ number_format($tableCount) }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-none border bg-light-subtle mb-0">
                <div class="card-body p-3">
                    <div class="d-flex align-items-center">
                        <span class="round-40 rounded bg-info text-white d-flex align-items-center justify-content-center">
                            <i class="ti ti-archive fs-6"></i>
                        </span>
                        <div class="ms-3">
                            <h6 class="mb-0 text-muted small">Estimated DB Size</h6>
                            <h4 class="mb-0 fw-bold text-info">{{ $dbSizeFormatted }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-none border bg-light-subtle mb-0">
                <div class="card-body p-3">
                    <div class="d-flex align-items-center">
                        <span class="round-40 rounded bg-warning text-white d-flex align-items-center justify-content-center">
                            <i class="ti ti-list-details fs-6"></i>
                        </span>
                        <div class="ms-3">
                            <h6 class="mb-0 text-muted small">Total Records / Rows</h6>
                            <h4 class="mb-0 fw-bold text-warning">{{ number_format($totalRows) }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Backups list --}}
    <div class="row">
        <div class="col-12">
            <div class="card shadow-none border">
                <div class="card-body p-0">
                    <div class="p-3 border-bottom d-flex align-items-center justify-content-between">
                        <h5 class="card-title mb-0">Available SQL Backups</h5>
                        <span class="text-muted small">Stored securely in Storage</span>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th class="ps-3" style="width: 50px;">#</th>
                                    <th>Backup Filename</th>
                                    <th>File Size</th>
                                    <th>Created Date</th>
                                    <th class="text-center" style="width: 200px;">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(count($backups) > 0)
                                    @foreach($backups as $index => $backup)
                                        <tr>
                                            <td class="ps-3 text-muted">{{ $index + 1 }}</td>
                                            <td>
                                                <div class="d-flex align-items-center gap-2">
                                                    <i class="ti ti-file-database text-primary fs-6"></i>
                                                    <span class="fw-semibold text-dark">{{ $backup['filename'] }}</span>
                                                </div>
                                            </td>
                                            <td><span class="badge bg-secondary-subtle text-secondary">{{ $backup['size'] }}</span></td>
                                            <td class="text-muted">{{ $backup['created_at'] }}</td>
                                            <td class="text-center">
                                                <div class="d-flex align-items-center justify-content-center gap-2">
                                                    <a href="{{ route('admin.backup.download', $backup['filename']) }}" 
                                                       class="btn btn-sm btn-light d-flex align-items-center gap-1">
                                                        <i class="ti ti-download text-success"></i> Download
                                                    </a>
                                                    <button type="button" 
                                                            class="btn btn-sm btn-light btn-delete-backup d-flex align-items-center gap-1" 
                                                            data-filename="{{ $backup['filename'] }}">
                                                        <i class="ti ti-trash text-danger"></i> Delete
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="5" class="text-center py-5">
                                            <i class="ti ti-database-off fs-9 text-muted mb-2"></i>
                                            <h5>No backups generated yet</h5>
                                            <p class="text-muted">Click the "Backup Database Now" button to create your first SQL dump.</p>
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        // Run Backup
        $('#btn-run-backup').on('click', function() {
            Swal.fire({
                title: 'Start Database Backup?',
                text: 'This will inspect tables, write schema structures, dump records, and save a secure SQL snapshot.',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#aaa',
                confirmButtonText: 'Yes, back it up!'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: 'Generating Backup...',
                        text: 'Please wait while we dump tables and compile schema structures.',
                        allowOutsideClick: false,
                        didOpen: () => {
                            Swal.showLoading();
                        }
                    });

                    $.ajax({
                        url: '{{ route("admin.backup.run") }}',
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            Swal.fire(
                                'Success!',
                                response.success || 'Backup file generated successfully.',
                                'success'
                            ).then(() => {
                                window.location.reload();
                            });
                        },
                        error: function(xhr) {
                            let msg = xhr.responseJSON?.error || 'An error occurred while backing up database.';
                            Swal.fire('Error', msg, 'error');
                        }
                    });
                }
            });
        });

        // Delete Backup
        $('.btn-delete-backup').on('click', function() {
            const filename = $(this).data('filename');
            
            Swal.fire({
                title: 'Delete Backup File?',
                text: `Are you sure you want to permanently delete backup: ${filename}?`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.showLoading();
                    
                    $.ajax({
                        url: '{{ url("dashboard/backup/delete") }}/' + filename,
                        type: 'DELETE',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            Swal.fire(
                                'Deleted!',
                                response.success || 'Backup deleted successfully.',
                                'success'
                            ).then(() => {
                                window.location.reload();
                            });
                        },
                        error: function(xhr) {
                            let msg = xhr.responseJSON?.error || 'An error occurred while deleting backup.';
                            Swal.fire('Error', msg, 'error');
                        }
                    });
                }
            });
        });
    });
</script>
@endpush
