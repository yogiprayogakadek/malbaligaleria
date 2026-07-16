@extends('templates.inventory.auth')

@section('page-title', 'Login Inventory')

@section('content')
    {{-- Error Alert --}}
    @if ($errors->any())
        <div class="alert-err">
            <span class="icon">
                <iconify-icon icon="solar:danger-triangle-bold"></iconify-icon>
            </span>
            <span>{{ $errors->first() }}</span>
        </div>
    @endif

    <form method="POST" action="{{ route('inventory.login.submit') }}" autocomplete="off">
        @csrf

        {{-- Email --}}
        <div class="field-group">
            <label class="field-label" for="email">Alamat Email</label>
            <div class="field-wrap">
                <span class="field-icon">
                    <iconify-icon icon="solar:letter-line-duotone"></iconify-icon>
                </span>
                <input type="email" id="email" name="email"
                       value="{{ old('email') }}"
                       placeholder="nama@malbaligaleria.com"
                       autofocus required>
            </div>
        </div>

        {{-- Password --}}
        <div class="field-group">
            <label class="field-label" for="password">Kata Sandi</label>
            <div class="field-wrap">
                <span class="field-icon">
                    <iconify-icon icon="solar:lock-password-line-duotone"></iconify-icon>
                </span>
                <input type="password" id="password" name="password"
                       placeholder="••••••••" required>
                <button type="button" class="toggle-eye" id="togglePwd" tabindex="-1">
                    <iconify-icon id="eyeIcon" icon="solar:eye-closed-line-duotone"></iconify-icon>
                </button>
            </div>
        </div>

        {{-- Remember --}}
        <div class="remember-row">
            <input type="checkbox" name="remember" id="remember">
            <label for="remember">Ingat saya di perangkat ini</label>
        </div>

        {{-- Submit --}}
        <button type="submit" class="btn-login">
            Masuk ke Sistem Inventory
        </button>
    </form>

    <p class="form-footer-note">
        Akses hanya untuk staf yang telah diotorisasi oleh administrator sistem.
    </p>
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
