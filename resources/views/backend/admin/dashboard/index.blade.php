@extends('templates.backend.master')

@section('page-title', 'Dashboard')
@section('page-link', route('admin.dashboard'))

@push('css')
    <style>
        /* Card & Design System */
        .stat-card {
            border: 1px solid rgba(226, 232, 240, 0.8) !important;
            border-radius: 16px !important;
            box-shadow: 0 4px 15px rgba(148, 163, 184, 0.05) !important;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            background: #ffffff;
        }
        .stat-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 25px rgba(148, 163, 184, 0.12) !important;
            border-color: rgba(99, 102, 241, 0.3) !important;
        }
        .stat-icon-wrapper {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            transition: all 0.3s ease;
        }
        .stat-card:hover .stat-icon-wrapper {
            transform: scale(1.1);
        }
        
        /* Traffic Premium Card */
        .traffic-card {
            background: linear-gradient(135deg, #4f46e5 0%, #312e81 100%) !important;
            color: #ffffff;
            border-radius: 16px !important;
            border: none !important;
            box-shadow: 0 10px 30px rgba(79, 70, 229, 0.15) !important;
            position: relative;
            overflow: hidden;
        }
        .traffic-card::after {
            content: '';
            position: absolute;
            width: 250px;
            height: 250px;
            background: radial-gradient(circle, rgba(255,255,255,0.08) 0%, rgba(255,255,255,0) 70%);
            top: -70px;
            right: -70px;
            pointer-events: none;
        }
        .bg-white-subtle {
            background-color: rgba(255, 255, 255, 0.15) !important;
            backdrop-filter: blur(4px);
        }
        .border-white-10 {
            border-color: rgba(255, 255, 255, 0.1) !important;
        }
        
        /* General Card Overrides */
        .card {
            border-radius: 16px !important;
            border: 1px solid rgba(226, 232, 240, 0.8) !important;
            box-shadow: 0 4px 15px rgba(148, 163, 184, 0.03) !important;
        }
        .card-title {
            color: #1e293b;
            font-weight: 600;
        }
        
        /* Quick Actions */
        .quick-action-btn {
            border-radius: 12px !important;
            border: 1px solid rgba(226, 232, 240, 0.8) !important;
            background: #ffffff;
            color: #475569;
            transition: all 0.2s ease;
            text-decoration: none;
            box-shadow: 0 2px 5px rgba(148, 163, 184, 0.02) !important;
        }
        .quick-action-btn:hover {
            background: #f8fafc;
            color: #4f46e5;
            border-color: rgba(79, 70, 229, 0.3) !important;
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(148, 163, 184, 0.08) !important;
        }
        
        /* Table enhancements */
        .table {
            border-color: rgba(226, 232, 240, 0.5);
        }
        .table th {
            font-weight: 600;
            color: #475569;
            background-color: #f8fafc !important;
        }
        
        /* Custom scrollbar for Details tables */
        .table-responsive::-webkit-scrollbar {
            width: 6px;
            height: 6px;
        }
        .table-responsive::-webkit-scrollbar-track {
            background: #f1f5f9;
        }
        .table-responsive::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 3px;
        }
        .table-responsive::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }
    </style>
