@extends('templates.inventory.auth')

@section('page-title', 'Login Inventory')

@section('content')
    <h5 class="fw-semibold mb-1" style="color:#0a2a4a;">Selamat Datang</h5>
    <p class="text-muted mb-4" style="font-size:13px;">Masuk untuk mengakses sistem inventory.</p>

    {{-- Error Alert --}}
    @if ($errors->any())
        <div class="alert alert-danger py-2 px-3 mb-4" style="font-size:13px; border-radius:10px;">
            <iconify-icon icon="solar:danger-triangle-line-duotone" class="me-1"></iconify-icon>
            {{ $errors->first() }}
        </div>
    @endif

    <form method="POST" action="{{ route('inventory.login.submit') }}" autocomplete="off">
        @csrf

        {{-- Email --}}
        <div class="mb-3">
            <label for="email" class="form-label fw-medium" style="font-size:13px; color:#374151;">
                Email Address
            </label>
            <div class="input-group">
                <span class="input-group-text" style="background:#f8fafc; border-right:0;">
                    <iconify-icon icon="solar:letter-line-duotone" style="color:#6c757d; font-size:16px;"></iconify-icon>
                </span>
                <input type="email" id="email" name="email"
                       class="form-control @error('email') is-invalid @enderror"
                       style="border-left:0; background:#f8fafc;"
                       value="{{ old('email') }}"
                       placeholder="nama@perusahaan.com"
                       autofocus required>
            </div>
        </div>

        {{-- Password --}}
        <div class="mb-4">
            <label for="password" class="form-label fw-medium" style="font-size:13px; color:#374151;">
                Password
            </label>
            <div class="input-group">
                <span class="input-group-text" style="background:#f8fafc; border-right:0;">
                    <iconify-icon icon="solar:lock-password-line-duotone" style="color:#6c757d; font-size:16px;"></iconify-icon>
                </span>
                <input type="password" id="password" name="password"
                       class="form-control"
                       style="border-left:0; border-right:0; background:#f8fafc;"
                       placeholder="••••••••" required>
                <button type="button" class="input-group-text" id="togglePwd"
                        style="background:#f8fafc; border-left:0; cursor:pointer;">
                    <iconify-icon id="eyeIcon" icon="solar:eye-closed-line-duotone" style="color:#6c757d; font-size:16px;"></iconify-icon>
                </button>
            </div>
        </div>

        {{-- Remember --}}
        <div class="d-flex align-items-center justify-content-between mb-4">
            <div class="form-check mb-0">
                <input class="form-check-input" type="checkbox" name="remember" id="remember">
                <label class="form-check-label" for="remember" style="font-size:13px;">
                    Ingat saya
                </label>
            </div>
        </div>

        {{-- Submit --}}
        <button type="submit" class="btn w-100 fw-semibold py-2"
                style="background: linear-gradient(135deg, #0f4c81, #1e88e5); color:#fff; border-radius:10px; font-size:14px; letter-spacing:.3px;">
            <iconify-icon icon="solar:login-2-line-duotone" class="me-2"></iconify-icon>
            Masuk ke Inventory
        </button>
    </form>

    <div class="text-center mt-4" style="font-size:12px; color:#9ca3af;">
        Sistem ini hanya untuk pengguna yang telah mendapatkan akses dari administrator.
    </div>
@endsection

@push('script')
<script>
    const toggleBtn = document.getElementById('togglePwd');
    const pwdInput  = document.getElementById('password');
    const eyeIcon   = document.getElementById('eyeIcon');

    toggleBtn.addEventListener('click', () => {
        const isText = pwdInput.type === 'text';
        pwdInput.type = isText ? 'password' : 'text';
        eyeIcon.setAttribute('icon', isText
            ? 'solar:eye-closed-line-duotone'
            : 'solar:eye-line-duotone');
    });
</script>
@endpush
