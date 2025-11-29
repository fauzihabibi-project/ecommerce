<div class="container py-5"
    x-data="{
        theme: localStorage.getItem('theme') || 'light',
        toggle() {
            this.theme = this.theme === 'light' ? 'dark' : 'light';
            localStorage.setItem('theme', this.theme);
            document.documentElement.setAttribute('data-theme', this.theme);
        },
        init() {
            document.documentElement.setAttribute('data-theme', this.theme);
        }
    }"
    x-init="init()">
    <div class="row justify-content-center g-4">

        <!-- Kolom Kiri: Profil -->
        <div class="col-md-5 card mb-4 mb-md-0 border-0">
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

                <h4 class="fw-bold mb-1 text-uppercase">{{ $user->name }}</h4>
                <small class="text-success text-capitalize d-block mb-3">
                    {{ $user->username ?? 'username' }}
                </small>

                <hr>

                <!-- Dark Mode Toggle -->
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <small class="text-uppercase fw-semibold">Dark Mode</small>

                    <button @click="toggle()" class="btn btn-outline-secondary rounded-pill px-3">
                        <span x-show="theme === 'light'">🌙</span>
                        <span x-show="theme === 'dark'">☀️</span>
                    </button>
                </div>


                <hr>

                <div class="text-start">
                    <h6 class="fw-bold mb-3">ACCOUNT INFORMATION</h6>
                    <div class="mb-1 d-flex">
                        <strong style="width: 100px;">Email</strong>
                        <span>: {{ $user->email }}</span>
                    </div>

                    <div class="mb-1 d-flex">
                        <strong style="width: 100px;">Phone</strong>
                        <span>: {{ $user->phone ?? '-' }}</span>
                    </div>

                    <div class="mb-1 d-flex">
                        <strong style="width: 100px;">Role</strong>
                        <span>: {{ ucfirst($user->role) }}</span>
                    </div>

                    <div class="mb-1 d-flex">
                        <strong style="width: 100px;">Status</strong>
                        : <span class="badge bg-success">Active</span>
                    </div>

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
        <div class="col-md-5 card mb-4 border-0 ms-md-4">
            <div class="p-4 rounded">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="fw-bold mb-0">ADDRESS LIST</h5>
                    <a href="{{ route('add.address') }}"
                        wire:navigate
                        class="btn btn-primary btn-sm p-2 fw-semibold rounded-pill shadow-sm">
                        + Add Address
                    </a>
                </div>

                @if ($addresses->isEmpty())
                <div class="alert text-muted text-center mb-0">
                    No addresses saved yet.
                </div>
                @else
                <div class="list-group list-group-flush">
                    @foreach ($addresses as $index => $address)
                    <div class="card list-group-item border rounded mb-3 p-3">
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
                                <button
                                    wire:click="$dispatch('confirm-delete', { id: {{ $address->id }} })"
                                    class="btn btn-sm btn-outline-danger rounded-pill d-flex align-items-center justify-content-center"
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
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    document.addEventListener('livewire:initialized', () => {
        Livewire.on('confirm-delete', data => {

            Swal.fire({
                title: 'Delete Address?',
                text: "This address will be permanently deleted.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.dispatch('deleteAddress', {
                        id: data.id
                    });
                }
            });

        });
    });
</script>
@endpush