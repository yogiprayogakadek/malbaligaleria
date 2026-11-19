<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $poll ? $poll->title : 'Survei Pet Friendly' }} | Mal Bali Galeria</title>
    <meta name="description" content="Survei keputusan tenant mengenai kebijakan pet friendly di Mal Bali Galeria.">
    <link rel="shortcut icon" href="{{ asset('assets/images/logo.png') }}" type="image/x-icon">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('assets/frontend/css/pet-poll.css') }}">
</head>
<body>
    <main class="pet-poll-page">
        <div class="pet-poll-card">
            <header class="poll-header">
                <img src="{{ asset('assets/images/logo.png') }}" alt="Mal Bali Galeria" class="poll-logo" width="180" height="135">
                @if($poll)
                    <h1 class="poll-title">{{ $poll->title }}</h1>
                    <p class="poll-intro">Mal Bali Galeria sedang menyiapkan kebijakan pet friendly. Kami meminta keputusan resmi dari setiap tenant sebelum kebijakan ini berlaku.</p>
                @else
                    <h1 class="poll-title">Survei Pet Friendly</h1>
                    <p class="poll-intro">Survei belum tersedia.</p>
                @endif
            </header>

            @if(session('error'))
                <div class="alert-message alert-error" role="alert">
                    {{ session('error') }}
                </div>
            @endif

            @if(!$poll)
                <div class="alert-message alert-banner">
                    Survei saat ini belum diaktifkan oleh pihak mall. Silakan hubungi manajemen Mal Bali Galeria.
                </div>
            @elseif(!$isOpen && !$submitted && !$response)
                <div class="alert-message alert-banner">
                    Survei sudah ditutup{{ $poll->closes_at ? ' pada ' . $poll->closes_at->timezone('Asia/Makassar')->translatedFormat('d F Y, H:i') . ' WITA' : '' }}. Terima kasih atas partisipasi Anda.
                </div>
            @elseif($submitted && $response)
                {{-- State konfirmasi sukses --}}
                <section class="confirmation-card" aria-live="polite">
                    <span class="confirmation-badge">Tersimpan</span>
                    <h2 class="confirmation-title">Jawaban tersimpan</h2>
                    <p class="step-helper">Terima kasih, keputusan tenant Anda telah tercatat.</p>

                    <div class="confirmation-detail">
                        <div class="detail-row">
                            <span class="detail-label">Tenant</span>
                            <strong>{{ $response->tenant->name }}</strong>
                            @if($response->tenant->category)
                                <span class="combobox-option-category">{{ $response->tenant->category->name }}</span>
                            @endif
                        </div>
                        <div class="detail-row" style="margin-top: 10px;">
                            <span class="detail-label">Keputusan</span>
                            <strong>{{ $response->allows_pets ? 'Kami mengizinkan pet' : 'Kami tidak mengizinkan pet' }}</strong>
                        </div>
                        @if($response->note)
                            <div class="detail-row" style="margin-top: 10px;">
                                <span class="detail-label">Catatan</span>
                                <span>{{ $response->note }}</span>
                            </div>
                        @endif
                        <div class="detail-row" style="margin-top: 10px; font-size: 12px; color: var(--sage-text);">
                            Dikirim pada {{ $response->responded_at ? $response->responded_at->timezone('Asia/Makassar')->translatedFormat('d M Y, H:i') : now()->timezone('Asia/Makassar')->translatedFormat('d M Y, H:i') }} WITA.
                            @if($isOpen && $poll->closes_at)
                                Jawaban dapat diubah sampai {{ $poll->closes_at->timezone('Asia/Makassar')->translatedFormat('d M Y, H:i') }} WITA.
                            @endif
                        </div>
                    </div>

                    @if($isOpen)
                        <form method="GET" action="{{ route('frontend.pet-poll.show') }}">
                            <input type="hidden" name="edit" value="1">
                            <button type="submit" class="btn-link-action">Ubah jawaban</button>
                        </form>
                    @endif
                </section>
            @else
                {{-- Form pengisian --}}
                @if($response && !request()->has('edit'))
                    <div class="alert-message alert-banner">
                        Anda sudah mengirim jawaban untuk <strong>{{ $response->tenant->name }}</strong>. Anda dapat memperbarui jawaban ini selama survei masih dibuka.
                    </div>
                @endif

                <form method="POST" action="{{ route('frontend.pet-poll.submit') }}" id="petPollForm" novalidate>
                    @csrf

                    {{-- Step 1: Tenant Combobox --}}
                    <div class="poll-step">
                        <label class="step-label" for="tenantSearchInput">1. Tenant Anda</label>
                        <h2 class="step-title">Nama tenant</h2>
                        <p class="step-helper">Gunakan nama tenant yang terdaftar di Mal Bali Galeria.</p>

                        <input type="hidden" name="tenant_id" id="selectedTenantId" value="{{ old('tenant_id', $response ? $response->tenant_id : '') }}">

                        <div class="combobox-wrapper" id="comboboxWrapper">
                            <input
                                type="text"
                                class="input-text"
                                id="tenantSearchInput"
                                placeholder="Cari nama tenant..."
                                autocomplete="off"
                                role="combobox"
                                aria-autocomplete="list"
                                aria-expanded="false"
                                aria-controls="tenantSearchResults"
                                aria-describedby="tenantHelp"
                                value="{{ old('tenant_name_display', $response ? $response->tenant->name : '') }}"
                            >
                            <span class="search-icon" aria-hidden="true">&#9906;</span>
                            <ul class="combobox-results" id="tenantSearchResults" role="listbox" style="display: none;"></ul>
                        </div>
                        <span id="tenantHelp" class="step-helper" style="display: block; margin-top: 6px;">Ketik minimal 2 karakter untuk mencari.</span>

                        @error('tenant_id')
                            <div class="alert-message alert-error" style="margin-top: 8px;">{{ $message }}</div>
                        @enderror

                        {{-- Prasasti tenant terpilih --}}
                        <div class="tenant-plaque" id="tenantPlaque" style="{{ ($response || old('tenant_id')) ? '' : 'display: none;' }}">
                            <div>
                                <div class="tenant-plaque-title" id="tenantPlaqueName">{{ $response ? $response->tenant->name : '' }}</div>
                                <div class="tenant-plaque-sub" id="tenantPlaqueCategory">{{ $response && $response->tenant->category ? $response->tenant->category->name : '' }}</div>
                            </div>
                            <button type="button" class="btn-link-action" id="btnChangeTenant">Ganti tenant</button>
                        </div>
                    </div>

                    {{-- Step 2: Keputusan Tenant --}}
                    <div class="poll-step">
                        <label class="step-label">2. Keputusan tenant Anda</label>
                        <h2 class="step-title">{{ $poll->question }}</h2>
                        <p class="step-helper">Keputusan ini untuk area tenant Anda, bukan area umum mall.</p>

                        <fieldset class="board-fieldset">
                            <legend class="visually-hidden" style="position: absolute; width: 1px; height: 1px; overflow: hidden; clip: rect(0,0,0,0);">Pilih keputusan izin pet</legend>
                            <div class="board-grid">
                                {{-- Board A: Mengizinkan --}}
                                <label class="board-card" for="allowsPetsYes">
                                    <input
                                        type="radio"
                                        name="allows_pets"
                                        id="allowsPetsYes"
                                        value="1"
                                        {{ old('allows_pets', $response ? ($response->allows_pets ? '1' : '0') : '') === '1' ? 'checked' : '' }}
                                    >
                                    <svg class="board-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                        <path d="M12 2a3 3 0 0 0-3 3c0 .34.06.67.17.97A3 3 0 0 0 7 9c0 .73.26 1.4.7 1.93A3.5 3.5 0 0 0 7 14c0 1.66 1.12 3.07 2.66 3.42C10.22 19.46 11.5 21 12 21s1.78-1.54 2.34-3.58C15.88 17.07 17 15.66 17 14a3.5 3.5 0 0 0-.7-3.07c.44-.53.7-1.2.7-1.93a3 3 0 0 0-2.17-3.03c.11-.3.17-.63.17-.97a3 3 0 0 0-3-3z"/>
                                    </svg>
                                    <div class="board-title">Kami mengizinkan pet</div>
                                    <div class="board-desc">{{ $poll->pet_scope }}</div>
                                </label>

                                {{-- Board B: Tidak mengizinkan --}}
                                <label class="board-card" for="allowsPetsNo">
                                    <input
                                        type="radio"
                                        name="allows_pets"
                                        id="allowsPetsNo"
                                        value="0"
                                        {{ old('allows_pets', $response ? ($response->allows_pets ? '1' : '0') : '') === '0' ? 'checked' : '' }}
                                    >
                                    <svg class="board-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                        <rect x="3" y="3" width="18" height="18" rx="2"/>
                                        <path d="m9 9 6 6"/>
                                        <path d="m15 9-6 6"/>
                                    </svg>
                                    <div class="board-title">Kami tidak mengizinkan pet</div>
                                    <div class="board-desc">Hewan tidak masuk ke area tenant.</div>
                                </label>
                            </div>
                        </fieldset>

                        @error('allows_pets')
                            <div class="alert-message alert-error" style="margin-top: 8px;">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Step 3: Catatan opsional disembunyikan sementara --}}

                    {{-- Submit button --}}
                    <button type="submit" class="btn-primary-poll" id="btnSubmitPoll" {{ !$isOpen ? 'disabled' : '' }}>
                        <span class="btn-text">Kirim jawaban</span>
                    </button>

                    <p class="poll-footer-note">
                        @if($poll->closes_at)
                            Jawaban dapat diubah sampai {{ $poll->closes_at->timezone('Asia/Makassar')->translatedFormat('d F Y, H:i') }} WITA.
                        @else
                            Jawaban dapat diubah selama survei masih dibuka.
                        @endif
                        <br>Nama dan jawaban digunakan hanya untuk kebijakan pet friendly Mal Bali Galeria.
                    </p>
                </form>
            @endif
        </div>
    </main>

    @if($poll)
        <script>
            window.__PET_POLL_CONFIG__ = {
                searchUrl: "{{ route('frontend.pet-poll.tenants') }}",
                isOpen: {{ $isOpen ? 'true' : 'false' }}
            };
        </script>
        <script src="{{ asset('assets/frontend/js/pet-poll.js') }}"></script>
    @endif
</body>
</html>
