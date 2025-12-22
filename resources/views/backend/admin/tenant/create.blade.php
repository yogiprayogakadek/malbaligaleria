@extends('templates.backend.master')

@section('page-title', 'Create Tenant')
@section('page-link', route('admin.tenant.create'))

@push('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
@endpush

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin.tenant.store') }}" method="POST" enctype="multipart/form-data"
                        id="form">
                        @csrf

                        {{-- Tenant Category --}}
                        <div class="mb-4 row align-items-center">
                            <label for="category" class="form-label col-sm-3 col-form-label">Category</label>
                            <div class="col-sm-12">
                                <select name="category_id" id="categoryId"
                                    class="form-control @error('category_id') is-invalid @enderror">
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}"
                                            {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- Tenant Name --}}
                        <div class="mb-4 row align-items-center">
                            <label for="name" class="form-label col-sm-3 col-form-label">Name</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    id="name" name="name" placeholder="Enter tenant name"
                                    value="{{ old('name') }}">
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- Tenant Phone --}}
                        <div class="mb-4 row align-items-center">
                            <label for="phone" class="form-label col-sm-3 col-form-label">Phone</label>
                            <div class="col-sm-12">
                                <input type="telp" class="form-control @error('phone') is-invalid @enderror"
                                    id="phone" name="phone" placeholder="Enter tenant telp"
                                    value="{{ old('phone') }}">
                                @error('phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- Tenant Email --}}
                        <div class="mb-4 row align-items-center">
                            <label for="email" class="form-label col-sm-3 col-form-label">Email</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control @error('email') is-invalid @enderror"
                                    id="email" name="email" placeholder="Enter tenant email"
                                    value="{{ old('email') }}">
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- Tenant Position --}}
                        {{-- Modal --}}
                        <div class="modal fade" id="modalMap" tabindex="-1" aria-labelledby="bs-example-modal-lg"
                            aria-hidden="true">
                            <div class="modal-dialog modal-xl">
                                <div class="modal-content">
                                    <div class="modal-header d-flex align-items-center">
                                        <h4 class="modal-title" id="myLargeModalLabel">
                                            Choose Teanant Location
                                        </h4>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row mb-4">
                                            <div class="col-sm-6">
                                                <button class="btn btn-primary btn-map-image" id="btnFirstFloor"
                                                    type="button" style="width: 100%" data-floor="1st">1st
                                                    Floor</button>
                                            </div>
                                            <div class="col-sm-6">
                                                <button class="btn btn-outline-primary btn-map-image" id="btnSecondFloor"
                                                    type="button" style="width: 100%" data-floor="2nd">2nd
                                                    Floor</button>
                                            </div>
                                        </div>
                                        <img src="{{ asset('assets/images/floors/1st.png') }}" alt="1st floor"
                                            srcset="{{ asset('assets/images/floors/1st.png') }}" width="100%"
                                            class="map-image" id="floorMapImage">
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button"
                                            class="btn bg-danger-subtle text-danger  waves-effect text-start"
                                            data-bs-dismiss="modal">
                                            Close
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mb-4 row align-items-center">
                            <div class="row">
                                <div class="col-sm-3">
                                    <label for="floor" class="form-label col-sm-3 col-form-label">Floor</label>
                                    <input type="number" class="form-control @error('floor') is-invalid @enderror"
                                        name="floor" id="floor" value="{{ old('floor') }}"
                                        placeholder="Between 1 & 2">
                                    @error('floor')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-sm-3">
                                    <label for="unit" class="form-label col-sm-3 col-form-label">Unit</label>
                                    <input type="text" class="form-control @error('unit') is-invalid @enderror"
                                        name="unit" id="unit" value="{{ old('unit') }}"
                                        placeholder="Enter unit tenant location">
                                    @error('unit')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-sm-3">
                                    <label for="positionX" class="form-label col-sm-3 col-form-label">Pos. X</label>
                                    <input type="number" class="form-control @error('position_x') is-invalid @enderror"
                                        name="position_x" id="positionX" value="{{ old('position-x') }}"
                                        placeholder="The field will be automatically filled (in)">
                                    @error('position_x')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-sm-3">
                                    <label for="positionY" class="form-label col-sm-3 col-form-label">Pos. Y</label>
                                    <input type="number" class="form-control @error('position_y') is-invalid @enderror"
                                        name="position_y" id="positionY" value="{{ old('position-y') }}"
                                        placeholder="The field will be automatically filled (in)">
                                    @error('position_y')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                {{-- <div class="col-sm-2">
                                    <button class="btn btn-info btn-map" type="button" style="width: 100%"
                                        data-bs-toggle="modal" data-bs-target="#modalMap">
                                        <i class="fa fa-map-pin"></i> Open Map
                                    </button>
                                </div> --}}
                            </div>
                        </div>

                        {{-- Tenant Website --}}
                        <div class="mb-4 row align-items-center">
                            <label for="website" class="form-label col-sm-3 col-form-label">Website</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control @error('website') is-invalid @enderror"
                                    id="website" name="website" placeholder="Enter tenant website"
                                    value="{{ old('website') }}">
                                @error('website')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- Tenant Logo --}}
                        <div class="mb-4 row align-items-center">
                            <label for="logo" class="form-label col-sm-3 col-form-label">Logo</label>
                            <div class="col-sm-12">
                                <input type="file" class="form-control @error('logo') is-invalid @enderror"
                                    id="logo" name="logo" placeholder="Enter tenant logo"
                                    value="{{ old('logo') }}">
                                @error('logo')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- Launched at --}}
                        <div class="mb-4 row align-items-center">
                            <label for="launchedAt" class="form-label col-sm-3 col-form-label">Launched at</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control @error('launched_at') is-invalid @enderror"
                                    id="launchedAt" name="launched_at" placeholder="Enter launched date of tenant"
                                    value="{{ old('launched_at') }}">
                                <small>Leave empty for existing stores</small>
                                @error('launched_at')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- Tenant Description --}}
                        <div class="mb-4 row align-items-center">
                            <label for="description" class="form-label col-sm-3 col-form-label">Description</label>
                            <div class="col-sm-12">
                                <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror"
                                    rows="10" id="description" name="description" placeholder="Enter tenant description">{{ old('description') }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- Submit --}}
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary hstack gap-6 float-end">
                                <i class="ti ti-send fs-4"></i> Submit
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        flatpickr("#launchedAt", {
            dateFormat: "Y-m-d",
            altInput: true,
            altFormat: "F j, Y",
        });

        $('body').on('click', '.btn-map-image', function() {
            let floor = $(this).data('floor');
            let image = floor == '1st' ? "{{ asset('assets/images/floors/1st.png') }}" :
                "{{ asset('assets/images/floors/2nd.png') }}";
            $('.map-image').attr({
                src: image,
                srcset: image
            });
            $('.btn-map-image').removeClass('btn-primary').addClass('btn-outline-primary');
            $(this).removeClass('btn-outline-primary').addClass('btn-primary');
        });

        // ===== COORDINATE PICKER =====
        function enableCoordinatePicker() {
            const mapImage = document.getElementById('floorMapImage');
            if (!mapImage) {
                alert('Please switch to Map View first!');
                return;
            }

            console.clear();
            console.log('%c📍 COORDINATE PICKER ENABLED',
                'background: #5fcfda; color: white; font-size: 16px; padding: 10px; font-weight: bold;');
            console.log('%cClick anywhere on the map to get coordinates', 'font-size: 14px; color: #666;');
            console.log('Image Natural Size:', mapImage.naturalWidth, 'x', mapImage.naturalHeight);
            console.log('Image Display Size:', mapImage.width, 'x', mapImage.height);

            mapImage.style.cursor = 'crosshair';

            if (mapImage._coordinateListener) {
                mapImage.removeEventListener('click', mapImage._coordinateListener);
            }

            const clickHandler = function(e) {
                const rect = this.getBoundingClientRect();
                const clickX = e.clientX - rect.left;
                const clickY = e.clientY - rect.top;
                const scaleX = this.naturalWidth / this.width;
                const scaleY = this.naturalHeight / this.height;
                const originalX = Math.round(clickX * scaleX);
                const originalY = Math.round(clickY * scaleY);

                console.log('%c✓ COORDINATES', 'background: #2ecc71; color: white; padding: 8px; font-weight: bold;');
                console.log(`mapCoords: { x: ${originalX}, y: ${originalY} },`);
                console.log(`mapOriginalSize: { width: ${this.naturalWidth}, height: ${this.naturalHeight} }`);

                const marker = document.createElement('div');
                marker.style.cssText = `
                    position: absolute; left: ${clickX}px; top: ${clickY}px; width: 12px; height: 12px;
                    background: #ff4757; border: 3px solid white; border-radius: 50%;
                    transform: translate(-50%, -50%); pointer-events: none; z-index: 9999;
                    box-shadow: 0 0 0 0 rgba(255, 71, 87, 1); animation: pulse 1.5s infinite;
                `;

                const wrapper = this.parentElement;
                wrapper.style.position = 'relative';
                wrapper.appendChild(marker);
                setTimeout(() => marker.remove(), 3000);
            };

            mapImage._coordinateListener = clickHandler;
            mapImage.addEventListener('click', clickHandler);

            if (!document.getElementById('pulseAnimation')) {
                const style = document.createElement('style');
                style.id = 'pulseAnimation';
                style.textContent = `
                    @keyframes pulse {
                        0% { box-shadow: 0 0 0 0 rgba(255, 71, 87, 0.7); }
                        70% { box-shadow: 0 0 0 20px rgba(255, 71, 87, 0); }
                        100% { box-shadow: 0 0 0 0 rgba(255, 71, 87, 0); }
                    }
                `;
                document.head.appendChild(style);
            }

            showToastr('Coordinate Picker', 'Click on map to get coordinates. Check console!', 4000);
        }
    </script>
@endpush
