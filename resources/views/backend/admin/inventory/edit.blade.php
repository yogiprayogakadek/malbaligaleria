@extends('templates.backend.master')

@section('page-title', 'Edit Inventory Asset')
@section('page-link', route('admin.inventory.edit', $item->id))

@section('content')
    <div class="row mb-4 align-items-center">
        <div class="col">
            <h4 class="mb-0 text-dark fw-bold">Edit Asset: {{ $item->name }}</h4>
            <p class="text-muted mb-0">Modify details of an asset in the inventory system</p>
        </div>
        <div class="col-auto">
            <a href="{{ route('admin.inventory.index') }}" class="btn btn-outline-secondary hstack gap-2">
                <i class="ti ti-arrow-left fs-4"></i> Back to List
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin.inventory.update', $item->id) }}" method="POST" id="asset-form">
                        @csrf
                        @method('PUT')

                        <!-- General Information Section -->
                        <h5 class="fw-semibold text-primary mb-4 pb-2 border-bottom"><i class="ti ti-info-circle me-1"></i> General Details</h5>
                        
                        <div class="row g-3 mb-4">
                            <div class="col-md-12">
                                <label for="name" class="form-label fw-semibold">Asset Name <span class="text-danger">*</span></label>
                                <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" placeholder="e.g. CCTV Ch 1 - IT Room Door" value="{{ old('name', $item->name) }}" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="category_id" class="form-label fw-semibold">Category</label>
                                <select name="category_id" id="category_id" class="form-select @error('category_id') is-invalid @enderror">
                                    <option value="">Select Category</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" data-slug="{{ $category->slug }}" {{ old('category_id', $item->category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="parent_id" class="form-label fw-semibold">Parent Asset (Optional)</label>
                                <select name="parent_id" id="parent_id" class="form-select @error('parent_id') is-invalid @enderror">
                                    <option value="">None (Top-level Asset / Parent)</option>
                                    @foreach($parentItems as $parent)
                                        <option value="{{ $parent->id }}" {{ old('parent_id', $item->parent_id) == $parent->id ? 'selected' : '' }}>{{ $parent->name }} ({{ $parent->brand ?? 'No Brand' }})</option>
                                    @endforeach
                                </select>
                                <div class="form-text">e.g., Select a DVR if this is a CCTV Channel.</div>
                                @error('parent_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Technical Specs Section -->
                        <h5 class="fw-semibold text-primary mb-3 pb-2 border-bottom d-flex justify-content-between align-items-center">
                            <span><i class="ti ti-settings me-1"></i> Technical Specifications (JSON)</span>
                            <button type="button" class="btn btn-sm btn-outline-primary" id="btn-add-spec">
                                <i class="ti ti-plus"></i> Add Field
                            </button>
                        </h5>
                        
                        <div id="specs-container" class="mb-4">
                            <!-- Preload existing specs -->
                            @if(!empty($item->specs) && is_array($item->specs))
                                @foreach($item->specs as $key => $value)
                                    <div class="row g-2 mb-2 spec-row align-items-center">
                                        <div class="col-sm-5">
                                            <input type="text" name="specs_keys[]" class="form-control form-control-sm" placeholder="Property Key" value="{{ $key }}" required>
                                        </div>
                                        <div class="col-sm-6">
                                            <input type="text" name="specs_values[]" class="form-control form-control-sm" placeholder="Value" value="{{ $value }}">
                                        </div>
                                        <div class="col-sm-1 text-center">
                                            <button type="button" class="btn btn-sm btn-danger btn-remove-spec"><i class="ti ti-trash"></i></button>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>

                        <!-- Hardware / Inventory Details -->
                        <h5 class="fw-semibold text-primary mb-4 pb-2 border-bottom"><i class="ti ti-package me-1"></i> Physical Details</h5>

                        <div class="row g-3 mb-4">
                            <div class="col-md-4">
                                <label for="brand" class="form-label fw-semibold">Brand</label>
                                <input type="text" name="brand" id="brand" class="form-control" placeholder="e.g. Hikvision" value="{{ old('brand', $item->brand) }}">
                            </div>
                            <div class="col-md-4">
                                <label for="model" class="form-label fw-semibold">Model / Type</label>
                                <input type="text" name="model" id="model" class="form-control" placeholder="e.g. DS-7216HQHI" value="{{ old('model', $item->model) }}">
                            </div>
                            <div class="col-md-4">
                                <label for="serial_number" class="form-label fw-semibold">Serial Number / Asset Tag</label>
                                <input type="text" name="serial_number" id="serial_number" class="form-control" placeholder="SN or barcode" value="{{ old('serial_number', $item->serial_number) }}">
                            </div>

                            <div class="col-md-6">
                                <label for="location" class="form-label fw-semibold">Physical Location</label>
                                <input type="text" name="location" id="location" class="form-control" placeholder="e.g. Ruang IT" value="{{ old('location', $item->location) }}">
                            </div>
                            <div class="col-md-3">
                                <label for="quantity" class="form-label fw-semibold">Quantity</label>
                                <input type="number" name="quantity" id="quantity" class="form-control @error('quantity') is-invalid @enderror" min="1" value="{{ old('quantity', $item->quantity) }}" required>
                                @error('quantity')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-3">
                                <label for="status" class="form-label fw-semibold">Status</label>
                                <select name="status" id="status" class="form-select" required>
                                    <option value="active" {{ old('status', $item->status) == 'active' ? 'selected' : '' }}>Active / In Use</option>
                                    <option value="maintenance" {{ old('status', $item->status) == 'maintenance' ? 'selected' : '' }}>Maintenance</option>
                                    <option value="broken" {{ old('status', $item->status) == 'broken' ? 'selected' : '' }}>Broken</option>
                                    <option value="stored" {{ old('status', $item->status) == 'stored' ? 'selected' : '' }}>Stored / Backup</option>
                                </select>
                            </div>
                        </div>

                        <!-- Notes Section -->
                        <div class="mb-4">
                            <label for="notes" class="form-label fw-semibold">Notes / Remarks</label>
                            <textarea name="notes" id="notes" class="form-control" rows="4" placeholder="Enter details...">{{ old('notes', $item->notes) }}</textarea>
                        </div>

                        <div class="d-flex justify-content-end gap-2">
                            <button type="submit" class="btn btn-primary px-4 hstack gap-2">
                                <i class="ti ti-device-floppy"></i> Save Changes
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Sidebar Hints -->
        <div class="col-lg-4">
            <div class="card bg-light-primary text-primary-subtle border-0">
                <div class="card-body">
                    <h5 class="fw-semibold text-primary mb-3"><i class="ti ti-bulb fs-5 me-1"></i> Asset Hierarchy</h5>
                    <p class="text-dark small mb-3">
                        Use **Parent Asset** to cluster child elements under a master device.
                    </p>
                    <ul class="text-dark small ps-3 mb-0">
                        <li class="mb-2">**DVR/NVR** -> Parent of multiple **CCTV Channels**.</li>
                        <li class="mb-2">**Server Rack** -> Parent of Switches, UPS, and Servers.</li>
                        <li>**PC Host** -> Parent of Monitors or specific critical hardware items.</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        $(document).ready(function() {
            // Function to add a spec row
            function addSpecRow(key = '', value = '') {
                var rowHtml = `
                    <div class="row g-2 mb-2 spec-row align-items-center animate__animated animate__fadeIn">
                        <div class="col-sm-5">
                            <input type="text" name="specs_keys[]" class="form-control form-control-sm" placeholder="Property Key" value="${key}" required>
                        </div>
                        <div class="col-sm-6">
                            <input type="text" name="specs_values[]" class="form-control form-control-sm" placeholder="Value" value="${value}">
                        </div>
                        <div class="col-sm-1 text-center">
                            <button type="button" class="btn btn-sm btn-danger btn-remove-spec"><i class="ti ti-trash"></i></button>
                        </div>
                    </div>
                `;
                $('#specs-container').append(rowHtml);
            }

            // Remove spec row
            $(document).on('click', '.btn-remove-spec', function() {
                $(this).closest('.spec-row').remove();
            });

            // Add button click
            $('#btn-add-spec').on('click', function() {
                addSpecRow();
            });

            // Auto-preset fields based on Category
            $('#category_id').on('change', function() {
                var option = $(this).find('option:selected');
                var slug = option.data('slug') || '';
                
                // Only suggest if the container is empty
                if ($('#specs-container .spec-row').length === 0) {
                    if (slug.includes('cctv')) {
                        addSpecRow('Channel Number', '');
                        addSpecRow('DVR IP Address', '');
                        addSpecRow('Resolution', '1080p');
                        addSpecRow('Coverage Area', '');
                    } else if (slug.includes('computer') || slug.includes('pc') || slug.includes('laptop')) {
                        addSpecRow('CPU', '');
                        addSpecRow('RAM', '8 GB');
                        addSpecRow('Storage', '256 GB SSD');
                        addSpecRow('OS', 'Windows 11');
                        addSpecRow('IP Address', '');
                        addSpecRow('MAC Address', '');
                    } else {
                        addSpecRow('Properties', '');
                    }
                }
            });

            // Initialize a generic spec row if none exist
            if ($('#specs-container .spec-row').length === 0) {
                addSpecRow('Properties', '');
            }
        });
    </script>
@endpush
