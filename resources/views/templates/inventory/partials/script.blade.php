{{-- Core backend JS --}}
<script src="{{ asset('assets/backend/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/backend/js/simplebar.min.js') }}"></script>
<script src="{{ asset('assets/backend/js/app.init.js') }}"></script>
<script src="{{ asset('assets/backend/js/theme.js') }}"></script>
<script src="{{ asset('assets/backend/js/app.min.js') }}"></script>

{{-- Iconify --}}
<script src="{{ asset('assets/backend/js/iconify-icon.min.js') }}"></script>

{{-- Inventory sidebar toggle --}}
<script>
(function () {
    const sidebar  = document.getElementById('invSidebar');
    const overlay  = document.getElementById('invSidebarOverlay');
    const toggle   = document.getElementById('invSidebarToggle');
    const COLLAPSED_KEY = 'inv_sidebar_collapsed';

    // Restore state
    if (window.innerWidth > 991 && localStorage.getItem(COLLAPSED_KEY) === '1') {
        sidebar.classList.add('collapsed');
    }

    toggle.addEventListener('click', function () {
        if (window.innerWidth <= 991) {
            // Mobile: slide in/out
            sidebar.classList.toggle('mobile-open');
            overlay.classList.toggle('visible');
        } else {
            // Desktop: collapse/expand
            sidebar.classList.toggle('collapsed');
            localStorage.setItem(COLLAPSED_KEY, sidebar.classList.contains('collapsed') ? '1' : '0');
        }
    });

    overlay.addEventListener('click', function () {
        sidebar.classList.remove('mobile-open');
        overlay.classList.remove('visible');
    });

    // Dark/light mode
    document.querySelectorAll('.moon').forEach(el => el.addEventListener('click', () => {
        document.documentElement.setAttribute('data-bs-theme', 'dark');
        document.querySelectorAll('.moon').forEach(m => m.style.display = 'none');
        document.querySelectorAll('.sun').forEach(s => s.style.display = '');
    }));
    document.querySelectorAll('.sun').forEach(el => el.addEventListener('click', () => {
        document.documentElement.setAttribute('data-bs-theme', 'light');
        document.querySelectorAll('.sun').forEach(s => s.style.display = 'none');
        document.querySelectorAll('.moon').forEach(m => m.style.display = '');
    }));
})();
</script>

{{-- Page-specific scripts --}}
@stack('script')
