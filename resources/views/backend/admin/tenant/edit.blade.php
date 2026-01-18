@extends('templates.backend.master')

@section('page-title', 'Update Tenant - ' . $tenant->name)
@section('page-link', route('admin.tenant.create'))

@push('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
@endpush

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin.tenant.update', $tenant->uuid) }}" method="POST"
                        enctype="multipart/form-data" id="form">
                        @method('PUT')
                        @csrf

                        {{-- Tenant Category --}}
                        <div class="mb-4 row align-items-center">
                            <label for="category" class="form-label col-sm-3 col-form-label">Category</label>
                            <div class="col-sm-12">
                                <select name="category_id" id="categoryId"
                                    class="form-control @error('category_id') is-invalid @enderror">
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}"
                                            {{ $tenant->category_id == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- Tenant Type --}}
                        <div class="mb-4 row align-items-center">
                            <label for="type" class="form-label col-sm-3 col-form-label">Type</label>
                            <div class="col-sm-12">
                                <select name="type" id="type"
                                    class="form-control @error('type') is-invalid @enderror">
                                    <option value="tenant" {{ $tenant->type == 'tenant' ? 'selected' : '' }}>
                                        Tenant
                                    </option>
                                    <option value="island" {{ $tenant->type == 'island' ? 'selected' : '' }}>
                                        Island
                                    </option>
                                </select>
                                @error('type')
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
                                    value="{{ $tenant->name }}">
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
                                    value="{{ $tenant->phone }}">
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
                                    value="{{ $tenant->email }}">
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
                                        <div id="mapContainer" style="position: relative;">
                                            <img src="{{ asset('assets/images/floors/1st_floor.png') }}" alt="1st floor"
                                                srcset="{{ asset('assets/images/floors/1st_floor.png') }}" width="100%"
                                                class="map-image" id="floorMapImage" style="cursor: crosshair;">
                                        </div>
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
                                        name="floor" id="floor" value="{{ $tenant->map_coords['floor'] ?? '' }}"
                                        placeholder="Between 1 & 2">
                                    @error('floor')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-sm-3">
                                    <label for="unit" class="form-label col-sm-3 col-form-label">Unit</label>
                                    <input type="text" class="form-control @error('unit') is-invalid @enderror"
                                        name="unit" id="unit" value="{{ $tenant->map_coords['unit'] ?? '' }}"
                                        placeholder="Enter unit tenant location">
                                    @error('unit')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-sm-3">
                                    <label for="positionX" class="form-label col-sm-3 col-form-label">Pos. X</label>
                                    <input type="number" class="form-control @error('position_x') is-invalid @enderror"
                                        name="position_x" id="positionX" value="{{ $tenant->map_coords['x'] ?? '' }}"
                                        placeholder="The field will be automatically filled (in)">
                                    @error('position_x')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-sm-3">
                                    <label for="positionY" class="form-label col-sm-3 col-form-label">Pos. Y</label>
                                    <input type="number" class="form-control @error('position_y') is-invalid @enderror"
                                        name="position_y" id="positionY" value="{{ $tenant->map_coords['y'] ?? '' }}"
                                        placeholder="The field will be automatically filled (in)">
                                    @error('position_y')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <input type="hidden" name="map_original_width" id="map_original_width"
                                        value="{{ $tenant->map_original_size['width'] ?? '' }}">
                                    <input type="hidden" name="map_original_height" id="map_original_height"
                                        value="{{ $tenant->map_original_size['height'] ?? '' }}">
                                </div>
                            </div>
                        </div>
                        <div class="mb-4 row align-items-center">
                            <div class="col-sm-2">
                                <button class="btn btn-info btn-map" type="button" style="width: 100%"
                                    data-bs-toggle="modal" data-bs-target="#modalMap">
                                    <i class="fa fa-map-pin"></i> Open Map
                                </button>
                            </div>
                        </div>

                        {{-- Tenant Website --}}
                        <div class="mb-4 row align-items-center">
                            <label for="website" class="form-label col-sm-3 col-form-label">Website</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control @error('website') is-invalid @enderror"
                                    id="website" name="website" placeholder="Enter tenant website"
                                    value="{{ $tenant->website }}">
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
                                <small>Leave blank if you do not want change the current image.</small>
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
                                    value="{{ $tenant->launched_at }}">
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
                                    rows="10" id="description" name="description" placeholder="Enter tenant description">{{ $tenant->description }}</textarea>
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
            let image = floor == '1st' ? "{{ asset('assets/images/floors/1st_floor.png') }}" :
                "{{ asset('assets/images/floors/2nd_floor.png') }}";
            $('.map-image').attr({
                src: image,
                srcset: image
            });
            $('.btn-map-image').removeClass('btn-primary').addClass('btn-outline-primary');
            $(this).removeClass('btn-outline-primary').addClass('btn-primary');

            // Remove existing markers when switching floors
            $('.map-marker').remove();

            // Update floor input
            $('#floor').val(floor == '1st' ? 1 : 2);
        });

        // Coordinate Picker Logic
        const mapImage = document.getElementById('floorMapImage');
        const mapContainer = document.getElementById('mapContainer');

        mapImage.addEventListener('click', function(e) {
            const rect = this.getBoundingClientRect();
            const clickX = e.clientX - rect.left;
            const clickY = e.clientY - rect.top;

            // Calculate scale based on natural size vs displayed size
            const scaleX = this.naturalWidth / this.width;
            const scaleY = this.naturalHeight / this.height;

            const originalX = Math.round(clickX * scaleX);
            const originalY = Math.round(clickY * scaleY);

            // Calculate percentage for responsive marker
            const percentX = (clickX / this.width) * 100;
            const percentY = (clickY / this.height) * 100;

            // Update Input Fields
            $('#positionX').val(originalX);
            $('#positionY').val(originalY);

            // Update Original Size Fields
            $('#map_original_width').val(this.naturalWidth);
            $('#map_original_height').val(this.naturalHeight);

            // Visual Marker
            // Remove existing marker
            $('.map-marker').remove();

            // Create new marker
            const marker = document.createElement('div');
            marker.className = 'map-marker';
            marker.style.cssText = `
                position: absolute;
                left: ${percentX}%;
                top: ${percentY}%;
                width: 12px;
                height: 12px;
                background: #ff4757;
                border: 3px solid white;
                border-radius: 50%;
                transform: translate(-50%, -50%);
                pointer-events: none;
                z-index: 10;
                box-shadow: 0 0 0 4px rgba(255, 71, 87, 0.3);
            `;

            mapContainer.appendChild(marker);
        });
    </script>
@endpush
