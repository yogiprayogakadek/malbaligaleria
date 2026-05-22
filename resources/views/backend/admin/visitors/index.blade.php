@extends('templates.backend.master')

@section('page-title', 'Visitor Logs')
@section('page-link', route('admin.visitors.index'))

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <h5 class="card-title mb-0">Monthly Visitor Summary</h5>
                    </div>
                    
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered align-middle text-nowrap">
                            <thead class="table-light">
                                <tr>
                                    <th style="width: 80px;">No.</th>
                                    <th>Period</th>
                                    <th class="text-end">Total Visits</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center" style="width: 150px;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($months as $index => $month)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td><strong>{{ $month->name }}</strong></td>
                                    <td class="text-end font-monospace fw-bold text-primary">{{ number_format($month->total_visits) }}</td>
                                    <td class="text-center">
                                        @if($month->is_current)
                                            <span class="badge bg-success-subtle text-success">Running</span>
                                        @else
                                            <span class="badge bg-secondary-subtle text-secondary">Archived</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <button class="btn btn-sm btn-primary btn-view-details" 
                                                data-year="{{ $month->year }}" 
                                                data-month="{{ $month->month }}"
                                                data-name="{{ $month->name }}">
                                            <i class="ti ti-eye"></i> View Details
                                        </button>
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

    <!-- Bootstrap Modal for Daily Details -->
    <div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="modalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle">Daily Visitors</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="modalBody">
                    <!-- Dynamic content injected here -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        $(document).ready(function() {
            $('body').on('click', '.btn-view-details', function() {
                let year = $(this).data('year');
                let month = $(this).data('month');
                let monthName = $(this).data('name');

                let url = "{{ route('admin.visitors.detail', ['year' => ':year', 'month' => ':month']) }}";
                url = url.replace(':year', year).replace(':month', month);

                $('#modalTitle').text('Daily Visitors - ' + monthName);
                $('#modalBody').html('<div class="text-center py-4"><div class="spinner-border text-primary" role="status"><span class="visually-hidden">Loading...</span></div></div>');
                
                let detailModal = new bootstrap.Modal(document.getElementById('detailModal'));
                detailModal.show();

                $.ajax({
                    type: "GET",
                    url: url,
                    success: function(response) {
                        $('#modalBody').html(response);
                    },
                    error: function(xhr) {
                        $('#modalBody').html('<div class="alert alert-danger">Failed to load details. Please try again.</div>');
                    }
                });
            });
        });
    </script>
@endpush
