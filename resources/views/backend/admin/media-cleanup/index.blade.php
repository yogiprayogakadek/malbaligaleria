@extends('templates.backend.master')

@section('page-title', 'Media Cleanup')
@section('page-link', route('admin.media-cleanup.index'))

@push('css')
<link rel="stylesheet" href="{{ asset('assets/backend/css/sweetalert2.min.css') }}">
@endpush

@section('content')
<div class="container-fluid">
    {{-- Header --}}
    <div class="d-flex align-items-center justify-content-between mb-4">
        <div>
            <h4 class="mb-0 fw-semibold">Orphaned Media Cleanup</h4>
            <p class="text-muted mb-0">Identify and safely delete media files that are no longer linked to database records.</p>
        </div>
        <div>
            @if(count($orphanedFiles) > 0)
                <button type="button" id="btn-cleanup-all" class="btn btn-danger d-flex align-items-center gap-2">
                    <i class="ti ti-trash-x"></i> Purge All Orphaned Media
                </button>
            @endif
        </div>
    </div>

    {{-- Reclaim Stats Cards --}}
    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card shadow-none border bg-danger-subtle mb-0">
                <div class="card-body p-3">
                    <div class="d-flex align-items-center">
                        <span class="round-40 rounded bg-danger text-white d-flex align-items-center justify-content-center">
                            <i class="ti ti-trash fs-6"></i>
                        </span>
                        <div class="ms-3">
                            <h6 class="mb-0 text-muted small">Total Orphaned Files</h6>
                            <h4 class="mb-0 fw-bold text-danger">{{ number_format($stats['total_count']) }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-none border bg-success-subtle mb-0">
                <div class="card-body p-3">
                    <div class="d-flex align-items-center">
                        <span class="round-40 rounded bg-success text-white d-flex align-items-center justify-content-center">
                            <i class="ti ti-device-sdcard fs-6"></i>
                        </span>
                        <div class="ms-3">
                            <h6 class="mb-0 text-muted small">Reclaimable Space</h6>
                            <h4 class="mb-0 fw-bold text-success">{{ $stats['total_size'] }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-none border bg-light-subtle mb-0">
                <div class="card-body p-3">
                    <div class="d-flex align-items-center">
                        <span class="round-40 rounded bg-primary text-white d-flex align-items-center justify-content-center">
                            <i class="ti ti-folder fs-6"></i>
                        </span>
                        <div class="ms-3">
                            <h6 class="mb-0 text-muted small">Scan Scope</h6>
                            <h5 class="mb-0 fw-bold text-primary">5 Public Directories</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Category breakdown panel --}}
    <div class="row mb-4">
        <div class="col-12">
            <div class="card shadow-none border">
                <div class="card-body p-3">
                    <h6 class="fw-semibold mb-3">Space Occupied by Category</h6>
                    <div class="row g-2">
                        @foreach($stats['by_category'] as $categoryName => $catStats)
                            <div class="col-md-2-4 col-sm-6">
                                <div class="p-2 border rounded text-center bg-light-subtle">
                                    <span class="text-muted small d-block mb-1">{{ $categoryName }}</span>
                                    <span class="fw-bold text-dark d-block fs-4">{{ number_format($catStats['count']) }} files</span>
                                    <span class="badge bg-secondary-subtle text-secondary fs-2">{{ $catStats['size'] }}</span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- File list --}}
    <div class="row">
        <div class="col-12">
            <div class="card shadow-none border">
                <div class="card-body p-0">
                    <div class="p-3 border-bottom d-flex align-items-center justify-content-between">
                        <h5 class="card-title mb-0">Scanned Orphaned Files</h5>
                        <span class="text-muted small">Updated just now</span>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th class="ps-3" style="width: 50px;">#</th>
                                    <th>File Category</th>
                                    <th>Filename / Path</th>
                                    <th>File Size</th>
                                    <th>Last Modified</th>
                                    <th class="text-center" style="width: 150px;">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(count($orphanedFiles) > 0)
                                    @foreach($orphanedFiles as $index => $file)
                                        <tr>
                                            <td class="ps-3 text-muted">{{ $index + 1 }}</td>
                                            <td>
                                                <span class="badge bg-info-subtle text-info fw-semibold">{{ $file['category'] }}</span>
                                            </td>
                                            <td>
                                                <div>
                                                    <a href="{{ asset('storage/' . $file['path']) }}" target="_blank" class="fw-semibold text-dark text-decoration-none">
                                                        {{ $file['filename'] }}
                                                    </a>
                                                    <span class="text-muted d-block font-monospace" style="font-size: 11px;">storage/app/public/{{ $file['path'] }}</span>
                                                </div>
                                            </td>
                                            <td><span class="text-muted font-monospace">{{ $file['size'] }}</span></td>
                                            <td class="text-muted">{{ $file['modified_at'] }}</td>
                                            <td class="text-center">
                                                <button type="button" 
                                                        class="btn btn-sm btn-light btn-delete-file d-flex align-items-center justify-content-center gap-1 mx-auto" 
                                                        data-path="{{ $file['path'] }}"
                                                        data-filename="{{ $file['filename'] }}">
                                                    <i class="ti ti-trash text-danger"></i> Delete File
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="6" class="text-center py-5">
                                            <i class="ti ti-circle-check fs-9 text-success mb-2"></i>
                                            <h5>All clear! No orphaned files found</h5>
                                            <p class="text-muted mb-0">All files inside public media directories are fully referenced in the database.</p>
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

@push('script')
<script src="{{ asset('assets/backend/js/sweetalert2.min.js') }}"></script>
<script>
    $(document).ready(function() {
        // Individual file delete
        $('.btn-delete-file').on('click', function() {
            const path = $(this).data('path');
            const filename = $(this).data('filename');

            Swal.fire({
                title: 'Delete Media File?',
                text: `Are you sure you want to permanently delete: ${filename}? This action cannot be undone.`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.showLoading();
                    $.ajax({
                        url: '{{ route("admin.media-cleanup.destroy") }}',
                        type: 'DELETE',
                        data: {
                            path: path,
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            Swal.fire(
                                'Deleted!',
                                response.success || 'File deleted successfully.',
                                'success'
                            ).then(() => {
                                window.location.reload();
                            });
                        },
                        error: function(xhr) {
                            let msg = xhr.responseJSON?.error || 'An error occurred while deleting file.';
                            Swal.fire('Error', msg, 'error');
                        }
                    });
                }
            });
        });

        // Mass cleanup
        $('#btn-cleanup-all').on('click', function() {
            Swal.fire({
                title: 'Purge ALL Orphaned Media?',
                text: 'WARNING: This will permanently delete all unreferenced files from disk. This cannot be undone!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, purge everything!'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.showLoading();
                    $.ajax({
                        url: '{{ route("admin.media-cleanup.destroy-mass") }}',
                        type: 'DELETE',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            Swal.fire(
                                'Purged!',
                                response.success || 'Orphaned media files deleted successfully.',
                                'success'
                            ).then(() => {
                                window.location.reload();
                            });
                        },
                        error: function(xhr) {
                            let msg = xhr.responseJSON?.error || 'An error occurred while cleaning media.';
                            Swal.fire('Error', msg, 'error');
                        }
                    });
                }
            });
        });
    });
</script>
@endpush
