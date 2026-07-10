@extends('templates.backend.master')

@section('page-title', 'Tambah Akses Subdomain')
@section('page-link', route('admin.subdomain-access.create'))

@section('content')
<div class="row mb-4 align-items-center">
    <div class="col">
        <p class="text-muted mb-0">Berikan akses subdomain kepada pengguna yang telah terdaftar.</p>
    </div>
    <div class="col-auto">
        <a href="{{ route('admin.subdomain-access.index') }}" class="btn btn-outline-secondary hstack gap-2">
            <i class="ti ti-arrow-left fs-4"></i> Kembali
        </a>
    </div>
</div>

<div class="row justify-content-center">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header py-3">
                <h6 class="mb-0 fw-semibold">
                    <i class="ti ti-user-check me-2 text-primary"></i>Form Pemberian Akses
                </h6>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.subdomain-access.store') }}" method="POST">
                    @csrf

                    {{-- User --}}
                    <div class="mb-4">
                        <label for="user_id" class="form-label fw-medium">User <span class="text-danger">*</span></label>
                        <select name="user_id" id="user_id" class="form-select @error('user_id') is-invalid @enderror" required>
                            <option value="">-- Pilih User --</option>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                                    {{ $user->name }} — {{ $user->email }}
                                    ({{ $user->getRoleNames()->first() ?? '-' }})
                                </option>
                            @endforeach
                        </select>
                        @error('user_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="text-muted">Hanya user dengan status approved yang ditampilkan.</small>
                    </div>

                    {{-- Subdomain --}}
                    <div class="mb-4">
                        <label for="subdomain" class="form-label fw-medium">Subdomain <span class="text-danger">*</span></label>
                        <select name="subdomain" id="subdomain" class="form-select @error('subdomain') is-invalid @enderror" required>
                            @foreach($subdomains as $sd)
                                <option value="{{ $sd }}" {{ old('subdomain', $sd) == $sd ? 'selected' : '' }}>
                                    {{ $sd }} ({{ $sd }}.malbaligaleria.com)
                                </option>
                            @endforeach
                        </select>
                        @error('subdomain')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Expired At --}}
                    <div class="mb-4">
                        <label for="expires_at" class="form-label fw-medium">Berlaku Sampai</label>
                        <input type="date" name="expires_at" id="expires_at"
                               class="form-control @error('expires_at') is-invalid @enderror"
                               value="{{ old('expires_at') }}"
                               min="{{ date('Y-m-d', strtotime('+1 day')) }}">
                        @error('expires_at')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="text-muted">Kosongkan jika akses tidak memiliki batas waktu.</small>
                    </div>

                    {{-- Note --}}
                    <div class="mb-4">
                        <label for="note" class="form-label fw-medium">Catatan</label>
                        <input type="text" name="note" id="note"
                               class="form-control @error('note') is-invalid @enderror"
                               value="{{ old('note') }}"
                               placeholder="Contoh: Akses sementara untuk audit Q3">
                        @error('note')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex gap-2 justify-content-end">
                        <a href="{{ route('admin.subdomain-access.index') }}" class="btn btn-outline-secondary">Batal</a>
                        <button type="submit" class="btn btn-primary hstack gap-2">
                            <i class="ti ti-check fs-5"></i> Berikan Akses
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
