@extends('templates.backend.master')

@section('page-title', 'Edit Setting')
@section('page-link', route('admin.setting.index'))

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.setting.update', $setting->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label class="form-label">Name (Key)</label>
                    <input type="text" name="name" class="form-control" value="{{ $setting->name }}" required>
                </div>
                
                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <textarea name="description" class="form-control" rows="3" required>{{ $setting->description }}</textarea>
                </div>

                <div class="mb-3">
                <div class="mb-3">
                    <label class="form-label">Payload (Key-Value Pairs)</label>
                    <div id="payload-container">
                        @php
                            $payloadData = $setting->payload;
                            // Ensure payloadData is an array. If it's a string, try to decode or wrap it.
                            if (is_string($payloadData)) {
                                $decoded = json_decode($payloadData, true);
                                if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                                    $payloadData = $decoded;
                                } else {
                                    $payloadData = ['value' => $payloadData];
                                }
                            }
                            if (empty($payloadData) || !is_array($payloadData)) {
                                $payloadData = ['' => ''];
                            }
                        @endphp

                        @foreach($payloadData as $selectedKey => $value)
                            <div class="row mb-2 payload-row">
                                <div class="col-md-5">
                                    <select name="payload_key[]" class="form-select payload-key">
                                        <option value="">Select Key</option>
                                        @foreach($availableKeys as $avKey)
                                            <option value="{{ $avKey }}" {{ $selectedKey == $avKey ? 'selected' : '' }}>{{ ucwords(str_replace('_', ' ', $avKey)) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-5">
                                    <input type="text" name="payload_value[]" class="form-control payload-value" placeholder="Value" value="{{ is_array($value) ? json_encode($value) : $value }}">
                                </div>
                                <div class="col-md-2">
                                    <button type="button" class="btn btn-danger btn-remove-row"><i class="ti ti-trash"></i></button>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <button type="button" class="btn btn-sm btn-success mt-2" id="btn-add-row"><i class="ti ti-plus"></i> Add Value</button>
                </div>

                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="is_active" name="is_active" value="1" {{ $setting->is_active ? 'checked' : '' }}>
                    <label class="form-check-label" for="is_active">Set as Active Setting</label>
                    <div class="form-text">Checking this will deactivate all other settings. Unchecking it is only allowed if another setting is active.</div>
                </div>

                <button type="submit" class="btn btn-primary">Update Setting</button>
            </form>
        </div>
    </div>
@endsection

@push('script')
    @if (session('error'))
        <script>
            toastr.error("{{ session('error') }}", "Error", { timeOut: 3000 });
        </script>
    @endif
    @if ($errors->any())
        <script>
            @foreach ($errors->all() as $error)
                toastr.error("{{ $error }}", "Validation Error", { timeOut: 3000 });
            @endforeach
        </script>
    @endif
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
