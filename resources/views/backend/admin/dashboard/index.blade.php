@extends('templates.backend.master')

@section('page-title', 'Dashboard')
@section('page-link', route('admin.dashboard'))

@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="d-flex align-items-center justify-content-between mb-4">
        <div>
            <h4 class="mb-0 fw-semibold">Admin Dashboard</h4>
            <p class="text-muted mb-0">Welcome back, {{ Auth::user()->name }}! Here's what's happening today.</p>
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

    <!-- Main Statistics Row -->
    <div class="row">
        <!-- Tenants Card -->
        <div class="col-lg-3 col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="round-40 rounded-circle bg-primary-subtle text-primary d-flex align-items-center justify-content-center">
                                <i class="ti ti-building-store fs-6"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="mb-0 text-muted">Total Tenants</h6>
                            <h3 class="mb-0 fw-semibold">{{ $totalTenants }}</h3>
                            <small class="text-success">
                                <i class="ti ti-check"></i> {{ $activeTenants }} Active
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Events Card -->
        <div class="col-lg-3 col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="round-40 rounded-circle bg-success-subtle text-success d-flex align-items-center justify-content-center">
                                <i class="ti ti-calendar-event fs-6"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="mb-0 text-muted">Total Events</h6>
                            <h3 class="mb-0 fw-semibold">{{ $totalEvents }}</h3>
                            <small class="text-success">
                                <i class="ti ti-check"></i> {{ $activeEvents }} Active
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Promos Card -->
        <div class="col-lg-3 col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="round-40 rounded-circle bg-warning-subtle text-warning d-flex align-items-center justify-content-center">
                                <i class="ti ti-ticket fs-6"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="mb-0 text-muted">Total Promos</h6>
                            <h3 class="mb-0 fw-semibold">{{ $totalPromos }}</h3>
                            <small class="text-success">
                                <i class="ti ti-check"></i> {{ $activePromos }} Active
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Users Card -->
        <div class="col-lg-3 col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="round-40 rounded-circle bg-info-subtle text-info d-flex align-items-center justify-content-center">
                                <i class="ti ti-users fs-6"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="mb-0 text-muted">Total Users</h6>
                            <h3 class="mb-0 fw-semibold">{{ $totalUsers }}</h3>
                            <small class="text-muted">
                                {{ $adminUsers }} Admin, {{ $tenantUsers }} Tenant
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Secondary Statistics Row -->
    <div class="row mt-3">
        <div class="col-lg-4 col-md-6">
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

        <div class="col-lg-4 col-md-6">
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

        <div class="col-lg-4 col-md-6">
            <div class="card bg-warning-subtle border-0">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <i class="ti ti-building fs-1 text-warning"></i>
                        <div class="ms-3">
                            <h6 class="text-warning mb-0">Active Tenants</h6>
                            <h3 class="mb-0 fw-semibold text-dark">{{ $activeTenants }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Activities Row -->
    <div class="row mt-4">
        <!-- Recent Tenants -->
        <div class="col-lg-4">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <h5 class="card-title mb-0">Recent Tenants</h5>
                        <a href="{{ route('admin.tenant.index') }}" class="btn btn-sm btn-outline-primary">
                            View All
                        </a>
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
                                         style="width: 40px; height: 40px; object-fit: cover;">
                                    @else
                                    <div class="rounded bg-light d-flex align-items-center justify-content-center" 
                                         style="width: 40px; height: 40px;">
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

        <!-- Recent Events -->
        <div class="col-lg-4">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <h5 class="card-title mb-0">Recent Events</h5>
                        <a href="{{ route('admin.event.index') }}" class="btn btn-sm btn-outline-success">
                            View All
                        </a>
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
                                         style="width: 40px; height: 40px; object-fit: cover;">
                                    @else
                                    <div class="rounded bg-light d-flex align-items-center justify-content-center" 
                                         style="width: 40px; height: 40px;">
                                        <i class="ti ti-calendar-event text-muted"></i>
                                    </div>
                                    @endif
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h6 class="mb-0">{{ Str::limit($event->name, 30) }}</h6>
                                    <small class="text-muted">
                                        <i class="ti ti-calendar"></i>
                                        {{ \Carbon\Carbon::parse($event->start_date)->format('d M Y') }}
                                    </small>
                                </div>
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

        <!-- Recent Promos -->
        <div class="col-lg-4">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <h5 class="card-title mb-0">Recent Promos</h5>
                        <a href="{{ route('admin.promo.index') }}" class="btn btn-sm btn-outline-warning">
                            View All
                        </a>
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
                                         style="width: 40px; height: 40px; object-fit: cover;">
                                    @else
                                    <div class="rounded bg-light d-flex align-items-center justify-content-center" 
                                         style="width: 40px; height: 40px;">
                                        <i class="ti ti-ticket text-muted"></i>
                                    </div>
                                    @endif
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h6 class="mb-0">{{ Str::limit($promo->name, 25) }}</h6>
                                    <small class="text-muted">{{ $promo->tenant->name ?? 'No Tenant' }}</small>
                                </div>
                                @php
                                    $now = \Carbon\Carbon::now();
                                    $startDate = \Carbon\Carbon::parse($promo->start_date);
                                    $endDate = \Carbon\Carbon::parse($promo->end_date);
                                @endphp
                                @if($promo->is_active && $startDate <= $now && $endDate >= $now)
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

    <!-- Quick Actions -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-3">Quick Actions</h5>
                    <div class="row g-3">
                        <div class="col-lg-3 col-md-6">
                            <a href="{{ route('admin.tenant.index') }}" class="btn btn-outline-primary w-100 d-flex align-items-center justify-content-center py-3">
                                <i class="ti ti-building-store fs-5 me-2"></i>
                                Manage Tenants
                            </a>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <a href="{{ route('admin.event.index') }}" class="btn btn-outline-success w-100 d-flex align-items-center justify-content-center py-3">
                                <i class="ti ti-calendar-event fs-5 me-2"></i>
                                Manage Events
                            </a>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <a href="{{ route('admin.promo.index') }}" class="btn btn-outline-warning w-100 d-flex align-items-center justify-content-center py-3">
                                <i class="ti ti-ticket fs-5 me-2"></i>
                                Manage Promos
                            </a>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <a href="{{ route('admin.category.index') }}" class="btn btn-outline-info w-100 d-flex align-items-center justify-content-center py-3">
                                <i class="ti ti-category fs-5 me-2"></i>
                                Manage Categories
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Section -->
    <div class="row mt-4">
        <!-- Monthly Trends Chart -->
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-3">Monthly Trends (Last 6 Months)</h5>
                    <canvas id="monthlyTrendsChart" height="80"></canvas>
                </div>
            </div>
        </div>

        <!-- Category Distribution Chart -->
        <div class="col-lg-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-3">Top 5 Categories</h5>
                    <canvas id="categoryChart" height="200"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>

<script>
    // Monthly Trends Chart
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
                    tension: 0.4,
                    fill: true
                },
                {
                    label: 'Events',
                    data: {!! json_encode($monthlyData['events']) !!},
                    borderColor: 'rgb(34, 197, 94)',
                    backgroundColor: 'rgba(34, 197, 94, 0.1)',
                    tension: 0.4,
                    fill: true
                },
                {
                    label: 'Promos',
                    data: {!! json_encode($monthlyData['promos']) !!},
                    borderColor: 'rgb(251, 191, 36)',
                    backgroundColor: 'rgba(251, 191, 36, 0.1)',
                    tension: 0.4,
                    fill: true
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            plugins: {
                legend: {
                    display: true,
                    position: 'top'
                },
                tooltip: {
                    mode: 'index',
                    intersect: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        precision: 0
                    }
                }
            }
        }
    });

    // Category Distribution Chart
    const categoryCtx = document.getElementById('categoryChart').getContext('2d');
    const categoryData = {!! json_encode($categoryData) !!};
    
    new Chart(categoryCtx, {
        type: 'doughnut',
        data: {
            labels: categoryData.map(item => item.name),
            datasets: [{
                data: categoryData.map(item => item.count),
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
                legend: {
                    display: true,
                    position: 'bottom'
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            const label = context.label || '';
                            const value = context.parsed || 0;
                            const total = context.dataset.data.reduce((a, b) => a + b, 0);
                            const percentage = ((value / total) * 100).toFixed(1);
                            return `${label}: ${value} (${percentage}%)`;
                        }
                    }
                }
            }
        }
    });
</script>
@endpush
@endsection
