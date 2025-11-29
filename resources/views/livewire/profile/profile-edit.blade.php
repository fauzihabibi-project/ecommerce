<div class="container py-12">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="p-4 rounded shadow-sm">

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
                        <label class="form-label">Name</label>
                        <input type="text" wire:model="name" class="form-control" placeholder="Enter Name">
                        @error('name') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <!-- Username -->
                    <div class="mb-3">
                        <label class="form-label">Username</label>
                        <input type="text" wire:model="username" class="form-control" placeholder="Enter Username">
                        @error('username') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <!-- Email -->
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" wire:model="email" class="form-control" placeholder="Enter Email" readonly>
                        @error('email') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <!-- Phone Number -->
                    <div class="mb-3">
                        <label class="form-label">Phone</label>
                        <input type="text" wire:model="phone" class="form-control" placeholder="Enter Phone Number">
                        @error('phone') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <!-- Password -->
                    <div class="mb-3">
                        <label class="form-label">New Password (optional)</label>
                        <input type="password" wire:model="password" class="form-control" placeholder="Fill if you want to change the password">
                        @error('password') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Confirm New Password (optional)</label>
                        <input type="password" wire:model="password_confirmation" class="form-control" placeholder="Fill if you want to change the password">
                        @error('password_confirmation') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <!-- Button -->
                    <div class="d-flex justify-content-between align-items-center mt-4">
                        <a href="{{ route('profile') }}" wire:navigate class="btn btn-outline-secondary rounded-pill">
                            Cancel
                        </a>
                        <button type="submit" class="btn btn-primary rounded-pill">
                            Save Changes
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
