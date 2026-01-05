@extends('templates.backend.master')

@section('page-title', 'Create Setting')
@section('page-link', route('admin.setting.index'))

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.setting.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Name (Key)</label>
                    <input type="text" name="name" class="form-control" placeholder="e.g. Nama global custom configuration" required>
                </div>
                
                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <textarea name="description" class="form-control" rows="3" placeholder="Explain what this setting does..." required></textarea>
                </div>

                <div class="mb-3">
                <div class="mb-3">
                    <label class="form-label">Payload (Key-Value Pairs)</label>
                    <div id="payload-container">
                        <div class="row mb-2 payload-row">
                            <div class="col-md-5">
                                <select name="payload_key[]" class="form-select payload-key">
                                    <option value="">Select Key</option>
                                    @foreach($availableKeys as $key)
                                        <option value="{{ $key }}">{{ ucwords(str_replace('_', ' ', $key)) }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-5">
                                <input type="text" name="payload_value[]" class="form-control payload-value" placeholder="Value">
                            </div>
                            <div class="col-md-2">
                                <button type="button" class="btn btn-danger btn-remove-row" style="display: none;"><i class="ti ti-trash"></i></button>
                            </div>
                        </div>
                    </div>
                    <button type="button" class="btn btn-sm btn-success mt-2" id="btn-add-row"><i class="ti ti-plus"></i> Add Value</button>
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
            var allKeys = @json($availableKeys);

            function updateDeleteButtons() {
                var rows = $('.payload-row');
                if (rows.length === 1) {
                    rows.find('.btn-remove-row').hide();
                } else {
                    rows.find('.btn-remove-row').show();
                }
            }

            function updateKeyOptions() {
                var selectedKeys = [];
                $('.payload-key').each(function() {
                    var val = $(this).val();
                    if (val) selectedKeys.push(val);
                });

                $('.payload-key').each(function() {
                    var currentVal = $(this).val();
                    $(this).find('option').each(function() {
                        var optionVal = $(this).val();
                        if (optionVal && selectedKeys.includes(optionVal) && optionVal !== currentVal) {
                            $(this).prop('disabled', true);
                        } else {
                            $(this).prop('disabled', false);
                        }
                    });
                });
            }

            $('#btn-add-row').click(function() {
                var options = '<option value="">Select Key</option>';
                allKeys.forEach(function(key) {
                    options += `<option value="${key}">${key.replace(/_/g, ' ').replace(/\b\w/g, l => l.toUpperCase())}</option>`;
                });

                var newRow = `
                    <div class="row mb-2 payload-row">
                        <div class="col-md-5">
                            <select name="payload_key[]" class="form-select payload-key">
                                ${options}
                            </select>
                        </div>
                        <div class="col-md-5">
                            <input type="text" name="payload_value[]" class="form-control payload-value" placeholder="Value">
                        </div>
                        <div class="col-md-2">
                            <button type="button" class="btn btn-danger btn-remove-row"><i class="ti ti-trash"></i></button>
                        </div>
                    </div>
                `;
                $('#payload-container').append(newRow);
                updateDeleteButtons();
                updateKeyOptions();
            });

            $(document).on('click', '.btn-remove-row', function() {
                $(this).closest('.payload-row').remove();
                updateDeleteButtons();
                updateKeyOptions();
            });

            $(document).on('change', '.payload-key', function() {
                updateKeyOptions();
            });

            updateDeleteButtons();
            updateKeyOptions();
        });
    </script>
@endpush
