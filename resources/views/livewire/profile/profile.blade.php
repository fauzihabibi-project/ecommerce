<div class="container py-5">
    <div class="row justify-content-center g-4">

        <!-- Kolom Kiri: Profil -->
        <div class="col-md-4 card mb-4 mb-md-0 border-0">
            <div class="p-4 rounded text-center">
                @if ($user->foto)
                <img src="{{ asset('storage/' . $user->foto) }}"
                    alt="{{ $user->name }}"
                    class="rounded-circle mb-3 shadow-sm"
                    width="150"
                    height="150">
                @else
                <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=random"
                    alt="{{ $user->name }}"
                    class="rounded-circle mb-3 shadow-sm"
                    width="150"
                    height="150">
                @endif

                <h4 class="fw-bold mb-1" >{{ $user->name }}</h4>
                <small class="text-success text-capitalize d-block mb-3">
                    {{ $user->role ?? 'user' }}
                </small>

                <hr>

                <div class="text-start">
                    <h6 class="fw-bold mb-3">Informasi Akun</h6>
                    <p class="mb-1"><strong>Email:</strong> {{ $user->email }}</p>
                    <p class="mb-1"><strong>Telepon:</strong> {{ $user->phone ?? '-' }}</p>
                    <p class="mb-1"><strong>Role:</strong> {{ ucfirst($user->role) }}</p>
                    <p class="mb-0">
                        <strong>Status:</strong>
                        <span class="badge bg-success">Aktif</span>
                    </p>
                </div>

                <hr>

                <a href="{{ route('edit.profile') }}"
                    wire:navigate
                    class="btn btn-primary btn-sm p-2 w-100 fw-semibold rounded-pill shadow-sm">
                    Edit Profil
                </a>
            </div>
        </div>

        <!-- Kolom Kanan: Daftar Alamat -->
        <div class="col-md-6 card mb-4 border-0 ms-md-4">
            <div class="p-4 rounded">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="fw-bold mb-0">Daftar Alamat</h5>
                    <a href="{{ route('add.address') }}"
                        wire:navigate
                        class="btn btn-primary btn-sm p-2 fw-semibold rounded-pill shadow-sm">
                        + Tambah Alamat
                    </a>
                </div>

                @if ($addresses->isEmpty())
                <div class="alert text-muted text-center mb-0">
                    Belum ada alamat yang disimpan.
                </div>
                @else
                <div class="list-group list-group-flush">
                    @foreach ($addresses as $index => $address)
                    <div class="list-group-item border rounded mb-3 p-3">
                        <div class="d-flex justify-content-between align-items-start">
                            <div class="me-3">
                                <div class="fw-bold text-capitalize">{{ $address->recipient_name }}</div>
                                <div class="text-muted small">({{ $address->recipient_phone }})</div>
                                <div class="mt-1">
                                    {{ $address->address_detail }},
                                    {{ $address->city->name ?? '-' }},
                                    {{ $address->province->name ?? '-' }},
                                    {{ $address->postal_code }}
                                </div>
                                <div class="text-muted small mt-1">
                                    {{ $address->notes ?? '-' }}
                                </div>
                                @if ($address->is_default)
                                <span class="badge bg-success rounded-pill mt-2">Utama</span>
                                @endif
                            </div>
                            <div class="d-flex flex-column align-items-end gap-2">
                                <a href="{{ route('edit.address', $address->id) }}"
                                    wire:navigate
                                    class="btn btn-sm btn-outline-secondary rounded-pill d-flex align-items-center justify-content-center"
                                    title="Edit">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <button wire:click="delete({{ $address->id }})"
                                    class="btn btn-sm btn-outline-danger rounded-pill d-flex align-items-center justify-content-center"
                                    onclick="return confirm('Hapus Alamat ini?')"
                                    title="Hapus">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                @endif
            </div>
        </div>
    </div>
</div>