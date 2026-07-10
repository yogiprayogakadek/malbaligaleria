@extends('templates.inventory.master')

@section('page-title', 'Asset Audit Log')
@section('page-subtitle', 'Riwayat perubahan aset')

@push('css')
    <style>
        .timeline-widget {
            position: relative;
            padding-left: 30px;
        }
        .timeline-widget::before {
            content: "";
            position: absolute;
            left: 9px;
            top: 5px;
            bottom: 5px;
            width: 2px;
            background: #e9ecef;
        }
        .timeline-item {
            position: relative;
            margin-bottom: 30px;
        }
        .timeline-badge {
            position: absolute;
            left: -30px;
            top: 2px;
            width: 20px;
            height: 20px;
            border-radius: 50%;
            background: #fff;
            border: 4px solid #0d6efd;
            z-index: 1;
        }
        .timeline-badge.bg-success { border-color: #198754; }
        .timeline-badge.bg-warning { border-color: #ffc107; }
        .timeline-badge.bg-danger { border-color: #dc3545; }
        
        .change-table th {
            width: 30%;
            font-size: 13px;
        }
        .change-table td {
            font-size: 13px;
        }
    </style>
@endpush

@section('content')
    <div class="row mb-4 align-items-center">
        <div class="col">
            <h4 class="mb-0 text-dark fw-bold">Asset Audit History</h4>
            <p class="text-muted mb-0">Audit history trail for **{{ $item->name }}**</p>
        </div>
        <div class="col-auto">
            <a href="{{ route('inventory.assets.index') }}" class="btn btn-outline-secondary hstack gap-2">
                <i class="ti ti-arrow-left fs-4"></i> Back to List
            </a>
        </div>
    </div>

    <div class="row">
        <!-- Asset Summary Card -->
        <div class="col-lg-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="fw-semibold text-primary mb-3"><i class="ti ti-info-circle me-1"></i> Asset Profile</h5>
                    
                    <table class="table table-sm table-borderless mb-0">
                        <tr>
                            <td class="fw-bold text-muted" style="width: 40%">Name:</td>
                            <td class="text-dark">{{ $item->name }}</td>
                        </tr>
                        <tr>
                            <td class="fw-bold text-muted">Category:</td>
                            <td>{{ $item->category ? $item->category->name : '-' }}</td>
                        </tr>
                        <tr>
                            <td class="fw-bold text-muted">Brand / Model:</td>
                            <td>{{ $item->brand ?? '-' }} / {{ $item->model ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td class="fw-bold text-muted">Serial No:</td>
                            <td><code>{{ $item->serial_number ?? '-' }}</code></td>
                        </tr>
                        <tr>
                            <td class="fw-bold text-muted">Location:</td>
                            <td>{{ $item->location ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td class="fw-bold text-muted">Status:</td>
                            <td>
                                @php
                                    $badges = ['active' => 'success', 'maintenance' => 'warning', 'broken' => 'danger', 'stored' => 'secondary'];
                                    $badge = $badges[$item->status] ?? 'info';
                                @endphp
                                <span class="badge bg-{{ $badge }}">{{ ucfirst($item->status) }}</span>
                            </td>
                        </tr>
                    </table>

                    @if(!empty($item->specs) && is_array($item->specs))
                        <h6 class="fw-semibold text-primary mt-4 mb-2"><i class="ti ti-settings me-1"></i> Tech Specs</h6>
                        <table class="table table-sm table-bordered mb-0">
                            @foreach($item->specs as $key => $val)
                                <tr>
                                    <td class="bg-light text-muted small" style="width: 45%">{{ $key }}</td>
                                    <td class="small">{{ $val }}</td>
                                </tr>
                            @endforeach
                        </table>
                    @endif
                </div>
            </div>
        </div>

        <!-- History Timeline -->
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <h5 class="fw-semibold text-primary mb-4"><i class="ti ti-history me-1"></i> Timeline Events</h5>

                    @if($logs->isEmpty())
                        <div class="alert alert-info text-center">
                            No logs recorded for this asset yet.
                        </div>
                    @else
                        <div class="timeline-widget">
                            @foreach($logs as $log)
                                <div class="timeline-item">
                                    @php
                                        $badgeClass = 'bg-primary';
                                        if ($log->action == 'create') $badgeClass = 'bg-success';
                                        if ($log->action == 'delete') $badgeClass = 'bg-danger';
                                        if ($log->action == 'status_change') $badgeClass = 'bg-warning';
                                    @endphp
                                    <div class="timeline-badge {{ $badgeClass }}"></div>
                                    
                                    <div class="d-flex justify-content-between align-items-center mb-1">
                                        <h6 class="fw-bold text-dark mb-0">
                                            @if($log->action == 'create')
                                                <span class="text-success"><i class="ti ti-plus"></i> Asset Created</span>
                                            @elseif($log->action == 'update')
                                                <span class="text-primary"><i class="ti ti-pencil"></i> Asset Updated</span>
                                            @elseif($log->action == 'delete')
                                                <span class="text-danger"><i class="ti ti-trash"></i> Asset Deleted</span>
                                            @else
                                                <span>{{ ucfirst($log->action) }}</span>
                                            @endif
                                        </h6>
                                        <span class="small text-muted">{{ $log->created_at->format('d M Y, H:i') }}</span>
                                    </div>
                                    <p class="small text-muted mb-2">Performed by: <strong>{{ $log->user ? $log->user->name : 'System' }}</strong></p>
                                    
                                    <!-- Log Details -->
                                    <div class="bg-light rounded p-3 mb-2">
                                        @if($log->notes)
                                            <p class="mb-2 text-dark font-monospace small"><em>Notes: {{ $log->notes }}</em></p>
                                        @endif

                                        @if($log->action == 'update' && !empty($log->changes))
                                            <table class="table table-sm table-bordered change-table bg-white mb-0">
                                                <thead>
                                                    <tr class="table-light">
                                                        <th>Field</th>
                                                        <th>Old Value</th>
                                                        <th>New Value</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($log->changes as $field => $change)
                                                        <tr>
                                                            <td class="fw-bold text-muted">{{ ucfirst(str_replace('_', ' ', $field)) }}</td>
                                                            <td>
                                                                @if(is_array($change['old']))
                                                                    <pre class="mb-0 small" style="font-size: 11px;">{{ json_encode($change['old'], JSON_PRETTY_PRINT) }}</pre>
                                                                @else
                                                                    <span class="text-danger"><del>{{ $change['old'] ?? '(empty)' }}</del></span>
                                                                @endif
                                                            </td>
                                                            <td>
                                                                @if(is_array($change['new']))
                                                                    <pre class="mb-0 small" style="font-size: 11px;">{{ json_encode($change['new'], JSON_PRETTY_PRINT) }}</pre>
                                                                @else
                                                                    <span class="text-success font-weight-bold">{{ $change['new'] ?? '(empty)' }}</span>
                                                                @endif
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        @elseif($log->action == 'create')
                                            <span class="text-muted small">Initial records logged.</span>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
