@extends('templates.inventory.auth')

@section('page-title', 'Akses Ditolak')

@section('content')
    <div class="text-center py-2">
        <div class="mb-4">
            <iconify-icon icon="solar:shield-cross-line-duotone"
                          style="font-size: 64px; color: #ef4444;"></iconify-icon>
        </div>

        <h5 class="fw-bold mb-2" style="color:#0a2a4a;">Akses Ditolak</h5>
        <p class="text-muted mb-4" style="font-size:13px; line-height:1.6;">
            Akun Anda belum mendapatkan izin untuk mengakses
            <strong>Sistem Inventory</strong>.<br>
            Hubungi administrator untuk meminta akses.
        </p>

        @if(Auth::check())
            <div class="alert alert-light py-2 px-3 mb-4 text-start" style="font-size:12px; border-radius:10px; border: 1px solid #e5e7eb;">
                <iconify-icon icon="solar:user-line-duotone" class="me-1"></iconify-icon>
                Login sebagai: <strong>{{ Auth::user()->email }}</strong>
            </div>
        @endif

        <div class="d-grid gap-2">
            @if(Auth::check())
                <form method="POST" action="{{ route('inventory.logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-danger w-100 fw-medium" style="border-radius:10px;">
                        <iconify-icon icon="solar:logout-2-line-duotone" class="me-2"></iconify-icon>
                        Logout
                    </button>
                </form>
            @else
                <a href="{{ route('inventory.login') }}"
                   class="btn w-100 fw-medium"
                   style="background:linear-gradient(135deg,#0f4c81,#1e88e5); color:#fff; border-radius:10px;">
                    <iconify-icon icon="solar:login-2-line-duotone" class="me-2"></iconify-icon>
                    Kembali ke Login
                </a>
            @endif
        </div>
    </div>
@endsection
