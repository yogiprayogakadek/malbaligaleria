@extends('templates.backend.master')

@section('page-title', 'Email Logs')
@section('page-link', route('admin.career.email-logs.index'))

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex flex-wrap justify-content-between align-items-center gap-3">
                    <h4 class="card-title mb-0">Outgoing Email Logs</h4>
                    
                    <form action="{{ route('admin.career.email-logs.index') }}" method="GET" class="d-flex flex-wrap gap-2 align-items-center">
                        <div>
                            <select name="status" class="form-select form-select-sm" onchange="this.form.submit()">
                                <option value="">All Status</option>
                                <option value="sent" {{ request('status') === 'sent' ? 'selected' : '' }}>Sent</option>
                                <option value="failed" {{ request('status') === 'failed' ? 'selected' : '' }}>Failed</option>
                            </select>
                        </div>
                        <div class="input-group input-group-sm" style="max-width: 250px;">
                            <input type="text" name="search" class="form-control" placeholder="Search recipient/subject..." value="{{ request('search') }}">
                            <button class="btn btn-outline-primary" type="submit">
                                <i class="ti ti-search"></i>
                            </button>
                        </div>
                        @if(request()->anyFilled(['search', 'status']))
                            <a href="{{ route('admin.career.email-logs.index') }}" class="btn btn-sm btn-outline-secondary">Reset</a>
                        @endif
                    </form>
                </div>
                
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th width="5%">No.</th>
                                    <th width="20%">Recipient</th>
                                    <th width="35%">Subject</th>
                                    <th width="15%">Sent At</th>
                                    <th width="10%" class="text-center">Status</th>
                                    <th width="15%" class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($logs as $index => $log)
                                    <tr>
                                        <td>{{ $logs->firstItem() + $index }}</td>
                                        <td>
                                            <span class="fw-semibold text-dark">{{ $log->recipient }}</span>
                                        </td>
                                        <td>{{ $log->subject }}</td>
                                        <td class="small">{{ $log->created_at->format('d M Y, H:i') }}</td>
                                        <td class="text-center">
                                            @if($log->status === 'sent')
                                                <span class="badge bg-success-subtle text-success py-1 px-2">Sent</span>
                                            @else
                                                <span class="badge bg-danger-subtle text-danger py-1 px-2" title="{{ $log->error_message }}">Failed</span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <a href="{{ route('admin.career.email-logs.show', $log->id) }}" class="btn btn-sm btn-outline-primary py-1 px-2" style="font-size: 12px;">
                                                <i class="ti ti-eye me-1"></i> View Detail
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-muted text-center py-4">No email logs found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                
                @if($logs->hasPages())
                    <div class="card-footer">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="small text-muted">
                                Showing {{ $logs->firstItem() }} to {{ $logs->lastItem() }} of {{ $logs->total() }} entries
                            </div>
                            <div>
                                {{ $logs->links() }}
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
