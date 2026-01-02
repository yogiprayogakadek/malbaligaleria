@extends('templates.backend.master')

@section('page-title', 'Dashboard')
@section('page-link', route('tenant.dashboard'))

@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="d-flex align-items-center justify-content-between mb-4">
        <div>
            <h4 class="mb-0 fw-semibold">Dashboard</h4>
            <p class="text-muted mb-0">Welcome back, {{ Auth::user()->name }}!</p>
        </div>
        <a href="{{ route('tenant.promo.create') }}" class="btn btn-primary">
            <i class="ti ti-plus"></i> Create New Promo
        </a>
    </div>

    <!-- Statistics Cards -->
    <div class="row">
        <!-- Total Promos -->
        <div class="col-lg-3 col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="round-40 rounded-circle bg-primary-subtle text-primary d-flex align-items-center justify-content-center">
                                <i class="ti ti-ticket fs-6"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="mb-0 text-muted">Total Promos</h6>
                            <h3 class="mb-0 fw-semibold">{{ $totalPromos }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Active Promos -->
        <div class="col-lg-3 col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="round-40 rounded-circle bg-success-subtle text-success d-flex align-items-center justify-content-center">
                                <i class="ti ti-check fs-6"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="mb-0 text-muted">Active Promos</h6>
                            <h3 class="mb-0 fw-semibold">{{ $activePromos }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Upcoming Promos -->
        <div class="col-lg-3 col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="round-40 rounded-circle bg-warning-subtle text-warning d-flex align-items-center justify-content-center">
                                <i class="ti ti-clock fs-6"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="mb-0 text-muted">Upcoming</h6>
                            <h3 class="mb-0 fw-semibold">{{ $upcomingPromos }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Expired Promos -->
        <div class="col-lg-3 col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="round-40 rounded-circle bg-danger-subtle text-danger d-flex align-items-center justify-content-center">
                                <i class="ti ti-x fs-6"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="mb-0 text-muted">Expired</h6>
                            <h3 class="mb-0 fw-semibold">{{ $expiredPromos }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Promos Table -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <h5 class="card-title mb-0">Recent Promos</h5>
                        <a href="{{ route('tenant.promo.index') }}" class="btn btn-sm btn-outline-primary">
                            View All
                        </a>
                    </div>

                    @if($recentPromos->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>Promo Name</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th>Status</th>
                                    <th class="text-end">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($recentPromos as $promo)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            @if($promo->banner)
                                            <img src="{{ asset('storage/' . $promo->banner) }}" 
                                                 alt="{{ $promo->name }}" 
                                                 class="rounded me-2" 
                                                 style="width: 50px; height: 50px; object-fit: cover;">
                                            @else
                                            <div class="rounded bg-light me-2 d-flex align-items-center justify-content-center" 
                                                 style="width: 50px; height: 50px;">
                                                <i class="ti ti-photo text-muted"></i>
                                            </div>
                                            @endif
                                            <div>
                                                <h6 class="mb-0">{{ $promo->name }}</h6>
                                                <small class="text-muted">{{ Str::limit($promo->description, 50) }}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <small class="text-muted">
                                            <i class="ti ti-calendar me-1"></i>
                                            {{ \Carbon\Carbon::parse($promo->start_date)->format('d M Y') }}
                                        </small>
                                    </td>
                                    <td>
                                        <small class="text-muted">
                                            <i class="ti ti-calendar me-1"></i>
                                            {{ \Carbon\Carbon::parse($promo->end_date)->format('d M Y') }}
                                        </small>
                                    </td>
                                    <td>
                                        @php
                                            $now = \Carbon\Carbon::now();
                                            $startDate = \Carbon\Carbon::parse($promo->start_date);
                                            $endDate = \Carbon\Carbon::parse($promo->end_date);
                                        @endphp

                                        @if($promo->is_active && $startDate <= $now && $endDate >= $now)
                                            <span class="badge bg-success-subtle text-success">Active</span>
                                        @elseif($startDate > $now)
                                            <span class="badge bg-warning-subtle text-warning">Upcoming</span>
                                        @elseif($endDate < $now)
                                            <span class="badge bg-danger-subtle text-danger">Expired</span>
                                        @else
                                            <span class="badge bg-secondary-subtle text-secondary">Inactive</span>
                                        @endif
                                    </td>
                                    <td class="text-end">
                                        <a href="{{ route('tenant.promo.edit', $promo->uuid) }}" 
                                           class="btn btn-sm btn-light" 
                                           title="Edit">
                                            <i class="ti ti-edit"></i>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @else
                    <div class="text-center py-5">
                        <i class="ti ti-ticket fs-1 text-muted mb-3 d-block"></i>
                        <h5 class="text-muted">No Promos Yet</h5>
                        <p class="text-muted mb-3">Start creating promotions to attract more customers!</p>
                        <a href="{{ route('tenant.promo.create') }}" class="btn btn-primary">
                            <i class="ti ti-plus"></i> Create Your First Promo
                        </a>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Tips -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="card bg-primary-subtle border-0">
                <div class="card-body">
                    <div class="d-flex align-items-start">
                        <div class="flex-shrink-0">
                            <i class="ti ti-bulb fs-1 text-primary"></i>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h5 class="text-primary mb-2">Quick Tips for Better Promotions</h5>
                            <ul class="mb-0 text-dark">
                                <li>Use eye-catching banners to attract more attention</li>
                                <li>Set clear start and end dates for your promotions</li>
                                <li>Write compelling descriptions that highlight the benefits</li>
                                <li>Keep your promotions active and up-to-date</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Section -->
    <div class="row mt-4">
        <!-- Promo Status Chart -->
        <div class="col-lg-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-3">Promo Status Distribution</h5>
                    <canvas id="promoStatusChart" height="200"></canvas>
                </div>
            </div>
        </div>

        <!-- Monthly Promo Trends Chart -->
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-3">Monthly Promo Trends (Last 6 Months)</h5>
                    <canvas id="monthlyPromoChart" height="80"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>

<script>
    // Promo Status Distribution Chart
    const statusCtx = document.getElementById('promoStatusChart').getContext('2d');
    new Chart(statusCtx, {
        type: 'doughnut',
        data: {
            labels: ['Active', 'Upcoming', 'Expired'],
            datasets: [{
                data: [
                    {{ $activePromos }},
                    {{ $upcomingPromos }},
                    {{ $expiredPromos }}
                ],
                backgroundColor: [
                    'rgba(34, 197, 94, 0.8)',   // Green for Active
                    'rgba(251, 191, 36, 0.8)',  // Yellow for Upcoming
                    'rgba(239, 68, 68, 0.8)'    // Red for Expired
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
                            const total = {{ $totalPromos }};
                            const percentage = total > 0 ? ((value / total) * 100).toFixed(1) : 0;
                            return `${label}: ${value} (${percentage}%)`;
                        }
                    }
                }
            }
        }
    });

    // Monthly Promo Trends Chart
    const monthlyPromoCtx = document.getElementById('monthlyPromoChart').getContext('2d');
    new Chart(monthlyPromoCtx, {
        type: 'line',
        data: {
            labels: {!! json_encode($monthlyData['labels']) !!},
            datasets: [{
                label: 'Promos Created',
                data: {!! json_encode($monthlyData['promos']) !!},
                borderColor: 'rgb(251, 191, 36)',
                backgroundColor: 'rgba(251, 191, 36, 0.1)',
                tension: 0.4,
                fill: true,
                borderWidth: 2
            }]
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
</script>
@endpush
@endsection
