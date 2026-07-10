<!DOCTYPE html>
<html lang="id" dir="ltr" data-bs-theme="light">

@include('templates.inventory.partials.head')

<body>
<div class="inv-wrapper">

    {{-- ── Sidebar ── --}}
    @include('templates.inventory.partials.sidebar')

    {{-- ── Main ── --}}
    <div class="inv-main" id="invMain">

        {{-- Topbar --}}
        @include('templates.inventory.partials.topbar')

        {{-- Flash Messages --}}
        @if(session('success'))
            <div class="mx-4 mt-3">
                <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
                    <iconify-icon icon="solar:check-circle-line-duotone" class="me-2 fs-5"></iconify-icon>
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            </div>
        @endif
        @if(session('error'))
            <div class="mx-4 mt-3">
                <div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert">
                    <iconify-icon icon="solar:close-circle-line-duotone" class="me-2 fs-5"></iconify-icon>
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            </div>
        @endif

        {{-- Content --}}
        <div class="inv-content">
            @yield('content')
        </div>

        {{-- Footer --}}
        <footer class="text-center text-muted py-3" style="font-size:12px; border-top: 1px solid #e9ecef;">
            &copy; {{ date('Y') }} Mal Bali Galeria — Inventory System
        </footer>
    </div>

</div>

@include('templates.inventory.partials.script')
</body>
</html>
