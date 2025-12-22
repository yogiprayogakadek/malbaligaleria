@extends('templates.backend.master')

@section('page-title', 'Edit Tenant Photo - ' . $tenantPhoto->tenant->name)
@section('page-link', route('admin.tenant.photo.edit', $tenantPhoto->id))

@push('css')
    <link rel="stylesheet" href="{{ asset('assets/backend/css/select2.css') }}">
    <link href="https://unpkg.com/filepond/dist/filepond.css" rel="stylesheet">
    <link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css" rel="stylesheet">
@endpush

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin.tenant.photo.update', $tenantPhoto->tenant_id) }}" method="POST"
                        enctype="multipart/form-data" id="form">
                        @method('PUT')
                        @csrf

                        {{-- Primary Image --}}
                        <div class="mb-4 row align-items-center">
                            <div class="row">
                                <div class="col-sm-8">
                                    <label for="path" class="form-label col-sm-3 col-form-label">Primary Display
                                        Image</label>
                                    <div class="col-sm-12">
                                        <input type="file" class="form-control @error('path') is-invalid @enderror"
                                            id="path" name="path" placeholder="Enter image path"
                                            value="{{ old('path') }}">
                                        <small>Leave blank if you do not want to change the current image.</small>
                                        @error('path')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <label for="caption" class="form-label col-sm-3 col-form-label">Caption</label>
                                    <input type="text" class="form-control @error('caption') is-invalid @enderror"
                                        id="caption" name="caption" placeholder="Enter image caption"
                                        value="{{ $tenantPhoto->caption }}">
                                    @error('caption')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <hr>

                        {{-- Album Image --}}
                        <div class="mb-4 row align-items-center">
                            <div class="row">
                                <div class="col-sm-12">
                                    <label for="album"
                                        class="form-label col-sm-3 col-form-label @error('album') is-invalid @enderror">Tenant
                                        Album</label>
                                    <div class="fallback">
                                        <input name="album[]" type="file" multiple class="album filepond form-control"
                                            id="album" data-allow-reorder="true" data-max-files="5"
                                            data-existing='@json($album ?? [])' />
                                    </div>
                                    @error('album')
                                        <div class="text-danger small mt-2">{{ $message }}</div>
                                    @enderror
                                    @if ($errors->has('album.*'))
                                        <div class="text-danger small mt-2">
                                            Some files do not meet the requirements (check size or format).
                                        </div>
                                    @endif
                                </div>
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
    <script src="{{ asset('assets/backend/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('assets/backend/js/select2.min.js') }}"></script>

    <script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js"></script>
    <script src="https://unpkg.com/filepond/dist/filepond.js"></script>

    <script>
        $("#tenantId").select2({
            placeholder: "Select a tenant",
            allowClear: true,
        });

        FilePond.registerPlugin(FilePondPluginImagePreview);
        const inputElements = document.querySelectorAll('.album');
        inputElements.forEach(inputElement => {
            const existingFiles = JSON.parse(inputElement.dataset.existing || '[]');

            FilePond.create(inputElement, {
                allowMultiple: true,
                allowImagePreview: true,
                imagePreviewHeight: 170,
                storeAsFile: true,
                labelIdle: 'Drag or <span class="filepond--label-action">Browse</span> your photo',

                // load old file
                files: existingFiles.map(file => ({
                    source: file.path,
                    option: {
                        type: 'local'
                    }
                })),

                server: {
                    load: (source, load, error, progress, abort, headers) => {
                        fetch(source)
                            .then(res => res.blob())
                            .then(load)
                            .catch(error);
                    }
                }
            });
        });
    </script>
@endpush
