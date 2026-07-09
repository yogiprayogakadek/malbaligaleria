@extends('templates.backend.master')

@section('page-title', 'Applicant Detail')
@section('page-link', route('admin.career.application.show', $application->uuid))

@section('content')
    @if (session('success'))
        <script>
            toastr.success("{{ session('success') }}", "Success", {
                showMethod: "slideDown", hideMethod: "slideUp", timeOut: 2500
            });
        </script>
    @endif

    <div class="row mb-3">
        <div class="col-12 d-flex justify-content-between align-items-center">
            <div>
                <h5 class="mb-1">Applicant Detail</h5>
                <p class="text-muted small mb-0">{{ $application->vacancy->title }} — {{ $application->vacancy->department }}</p>
            </div>
            <div class="d-flex gap-2">
                <a href="{{ route('admin.career.application.print', $application->uuid) }}" target="_blank" class="btn btn-info btn-sm">
                    <i class="ti ti-printer me-1"></i> Print / Export PDF
                </a>
                <a href="{{ route('admin.career.application.index') }}" class="btn btn-outline-secondary btn-sm">
                    <i class="ti ti-arrow-left me-1"></i> Back
                </a>
            </div>
        </div>
    </div>

    <div class="row g-4">
        {{-- Informasi Pelamar --}}
        <div class="col-md-7">
            <div class="card">
                <div class="card-header">
                    <h6 class="mb-0"><i class="ti ti-user me-2"></i>Applicant Information</h6>
                </div>
                <div class="card-body">
                    <table class="table table-borderless">
                        <tr>
                            <th width="35%" class="text-muted">Full Name</th>
                            <td class="fw-semibold">{{ $application->name }}</td>
                        </tr>
                        <tr>
                            <th class="text-muted">Email</th>
                            <td><a href="mailto:{{ $application->email }}">{{ $application->email }}</a></td>
                        </tr>
                        <tr>
                            <th class="text-muted">Phone Number</th>
                            <td><a href="tel:{{ $application->phone }}">{{ $application->phone }}</a></td>
                        </tr>
                        @if($application->address)
                        <tr>
                            <th class="text-muted">Address</th>
                            <td>{{ $application->address }}</td>
                        </tr>
                        @endif
                        <tr>
                            <th class="text-muted">Application Date</th>
                            <td>{{ $application->created_at->format('d M Y, H:i') }}</td>
                        </tr>
                        <tr>
                            <th class="text-muted">Status</th>
                            <td>
                                <span class="badge {{ $application->status_badge }} fs-6">
                                    {{ $application->status_label }}
                                </span>
                            </td>
                        </tr>
                    </table>

                    @if($application->cover_letter)
                        <hr>
                        <h6 class="text-muted mb-2"><i class="ti ti-file-text me-1"></i>Cover Letter</h6>
                        <div class="bg-light rounded p-3" style="white-space: pre-wrap; font-size: 14px;">{{ $application->cover_letter }}</div>
                    @endif
                </div>
                <div class="card-footer d-flex gap-2">
                    <a href="{{ route('admin.career.application.downloadCv', $application->uuid) }}"
                        class="btn btn-success btn-sm">
                        <i class="ti ti-download me-1"></i> Download CV
                    </a>
                    <a href="mailto:{{ $application->email }}" class="btn btn-outline-primary btn-sm">
                        <i class="ti ti-mail me-1"></i> Send Email
                    </a>
                    <a href="tel:{{ $application->phone }}" class="btn btn-outline-secondary btn-sm">
                        <i class="ti ti-phone me-1"></i> Call
                    </a>
                </div>
            </div>

            {{-- Review & Timeline Evaluasi --}}
            <div class="card mt-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h6 class="mb-0 text-dark"><i class="ti ti-checklist me-2"></i>HR Evaluation & Reviews</h6>
                    @if($application->average_rating)
                        <div class="d-flex align-items-center gap-1">
                            <span class="fw-bold text-dark me-1">{{ $application->average_rating }}</span>
                            <div class="text-warning">
                                @for($i = 1; $i <= 5; $i++)
                                    @if($i <= round($application->average_rating))
                                        <i class="ti ti-star-filled"></i>
                                    @else
                                        <i class="ti ti-star"></i>
                                    @endif
                                @endfor
                            </div>
                            <span class="text-muted small">({{ $application->reviews->count() }} reviews)</span>
                        </div>
                    @endif
                </div>
                <div class="card-body">
                    {{-- Form Tambah Review --}}
                    <form action="{{ route('admin.career.application.storeReview', $application->uuid) }}" method="POST" class="mb-4">
                        @csrf
                        <div class="bg-light rounded p-3 mb-3">
                            <h6 class="fs-7 fw-semibold mb-2 text-dark">Add Review & Rating</h6>
                            
                            <div class="mb-2">
                                <label class="form-label d-block fw-semibold text-muted small mb-1">Rating</label>
                                <div class="d-flex gap-2 fs-5" id="star-rating-picker">
                                    <i class="ti ti-star text-muted cursor-pointer" data-value="1" style="transition: transform 0.2s;"></i>
                                    <i class="ti ti-star text-muted cursor-pointer" data-value="2" style="transition: transform 0.2s;"></i>
                                    <i class="ti ti-star text-muted cursor-pointer" data-value="3" style="transition: transform 0.2s;"></i>
                                    <i class="ti ti-star text-muted cursor-pointer" data-value="4" style="transition: transform 0.2s;"></i>
                                    <i class="ti ti-star text-muted cursor-pointer" data-value="5" style="transition: transform 0.2s;"></i>
                                </div>
                                <input type="hidden" name="rating" id="rating-input" value="">
                            </div>

                            <div class="mb-2">
                                <label for="review_notes" class="form-label fw-semibold text-muted small mb-1">Evaluation Notes / Comments</label>
                                <textarea name="notes" id="review_notes" rows="3" class="form-control form-control-sm" placeholder="Write internal HR assessment..." required></textarea>
                            </div>

                            <div class="text-end">
                                <button type="submit" class="btn btn-primary btn-sm py-1 px-3">
                                    <i class="ti ti-plus me-1"></i> Submit Review
                                </button>
                            </div>
                        </div>
                    </form>

                    <hr class="my-4">

                    {{-- Timeline Review --}}
                    <h6 class="fw-semibold mb-3 text-dark"><i class="ti ti-history me-1"></i>History Timeline</h6>
                    
                    <div class="position-relative ps-2">
                        @forelse($application->reviews as $review)
                            <div class="d-flex mb-4 position-relative">
                                {{-- Bulatan Timeline --}}
                                <div class="me-3 text-center position-relative" style="z-index: 2;">
                                    <div class="rounded-circle bg-primary-subtle text-primary d-flex align-items-center justify-content-center" style="width: 38px; height: 38px;">
                                        <i class="ti ti-user fs-5"></i>
                                    </div>
                                </div>
                                
                                {{-- Isi Chat --}}
                                <div class="flex-grow-1 bg-light rounded p-3">
                                    <div class="d-flex justify-content-between align-items-center mb-1">
                                        <span class="fw-semibold text-dark">{{ $review->user->name ?? 'Deleted User' }}</span>
                                        <span class="small text-muted">{{ $review->created_at->diffForHumans() }}</span>
                                    </div>
                                    
                                    @if($review->rating)
                                        <div class="text-warning mb-2 fs-7">
                                            @for($i = 1; $i <= 5; $i++)
                                                @if($i <= $review->rating)
                                                    <i class="ti ti-star-filled"></i>
                                                @else
                                                    <i class="ti ti-star"></i>
                                                @endif
                                            @endfor
                                        </div>
                                    @endif
                                    
                                    <p class="mb-0 text-secondary" style="white-space: pre-wrap; font-size: 13.5px;">{{ $review->notes }}</p>
                                </div>
                            </div>
                        @empty
                            <div class="text-muted text-center py-3">No evaluation history yet.</div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>

        {{-- Info Posisi + Update Status --}}
        <div class="col-md-5">
            {{-- Info Posisi --}}
            <div class="card mb-4">
                <div class="card-header">
                    <h6 class="mb-0"><i class="ti ti-briefcase me-2"></i>Applied Position</h6>
                </div>
                <div class="card-body">
                    <table class="table table-borderless mb-0">
                        <tr>
                            <th width="40%" class="text-muted">Position</th>
                            <td class="fw-semibold">{{ $application->vacancy->title }}</td>
                        </tr>
                        <tr>
                            <th class="text-muted">Department</th>
                            <td>{{ $application->vacancy->department }}</td>
                        </tr>
                        <tr>
                            <th class="text-muted">Type</th>
                            <td>
                                <span class="badge bg-primary-subtle text-primary">
                                    {{ $application->vacancy->type_label }}
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <th class="text-muted">Location</th>
                            <td>{{ $application->vacancy->location }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            {{-- Update Status --}}
            <div class="card">
                <div class="card-header">
                    <h6 class="mb-0"><i class="ti ti-adjustments me-2"></i>Update Application Status</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.career.application.updateStatus', $application->uuid) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="status" class="form-label fw-semibold">Status</label>
                            <select name="status" id="status" class="form-select">
                                <option value="new" {{ $application->status == 'new' ? 'selected' : '' }}>
                                    🔵 New
                                </option>
                                <option value="reviewed" {{ $application->status == 'reviewed' ? 'selected' : '' }}>
                                    🟡 Reviewed
                                </option>
                                <option value="interview" {{ $application->status == 'interview' ? 'selected' : '' }}>
                                    🟣 Interview
                                </option>
                                <option value="on_hold" {{ $application->status == 'on_hold' ? 'selected' : '' }}>
                                    🟠 On Hold
                                </option>
                                <option value="accepted" {{ $application->status == 'accepted' ? 'selected' : '' }}>
                                    🟢 Accepted
                                </option>
                                <option value="rejected" {{ $application->status == 'rejected' ? 'selected' : '' }}>
                                    🔴 Rejected
                                </option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="notes" class="form-label fw-semibold">Internal Notes / Message <small class="text-muted">(optional)</small></label>
                            <textarea name="notes" id="notes" rows="4" class="form-control"
                                placeholder="Notes for HR team... (Will be included in email if sent)">{{ $application->notes }}</textarea>
                            <small class="text-muted d-block mt-1">If "Notify Applicant" is checked, these notes will be included in the email.</small>
                        </div>

                        <div class="mb-3">
                            <div class="form-check form-switch p-0" style="padding-left: 2.5em !important;">
                                <input class="form-check-input" type="checkbox" name="notify" id="notify" value="1">
                                <label class="form-check-label fw-bold text-primary" for="notify">
                                    <i class="ti ti-mail me-1"></i> Notify Applicant via Email
                                </label>
                            </div>
                            <p class="small text-muted mt-1">Send a branded status update email to the candidate.</p>
                        </div>

                        <button type="submit" class="btn btn-primary w-100 py-2">
                            <i class="ti ti-rotate me-1"></i> Update Status & Process
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
<script>
    document.querySelectorAll('#star-rating-picker i').forEach(star => {
        star.addEventListener('mouseenter', function() {
            const val = this.getAttribute('data-value');
            highlightStars(val);
        });

        star.addEventListener('mouseleave', function() {
            const currentVal = document.getElementById('rating-input').value;
            highlightStars(currentVal);
        });

        star.addEventListener('click', function() {
            const val = this.getAttribute('data-value');
            document.getElementById('rating-input').value = val;
            highlightStars(val);
        });
    });

    function highlightStars(val) {
        document.querySelectorAll('#star-rating-picker i').forEach(s => {
            const sVal = s.getAttribute('data-value');
            if (val && parseInt(sVal) <= parseInt(val)) {
                s.classList.remove('ti-star', 'text-muted');
                s.classList.add('ti-star-filled', 'text-warning');
                s.style.transform = 'scale(1.2)';
            } else {
                s.classList.remove('ti-star-filled', 'text-warning');
                s.classList.add('ti-star', 'text-muted');
                s.style.transform = 'scale(1)';
            }
        });
    }
</script>
@endpush
