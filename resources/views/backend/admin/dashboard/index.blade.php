@extends('templates.backend.master')

@section('page-title', 'Dashboard')
@section('page-link', route('admin.dashboard'))

@section('content')
<div class="container-fluid">

    {{-- === ALERT BANNER (konten kritis) === --}}
    @if($eventsWithoutPhoto > 0 || $expiringPromos > 0 || $expiredEvents > 0)
    <div class="row mb-3">
        <div class="col-12">
            <div class="d-flex flex-wrap gap-2">
                @if($eventsWithoutPhoto > 0)
                <div class="alert alert-warning d-flex align-items-center gap-2 mb-0 py-2 px-3" style="border-radius:10px;">
                    <i class="ti ti-photo-off fs-5"></i>
                    <span><strong>{{ $eventsWithoutPhoto }} events</strong> do not have photos. <a href="{{ route('admin.event.photo.create') }}" class="alert-link">Upload now →</a></span>
                </div>
                @endif
                @if($expiringPromos > 0)
                <div class="alert alert-info d-flex align-items-center gap-2 mb-0 py-2 px-3" style="border-radius:10px;">
                    <i class="ti ti-clock-exclamation fs-5"></i>
                    <span><strong>{{ $expiringPromos }} promos</strong> will expire within 7 days. <a href="{{ route('admin.promo.index') }}" class="alert-link">Check now →</a></span>
                </div>
                @endif
                @if($expiredEvents > 0)
                <div class="alert alert-secondary d-flex align-items-center gap-2 mb-0 py-2 px-3" style="border-radius:10px;">
                    <i class="ti ti-calendar-x fs-5"></i>
                    <span><strong>{{ $expiredEvents }} events</strong> have ended. <a href="{{ route('admin.event.index') }}" class="alert-link">Manage events →</a></span>
                </div>
                @endif
            </div>
        </div>
    </div>
    @endif

    {{-- === PAGE HEADER === --}}
    <div class="d-flex align-items-center justify-content-between mb-4">
        <div>
            <h4 class="mb-0 fw-semibold">Admin Dashboard</h4>
            <p class="text-muted mb-0">
                Welcome back, {{ Auth::user()->name }}!
                <span class="ms-1 text-muted small">{{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }}</span>
            </p>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('admin.tenant.create') }}" class="btn btn-primary">
                <i class="ti ti-building-store"></i> Add Tenant
            </a>
            <a href="{{ route('admin.event.create') }}" class="btn btn-success">
                <i class="ti ti-calendar-event"></i> Add Event
            </a>
        </div>
    </div>

    {{-- === MAIN STATS === --}}
    <div class="row">
        <div class="col-xxl-2 col-md-4 col-sm-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="round-40 rounded-circle bg-primary-subtle text-primary d-flex align-items-center justify-content-center flex-shrink-0">
                            <i class="ti ti-building-store fs-6"></i>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="mb-0 text-muted">Total Tenants</h6>
                            <h3 class="mb-0 fw-semibold">{{ $totalTenants }}</h3>
                            <div class="d-flex align-items-center gap-2">
                                <small class="text-success"><i class="ti ti-check"></i> {{ $activeTenants }} Active</small>
                                @if($tenantGrowth !== null)
                                    <small class="{{ $tenantGrowth >= 0 ? 'text-success' : 'text-danger' }}">
                                        <i class="ti ti-trending-{{ $tenantGrowth >= 0 ? 'up' : 'down' }}"></i> {{ abs($tenantGrowth) }}% MoM
                                    </small>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xxl-2 col-md-4 col-sm-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="round-40 rounded-circle bg-success-subtle text-success d-flex align-items-center justify-content-center flex-shrink-0">
                            <i class="ti ti-calendar-event fs-6"></i>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="mb-0 text-muted">Total Events</h6>
                            <h3 class="mb-0 fw-semibold">{{ $totalEvents }}</h3>
                            <div class="d-flex align-items-center gap-2">
                                <small class="text-success"><i class="ti ti-check"></i> {{ $activeEvents }} Active</small>
                                @if($eventGrowth !== null)
                                    <small class="{{ $eventGrowth >= 0 ? 'text-success' : 'text-danger' }}">
                                        <i class="ti ti-trending-{{ $eventGrowth >= 0 ? 'up' : 'down' }}"></i> {{ abs($eventGrowth) }}% MoM
                                    </small>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xxl-2 col-md-4 col-sm-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="round-40 rounded-circle bg-warning-subtle text-warning d-flex align-items-center justify-content-center flex-shrink-0">
                            <i class="ti ti-ticket fs-6"></i>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="mb-0 text-muted">Total Promos</h6>
                            <h3 class="mb-0 fw-semibold">{{ $totalPromos }}</h3>
                            <small class="text-success"><i class="ti ti-check"></i> {{ $activePromos }} Active</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xxl-2 col-md-4 col-sm-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="round-40 rounded-circle bg-info-subtle text-info d-flex align-items-center justify-content-center flex-shrink-0">
                            <i class="ti ti-users fs-6"></i>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="mb-0 text-muted">Total Users</h6>
                            <h3 class="mb-0 fw-semibold">{{ $totalUsers }}</h3>
                            <small class="text-muted">{{ $adminUsers }} Admin, {{ $tenantUsers }} Tenant</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xxl-4 col-md-8 col-sm-12">
            <div class="card bg-primary-subtle border-0">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="round-40 rounded-circle bg-primary text-white d-flex align-items-center justify-content-center flex-shrink-0">
                            <i class="ti ti-users fs-6"></i>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="mb-1 text-primary fw-semibold">Visitor Statistics</h6>
                            <div class="d-flex align-items-baseline gap-3">
                                <h3 class="mb-0 fw-bold text-dark">{{ number_format($totalVisitors) }}</h3>
                                <span class="small text-muted">Total Visits</span>
                            </div>
                            <div class="d-flex align-items-center gap-3 mt-1 small">
                                <span class="text-success fw-medium"><i class="ti ti-arrow-up-right"></i> {{ number_format($todayVisitors) }} Today</span>
                                <span class="text-info fw-medium"><i class="ti ti-circle-filled fs-2 me-1"></i> {{ number_format($onlineVisitors) }} Online</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- === CAREER STATS (ONLY FOR SUPERUSER) === --}}
    @role('superuser')
    <div class="row mt-3">
        <div class="col-lg-3 col-md-6">
            <div class="card bg-info-subtle border-0">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <i class="ti ti-briefcase fs-1 text-info"></i>
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
                        <i class="ti ti-users-group fs-1 text-primary"></i>
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
    @endrole

    {{-- === SECONDARY STATS (contextual, no duplicates) === --}}
    <div class="row mt-3">
        <div class="col-lg-3 col-md-6">
            <div class="card bg-primary-subtle border-0">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <i class="ti ti-category fs-1 text-primary"></i>
                        <div class="ms-3">
                            <h6 class="text-primary mb-0">Categories</h6>
                            <h3 class="mb-0 fw-semibold text-dark">{{ $totalCategories }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6">
            <div class="card bg-success-subtle border-0">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <i class="ti ti-calendar-time fs-1 text-success"></i>
                        <div class="ms-3">
                            <h6 class="text-success mb-0">Upcoming Events</h6>
                            <h3 class="mb-0 fw-semibold text-dark">{{ $upcomingEvents }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6">
            <div class="card bg-danger-subtle border-0">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <i class="ti ti-calendar-x fs-1 text-danger"></i>
                        <div class="ms-3">
                            <h6 class="text-danger mb-0">Expired Events</h6>
                            <h3 class="mb-0 fw-semibold text-dark">{{ $expiredEvents }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6">
            <div class="card bg-warning-subtle border-0">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <i class="ti ti-clock-exclamation fs-1 text-warning"></i>
                        <div class="ms-3">
                            <h6 class="text-warning mb-0">Expiring Promos</h6>
                            <h3 class="mb-0 fw-semibold text-dark">{{ $expiringPromos }}</h3>
                            <small class="text-muted" style="font-size:11px;">within 7 days</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- === RECENT ACTIVITIES === --}}
    <div class="row mt-4">
        {{-- Recent Tenants --}}
        <div class="col-lg-4">
            <div class="card h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <h5 class="card-title mb-0">Recent Tenants</h5>
                        <a href="{{ route('admin.tenant.index') }}" class="btn btn-sm btn-outline-primary">View All</a>
                    </div>
                    @if($recentTenants->count() > 0)
                    <div class="list-group list-group-flush">
                        @foreach($recentTenants as $tenant)
                        <div class="list-group-item px-0">
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0">
                                    @if($tenant->primaryPhoto)
                                    <img src="{{ asset('storage/' . $tenant->primaryPhoto->path) }}"
                                         alt="{{ $tenant->name }}"
                                         class="rounded"
                                         style="width:40px;height:40px;object-fit:cover;">
                                    @else
                                    <div class="rounded bg-light d-flex align-items-center justify-content-center" style="width:40px;height:40px;">
                                        <i class="ti ti-building-store text-muted"></i>
                                    </div>
                                    @endif
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h6 class="mb-0">{{ $tenant->name }}</h6>
                                    <small class="text-muted">{{ $tenant->category->name ?? 'No Category' }}</small>
                                </div>
                                <span class="badge {{ $tenant->is_active ? 'bg-success-subtle text-success' : 'bg-secondary-subtle text-secondary' }}">
                                    {{ $tenant->is_active ? 'Active' : 'Inactive' }}
                                </span>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @else
                    <div class="text-center py-4">
                        <i class="ti ti-building-store fs-1 text-muted"></i>
                        <p class="text-muted mb-0">No tenants yet</p>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        {{-- Recent Events --}}
        <div class="col-lg-4">
            <div class="card h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <h5 class="card-title mb-0">Recent Events</h5>
                        <a href="{{ route('admin.event.index') }}" class="btn btn-sm btn-outline-success">View All</a>
                    </div>
                    @if($recentEvents->count() > 0)
                    <div class="list-group list-group-flush">
                        @foreach($recentEvents as $event)
                        <div class="list-group-item px-0">
                            <div class="d-flex align-items-start">
                                <div class="flex-shrink-0">
                                    @if($event->primaryPhoto)
                                    <img src="{{ asset('storage/' . $event->primaryPhoto->path) }}"
                                         alt="{{ $event->name }}"
                                         class="rounded"
                                         style="width:40px;height:40px;object-fit:cover;">
                                    @else
                                    <div class="rounded bg-light d-flex align-items-center justify-content-center" style="width:40px;height:40px;">
                                        <i class="ti ti-calendar-event text-muted"></i>
                                    </div>
                                    @endif
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <a href="{{ route('admin.event.edit', $event->uuid) }}" class="text-decoration-none text-dark">
                                        <h6 class="mb-0">{{ Str::limit($event->name, 30) }}</h6>
                                    </a>
                                    <small class="text-muted">
                                        <i class="ti ti-calendar"></i>
                                        {{ \Carbon\Carbon::parse($event->start_date)->format('d M Y') }}
                                    </small>
                                </div>
                                @php
                                    $now = \Carbon\Carbon::now();
                                    $start = \Carbon\Carbon::parse($event->start_date);
                                    $end   = \Carbon\Carbon::parse($event->end_date);
                                @endphp
                                @if(!$event->is_active)
                                    <span class="badge bg-secondary-subtle text-secondary">Inactive</span>
                                @elseif($end < $now)
                                    <span class="badge bg-danger-subtle text-danger">Expired</span>
                                @elseif($start <= $now && $end >= $now)
                                    <span class="badge bg-success-subtle text-success">Live</span>
                                @else
                                    <span class="badge bg-info-subtle text-info">Upcoming</span>
                                @endif
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @else
                    <div class="text-center py-4">
                        <i class="ti ti-calendar-event fs-1 text-muted"></i>
                        <p class="text-muted mb-0">No events yet</p>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        {{-- Recent Promos --}}
        <div class="col-lg-4">
            <div class="card h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <h5 class="card-title mb-0">Recent Promos</h5>
                        <a href="{{ route('admin.promo.index') }}" class="btn btn-sm btn-outline-warning">View All</a>
                    </div>
                    @if($recentPromos->count() > 0)
                    <div class="list-group list-group-flush">
                        @foreach($recentPromos as $promo)
                        <div class="list-group-item px-0">
                            <div class="d-flex align-items-start">
                                <div class="flex-shrink-0">
                                    @if($promo->banner)
                                    <img src="{{ asset('storage/' . $promo->banner) }}"
                                         alt="{{ $promo->name }}"
                                         class="rounded"
                                         style="width:40px;height:40px;object-fit:cover;">
                                    @else
                                    <div class="rounded bg-light d-flex align-items-center justify-content-center" style="width:40px;height:40px;">
                                        <i class="ti ti-ticket text-muted"></i>
                                    </div>
                                    @endif
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h6 class="mb-0">{{ Str::limit($promo->name, 25) }}</h6>
                                    <small class="text-muted">{{ $promo->tenant->name ?? 'No Tenant' }}</small>
                                </div>
                                @php
                                    $now      = \Carbon\Carbon::now();
                                    $pStart   = \Carbon\Carbon::parse($promo->start_date);
                                    $pEnd     = \Carbon\Carbon::parse($promo->end_date);
                                @endphp
                                @if($promo->is_active && $pStart <= $now && $pEnd >= $now)
                                    <span class="badge bg-success-subtle text-success">Active</span>
                                @else
                                    <span class="badge bg-secondary-subtle text-secondary">Inactive</span>
                                @endif
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @else
                    <div class="text-center py-4">
                        <i class="ti ti-ticket fs-1 text-muted"></i>
                        <p class="text-muted mb-0">No promos yet</p>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    {{-- === QUICK ACTIONS (+ Manage Users) === --}}
    <div class="row mt-4">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-3">Quick Actions</h5>
                    <div class="row g-3">
                        <div class="col-lg-2 col-md-4 col-6">
                            <a href="{{ route('admin.tenant.index') }}" class="btn btn-outline-primary w-100 d-flex align-items-center justify-content-center py-3 flex-column gap-1">
                                <i class="ti ti-building-store fs-4"></i>
                                <span class="small">Tenants</span>
                            </a>
                        </div>
                        <div class="col-lg-2 col-md-4 col-6">
                            <a href="{{ route('admin.event.index') }}" class="btn btn-outline-success w-100 d-flex align-items-center justify-content-center py-3 flex-column gap-1">
                                <i class="ti ti-calendar-event fs-4"></i>
                                <span class="small">Events</span>
                            </a>
                        </div>
                        <div class="col-lg-2 col-md-4 col-6">
                            <a href="{{ route('admin.promo.index') }}" class="btn btn-outline-warning w-100 d-flex align-items-center justify-content-center py-3 flex-column gap-1">
                                <i class="ti ti-ticket fs-4"></i>
                                <span class="small">Promos</span>
                            </a>
                        </div>
                        <div class="col-lg-2 col-md-4 col-6">
                            <a href="{{ route('admin.category.index') }}" class="btn btn-outline-info w-100 d-flex align-items-center justify-content-center py-3 flex-column gap-1">
                                <i class="ti ti-category fs-4"></i>
                                <span class="small">Categories</span>
                            </a>
                        </div>
                        @role('superuser')
                        <div class="col-lg-2 col-md-4 col-6">
                            <a href="{{ route('admin.career.vacancy.index') }}" class="btn btn-outline-info w-100 d-flex align-items-center justify-content-center py-3 flex-column gap-1">
                                <i class="ti ti-briefcase fs-4"></i>
                                <span class="small">Vacancies</span>
                            </a>
                        </div>
                        <div class="col-lg-2 col-md-4 col-6">
                            <a href="{{ route('admin.career.application.index') }}" class="btn btn-outline-primary w-100 d-flex align-items-center justify-content-center py-3 flex-column gap-1">
                                <i class="ti ti-users-group fs-4"></i>
                                <span class="small">Applicants</span>
                            </a>
                        </div>
                        <div class="col-lg-2 col-md-4 col-6">
                            <a href="{{ route('admin.user.index') }}" class="btn btn-outline-secondary w-100 d-flex align-items-center justify-content-center py-3 flex-column gap-1">
                                <i class="ti ti-users fs-4"></i>
                                <span class="small">Users</span>
                            </a>
                        </div>
                        <div class="col-lg-2 col-md-4 col-6">
                            <a href="{{ route('admin.setting.index') }}" class="btn btn-outline-dark w-100 d-flex align-items-center justify-content-center py-3 flex-column gap-1">
                                <i class="ti ti-settings fs-4"></i>
                                <span class="small">Settings</span>
                            </a>
                        </div>
                        @endrole
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- === CHARTS === --}}
    <div class="row mt-4">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <h5 class="card-title mb-0">Monthly Trends (Last 6 Months)</h5>
                        <div class="d-flex gap-2">
                            @if($tenantGrowth !== null)
                            <span class="badge {{ $tenantGrowth >= 0 ? 'bg-success-subtle text-success' : 'bg-danger-subtle text-danger' }}">
                                Tenants {{ $tenantGrowth >= 0 ? '+' : '' }}{{ $tenantGrowth }}% MoM
                            </span>
                            @endif
                            @if($eventGrowth !== null)
                            <span class="badge {{ $eventGrowth >= 0 ? 'bg-success-subtle text-success' : 'bg-danger-subtle text-danger' }}">
                                Events {{ $eventGrowth >= 0 ? '+' : '' }}{{ $eventGrowth }}% MoM
                            </span>
                            @endif
                        </div>
                    </div>
                    <canvas id="monthlyTrendsChart" height="80"></canvas>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-3">Top 5 Categories</h5>
                    <canvas id="categoryChart" height="200"></canvas>
                </div>
            </div>
        </div>
    </div>

    {{-- === VISITOR HISTORY === --}}
    <div class="row mt-4">
        <div class="col-md-6 col-12 mb-3 mb-md-0">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="card-title mb-3">Visitor History (Monthly Summary)</h5>
                    <div class="table-responsive" style="max-height: 280px; overflow-y: auto;">
                        <table class="table table-striped table-hover align-middle mb-0">
                            <thead class="table-light sticky-top" style="z-index: 1;">
                                <tr>
                                    <th>Period</th>
                                    <th class="text-end">Visits Count</th>
                                    <th class="text-center">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($monthlyVisitorsList as $item)
                                <tr>
                                    <td><strong>{{ $item->period }}</strong></td>
                                    <td class="text-end font-monospace fw-semibold">{{ number_format($item->visit_count) }}</td>
                                    <td class="text-center">
                                        @if($item->status == 'Active')
                                            <span class="badge bg-success-subtle text-success">Running</span>
                                        @else
                                            <span class="badge bg-secondary-subtle text-secondary">Archived</span>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-6 col-12">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="card-title mb-3">Monthly Visitor Trends</h5>
                    <canvas id="visitorTrendsChart" height="135"></canvas>
                </div>
            </div>
        </div>
    </div>

