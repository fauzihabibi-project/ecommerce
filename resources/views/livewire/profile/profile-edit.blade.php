<div class="container py-12">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="bg-white p-4 rounded shadow-sm">
                <h5 class="fw-bold mb-4">Edit Profil</h5>

                <form wire:submit.prevent="updateProfile" enctype="multipart/form-data">
                    <!-- Foto Profil -->
                    <div class="text-center mb-4">
                        @if (Auth::user()->foto)
                            <img src="{{ asset('storage/' . Auth::user()->foto) }}" alt="Foto Profil" class="rounded-circle mb-2" width="100" height="100">
                        @else
                            <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}" alt="Foto Profil" class="rounded-circle mb-2" width="100" height="100">
                        @endif
                        <div class="mt-2">
                            <input type="file" wire:model="foto" class="form-control form-control-sm">
                            @error('foto') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                    </div>

                    <!-- Nama -->
                    <div class="mb-3">
                        <label class="form-label">Nama Lengkap</label>
                        <input type="text" wire:model="name" class="form-control" placeholder="Masukkan nama lengkap">
                        @error('name') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <!-- Email -->
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" wire:model="email" class="form-control" placeholder="Masukkan email">
                        @error('email') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <!-- Nomor Telepon -->
                    <div class="mb-3">
                        <label class="form-label">Nomor Telepon</label>
                        <input type="text" wire:model="phone" class="form-control" placeholder="Masukkan nomor telepon">
                        @error('phone') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <!-- Password -->
                    <div class="mb-3">
                        <label class="form-label">Password Baru (opsional)</label>
                        <input type="password" wire:model="password" class="form-control" placeholder="Isi jika ingin ubah password">
                        @error('password') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Konfirmasi Password Baru (opsional)</label>
                        <input type="password" wire:model="password" class="form-control" placeholder="Isi jika ingin ubah password">
                        @error('password') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <!-- Tombol -->
                    <div class="d-flex justify-content-between align-items-center mt-4">
                        <a href="{{ route('profile') }}" wire:navigate class="btn btn-outline-secondary rounded-pill">
                            Batal
                        </a>
                        <button type="submit" class="btn btn-primary rounded-pill">
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
