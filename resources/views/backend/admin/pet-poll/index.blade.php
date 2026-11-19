@extends('templates.backend.master')

@section('page-title', 'Pet Poll Management')
@section('page-link', route('admin.pet-poll.index'))

@section('content')
<div class="container-fluid">
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Header -->
    <div class="d-flex align-items-center justify-content-between mb-4 flex-wrap gap-2">
        <div>
            <h4 class="mb-0 fw-semibold">Survei Pet Friendly</h4>
            <p class="text-muted mb-0">
                @if($poll)
                    {{ $poll->title }} &middot;
                    @if($poll->isOpen())
                        <span class="badge bg-success-subtle text-success">Dibuka</span>
                        @if($poll->closes_at)
                            <span class="text-muted fs-2">sampai {{ $poll->closes_at->timezone('Asia/Makassar')->format('d M Y, H:i') }} WITA</span>
                        @endif
                    @else
                        <span class="badge bg-danger-subtle text-danger">Ditutup</span>
                    @endif
                @else
                    <span class="badge bg-warning-subtle text-warning">Belum Dibuat</span>
                @endif
            </p>
        </div>

        <div class="d-flex gap-2 flex-wrap">
            @if($poll)
                <button type="button" class="btn btn-outline-primary" id="btnCopyPollUrl" data-url="{{ route('frontend.pet-poll.show') }}">
                    <i class="ti ti-copy fs-4 me-1"></i> Salin Tautan
                </button>
                <a href="{{ route('admin.pet-poll.export', ['filter' => $filter, 'search' => $search]) }}" class="btn btn-outline-secondary">
                    <i class="ti ti-download fs-4 me-1"></i> Ekspor CSV
                </a>
                <a href="{{ route('admin.pet-poll.settings') }}" class="btn btn-primary">
                    <i class="ti ti-settings fs-4 me-1"></i> Pengaturan
                </a>
            @else
                <form method="POST" action="{{ route('admin.pet-poll.store') }}">
                    @csrf
                    <button type="submit" class="btn btn-primary">
                        <i class="ti ti-plus fs-4 me-1"></i> Buat Survei
                    </button>
                </form>
            @endif
        </div>
    </div>

    @if($poll)
        <!-- Stats Cards -->
        <div class="row mb-4">
            <div class="col-lg-3 col-sm-6 mb-3">
                <div class="card h-100 mb-0">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="round-40 rounded-circle bg-primary-subtle text-primary d-flex align-items-center justify-content-center">
                                <i class="ti ti-building-store fs-6"></i>
                            </div>
                            <div class="ms-3">
                                <h6 class="mb-0 text-muted">Total Tenant Aktif</h6>
                                <h3 class="mb-0 fw-semibold">{{ $stats['total'] }}</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-sm-6 mb-3">
                <div class="card h-100 mb-0">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="round-40 rounded-circle bg-info-subtle text-info d-flex align-items-center justify-content-center">
                                <i class="ti ti-checkup-list fs-6"></i>
                            </div>
                            <div class="ms-3">
                                <h6 class="mb-0 text-muted">Sudah Menjawab</h6>
                                <h3 class="mb-0 fw-semibold">{{ $stats['answered'] }} <span class="fs-2 text-muted">({{ $stats['percentage'] }}%)</span></h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-sm-6 mb-3">
                <div class="card h-100 mb-0">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="round-40 rounded-circle bg-success-subtle text-success d-flex align-items-center justify-content-center">
                                <i class="ti ti-thumb-up fs-6"></i>
                            </div>
                            <div class="ms-3">
                                <h6 class="mb-0 text-muted">Mengizinkan Pet</h6>
                                <h3 class="mb-0 fw-semibold">{{ $stats['allowed'] }}</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-sm-6 mb-3">
                <div class="card h-100 mb-0">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="round-40 rounded-circle bg-danger-subtle text-danger d-flex align-items-center justify-content-center">
                                <i class="ti ti-thumb-down fs-6"></i>
                            </div>
                            <div class="ms-3">
                                <h6 class="mb-0 text-muted">Tidak Mengizinkan</h6>
                                <h3 class="mb-0 fw-semibold">{{ $stats['denied'] }}</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Progress Bar -->
        <div class="card mb-4">
            <div class="card-body py-3">
                <div class="d-flex justify-content-between align-items-center mb-1">
                    <span class="fs-3 fw-medium">Partisipasi Tenant</span>
                    <span class="fs-3 text-muted">{{ $stats['answered'] }} dari {{ $stats['total'] }} tenant</span>
                </div>
                <div class="progress" style="height: 8px;">
                    <div class="progress-bar bg-primary" role="progressbar" style="width: {{ $stats['percentage'] }}%;" aria-valuenow="{{ $stats['percentage'] }}" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
        </div>

        <!-- Filter & Table Card -->
        <div class="card">
            <div class="card-body">
                <!-- Filters -->
                <div class="d-flex flex-wrap align-items-center justify-content-between gap-2 mb-3">
                    <div class="btn-group" role="group" aria-label="Filter status jawaban">
                        <a href="{{ route('admin.pet-poll.index', ['filter' => 'all', 'search' => $search]) }}" class="btn btn-sm {{ $filter === 'all' ? 'btn-primary' : 'btn-outline-primary' }}">
                            Semua ({{ $stats['answered'] }})
                        </a>
                        <a href="{{ route('admin.pet-poll.index', ['filter' => 'allowed', 'search' => $search]) }}" class="btn btn-sm {{ $filter === 'allowed' ? 'btn-success' : 'btn-outline-success' }}">
                            Mengizinkan ({{ $stats['allowed'] }})
                        </a>
                        <a href="{{ route('admin.pet-poll.index', ['filter' => 'denied', 'search' => $search]) }}" class="btn btn-sm {{ $filter === 'denied' ? 'btn-danger' : 'btn-outline-danger' }}">
                            Tidak Mengizinkan ({{ $stats['denied'] }})
                        </a>
                        <a href="{{ route('admin.pet-poll.index', ['filter' => 'unanswered', 'search' => $search]) }}" class="btn btn-sm {{ $filter === 'unanswered' ? 'btn-secondary' : 'btn-outline-secondary' }}">
                            Belum Menjawab ({{ $stats['unanswered'] }})
                        </a>
                    </div>

                    <form method="GET" action="{{ route('admin.pet-poll.index') }}" class="d-flex gap-2">
                        <input type="hidden" name="filter" value="{{ $filter }}">
                        <input type="text" name="search" class="form-control form-control-sm" placeholder="Cari nama tenant..." value="{{ $search }}" style="min-width: 200px;">
                        @if($search)
                            <a href="{{ route('admin.pet-poll.index', ['filter' => $filter]) }}" class="btn btn-sm btn-outline-secondary">Reset</a>
                        @endif
                        <button type="submit" class="btn btn-sm btn-primary">Cari</button>
                    </form>
                </div>

                <!-- Table -->
                <div class="table-responsive">
                    @if($filter === 'unanswered')
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>No.</th>
                                    <th>Nama Tenant</th>
                                    <th>Kategori</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($unansweredTenants as $tenant)
                                    <tr>
                                        <td>{{ $unansweredTenants->firstItem() + $loop->index }}</td>
                                        <td class="fw-semibold">{{ $tenant->name }}</td>
                                        <td>{{ $tenant->category ? $tenant->category->name : '-' }}</td>
                                        <td><span class="badge bg-secondary-subtle text-secondary">Belum menjawab</span></td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center py-4 text-muted">
                                            Tidak ada tenant dalam kategori ini.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <div class="mt-3">
                            {{ $unansweredTenants->links() }}
                        </div>
                    @else
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>No.</th>
                                    <th>Nama Tenant</th>
                                    <th>Kategori</th>
                                    <th>Keputusan</th>
                                    <th>Email</th>
                                    <th>Catatan</th>
                                    <th>Waktu (WITA)</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($responses as $resp)
                                    <tr>
                                        <td>{{ $responses->firstItem() + $loop->index }}</td>
                                        <td class="fw-semibold">{{ $resp->tenant ? $resp->tenant->name : '-' }}</td>
                                        <td>{{ ($resp->tenant && $resp->tenant->category) ? $resp->tenant->category->name : '-' }}</td>
                                        <td>
                                            @if($resp->allows_pets)
                                                <span class="badge bg-success-subtle text-success">Mengizinkan</span>
                                            @else
                                                <span class="badge bg-danger-subtle text-danger">Tidak Mengizinkan</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($resp->email)
                                                <span class="text-truncate d-inline-block" style="max-width: 180px;" title="{{ $resp->email }}">{{ $resp->email }}</span>
                                            @else
                                                <span class="text-muted">-</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($resp->note)
                                                <span class="text-truncate d-inline-block" style="max-width: 240px;" title="{{ $resp->note }}">{{ $resp->note }}</span>
                                            @else
                                                <span class="text-muted">-</span>
                                            @endif
                                        </td>
                                        <td>{{ $resp->responded_at ? $resp->responded_at->timezone('Asia/Makassar')->format('d M Y, H:i') : '-' }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center py-4 text-muted">
                                            Belum ada jawaban. Bagikan tautan survei ke tenant.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <div class="mt-3">
                            {{ $responses->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    @else
        <div class="card text-center py-5">
            <div class="card-body">
                <i class="ti ti-clipboard-list fs-10 text-muted mb-3 d-inline-block"></i>
                <h5 class="fw-semibold mb-2">Belum ada survei aktif</h5>
                <p class="text-muted mb-4">Klik tombol di bawah untuk membuat survei pet friendly baru bagi tenant.</p>
                <form method="POST" action="{{ route('admin.pet-poll.store') }}">
                    @csrf
                    <button type="submit" class="btn btn-primary">
                        <i class="ti ti-plus fs-4 me-1"></i> Buat Survei Pet Friendly
                    </button>
                </form>
            </div>
        </div>
    @endif
</div>

@push('script')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var copyBtn = document.getElementById('btnCopyPollUrl');
        if (copyBtn) {
            copyBtn.addEventListener('click', function () {
                var url = copyBtn.getAttribute('data-url');
                if (navigator.clipboard) {
                    navigator.clipboard.writeText(url).then(function () {
                        if (window.toastr) {
                            toastr.success('Tautan survei disalin ke clipboard.');
                        } else {
                            alert('Tautan survei disalin ke clipboard.');
                        }
                    });
                }
            });
        }
    });
</script>
@endpush
@endsection
