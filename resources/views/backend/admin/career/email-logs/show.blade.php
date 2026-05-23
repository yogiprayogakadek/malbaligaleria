@extends('templates.backend.master')

@section('page-title', 'Email Log Detail')
@section('page-link', route('admin.career.email-logs.show', $log->id))

@section('content')
    <div class="row mb-3">
        <div class="col-12 d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Email Log Detail</h5>
            <a href="{{ route('admin.career.email-logs.index') }}" class="btn btn-outline-secondary btn-sm">
                <i class="ti ti-arrow-left me-1"></i> Back to Logs
            </a>
        </div>
    </div>

    <div class="row g-4">
        {{-- Metadata Card --}}
        <div class="col-md-4">
            <div class="card h-100">
                <div class="card-header">
                    <h6 class="mb-0"><i class="ti ti-info-circle me-2"></i>Email Metadata</h6>
                </div>
                <div class="card-body">
                    <table class="table table-sm table-borderless">
                        <tr>
                            <th width="35%" class="text-muted small">Recipient</th>
                            <td class="fw-semibold text-dark">{{ $log->recipient }}</td>
                        </tr>
                        <tr>
                            <th class="text-muted small">Subject</th>
                            <td>{{ $log->subject }}</td>
                        </tr>
                        <tr>
                            <th class="text-muted small">Date Sent</th>
                            <td>{{ $log->created_at->format('d M Y, H:i:s') }}</td>
                        </tr>
                        <tr>
                            <th class="text-muted small">Status</th>
                            <td>
                                @if($log->status === 'sent')
                                    <span class="badge bg-success py-1 px-2">Sent</span>
                                @else
                                    <span class="badge bg-danger py-1 px-2">Failed</span>
                                @endif
                            </td>
                        </tr>
                    </table>

                    @if($log->status === 'failed')
                        <hr>
                        <div class="alert alert-danger mb-0" role="alert">
                            <h6 class="alert-heading fw-bold small"><i class="ti ti-exclamation-circle me-1"></i>Error Message:</h6>
                            <p class="mb-0 small text-break" style="font-family: monospace;">{{ $log->error_message }}</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        {{-- Email Body --}}
        <div class="col-md-8">
            <div class="card h-100">
                <div class="card-header">
                    <h6 class="mb-0"><i class="ti ti-mail me-2"></i>Message Body</h6>
                </div>
                <div class="card-body p-0">
                    @if($log->body)
                        <iframe srcdoc="{{ $log->body }}" style="width: 100%; height: 500px; border: none; background: #fff;" sandbox="allow-same-origin"></iframe>
                    @else
                        <div class="text-muted text-center py-5">No body content recorded.</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
