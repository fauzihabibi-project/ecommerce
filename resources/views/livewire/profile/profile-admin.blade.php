<div class="container py-5">

    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body p-5">

                    <!-- Header -->
                    <div class="d-flex align-items-center mb-4">
                        <div class="me-3">
                            @if ($user->foto)
                            <img src="{{ asset('storage/' . $user->foto) }}"
                                alt="{{ $user->name }}"
                                class="rounded-circle mb-3 shadow-sm border border-3 border-primary"
                                width="130"
                                height="130">
                            @else
                            <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=random"
                                alt="{{ $user->name }}"
                                class="rounded-circle mb-3 shadow-sm border border-3 border-primary"
                                width="130"
                                height="130">
                            @endif
                        </div>
                        <div>
                            <h3 class="fw-bold mb-1">{{ $user->name }}</h3>
                            <p class="text-muted mb-0">Administrator</p>
                        </div>
                    </div>

                    <!-- Info Cards -->
                    <div class="row g-4">

                        <!-- Email -->
                        <div class="col-md-6">
                            <div class="p-4 border rounded-4 shadow-sm h-100 d-flex">
                                <div class="me-3 d-flex align-items-center justify-content-center bg-primary bg-opacity-10 p-3 rounded-circle">
                                    <i class="fas fa-envelope text-primary fs-4"></i>
                                </div>
                                <div>
                                    <h6 class="text-muted mb-1">Email</h6>
                                    <p class="fw-semibold mb-0">{{ $user->email }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Role -->
                        <div class="col-md-3">
                            <div class="p-4 border rounded-4 shadow-sm h-100 d-flex">
                                <div class="me-3 d-flex align-items-center justify-content-center bg-success bg-opacity-10 p-3 rounded-circle">
                                    <i class="fas fa-user-shield text-success fs-4"></i>
                                </div>
                                <div>
                                    <h6 class="text-muted mb-1">Role</h6>
                                    <p class="fw-semibold mb-0">{{ $user->role ?? 'Admin' }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Join Date -->
                        <div class="col-md-3">
                            <div class="p-4 border rounded-4 shadow-sm h-100 d-flex">
                                <div class="me-3 d-flex align-items-center justify-content-center bg-warning bg-opacity-10 p-3 rounded-circle">
                                    <i class="fas fa-calendar text-warning fs-4"></i>
                                </div>
                                <div>
                                    <h6 class="text-muted mb-1">Made On</h6>
                                    <p class="fw-semibold mb-0">
                                        {{ $user->created_at->format('d M Y') }}
                                    </p>
                                </div>
                            </div>
                        </div>

                    </div>

                    <!-- Action Buttons -->
                    <div class="d-flex justify-content-between align-items-center mt-3">

                        <!-- Tombol Kembali -->
                        <a href="{{ route('dashboard') }}" class="btn btn-secondary px-4 py-2 rounded-3">
                            <i class="fas fa-arrow-left me-1"></i> Back
                        </a>

                        <!-- Tombol Edit Profile -->
                        <a href="{{ route('profile.admin.edit') }}" class="btn btn-primary px-4 py-2 rounded-3">
                            <i class="fas fa-edit me-1"></i> Edit Profile
                        </a>

                    </div>
                </div>
            </div>

        </div>
    </div>
</div>