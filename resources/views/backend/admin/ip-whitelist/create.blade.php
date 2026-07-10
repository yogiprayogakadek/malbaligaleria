@extends('templates.backend.master')

@section('page-title', 'Tambah IP Whitelist')
@section('page-link', route('admin.ip-whitelist.create'))

@section('content')
<div class="row mb-4 align-items-center">
    <div class="col">
        <p class="text-muted mb-0">Tambahkan IP Address yang diizinkan untuk mengakses subdomain.</p>
    </div>
    <div class="col-auto">
        <a href="{{ route('admin.ip-whitelist.index') }}" class="btn btn-outline-secondary hstack gap-2">
            <i class="ti ti-arrow-left fs-4"></i> Kembali
        </a>
    </div>
</div>

<div class="row justify-content-center">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header py-3">
                <h6 class="mb-0 fw-semibold">
                    <i class="ti ti-shield-lock me-2 text-primary"></i>Form IP Whitelist
                </h6>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.ip-whitelist.store') }}" method="POST">
                    @csrf

                    {{-- Subdomain --}}
                    <div class="mb-4">
                        <label for="subdomain" class="form-label fw-medium">Subdomain <span class="text-danger">*</span></label>
                        <select name="subdomain" id="subdomain" class="form-select @error('subdomain') is-invalid @enderror" required>
                            @foreach($subdomains as $sd)
                                <option value="{{ $sd }}" {{ old('subdomain') == $sd ? 'selected' : '' }}>
                                    {{ $sd }} ({{ $sd }}.malbaligaleria.com)
                                </option>
                            @endforeach
                        </select>
                        @error('subdomain')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- IP Address --}}
                    <div class="mb-4">
                        <label for="ip_address" class="form-label fw-medium">IP Address <span class="text-danger">*</span></label>
                        <input type="text" name="ip_address" id="ip_address"
                               class="form-control @error('ip_address') is-invalid @enderror"
                               value="{{ old('ip_address') }}"
                               placeholder="Contoh: 182.253.50.84" required>
                        @error('ip_address')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="text-muted">Mendukung format IPv4 (e.g. 192.168.1.1) dan IPv6.</small>
                    </div>

                    {{-- Label --}}
                    <div class="mb-4">
                        <label for="label" class="form-label fw-medium">Label / Nama Lokasi</label>
                        <input type="text" name="label" id="label"
                               class="form-control @error('label') is-invalid @enderror"
                               value="{{ old('label') }}"
                               placeholder="Contoh: Wifi Ruang IT, Kantor Pusat">
                        @error('label')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex gap-2 justify-content-end">
                        <a href="{{ route('admin.ip-whitelist.index') }}" class="btn btn-outline-secondary">Batal</a>
                        <button type="submit" class="btn btn-primary hstack gap-2">
                            <i class="ti ti-check fs-5"></i> Simpan IP Whitelist
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
