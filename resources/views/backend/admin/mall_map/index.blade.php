@extends('templates.backend.master')

@section('page-title', 'Mall Map Management')
@section('page-link', route('admin.mall-map.index'))

@push('css')
    <link rel="stylesheet" href="{{ asset('assets/backend/css/sweetalert2.min.css') }}">
    <style>
        .map-preview-card {
            border: 2px dashed #e0e6ed;
            border-radius: 12px;
            padding: 30px;
            text-align: center;
            background: #fafafa;
            transition: all 0.3s ease;
        }
        .map-preview-card:hover {
            border-color: #5d87ff;
            background: #f4f7ff;
        }
        .file-icon-badge {
            width: 64px;
            height: 64px;
            border-radius: 16px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 28px;
            margin-bottom: 15px;
        }
        .badge-pdf { background: #ffebee; color: #d32f2f; }
        .badge-img { background: #e3f2fd; color: #1976d2; }
    </style>
@endpush

@section('content')
    @if (session('success'))
        <script>
            toastr.success("{{ session('success') }}", "Success", {
                showMethod: "slideDown",
                hideMethod: "slideUp",
                timeOut: 3000
            });
        </script>
    @endif

    <div class="row">
        <div class="col-lg-8 col-md-10 col-12 mx-auto">
            <div class="card shadow-sm">
                <div class="card-header bg-transparent border-bottom d-flex align-items-center justify-content-between">
                    <h4 class="card-title mb-0">
                        <i class="ti ti-map-pin text-primary me-2 fs-5"></i>Kelola Peta Mal (Download Map Mobile)
                    </h4>
                </div>
                <div class="card-body">
                    <p class="text-muted fs-3 mb-4">
                        Unggah file peta lokasi Mal Bali Galeria (format <strong>PDF, PNG, JPG, JPEG, atau WEBP</strong>, maksimal <strong>20MB</strong>). File ini akan dapat diunduh oleh pengunjung pada halaman <em>Directory (Mobile View)</em>.
                    </p>

                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <ul class="mb-0 ps-3">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <!-- Upload Form -->
                    <form action="{{ route('admin.mall-map.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-4">
                            <label for="map_file" class="form-label fw-semibold">Pilih File Peta Baru</label>
                            <input type="file" name="map_file" id="map_file" class="form-control form-control-lg @error('map_file') is-invalid @enderror" accept=".pdf,.png,.jpg,.jpeg,.webp" required>
                            <div class="form-text">Maksimal ukuran file: 20MB. Format yang didukung: PDF, PNG, JPG, JPEG, WEBP.</div>
                        </div>

                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary px-4 py-2">
                                <i class="ti ti-cloud-upload me-1 fs-5"></i> Unggah File Peta
                            </button>
                        </div>
                    </form>

                    <hr class="my-4">

                    <!-- Current Map Information -->
                    <h5 class="fw-semibold mb-3">Status File Peta Saat Ini</h5>
                    @if ($mapData)
                        <div class="map-preview-card">
                            <div class="file-icon-badge {{ $mapData['file_type'] === 'pdf' ? 'badge-pdf' : 'badge-img' }}">
                                @if ($mapData['file_type'] === 'pdf')
                                    <i class="ti ti-file-text"></i>
                                @else
                                    <i class="ti ti-photo"></i>
                                @endif
                            </div>
                            <h5 class="fw-bold mb-1 text-dark">{{ $mapData['file_name'] }}</h5>
                            <p class="text-muted mb-3 fs-2">
                                Format: <span class="badge bg-light-primary text-primary text-uppercase">{{ $mapData['file_type'] }}</span> | 
                                Diperbarui: {{ $mapData['updated_at'] }}
                            </p>

                            <div class="d-flex justify-content-center gap-2">
                                <a href="{{ $mapData['url'] }}" target="_blank" download class="btn btn-outline-primary btn-sm px-3">
                                    <i class="ti ti-download me-1"></i> Unduh / Liat File
                                </a>
                                <button type="button" class="btn btn-outline-danger btn-sm px-3 btn-delete-map">
                                    <i class="ti ti-trash me-1"></i> Hapus Peta
                                </button>
                            </div>
                        </div>

                        <form id="deleteMapForm" action="{{ route('admin.mall-map.destroy') }}" method="POST" style="display: none;">
                            @csrf
                            @method('DELETE')
                        </form>
                    @else
                        <div class="alert alert-warning d-flex align-items-center" role="alert">
                            <i class="ti ti-alert-triangle fs-6 me-2"></i>
                            <div>
                                Belum ada file peta yang diunggah. Tombol <em>Download Map</em> di mobile view akan menampilkan pemberitahuan file belum tersedia.
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script src="{{ asset('assets/backend/js/sweetalert2.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('.btn-delete-map').on('click', function() {
                Swal.fire({
                    title: 'Hapus File Peta?',
                    text: "File peta yang diunggah akan dihapus dari sistem.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Ya, Hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $('#deleteMapForm').submit();
                    }
                });
            });
        });
    </script>
@endpush
