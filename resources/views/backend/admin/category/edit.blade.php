@extends('templates.backend.master')

@section('page-title', 'Update Category Tenant')
@section('page-link', route('admin.category.edit', $category->uuid))


@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin.category.update', $category->uuid) }}" method="POST" id="form">
                        @method('PUT')
                        @csrf

                        {{-- Category Name --}}
                        <div class="mb-4 row align-items-center">
                            <label for="name" class="form-label col-sm-3 col-form-label">Name</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    id="name" name="name" placeholder="Enter category name"
                                    value="{{ $category->name }}">
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- Color Zone --}}
                        <div class="mb-4 row align-items-center">
                            <label for="colorZone" class="form-label col-sm-3 col-form-label">Color Zone</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control @error('color_zone') is-invalid @enderror"
                                    id="colorZone" name="color_zone" placeholder="Enter color zone"
                                    value="{{ $category->color_zone }}">
                                @error('color_zone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- Category Status --}}
                        <div class="mb-4 row align-items-center">
                            <label for="is_active" class="form-label col-sm-3 col-form-label">Status</label>
                            <div class="col-sm-12">
                                <select name="is_active" id="is_active"
                                    class="form-control @error('is_active') is-invalid @enderror">
                                    <option value="1" {{ $category->is_active == 1 ? 'selected' : '' }}>Active</option>
                                    <option value="0" {{ $category->is_active == 0 ? 'selected' : '' }}>Inactive
                                    </option>
                                </select>
                                @error('is_active')
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

@section('additional-content')
    <!-- Modal -->
    <div class="modal fade" id="modalMap" tabindex="-1" aria-labelledby="bs-example-modal-lg" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header d-flex align-items-center">
                    <h4 class="modal-title" id="myLargeModalLabel">
                        Choose Color from Map
                    </h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row mb-4">
                        <div class="col-sm-6">
                            <button class="btn btn-primary btn-map-image" id="btnFirstFloor" type="button"
                                style="width: 100%" data-floor="1st">1st Floor</button>
                        </div>
                        <div class="col-sm-6">
                            <button class="btn btn-outline-primary btn-map-image" id="btnSecondFloor" type="button"
                                style="width: 100%" data-floor="2nd">2nd Floor</button>
                        </div>
                    </div>
                    <div class="alert alert-info">
                        <i class="ti ti-info-circle"></i> Click on any colored area of the map to pick that color
                    </div>
                    <div id="mapContainer" style="position: relative;">
                        <img src="{{ asset('assets/images/floors/1st_floor.png') }}" alt="1st floor"
                            srcset="{{ asset('assets/images/floors/1st_floor.png') }}" width="100%" class="map-image"
                            id="floorMapImage" style="cursor: crosshair;">
                        <canvas id="colorCanvas" style="display: none;"></canvas>
                    </div>
                    <div class="mt-3" id="colorPreview" style="display: none;">
                        <strong>Selected Color:</strong>
                        <div class="d-flex align-items-center gap-2 mt-2">
                            <div id="colorBox"
                                style="width: 50px; height: 50px; border: 2px solid #ddd; border-radius: 8px;"></div>
                            <span id="colorCode" style="font-family: monospace; font-size: 16px;"></span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn bg-danger-subtle text-danger waves-effect text-start"
                        data-bs-dismiss="modal">
                        Close
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        $(document).ready(function() {
            // Set initial color if exists
            const initialColor = $('#colorZone').val();
            if (initialColor) {
                $('#colorZone').css('background-color', initialColor);
                $('#colorZone').css('color', getContrastColor(initialColor));
            }

            // Open modal when clicking color zone input
            $('#colorZone').click(function() {
                $('#modalMap').modal('show');
            });

            // Floor switching logic
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
            });

            // Color extraction logic
            const mapImage = document.getElementById('floorMapImage');
            const canvas = document.getElementById('colorCanvas');
            const ctx = canvas.getContext('2d');

            mapImage.addEventListener('click', function(e) {
                const rect = this.getBoundingClientRect();
                const clickX = e.clientX - rect.left;
                const clickY = e.clientY - rect.top;

                // Set canvas size to match image natural size
                canvas.width = this.naturalWidth;
                canvas.height = this.naturalHeight;

                // Draw image to canvas
                ctx.drawImage(this, 0, 0);

                // Calculate coordinates on natural image
                const scaleX = this.naturalWidth / this.width;
                const scaleY = this.naturalHeight / this.height;
                const naturalX = Math.round(clickX * scaleX);
                const naturalY = Math.round(clickY * scaleY);

                // Get pixel color data
                const pixel = ctx.getImageData(naturalX, naturalY, 1, 1).data;

                // Convert RGB to HEX
                const hex = '#' + ((1 << 24) + (pixel[0] << 16) + (pixel[1] << 8) + pixel[2]).toString(16)
                    .slice(1).toUpperCase();

                // Update color zone input
                $('#colorZone').val(hex);

                // Show color preview
                $('#colorPreview').show();
                $('#colorBox').css('background-color', hex);
                $('#colorCode').text(hex);

                // Visual feedback
                $('#colorZone').css('background-color', hex);
                $('#colorZone').css('color', getContrastColor(hex));

                // Show success notification
                toastr.success('Color ' + hex + ' has been selected!', 'Success', {
                    closeButton: true,
                    progressBar: true,
                    timeOut: 3000
                });
            });

            // Helper function to get contrasting text color
            function getContrastColor(hexcolor) {
                // Convert hex to RGB
                const r = parseInt(hexcolor.substr(1, 2), 16);
                const g = parseInt(hexcolor.substr(3, 2), 16);
                const b = parseInt(hexcolor.substr(5, 2), 16);

                // Calculate luminance
                const luminance = (0.299 * r + 0.587 * g + 0.114 * b) / 255;

                // Return black or white based on luminance
                return luminance > 0.5 ? '#000000' : '#FFFFFF';
            }
        });
    </script>
@endpush
