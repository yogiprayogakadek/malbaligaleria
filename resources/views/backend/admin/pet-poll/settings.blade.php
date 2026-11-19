@extends('templates.backend.master')

@section('page-title', 'Pengaturan Pet Poll')
@section('page-link', route('admin.pet-poll.settings'))

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

    <div class="d-flex align-items-center justify-content-between mb-4 flex-wrap gap-2">
        <div>
            <h4 class="mb-0 fw-semibold">Pengaturan Survei</h4>
            <p class="text-muted mb-0">Ubah teks pertanyaan, cakupan pet, dan tenggat waktu.</p>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('admin.pet-poll.index') }}" class="btn btn-outline-secondary">
                <i class="ti ti-arrow-left fs-4 me-1"></i> Kembali ke Rekap
            </a>
            <form method="POST" action="{{ route('admin.pet-poll.status') }}">
                @csrf
                @if($poll->is_open)
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Tutup survei ini? Tenant tidak akan bisa mengirim jawaban lagi.');">
                        <i class="ti ti-lock fs-4 me-1"></i> Tutup Survei
                    </button>
                @else
                    <button type="submit" class="btn btn-success">
                        <i class="ti ti-lock-open fs-4 me-1"></i> Buka Survei Kembali
                    </button>
                @endif
            </form>
        </div>
    </div>

    @if($hasResponses)
        <div class="alert alert-warning d-flex align-items-center mb-4" role="alert">
            <i class="ti ti-alert-triangle fs-6 me-2"></i>
            <div>
                <strong>Pertanyaan dan cakupan pet terkunci</strong> karena sudah ada <strong>{{ $responseCount }}</strong> jawaban dari tenant. Judul dan tenggat waktu tetap dapat diubah.
            </div>
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route('admin.pet-poll.settings.update') }}">
                @csrf
                @method('PUT')

                {{-- Judul Survei --}}
                <div class="mb-3">
                    <label for="pollTitle" class="form-label fw-semibold">Judul Survei <span class="text-danger">*</span></label>
                    <input
                        type="text"
                        name="title"
                        id="pollTitle"
                        class="form-control @error('title') is-invalid @enderror"
                        maxlength="80"
                        value="{{ old('title', $poll->title) }}"
                        required
                    >
                    <div class="form-text">Judul yang tampil di bagian atas formulir publik (maksimal 80 karakter).</div>
                    @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Pertanyaan --}}
                <div class="mb-3">
                    <label for="pollQuestion" class="form-label fw-semibold">Pertanyaan <span class="text-danger">*</span></label>
                    <textarea
                        name="question"
                        id="pollQuestion"
                        rows="2"
                        class="form-control @error('question') is-invalid @enderror"
                        maxlength="200"
                        {{ $hasResponses ? 'readonly' : 'required' }}
                    >{{ old('question', $poll->question) }}</textarea>
                    <div class="form-text">
                        Pertanyaan utama yang dijawab oleh tenant (maksimal 200 karakter).
                        @if($hasResponses)
                            <span class="text-danger fw-semibold">Terkunci karena sudah ada jawaban.</span>
                        @endif
                    </div>
                    @error('question')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Cakupan Pet --}}
                <div class="mb-3">
                    <label for="pollScope" class="form-label fw-semibold">Cakupan Pet <span class="text-danger">*</span></label>
                    <textarea
                        name="pet_scope"
                        id="pollScope"
                        rows="3"
                        class="form-control @error('pet_scope') is-invalid @enderror"
                        maxlength="300"
                        {{ $hasResponses ? 'readonly' : 'required' }}
                    >{{ old('pet_scope', $poll->pet_scope) }}</textarea>
                    <div class="form-text">
                        Teks penjelasan di bawah pilihan "Kami mengizinkan pet" (maksimal 300 karakter). Contoh: "Anjing dan kucing, wajib memakai tali atau carrier."
                        @if($hasResponses)
                            <span class="text-danger fw-semibold">Terkunci karena sudah ada jawaban.</span>
                        @endif
                    </div>
                    @error('pet_scope')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Tenggat Waktu --}}
                <div class="mb-4">
                    <label for="pollClosesAt" class="form-label fw-semibold">Tenggat Waktu Jawaban (WITA)</label>
                    <input
                        type="datetime-local"
                        name="closes_at"
                        id="pollClosesAt"
                        class="form-control @error('closes_at') is-invalid @enderror"
                        value="{{ old('closes_at', $poll->closes_at ? $poll->closes_at->timezone('Asia/Makassar')->format('Y-m-d\TH:i') : '') }}"
                        style="max-width: 320px;"
                    >
                    <div class="form-text">Biarkan kosong jika tidak ada batas waktu otomatis. Waktu menggunakan zona WITA (Bali).</div>
                    @error('closes_at')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <hr class="my-4">

                {{-- Konfigurasi Pengirim Email --}}
                <h5 class="fw-semibold mb-1">Pengaturan Email Notifikasi</h5>
                <p class="text-muted fs-2 mb-3">Tautan ubah jawaban survei akan dikirim ke PIC tenant menggunakan identitas pengirim ini.</p>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="pollSenderEmail" class="form-label fw-semibold">Email Pengirim</label>
                        <input
                            type="email"
                            name="sender_email"
                            id="pollSenderEmail"
                            class="form-control @error('sender_email') is-invalid @enderror"
                            placeholder="contoh: tenant.relations@malbaligaleria.com"
                            value="{{ old('sender_email', $poll->sender_email) }}"
                            maxlength="150"
                        >
                        <div class="form-text">Alamat email yang tampil sebagai pengirim (From). Jika kosong, menggunakan default sistem (<code>{{ config('mail.from.address') }}</code>).</div>
                        @error('sender_email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="pollSenderName" class="form-label fw-semibold">Nama Pengirim</label>
                        <input
                            type="text"
                            name="sender_name"
                            id="pollSenderName"
                            class="form-control @error('sender_name') is-invalid @enderror"
                            placeholder="contoh: Management Mal Bali Galeria"
                            value="{{ old('sender_name', $poll->sender_name) }}"
                            maxlength="100"
                        >
                        <div class="form-text">Nama pengirim yang tampil di inbox penerima. Jika kosong, menggunakan default sistem (<code>{{ config('mail.from.name') }}</code>).</div>
                        @error('sender_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="alert alert-info py-2 px-3 fs-2 mb-4 d-flex align-items-center">
                    <i class="ti ti-info-circle fs-5 me-2 flex-shrink-0"></i>
                    <div>
                        Server pengiriman email (SMTP host, port, username, password) dikonfigurasi melalui file <code>.env</code> server (driver saat ini: <strong>{{ config('mail.default') }}</strong>).
                    </div>
                </div>

                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('admin.pet-poll.index') }}" class="btn btn-outline-secondary">Batal</a>
                    <button type="submit" class="btn btn-primary">
                        <i class="ti ti-device-floppy fs-4 me-1"></i> Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
