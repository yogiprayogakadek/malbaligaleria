@extends('templates.backend.master')

@section('page-title', 'User Profile')
@section('page-link', route('admin.profile.index'))

@section('content')
    @if (session('success'))
        <script>
            toastr.success(
                "{{ session('success') }}",
                "Success", {
                    showMethod: "slideDown",
                    hideMethod: "slideUp",
                    timeOut: 2000
                }
            );
        </script>
    @endif

    <div class="row">
        <!-- Account Details -->
        <div class="col-lg-7 col-md-12">
            <div class="card">
                <div class="card-header bg-primary-subtle">
                    <h5 class="card-title fw-semibold mb-0">Account Information</h5>
                    <p class="mb-0 text-muted">Update your personal details and avatar.</p>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="d-flex align-items-center mb-4 gap-3">
                            <div class="position-relative">
                                <img src="{{ $user->avatar ?? 'https://bootstrapdemos.wrappixel.com/materialM/dist/assets/images/profile/user-1.jpg' }}"
                                    id="avatar-preview" class="rounded-circle border border-2 border-primary"
                                    width="100" height="100" style="object-fit: cover;" alt="avatar" />
                                <label for="avatar" class="position-absolute bottom-0 end-0 bg-primary text-white rounded-circle p-1 cursor-pointer"
                                    style="width: 32px; height: 32px; display: flex; align-items: center; justify-content: center;">
                                    <i class="ti ti-camera fs-4"></i>
                                </label>
                                <input type="file" id="avatar" name="avatar" class="d-none" accept="image/*">
                            </div>
                            <div>
                                <h6 class="fw-semibold mb-1">Profile Picture</h6>
                                <p class="text-muted mb-0 fs-2">JPG, GIF or PNG. Max size 2MB</p>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="name" class="form-label fw-semibold">Full Name</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                    id="name" name="name" value="{{ old('name', $user->name) }}" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="email" class="form-label fw-semibold">Email Address</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                    id="email" name="email" value="{{ old('email', $user->email) }}" required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="phone" class="form-label fw-semibold">Phone Number</label>
                                <input type="text" class="form-control @error('phone') is-invalid @enderror" 
                                    id="phone" name="phone" value="{{ old('phone', $user->phone) }}">
                                @error('phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mt-4">
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Security / Password -->
        <div class="col-lg-5 col-md-12">
            <div class="card">
                <div class="card-header bg-danger-subtle">
                    <h5 class="card-title fw-semibold mb-0">Security Settings</h5>
                    <p class="mb-0 text-muted">Keep your account secure.</p>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.profile.password.update') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="current_password" class="form-label fw-semibold">Current Password</label>
                            <input type="password" class="form-control @error('current_password') is-invalid @enderror" 
                                id="current_password" name="current_password" required>
                            @error('current_password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <hr>
                        <div class="mb-3">
                            <label for="password" class="form-label fw-semibold">New Password</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" 
                                id="password" name="password" required>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label fw-semibold">Confirm New Password</label>
                            <input type="password" class="form-control" 
                                id="password_confirmation" name="password_confirmation" required>
                        </div>

                        <div class="mt-4">
                            <button type="submit" class="btn btn-danger">Update Password</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        // Avatar preview
        document.getElementById('avatar').onchange = function (evt) {
            const [file] = this.files;
            if (file) {
                document.getElementById('avatar-preview').src = URL.createObjectURL(file);
            }
        }
    </script>
@endpush
