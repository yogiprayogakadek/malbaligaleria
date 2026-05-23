@extends('templates.backend.master')

@section('page-title', 'HR Dashboard')
@section('page-link', route('admin.dashboard'))

@section('content')
<div class="container-fluid">

    {{-- === PAGE HEADER === --}}
    <div class="d-flex align-items-center justify-content-between mb-4">
        <div>
            <h4 class="mb-0 fw-semibold">HR Recruitment Dashboard</h4>
            <p class="text-muted mb-0">
                Welcome back, {{ Auth::user()->name }}!
                <span class="ms-1 text-muted small">{{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }}</span>
            </p>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('admin.career.vacancy.create') }}" class="btn btn-primary">
                <i class="ti ti-briefcase"></i> Post New Vacancy
            </a>
        </div>
    </div>

    {{-- === DATE RANGE FILTER === --}}
    <div class="card mb-4 border-0 shadow-sm bg-light-subtle" style="border-radius:12px;">
        <div class="card-body p-3">
            <form action="{{ route('admin.dashboard') }}" method="GET" class="row g-2 align-items-center">
                <div class="col-12 col-md-auto d-flex align-items-center">
                    <span class="fw-semibold text-dark me-2 small"><i class="ti ti-filter me-1 text-primary"></i>Filter Date Range:</span>
                </div>
                <div class="col-6 col-md-auto">
                    <input type="date" name="start_date" class="form-control form-control-sm" value="{{ request('start_date') }}">
                </div>
                <div class="col-6 col-md-auto">
                    <span class="text-muted mx-1 small d-none d-md-inline">to</span>
                    <input type="date" name="end_date" class="form-control form-control-sm" value="{{ request('end_date') }}">
                </div>
                <div class="col-12 col-md-auto d-flex gap-2 mt-2 mt-md-0">
                    <button type="submit" class="btn btn-sm btn-primary px-3">
                        <i class="ti ti-search me-1"></i> Apply
                    </button>
                    @if(request()->anyFilled(['start_date', 'end_date']))
                        <a href="{{ route('admin.dashboard') }}" class="btn btn-sm btn-outline-secondary px-3">
                            <i class="ti ti-rotate me-1"></i> Reset
                        </a>
                    @endif
                </div>
            </form>
        </div>
    </div>

    {{-- === CAREER STATS === --}}
    <div class="row">
        <div class="col-lg-3 col-md-6">
            <div class="card bg-info-subtle border-0">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <i class="ti ti-briefcase fs-8 text-info"></i>
                        <div class="ms-3">
                            <h6 class="text-info mb-0">Total Vacancies</h6>
                            <h3 class="mb-0 fw-semibold text-dark">{{ $totalVacancies }}</h3>
                            <small class="text-muted">{{ $activeVacancies }} Active</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="card bg-primary-subtle border-0">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <i class="ti ti-users-group fs-8 text-primary"></i>
                        <div class="ms-3">
                            <h6 class="text-primary mb-0">Total Applications</h6>
                            <h3 class="mb-0 fw-semibold text-dark">{{ $totalApplications }}</h3>
                            <small class="text-success"><i class="ti ti-bell"></i> {{ $newApplications }} New</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- === RECENT APPLICATIONS === --}}
    <div class="row mt-4">
        <div class="col-12">
            <div class="card h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <h5 class="card-title mb-0">Recent Applications</h5>
                        <a href="{{ route('admin.career.application.index') }}" class="btn btn-sm btn-outline-primary">View All</a>
                    </div>
                    @if($recentApplications->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="text-dark fs-4">
                                <tr>
                                    <th class="border-bottom-0"><h6 class="fw-semibold mb-0">Applicant</h6></th>
                                    <th class="border-bottom-0"><h6 class="fw-semibold mb-0">Position</h6></th>
                                    <th class="border-bottom-0"><h6 class="fw-semibold mb-0">Date</h6></th>
                                    <th class="border-bottom-0"><h6 class="fw-semibold mb-0">Status</h6></th>
                                    <th class="border-bottom-0"><h6 class="fw-semibold mb-0">Action</h6></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($recentApplications as $app)
                                <tr>
                                    <td class="border-bottom-0">
                                        <h6 class="fw-semibold mb-1">{{ $app->name }}</h6>
                                        <span class="fw-normal">{{ $app->email }}</span>
                                    </td>
                                    <td class="border-bottom-0">
                                        <p class="mb-0 fw-normal">{{ $app->vacancy->title }}</p>
                                    </td>
                                    <td class="border-bottom-0">
                                        <p class="mb-0 fw-normal">{{ $app->created_at->format('d M Y, H:i') }}</p>
                                    </td>
                                    <td class="border-bottom-0">
                                        <span class="badge {{ $app->status_badge }} rounded-3 fw-semibold">{{ $app->status_label }}</span>
                                    </td>
                                    <td class="border-bottom-0">
                                        <a href="{{ route('admin.career.application.show', $app->uuid) }}" class="btn btn-sm bg-info-subtle text-info">
                                            <i class="ti ti-eye"></i> Detail
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @else
                    <div class="text-center py-5">
                        <i class="ti ti-users-group fs-9 text-muted mb-3 d-block"></i>
                        <p class="text-muted mb-0">No applications received yet</p>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    {{-- === QUICK ACTIONS === --}}
    <div class="row mt-4">
        <div class="col-12">
            <div class="card bg-light-primary border-0">
                <div class="card-body">
                    <h5 class="card-title mb-3">HR Menu</h5>
                    <div class="d-flex flex-wrap gap-3">
                        <a href="{{ route('admin.career.vacancy.index') }}" class="btn btn-white px-4 py-2 shadow-sm d-flex align-items-center gap-2">
                            <i class="ti ti-list-details fs-5"></i> Manage Vacancies
                        </a>
                        <a href="{{ route('admin.career.application.index') }}" class="btn btn-white px-4 py-2 shadow-sm d-flex align-items-center gap-2">
                            <i class="ti ti-users fs-5"></i> All Applicants
                        </a>
                        <a href="{{ route('admin.career.vacancy.create') }}" class="btn btn-white px-4 py-2 shadow-sm d-flex align-items-center gap-2">
                            <i class="ti ti-plus fs-5"></i> Create New Post
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
