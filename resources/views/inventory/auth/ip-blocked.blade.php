@extends('templates.inventory.auth')

@section('page-title', 'IP Diblokir')

@section('content')
    <div class="text-center py-2">
        <div class="mb-4">
            <iconify-icon icon="solar:wifi-router-line-duotone"
                          style="font-size: 64px; color: #f59e0b;"></iconify-icon>
        </div>

        <h5 class="fw-bold mb-2" style="color:#0a2a4a;">Akses IP Diblokir</h5>
        <p class="text-muted mb-4" style="font-size:13px; line-height:1.6;">
            IP Address Anda tidak terdaftar dalam whitelist yang
            diizinkan untuk mengakses sistem ini.
        </p>

        <div class="alert alert-warning py-2 px-3 mb-4 text-start" style="font-size:12px; border-radius:10px;">
            <iconify-icon icon="solar:map-point-line-duotone" class="me-1"></iconify-icon>
            IP Anda: <strong>{{ $ip ?? request()->ip() }}</strong>
        </div>

        <p class="text-muted" style="font-size:12px;">
            Hubungi administrator untuk mendaftarkan IP Anda, atau akses dari
            jaringan yang telah diizinkan.
        </p>

        <div class="d-grid mt-4">
            <form method="POST" action="{{ route('inventory.logout') }}">
                @csrf
                <button type="submit" class="btn btn-outline-secondary w-100 fw-medium" style="border-radius:10px;">
                    <iconify-icon icon="solar:logout-2-line-duotone" class="me-2"></iconify-icon>
                    Logout
                </button>
            </form>
        </div>
    </div>
@endsection