</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<script>
    const monthlyTrendsCtx = document.getElementById('monthlyTrendsChart').getContext('2d');
    new Chart(monthlyTrendsCtx, {
        type: 'line',
        data: {
            labels: {!! json_encode($monthlyData['labels']) !!},
            datasets: [
                {
                    label: 'Tenants',
                    data: {!! json_encode($monthlyData['tenants']) !!},
                    borderColor: 'rgb(75, 85, 99)',
                    backgroundColor: 'rgba(75, 85, 99, 0.1)',
                    tension: 0.4, fill: true
                },
                {
                    label: 'Events',
                    data: {!! json_encode($monthlyData['events']) !!},
                    borderColor: 'rgb(34, 197, 94)',
                    backgroundColor: 'rgba(34, 197, 94, 0.1)',
                    tension: 0.4, fill: true
                },
                {
                    label: 'Promos',
                    data: {!! json_encode($monthlyData['promos']) !!},
                    borderColor: 'rgb(251, 191, 36)',
                    backgroundColor: 'rgba(251, 191, 36, 0.1)',
                    tension: 0.4, fill: true
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            plugins: {
                legend: { display: true, position: 'top' },
                tooltip: { mode: 'index', intersect: false }
            },
            scales: {
                y: { beginAtZero: true, ticks: { precision: 0 } }
            }
        }
    });

    const categoryCtx  = document.getElementById('categoryChart').getContext('2d');
    const categoryData = {!! json_encode($categoryData) !!};

    new Chart(categoryCtx, {
        type: 'doughnut',
        data: {
            labels: categoryData.map(i => i.name),
            datasets: [{
                data: categoryData.map(i => i.count),
                backgroundColor: [
                    'rgba(75, 85, 99, 0.8)',
                    'rgba(34, 197, 94, 0.8)',
                    'rgba(251, 191, 36, 0.8)',
                    'rgba(59, 130, 246, 0.8)',
                    'rgba(168, 85, 247, 0.8)'
                ],
                borderWidth: 2,
                borderColor: '#fff'
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            plugins: {
                legend: { display: true, position: 'bottom' },
                tooltip: {
                    callbacks: {
                        label: function(ctx) {
                            const total = ctx.dataset.data.reduce((a, b) => a + b, 0);
                            const pct   = total > 0 ? ((ctx.parsed / total) * 100).toFixed(1) : 0;
                            return `${ctx.label}: ${ctx.parsed} (${pct}%)`;
                        }
                    }
                }
            }
        }
    });

    const visitorTrendsCtx = document.getElementById('visitorTrendsChart').getContext('2d');
    new Chart(visitorTrendsCtx, {
        type: 'bar',
        data: {
            labels: {!! json_encode($monthlyData['labels']) !!},
            datasets: [
                {
                    label: 'Visits',
                    data: {!! json_encode($monthlyData['visitors']) !!},
                    borderColor: 'rgb(0, 133, 219)',
                    backgroundColor: 'rgba(0, 133, 219, 0.2)',
                    borderWidth: 2,
                    borderRadius: 5
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            plugins: {
                legend: { display: false },
                tooltip: { mode: 'index', intersect: false }
            },
            scales: {
                y: { beginAtZero: true, ticks: { precision: 0 } }
            }
        }
    });
</script>
@endpush
@endsection
