@extends('templates.backend.master')

@section('page-title', 'Create Setting')
@section('page-link', route('admin.setting.index'))

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.setting.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Pages</label>
                    <select name="pages" id="pages" class="form-select pages">
                        <option value="">Select Page</option>
                        @foreach ($availablePages as $key => $value)
                            <option value="{{ $key }}">{{ ucwords($key) }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Name (Key)</label>
                    <input type="text" name="name" class="form-control"
                        placeholder="e.g. Nama global custom configuration" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <textarea name="description" class="form-control" rows="3" placeholder="Explain what this setting does..."
                        required></textarea>
                </div>

                <div class="mb-3">
                    <div class="mb-3">
                        <div id="payload-container">
                            <div class="row mb-2 payload-row">
                                {{-- render --}}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="is_active" name="is_active" value="1">
                    <label class="form-check-label" for="is_active">Set as Active Setting</label>
                    <div class="form-text">Checking this will deactivate all other settings.</div>
                </div>

                <button type="submit" class="btn btn-primary" id="btn-save">Save Setting</button>
            </form>
        </div>
    </div>
@endsection

@push('script')
    <script>
        $(document).ready(function() {
            var availableKeys = @json($availablePages);

            $('#pages').change(function() {
                var selected = $('#pages').find(':selected').val();

                var input = '';

                if (selected == '') {
                    $('.payload-row').empty();
                    return false;
                }

                Object.keys(availableKeys[selected]).forEach(function(key) {
                    input += `<div class="mb-3">
                                <label class="form-label">${key.replace(/_/g, ' ').replace(/\b\w/g, l => l.toUpperCase())}</label>
                                <input type="${availableKeys[selected][key]}" class="form-control" name="${key}">
                            </div>`;
                });

                var newRow = `
                    <div class="col-md-12">
                        ${input}
                    </div>
                `;

                $('.payload-row').empty()
                $('.payload-row').append(newRow);
            });

        });
    </script>
@endpush
