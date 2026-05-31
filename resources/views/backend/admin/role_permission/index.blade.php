@extends('templates.backend.master')

@section('page-title', 'Role & Permission Management')
@section('page-link', route('admin.role-permission.index'))

@push('css')
    <style>
        .role-header {
            text-transform: capitalize;
            min-width: 120px;
            text-align: center;
        }
        .permission-checkbox {
            width: 22px;
            height: 22px;
            cursor: pointer;
            transition: transform 0.15s ease-in-out;
        }
        .permission-checkbox:hover {
            transform: scale(1.15);
        }
        .module-header {
            background-color: rgba(var(--bs-primary-rgb), 0.08) !important;
            font-weight: 700;
            color: var(--bs-primary);
            cursor: pointer;
            user-select: none;
        }
        .module-header:hover {
            background-color: rgba(var(--bs-primary-rgb), 0.12) !important;
        }
        .hover-row:hover {
            background-color: rgba(0, 0, 0, 0.02);
        }
        .select-column-btn {
            font-size: 0.75rem;
            padding: 2px 6px;
        }
        .toggle-chevron {
            transition: transform 0.2s ease-in-out;
        }
        .module-header.collapsed .toggle-chevron {
            transform: rotate(-90deg) !important;
        }
    </style>
@endpush

@section('content')
    <div class="row">
        <div class="col-12">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <div class="d-flex align-items-center">
                        <iconify-icon icon="solar:check-circle-line-duotone" class="fs-5 me-2"></iconify-icon>
                        <div>{{ session('success') }}</div>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="card shadow-sm border-0">
                <div class="card-header bg-white py-3 d-flex align-items-center justify-content-between">
                    <div>
                        <h5 class="mb-0 fw-bold">Role & Permission Matrix</h5>
                        <p class="text-muted small mb-0">Select which menus and operations are authorized for each backend user role.</p>
                    </div>
                    <div class="d-flex gap-2">
                        <button type="button" class="btn btn-sm btn-outline-secondary" id="btn-select-all">
                            Select All
                        </button>
                        <button type="button" class="btn btn-sm btn-outline-danger" id="btn-deselect-all">
                            Deselect All
                        </button>
                    </div>
                </div>
                <div class="card-body p-0">
                    <form action="{{ route('admin.role-permission.update') }}" method="POST" id="permissions-form">
                        @csrf

                        <div class="table-responsive">
                            <table class="table align-middle mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th style="width: 40%;">Menu / Permission Rule</th>
                                        @foreach($roles as $role)
                                            <th class="role-header text-center">
                                                <div class="fw-bold">{{ $role->name }}</div>
                                                <div class="mt-1">
                                                    <button type="button" class="btn btn-xs btn-outline-primary select-column-btn" data-role-id="{{ $role->id }}" data-action="select">
                                                        All
                                                    </button>
                                                    <button type="button" class="btn btn-xs btn-outline-secondary select-column-btn" data-role-id="{{ $role->id }}" data-action="deselect">
                                                        None
                                                    </button>
                                                </div>
                                            </th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($modules as $moduleName => $permissions)
                                        @php
                                            $moduleKey = str_replace(' ', '-', strtolower($moduleName));
                                        @endphp
                                        <tr class="module-header collapsed" data-module="{{ $moduleKey }}">
                                            <td colspan="{{ count($roles) + 1 }}" class="py-2 px-3 fw-bold">
                                                <div class="d-flex align-items-center justify-content-between">
                                                    <div class="d-flex align-items-center">
                                                        <iconify-icon icon="solar:folder-open-line-duotone" class="me-2 fs-5"></iconify-icon>
                                                        <span>{{ $moduleName }}</span>
                                                    </div>
                                                    <iconify-icon icon="solar:alt-arrow-down-line-duotone" class="toggle-chevron fs-5" style="transform: rotate(-90deg);"></iconify-icon>
                                                </div>
                                            </td>
                                        </tr>
                                        @foreach($permissions as $permissionName => $displayName)
                                            <tr class="hover-row module-row-{{ $moduleKey }}" style="display: none;">
                                                <td class="ps-4">
                                                    <div class="fw-semibold text-dark">{{ $displayName }}</div>
                                                    <div class="text-muted small" style="font-size: 0.7rem;">{{ $permissionName }}</div>
                                                </td>
                                                @foreach($roles as $role)
                                                    <td class="text-center">
                                                        <input type="checkbox" 
                                                               name="permissions[{{ $role->id }}][]" 
                                                               value="{{ $permissionName }}"
                                                               class="form-check-input permission-checkbox role-checkbox-{{ $role->id }}"
                                                               {{ $role->hasPermissionTo($permissionName) ? 'checked' : '' }}>
                                                    </td>
                                                @endforeach
                                            </tr>
                                        @endforeach
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="p-4 bg-light border-top d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary px-4 py-2">
                                <iconify-icon icon="solar:diskette-line-duotone" class="align-middle me-2 fs-5"></iconify-icon>
                                Save Changes
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            // Toggle module row visibility
            $('.module-header').on('click', function() {
                var moduleKey = $(this).data('module');
                var isCollapsed = $(this).hasClass('collapsed');
                
                $(this).toggleClass('collapsed');
                $('.module-row-' + moduleKey).toggle();
            });

            // Select All roles/permissions
            $('#btn-select-all').on('click', function() {
                $('.permission-checkbox').prop('checked', true);
            });

            // Deselect All
            $('#btn-deselect-all').on('click', function() {
                $('.permission-checkbox').prop('checked', false);
            });

            // Select / Deselect individual columns (Role wise)
            $('.select-column-btn').on('click', function(e) {
                e.stopPropagation();
                var roleId = $(this).data('role-id');
                var action = $(this).data('action');
                var checkState = (action === 'select');
                $('.role-checkbox-' + roleId).prop('checked', checkState);
            });
        });
    </script>
@endpush
