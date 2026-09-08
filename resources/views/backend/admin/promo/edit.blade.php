@extends('templates.backend.master')

@section('page-title', 'Edit Promo - ' . $promo->name)
@section('page-link', route('admin.promo.edit', $promo->uuid))

@push('css')
    <link rel="stylesheet" href="{{ asset('assets/backend/css/select2.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
@endpush

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin.promo.update', $promo->uuid) }}" method="POST"
                        enctype="multipart/form-data" id="form">
                        @method('PUT')
                        @csrf

                        {{-- Tenant ID --}}
                        <div class="mb-4 row align-items-center">
                            <label for="tenant" class="form-label col-sm-3 col-form-label">Tenant</label>
                            <div class="col-sm-12">
                                <select name="tenant_id" id="tenantId"
                                    class="form-control @error('tenant_id') is-invalid @enderror">
                                    <option value="">Select tenant...</option>
                                    @foreach ($tenants as $tenant)
                                        <option value="{{ $tenant->id }}"
                                            {{ $promo->tenant_id == $tenant->id ? 'selected' : '' }}>
                                            {{ $tenant->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('tenant_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- Promo Name --}}
                        <div class="mb-4 row align-items-center">
                            <label for="name" class="form-label col-sm-3 col-form-label">Name</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    id="name" name="name" placeholder="Enter promo name"
                                    value="{{ $promo->name }}">
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- Promo Banner --}}
                        <div class="mb-4 row">
                            <label for="banner" class="form-label col-sm-3 col-form-label">Banner Image(s)</label>
                            <div class="col-sm-12">
                                @if(!empty($promo->banners) && count($promo->banners) > 0)
                                    <div class="mb-3">
                                        <label class="form-label fw-semibold">Current Banners:</label>
                                        <div class="d-flex flex-wrap gap-3" id="existingBannersContainer">
                                            @foreach($promo->banners as $index => $bPath)
                                                @php
                                                    $url = str_starts_with($bPath, 'http') ? $bPath : (Storage::disk('public')->exists($bPath) ? asset('storage/' . $bPath) : asset($bPath));
                                                @endphp
                                                <div class="existing-banner-item position-relative border rounded p-1" style="width: 110px; height: 110px;">
                                                    <img src="{{ $url }}" alt="Banner {{ $index + 1 }}" style="width: 100%; height: 100%; object-fit: cover; border-radius: 6px;">
                                                    <input type="hidden" name="retained_banners[]" value="{{ $bPath }}">
                                                    <button type="button" class="btn btn-danger btn-sm position-absolute top-0 end-0 m-1 remove-existing-banner" style="padding: 2px 6px; font-size: 11px; border-radius: 50%;" title="Remove this image">&times;</button>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif

                                <input type="file" class="form-control @error('banner') is-invalid @enderror @error('banner.*') is-invalid @enderror"
                                    id="banner" name="banner[]" multiple accept="image/*">
                                <small class="text-muted d-block mt-1">Select new images if you want to add or replace banners.</small>
                                @error('banner')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                                @error('banner.*')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                                <div id="bannerPreviewContainer" class="d-flex flex-wrap gap-2 mt-3"></div>
                            </div>
                        </div>

                        {{-- Compress Checkbox --}}
                        <div class="mb-4 row align-items-center">
                            <div class="col-sm-12">
                                <input type="hidden" name="compress_image_submitted" value="1">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" name="compress_image" id="compress_image" value="1" checked>
                                    <label class="form-check-label" for="compress_image">Compress image on upload</label>
                                </div>
                            </div>
                        </div>

                        {{-- Start date --}}
                        <div class="mb-4 row align-items-center">
                            <label for="start_date" class="form-label col-sm-3 col-form-label">Start date</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control @error('start_date') is-invalid @enderror"
                                    id="start_date" name="start_date" placeholder="Enter start date promo"
                                    value="{{ $promo->start_date }}">
                                @error('start_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- End date --}}
                        <div class="mb-4 row align-items-center">
                            <label for="end_date" class="form-label col-sm-3 col-form-label">End date</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control @error('end_date') is-invalid @enderror"
                                    id="end_date" name="end_date" placeholder="Enter end date promo"
                                    value="{{ $promo->end_date }}">
                                @error('end_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- Promo Description --}}
                        <div class="mb-4 row align-items-center">
                            <label for="description" class="form-label col-sm-3 col-form-label">Description</label>
                            <div class="col-sm-12">
                                <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror"
                                    rows="10" id="description" name="description" placeholder="Enter promo description">{{ $promo->description }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- Promo Status --}}
                        <div class="mb-4 row align-items-center">
                            <label for="is_active" class="form-label col-sm-3 col-form-label">Status</label>
                            <div class="col-sm-12">
                                <select name="is_active" id="is_active"
                                    class="form-control @error('is_active') is-invalid @enderror">
                                    <option value="1" {{ $promo->is_active == 1 ? 'selected' : '' }}>Active</option>
                                    <option value="0" {{ $promo->is_active == 0 ? 'selected' : '' }}>Not Active
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

@push('script')
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="{{ asset('assets/backend/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('assets/backend/js/select2.min.js') }}"></script>
    <script>
        flatpickr("#start_date, #end_date", {
            dateFormat: "Y-m-d",
            altInput: true,
            altFormat: "F j, Y",
        });

        $("#tenantId").select2({
            placeholder: "Select a tenant",
            allowClear: true,
        });

        // Remove existing banner item
        $(document).on('click', '.remove-existing-banner', function () {
            $(this).closest('.existing-banner-item').remove();
        });

        // Preview new banner files
        $('#banner').on('change', function(e) {
            const container = $('#bannerPreviewContainer');
            container.empty();
            const files = e.target.files;
            if (files && files.length > 0) {
                Array.from(files).forEach(file => {
                    const reader = new FileReader();
                    reader.onload = function(evt) {
                        const wrapper = $('<div>').css({
                            'position': 'relative',
                            'width': '110px',
                            'height': '110px',
                            'border': '2px dashed #4CAF50',
                            'border-radius': '8px',
                            'overflow': 'hidden'
                        });
                        const badge = $('<span>').text('NEW').css({
                            'position': 'absolute',
                            'top': '4px',
                            'left': '4px',
                            'background': '#4CAF50',
                            'color': '#fff',
                            'font-size': '10px',
                            'padding': '1px 5px',
                            'border-radius': '4px',
                            'font-weight': '600',
                            'z-index': 1
                        });
                        const img = $('<img>').attr('src', evt.target.result).css({
                            'width': '100%',
                            'height': '100%',
                            'object-fit': 'cover'
                        });
                        wrapper.append(img).append(badge);
                        container.append(wrapper);
                    }
                    reader.readAsDataURL(file);
                });
            }
        });
    </script>
@endpush
