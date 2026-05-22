@extends('templates.backend.master')

@section('page-title', 'Error Logs')
@section('page-link', route('admin.logs.index'))

@section('content')
<div class="container-fluid">
    {{-- Header --}}
    <div class="d-flex align-items-center justify-content-between mb-4">
        <div>
            <h4 class="mb-0 fw-semibold">System Error Logs</h4>
            <p class="text-muted mb-0">View, search, and analyze Laravel application logs.</p>
        </div>
        <div>
            <button type="button" id="btn-clear-logs" class="btn btn-danger d-flex align-items-center gap-2">
                <i class="ti ti-trash"></i> Clear Log File
            </button>
        </div>
    </div>

    {{-- Stats Cards --}}
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card shadow-none border bg-light-subtle mb-0">
                <div class="card-body p-3">
                    <div class="d-flex align-items-center">
                        <span class="round-40 rounded bg-primary text-white d-flex align-items-center justify-content-center">
                            <i class="ti ti-notes fs-6"></i>
                        </span>
                        <div class="ms-3">
                            <h6 class="mb-0 text-muted small">Total Extracted Entries</h6>
                            <h4 class="mb-0 fw-bold">{{ number_format($stats['total']) }}</h4>
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
                            <i class="ti ti-filter fs-6"></i>
                        </span>
                        <div class="ms-3">
                            <h6 class="mb-0 text-muted small">Filtered Results</h6>
                            <h4 class="mb-0 fw-bold text-info">{{ number_format($stats['filtered']) }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-none border bg-light-subtle mb-0">
                <div class="card-body p-3">
                    <div class="d-flex align-items-center">
                        <span class="round-40 rounded bg-danger text-white d-flex align-items-center justify-content-center">
                            <i class="ti ti-bug fs-6"></i>
                        </span>
                        <div class="ms-3">
                            <h6 class="mb-0 text-muted small">Errors / Criticals</h6>
                            <h4 class="mb-0 fw-bold text-danger">{{ number_format($stats['errors']) }}</h4>
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
                            <i class="ti ti-alert-triangle fs-6"></i>
                        </span>
                        <div class="ms-3">
                            <h6 class="mb-0 text-muted small">Warnings</h6>
                            <h4 class="mb-0 fw-bold text-warning">{{ number_format($stats['warnings']) }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Filters Card --}}
    <div class="card shadow-none border mb-4">
        <div class="card-body p-3">
            <form action="{{ route('admin.logs.index') }}" method="GET" class="row g-2 align-items-center">
                <div class="col-md-3">
                    <select name="level" class="form-select" onchange="this.form.submit()">
                        <option value="all" {{ $levelFilter === 'all' ? 'selected' : '' }}>-- All Log Levels --</option>
                        @foreach(array_keys($logLevels) as $level)
                            <option value="{{ strtolower($level) }}" {{ strtolower($levelFilter) === strtolower($level) ? 'selected' : '' }}>
                                {{ $level }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <div class="input-group">
                        <span class="input-group-text bg-transparent"><i class="ti ti-search text-muted"></i></span>
                        <input type="text" name="search" class="form-control" placeholder="Search by error message, timestamp, or trace..." value="{{ $search }}">
                    </div>
                </div>
                <div class="col-md-3 d-flex gap-2">
                    <button type="submit" class="btn btn-primary w-100">Filter</button>
                    @if(!empty($search) || $levelFilter !== 'all')
                        <a href="{{ route('admin.logs.index') }}" class="btn btn-outline-secondary">Reset</a>
                    @endif
                </div>
            </form>
        </div>
    </div>

    {{-- Log entries --}}
    <div class="row">
        <div class="col-12">
            @if(count($filteredLogs) > 0)
                <div class="d-flex flex-column gap-3">
                    @foreach($filteredLogs as $index => $log)
                        @php
                            $badgeClass = $logLevels[$log['level']] ?? 'secondary';
                        @endphp
                        <div class="card shadow-none border mb-0">
                            <div class="card-header bg-light d-flex align-items-center justify-content-between py-2 px-3">
                                <div class="d-flex align-items-center gap-2">
                                    <span class="badge bg-{{ $badgeClass }}-subtle text-{{ $badgeClass }} fw-bold fs-2">
                                        {{ $log['level'] }}
                                    </span>
                                    <span class="font-monospace text-muted small">{{ $log['timestamp'] }}</span>
                                    <span class="badge bg-secondary-subtle text-secondary fs-2">{{ $log['env'] }}</span>
                                </div>
                                @if(!empty($log['stack']))
                                    <button class="btn btn-xs btn-outline-{{ $badgeClass }} py-0 px-2 font-monospace text-uppercase" 
                                            style="font-size:10px;" 
                                            type="button" 
                                            data-bs-toggle="collapse" 
                                            data-bs-target="#trace-{{ $index }}" 
                                            aria-expanded="false">
                                        Toggle Stack Trace
                                    </button>
                                @endif
                            </div>
                            <div class="card-body p-3">
                                <p class="mb-0 text-dark font-monospace text-break" style="font-size: 13px; line-height: 1.5;">
                                    {{ $log['message'] }}
                                </p>
                                
                                @if(!empty($log['stack']))
                                    <div class="collapse mt-3" id="trace-{{ $index }}">
                                        <div class="p-3 bg-dark text-light rounded-3 overflow-x-auto" style="max-height: 400px; font-family: SFMono-Regular, Menlo, Monaco, Consolas, monospace; font-size: 11px; line-height: 1.6;">
                                            <pre class="mb-0 text-break white-space-pre-wrap">{{ $log['stack'] }}</pre>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="card shadow-none border text-center py-5">
                    <div class="card-body">
                        <i class="ti ti-notes-off fs-9 text-muted mb-2"></i>
                        <h5>No logs found</h5>
                        <p class="text-muted">There are no log entries matching your current filters or the log file is empty.</p>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

@push('css')
<link rel="stylesheet" href="{{ asset('assets/backend/css/sweetalert2.min.css') }}">
@endpush

@push('script')
<script src="{{ asset('assets/backend/js/sweetalert2.min.js') }}"></script>
<script>
    $(document).ready(function() {
        $('#btn-clear-logs').on('click', function() {
            Swal.fire({
                title: 'Clear Log File?',
                text: 'All current log entries in laravel.log will be deleted permanently.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, clear it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.showLoading();
                    $.ajax({
                        url: '{{ route("admin.logs.clear") }}',
                        type: 'DELETE',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            Swal.fire(
                                'Cleared!',
                                response.success || 'Logs cleared successfully.',
                                'success'
                            ).then(() => {
                                window.location.reload();
                            });
                        },
                        error: function(xhr) {
                            let msg = xhr.responseJSON?.error || 'An error occurred while clearing logs.';
                            Swal.fire('Error', msg, 'error');
                        }
                    });
                }
            });
        });
    });
</script>
@endpush
