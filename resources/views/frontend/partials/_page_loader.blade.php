{{-- Page Loader Component --}}
<div class="page-loader" id="pageLoader">
    <div class="loader-content">
        <div class="loader-logo">
            <div class="loader-logo-circle">
                <img src="{{ asset('assets/images/logo.png') }}" alt="MBG Logo" class="loader-logo-image"
                    onerror="this.style.display='none'">
            </div>
            <h1>mal bali galeria</h1>
            <span>SHOPPING CENTER</span>
        </div>
        <div class="loader-spinner">
            <div class="spinner-ring"></div>
            <div class="spinner-ring"></div>
            <div class="spinner-ring"></div>
        </div>
        <div class="loader-progress">
            <div class="progress-bar"></div>
        </div>
        <p class="loader-text">{{ $text ?? 'LOADING...' }}</p>
    </div>
</div>