@endpush

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
    <div class="d-flex flex-column flex-sm-row align-items-start align-items-sm-center justify-content-between gap-3 mb-4">
        <div>
            <h4 class="mb-0 fw-semibold">Admin Dashboard</h4>
            <p class="text-muted mb-0">
                Welcome back, {{ Auth::user()->name }}!
                <span class="ms-1 text-muted small">{{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }}</span>
            </p>
        </div>
        <div class="d-flex gap-2 w-100 w-sm-auto">
            <a href="{{ route('admin.tenant.create') }}" class="btn btn-primary flex-fill flex-sm-grow-0 d-inline-flex align-items-center justify-content-center gap-1">
                <i class="ti ti-building-store"></i> Add Tenant
            </a>
            <a href="{{ route('admin.event.create') }}" class="btn btn-success flex-fill flex-sm-grow-0 d-inline-flex align-items-center justify-content-center gap-1">
                <i class="ti ti-calendar-event"></i> Add Event
            </a>
        </div>
    </div>

    {{-- === DATE RANGE FILTER === --}}
    <div class="card mb-4 border-0 shadow-sm bg-light-subtle" style="border-radius:12px;">
        <div class="card-body p-3">
            <form action="{{ route('admin.dashboard') }}" method="GET" class="d-flex flex-wrap align-items-center gap-2">
                <div class="d-flex align-items-center">
                    <span class="fw-semibold text-dark small"><i class="ti ti-filter me-1 text-primary"></i>Filter Date Range:</span>
                </div>
                <div class="d-flex align-items-center gap-2 flex-wrap">
                    <input type="date" name="start_date" class="form-control form-control-sm" style="width: 160px;" value="{{ request('start_date') }}">
                    <span class="text-muted small">to</span>
                    <input type="date" name="end_date" class="form-control form-control-sm" style="width: 160px;" value="{{ request('end_date') }}">
                </div>
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-sm btn-primary px-3 d-inline-flex align-items-center gap-1">
                        <i class="ti ti-search"></i> Apply
                    </button>
                    @if(request()->anyFilled(['start_date', 'end_date']))
                        <a href="{{ route('admin.dashboard') }}" class="btn btn-sm btn-outline-secondary px-3 d-inline-flex align-items-center gap-1">
                            <i class="ti ti-rotate"></i> Reset
                        </a>
                    @endif
                </div>
            </form>
        </div>
    </div>

    {{-- === STATS GRID === --}}
    <div class="row g-4 mb-4">
        {{-- Tenants Stat --}}
        <div class="col-xl-3 col-md-6 col-sm-12">
            <div class="card stat-card h-100 border-0 shadow-sm">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <div class="stat-icon-wrapper bg-primary-subtle text-primary">
                            <i class="ti ti-building-store fs-6"></i>
                        </div>
                        @if($tenantGrowth !== null)
                            <span class="badge bg-{{ $tenantGrowth >= 0 ? 'success' : 'danger' }}-subtle text-{{ $tenantGrowth >= 0 ? 'success' : 'danger' }} badge-pill small">
                                <i class="ti ti-trending-{{ $tenantGrowth >= 0 ? 'up' : 'down' }} me-1"></i>{{ abs($tenantGrowth) }}% MoM
                            </span>
                        @endif
                    </div>
                    <h3 class="mb-1 fw-bold text-dark font-monospace">{{ $totalTenants }}</h3>
                    <h6 class="text-muted mb-3 fw-medium">Total Tenants</h6>
                    <div class="d-flex align-items-center gap-2 pt-2 border-top border-light-subtle">
                        <span class="small text-success fw-medium"><i class="ti ti-circle-filled fs-2 me-1"></i>{{ $activeTenants }} Active</span>
                        <span class="small text-muted">•</span>
                        <span class="small text-secondary fw-medium">{{ $totalCategories }} Categories</span>
                    </div>
                </div>
            </div>
        </div>

        {{-- Events Stat --}}
        <div class="col-xl-3 col-md-6 col-sm-12">
            <div class="card stat-card h-100 border-0 shadow-sm">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <div class="stat-icon-wrapper bg-success-subtle text-success">
                            <i class="ti ti-calendar-event fs-6"></i>
                        </div>
                        @if($eventGrowth !== null)
                            <span class="badge bg-{{ $eventGrowth >= 0 ? 'success' : 'danger' }}-subtle text-{{ $eventGrowth >= 0 ? 'success' : 'danger' }} badge-pill small">
                                <i class="ti ti-trending-{{ $eventGrowth >= 0 ? 'up' : 'down' }} me-1"></i>{{ abs($eventGrowth) }}% MoM
                            </span>
                        @endif
                    </div>
                    <h3 class="mb-1 fw-bold text-dark font-monospace">{{ $totalEvents }}</h3>
                    <h6 class="text-muted mb-3 fw-medium">Total Events</h6>
                    <div class="d-flex flex-wrap align-items-center gap-x-2 gap-y-1 pt-2 border-top border-light-subtle">
                        <span class="small text-success fw-medium"><i class="ti ti-circle-filled fs-2 me-1"></i>{{ $activeEvents }} Active</span>
                        <span class="small text-muted">•</span>
                        <span class="small text-info fw-medium">{{ $upcomingEvents }} Upcoming</span>
                        <span class="small text-muted">•</span>
                        <span class="small text-danger fw-medium">{{ $expiredEvents }} Ended</span>
                    </div>
                </div>
            </div>
        </div>

        {{-- Promos Stat --}}
        <div class="col-xl-3 col-md-6 col-sm-12">
            <div class="card stat-card h-100 border-0 shadow-sm">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <div class="stat-icon-wrapper bg-warning-subtle text-warning">
                            <i class="ti ti-ticket fs-6"></i>
                        </div>
                        @if($expiringPromos > 0)
                            <span class="badge bg-warning-subtle text-warning badge-pill small" title="Expiring within 7 days">
                                <i class="ti ti-clock-exclamation me-1"></i>{{ $expiringPromos }} Expiring
                            </span>
                        @endif
                    </div>
                    <h3 class="mb-1 fw-bold text-dark font-monospace">{{ $totalPromos }}</h3>
                    <h6 class="text-muted mb-3 fw-medium">Total Promos</h6>
                    <div class="d-flex align-items-center gap-2 pt-2 border-top border-light-subtle">
                        <span class="small text-success fw-medium"><i class="ti ti-circle-filled fs-2 me-1"></i>{{ $activePromos }} Active</span>
                    </div>
                </div>
            </div>
        </div>

        {{-- Role-based Fourth Stat --}}
        <div class="col-xl-3 col-md-6 col-sm-12">
            <div class="card stat-card h-100 border-0 shadow-sm">
                <div class="card-body p-4">
                    @role('superuser')
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <div class="stat-icon-wrapper bg-info-subtle text-info">
                            <i class="ti ti-briefcase fs-6"></i>
                        </div>
                        @if($newApplications > 0)
                            <span class="badge bg-danger-subtle text-danger badge-pill small">
                                <i class="ti ti-bell me-1"></i>{{ $newApplications }} New
                            </span>
                        @endif
                    </div>
                    <h3 class="mb-1 fw-bold text-dark font-monospace">{{ $totalVacancies }}</h3>
                    <h6 class="text-muted mb-3 fw-medium">Careers & Vacancies</h6>
                    <div class="d-flex align-items-center gap-2 pt-2 border-top border-light-subtle">
                        <span class="small text-info fw-medium">{{ $activeVacancies }} Active Jobs</span>
                        <span class="small text-muted">•</span>
                        <span class="small text-primary fw-medium">{{ $totalApplications }} Applicants</span>
                    </div>
                    @else
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <div class="stat-icon-wrapper bg-info-subtle text-info">
                            <i class="ti ti-users fs-6"></i>
                        </div>
                    </div>
                    <h3 class="mb-1 fw-bold text-dark font-monospace">{{ $totalUsers }}</h3>
                    <h6 class="text-muted mb-3 fw-medium">System Users</h6>
                    <div class="d-flex align-items-center gap-2 pt-2 border-top border-light-subtle">
                        <span class="small text-secondary fw-medium">{{ $adminUsers }} Admin</span>
                        <span class="small text-muted">•</span>
                        <span class="small text-muted fw-medium">{{ $tenantUsers }} Tenant</span>
                    </div>
                    @endrole
                </div>
            </div>
        </div>
    </div>

    {{-- === CHARTS & LIVE TRAFFIC === --}}
    <div class="row g-4 mb-4">
        {{-- Live Traffic Stats --}}
        <div class="col-xl-4 col-lg-12">
            <div class="card traffic-card h-100 border-0">
                <div class="card-body p-4 d-flex flex-column justify-content-between" style="min-height: 320px;">
                    <div>
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <h5 class="card-title text-white mb-0 fw-semibold">Live Traffic Analytics</h5>
                            <span class="badge bg-white-subtle text-white badge-pill small d-flex align-items-center gap-1">
                                <span class="spinner-grow spinner-grow-sm text-success" role="status" style="width: 8px; height: 8px;"></span> Real-time
                            </span>
                        </div>
                        <h6 class="text-white-50 mb-1 fw-medium">Total Web Visits</h6>
                        <h2 class="text-white fw-bold font-monospace mb-4" style="letter-spacing: -1px; font-size: 2.2rem;">{{ number_format($totalVisitors) }}</h2>
                    </div>
                    <div class="row g-3 pt-3 border-top border-white-10">
                        <div class="col-6">
                            <h6 class="text-white-50 small mb-1">Today's Visits</h6>
                            <h4 class="text-white fw-bold mb-0 font-monospace">{{ number_format($todayVisitors) }}</h4>
                        </div>
                        <div class="col-6">
                            <h6 class="text-white-50 small mb-1">Online Users</h6>
                            <h4 class="text-white fw-bold mb-0 font-monospace d-flex align-items-center gap-2">
                                <span class="d-inline-block rounded-circle bg-success animate__ping" style="width: 8px; height: 8px; box-shadow: 0 0 10px rgba(40, 167, 69, 0.8);"></span>
                                {{ number_format($onlineVisitors) }}
                            </h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Monthly Trends Chart --}}
        <div class="col-xl-8 col-lg-12">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <h5 class="card-title mb-0 fw-semibold">Monthly Performance Trends</h5>
                        <div class="d-flex gap-2">
                            @if($tenantGrowth !== null)
                            <span class="badge bg-success-subtle text-success badge-pill small">
                                Tenants {{ $tenantGrowth >= 0 ? '+' : '' }}{{ $tenantGrowth }}%
                            </span>
                            @endif
                            @if($eventGrowth !== null)
                            <span class="badge bg-info-subtle text-info badge-pill small">
                                Events {{ $eventGrowth >= 0 ? '+' : '' }}{{ $eventGrowth }}%
                            </span>
                            @endif
                        </div>
                    </div>
                    <div style="position: relative;">
                        <canvas id="monthlyTrendsChart" height="100"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- === DAILY VISITOR & CATEGORIES === --}}
    <div class="row g-4 mb-4">
        {{-- Daily Visitor Analytics --}}
        <div class="col-xl-8 col-lg-12">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body p-4">
                    <h5 class="card-title mb-4 fw-semibold">
                        @if(request()->anyFilled(['start_date', 'end_date']))
                            Daily Visitor Analytics (Range: {{ \Carbon\Carbon::parse(request('start_date'))->format('d M Y') }} - {{ \Carbon\Carbon::parse(request('end_date'))->format('d M Y') }})
                        @else
                            Daily Visitor Analytics (Last 15 Days)
                        @endif
                    </h5>
                    <div>
                        <canvas id="dailyVisitorChart" height="100"></canvas>
                    </div>
                </div>
            </div>
        </div>

        {{-- Top 5 Categories --}}
        <div class="col-xl-4 col-lg-12">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body p-4 d-flex flex-column justify-content-between">
                    <h5 class="card-title mb-4 fw-semibold">Top Categories</h5>
                    <div style="position: relative; max-height: 200px; max-width: 200px; margin: 0 auto;">
                        <canvas id="categoryChart" height="200"></canvas>
                    </div>
                    <div class="mt-3 text-center small text-muted">
                        Tenant distribution by category
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- === RECENT ACTIVITIES === --}}
    <div class="row g-4">
        {{-- Recent Tenants --}}
        <div class="col-lg-4">
            <div class="card h-100 shadow-sm border-0">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <h5 class="card-title mb-0">Recent Tenants</h5>
                        <a href="{{ route('admin.tenant.index') }}" class="btn btn-sm btn-outline-primary px-3 rounded-pill">View All</a>
                    </div>
                    @if($recentTenants->count() > 0)
                    <div class="list-group list-group-flush">
                        @foreach($recentTenants as $tenant)
                        <div class="list-group-item px-0 py-3 border-light-subtle">
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0">
                                    @if($tenant->primaryPhoto)
                                    <img src="{{ asset('storage/' . $tenant->primaryPhoto->path) }}"
                                         alt="{{ $tenant->name }}"
                                         class="rounded-3 shadow-xs"
                                         style="width:40px;height:40px;object-fit:cover;">
                                    @else
                                    <div class="rounded bg-light d-flex align-items-center justify-content-center" style="width:40px;height:40px;">
                                        <i class="ti ti-building-store text-muted fs-5"></i>
                                    </div>
                                    @endif
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h6 class="mb-0 fw-semibold text-dark">{{ $tenant->name }}</h6>
                                    <small class="text-muted">{{ $tenant->category->name ?? 'No Category' }}</small>
                                </div>
                                <span class="badge {{ $tenant->is_active ? 'bg-success-subtle text-success' : 'bg-secondary-subtle text-secondary' }} badge-pill">
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
            <div class="card h-100 shadow-sm border-0">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <h5 class="card-title mb-0">Recent Events</h5>
                        <a href="{{ route('admin.event.index') }}" class="btn btn-sm btn-outline-success px-3 rounded-pill">View All</a>
                    </div>
                    @if($recentEvents->count() > 0)
                    <div class="list-group list-group-flush">
                        @foreach($recentEvents as $event)
                        <div class="list-group-item px-0 py-3 border-light-subtle">
                            <div class="d-flex align-items-start">
                                <div class="flex-shrink-0">
                                    @if($event->primaryPhoto)
                                    <img src="{{ asset('storage/' . $event->primaryPhoto->path) }}"
                                         alt="{{ $event->name }}"
                                         class="rounded-3 shadow-xs"
                                         style="width:40px;height:40px;object-fit:cover;">
                                    @else
                                    <div class="rounded bg-light d-flex align-items-center justify-content-center" style="width:40px;height:40px;">
                                        <i class="ti ti-calendar-event text-muted fs-5"></i>
                                    </div>
                                    @endif
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <a href="{{ route('admin.event.edit', $event->uuid) }}" class="text-decoration-none text-dark">
                                        <h6 class="mb-0 fw-semibold">{{ Str::limit($event->name, 25) }}</h6>
                                    </a>
                                    <small class="text-muted">
                                        <i class="ti ti-calendar me-1"></i>
                                        {{ \Carbon\Carbon::parse($event->start_date)->format('d M Y') }}
                                    </small>
                                </div>
                                @php
                                    $now = \Carbon\Carbon::now();
                                    $start = \Carbon\Carbon::parse($event->start_date);
                                    $end   = \Carbon\Carbon::parse($event->end_date);
                                @endphp
                                @if(!$event->is_active)
                                    <span class="badge bg-secondary-subtle text-secondary badge-pill">Inactive</span>
                                @elseif($end < $now)
                                    <span class="badge bg-danger-subtle text-danger badge-pill">Expired</span>
                                @elseif($start <= $now && $end >= $now)
                                    <span class="badge bg-success-subtle text-success badge-pill">Live</span>
                                @else
                                    <span class="badge bg-info-subtle text-info badge-pill">Upcoming</span>
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
            <div class="card h-100 shadow-sm border-0">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <h5 class="card-title mb-0">Recent Promos</h5>
                        <a href="{{ route('admin.promo.index') }}" class="btn btn-sm btn-outline-warning px-3 rounded-pill">View All</a>
                    </div>
                    @if($recentPromos->count() > 0)
                    <div class="list-group list-group-flush">
                        @foreach($recentPromos as $promo)
                        <div class="list-group-item px-0 py-3 border-light-subtle">
                            <div class="d-flex align-items-start">
                                <div class="flex-shrink-0">
                                    @if($promo->banner)
                                    <img src="{{ asset('storage/' . $promo->banner) }}"
                                         alt="{{ $promo->name }}"
                                         class="rounded-3 shadow-xs"
                                         style="width:40px;height:40px;object-fit:cover;">
                                    @else
                                    <div class="rounded bg-light d-flex align-items-center justify-content-center" style="width:40px;height:40px;">
                                        <i class="ti ti-ticket text-muted fs-5"></i>
                                    </div>
                                    @endif
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h6 class="mb-0 fw-semibold text-dark">{{ Str::limit($promo->name, 22) }}</h6>
                                    <small class="text-muted">{{ $promo->tenant->name ?? 'No Tenant' }}</small>
                                </div>
                                @php
                                    $now      = \Carbon\Carbon::now();
                                    $pStart   = \Carbon\Carbon::parse($promo->start_date);
                                    $pEnd     = \Carbon\Carbon::parse($promo->end_date);
                                @endphp
                                @if($promo->is_active && $pStart <= $now && $pEnd >= $now)
                                    <span class="badge bg-success-subtle text-success badge-pill">Active</span>
                                @else
                                    <span class="badge bg-secondary-subtle text-secondary badge-pill">Inactive</span>
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
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    <h5 class="card-title mb-4 fw-semibold">Quick Actions</h5>
                    <div class="row g-3">
                        <div class="col-lg-2 col-md-4 col-6">
                            <a href="{{ route('admin.tenant.index') }}" class="quick-action-btn w-100 d-flex align-items-center justify-content-center py-3 flex-column gap-2">
                                <i class="ti ti-building-store fs-5"></i>
                                <span class="small fw-medium">Tenants</span>
                            </a>
                        </div>
                        <div class="col-lg-2 col-md-4 col-6">
                            <a href="{{ route('admin.event.index') }}" class="quick-action-btn w-100 d-flex align-items-center justify-content-center py-3 flex-column gap-2">
                                <i class="ti ti-calendar-event fs-5"></i>
                                <span class="small fw-medium">Events</span>
                            </a>
                        </div>
                        <div class="col-lg-2 col-md-4 col-6">
                            <a href="{{ route('admin.promo.index') }}" class="quick-action-btn w-100 d-flex align-items-center justify-content-center py-3 flex-column gap-2">
                                <i class="ti ti-ticket fs-5"></i>
                                <span class="small fw-medium">Promos</span>
                            </a>
                        </div>
                        <div class="col-lg-2 col-md-4 col-6">
                            <a href="{{ route('admin.category.index') }}" class="quick-action-btn w-100 d-flex align-items-center justify-content-center py-3 flex-column gap-2">
                                <i class="ti ti-category fs-5"></i>
                                <span class="small fw-medium">Categories</span>
                            </a>
                        </div>
                        @role('superuser')
                        <div class="col-lg-2 col-md-4 col-6">
                            <a href="{{ route('admin.career.vacancy.index') }}" class="quick-action-btn w-100 d-flex align-items-center justify-content-center py-3 flex-column gap-2">
                                <i class="ti ti-briefcase fs-5"></i>
                                <span class="small fw-medium">Vacancies</span>
                            </a>
                        </div>
                        <div class="col-lg-2 col-md-4 col-6">
                            <a href="{{ route('admin.career.application.index') }}" class="quick-action-btn w-100 d-flex align-items-center justify-content-center py-3 flex-column gap-2">
                                <i class="ti ti-users-group fs-5"></i>
                                <span class="small fw-medium">Applicants</span>
                            </a>
                        </div>
                        <div class="col-lg-2 col-md-4 col-6">
                            <a href="{{ route('admin.user.index') }}" class="quick-action-btn w-100 d-flex align-items-center justify-content-center py-3 flex-column gap-2">
                                <i class="ti ti-users fs-5"></i>
                                <span class="small fw-medium">Users</span>
                            </a>
                        </div>
                        <div class="col-lg-2 col-md-4 col-6">
                            <a href="{{ route('admin.setting.index') }}" class="quick-action-btn w-100 d-flex align-items-center justify-content-center py-3 flex-column gap-2">
                                <i class="ti ti-settings fs-5"></i>
                                <span class="small fw-medium">Settings</span>
                            </a>
                        </div>
                        @endrole
                    </div>
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
                    <div class="table-responsive" style="max-height: 320px; overflow-y: auto;">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light sticky-top" style="z-index: 2;">
                                <tr>
                                    <th>Period</th>
                                    <th class="text-end">Total Visits</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($groupedVisits as $monthKey => $monthData)
                                <tr class="table-light-subtle">
                                    <td>
                                        <strong>{{ $monthData['name'] }}</strong>
                                    </td>
                                    <td class="text-end font-monospace fw-bold text-primary">
                                        {{ number_format($monthData['total']) }}
                                    </td>
                                    <td class="text-center">
                                        <button class="btn btn-xs btn-outline-primary py-1 px-2 fs-2" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-{{ $monthKey }}" aria-expanded="false" style="font-size: 11px;">
                                            <i class="ti ti-chevron-down"></i> Details
                                        </button>
                                    </td>
                                </tr>
                                <tr class="collapse" id="collapse-{{ $monthKey }}">
                                    <td colspan="3" class="p-0 border-0">
                                        <div class="p-3 bg-light-subtle rounded-3 my-2 border">
                                            <div class="table-responsive" style="max-height: 200px; overflow-y: auto;">
                                                <table class="table table-sm table-bordered mb-0 bg-white">
                                                    <thead class="table-light">
                                                        <tr>
                                                            <th>Date</th>
                                                            <th class="text-end">Visits</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($monthData['days'] as $day)
                                                        <tr class="{{ isset($day->is_today) && $day->is_today ? 'table-warning text-dark' : '' }}">
                                                            <td class="small py-1">
                                                                @if(isset($day->is_today) && $day->is_today)
                                                                    <span class="badge bg-danger py-1 px-1 me-1 text-white" style="font-size: 9px;">LIVE</span>
                                                                @endif
                                                                {{ $day->date }}
                                                            </td>
                                                            <td class="text-end font-monospace small py-1">{{ number_format($day->count) }}</td>
                                                        </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
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

    {{-- === VISITOR DEMOGRAPHICS === --}}
    <div class="row mt-4">
        <div class="col-md-6 col-12 mb-3 mb-md-0">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="card-title mb-3">Visitor Demographics: Top Countries</h5>
                    <div class="row align-items-center">
                        <div class="col-sm-6 text-center">
                            <div style="max-height: 200px; max-width: 200px; margin: 0 auto;">
                                <canvas id="countryChart" height="200" width="200"></canvas>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="table-responsive">
                                <table class="table table-sm table-borderless align-middle mb-0">
                                    <thead>
                                        <tr>
                                            <th>Country</th>
                                            <th class="text-end">Visits</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($topCountries as $country)
                                        <tr>
                                            <td>
                                                <i class="ti ti-map-pin-filled text-primary me-1"></i>
                                                {{ $country->country ?: 'Unknown' }}
                                            </td>
                                            <td class="text-end font-monospace fw-bold text-dark">{{ number_format($country->count) }}</td>
                                        </tr>
                                        @endforeach
                                        @if($topCountries->isEmpty())
                                        <tr>
                                            <td colspan="2" class="text-muted text-center py-3">No data recorded</td>
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
        <div class="col-md-6 col-12">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="card-title mb-3">Visitor Demographics: Top Cities</h5>
                    <div class="row align-items-center">
                        <div class="col-sm-6 text-center">
                            <div style="max-height: 200px; max-width: 200px; margin: 0 auto;">
                                <canvas id="cityChart" height="200" width="200"></canvas>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="table-responsive">
                                <table class="table table-sm table-borderless align-middle mb-0">
                                    <thead>
                                        <tr>
                                            <th>City</th>
                                            <th class="text-end">Visits</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($topCities as $city)
                                        <tr>
                                            <td>
                                                <i class="ti ti-map-pin text-info me-1"></i>
                                                {{ $city->city ?: 'Unknown' }}
                                            </td>
                                            <td class="text-end font-monospace fw-bold text-dark">{{ number_format($city->count) }}</td>
                                        </tr>
                                        @endforeach
                                        @if($topCities->isEmpty())
                                        <tr>
                                            <td colspan="2" class="text-muted text-center py-3">No data recorded</td>
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

    const dailyVisitorCtx = document.getElementById('dailyVisitorChart').getContext('2d');
    new Chart(dailyVisitorCtx, {
        type: 'line',
        data: {
            labels: {!! json_encode($last15Days['labels']) !!},
            datasets: [
                {
                    label: 'Visits',
                    data: {!! json_encode($last15Days['data']) !!},
                    borderColor: 'rgb(59, 130, 246)',
                    backgroundColor: 'rgba(59, 130, 246, 0.1)',
                    tension: 0.3,
                    fill: true,
                    borderWidth: 2,
                    pointBackgroundColor: 'rgb(59, 130, 246)',
                    pointRadius: 4
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

    const countryCtx = document.getElementById('countryChart').getContext('2d');
    new Chart(countryCtx, {
        type: 'doughnut',
        data: {
            labels: {!! json_encode($countryChart['labels']) !!},
            datasets: [{
                data: {!! json_encode($countryChart['data']) !!},
                backgroundColor: [
                    'rgba(44, 95, 93, 0.8)',
                    'rgba(212, 175, 55, 0.8)',
                    'rgba(59, 130, 246, 0.8)',
                    'rgba(231, 76, 60, 0.8)',
                    'rgba(155, 89, 182, 0.8)'
                ],
                borderWidth: 2,
                borderColor: '#fff'
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            plugins: {
                legend: { display: false }
            }
        }
    });

    const cityCtx = document.getElementById('cityChart').getContext('2d');
    new Chart(cityCtx, {
        type: 'doughnut',
        data: {
            labels: {!! json_encode($cityChart['labels']) !!},
            datasets: [{
                data: {!! json_encode($cityChart['data']) !!},
                backgroundColor: [
                    'rgba(44, 95, 93, 0.8)',
                    'rgba(212, 175, 55, 0.8)',
                    'rgba(59, 130, 246, 0.8)',
                    'rgba(231, 76, 60, 0.8)',
                    'rgba(155, 89, 182, 0.8)'
                ],
                borderWidth: 2,
                borderColor: '#fff'
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            plugins: {
                legend: { display: false }
            }
        }
    });
</script>
@endpush
@endsection
