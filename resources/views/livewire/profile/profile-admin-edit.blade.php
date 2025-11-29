<div class="container py-5">

    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card border-0 shadow-sm rounded-4">

                <div class="card-body p-4">

                    <!-- FOTO PREVIEW -->
                    <div class="text-center mb-4">
                        <img src="{{ $foto ? $foto->temporaryUrl() : (Auth::user()->foto
                                ? asset('storage/' . Auth::user()->foto)
                                : 'https://ui-avatars.com/api/?name='.Auth::user()->name.'&background=0D6EFD&color=fff&size=150') }}"
                             class="rounded-circle shadow-sm"
                             width="150">
                    </div>

                    <form wire:submit.prevent="updateProfile">

                        <!-- FOTO -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Profile Photo</label>
                            <input type="file" class="form-control" wire:model="foto">
                            @error('foto') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>

                        <!-- NAMA -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Full Name</label>
                            <input type="text" class="form-control" wire:model="name">
                            @error('name') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>

                        <!-- EMAIL -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Email</label>
                            <input type="email" class="form-control" wire:model="email">
                            @error('email') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>

                        <!-- PHONE -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Phone Number</label>
                            <input type="text" class="form-control" wire:model="phone">
                            @error('phone') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>

                        <!-- PASSWORD -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold">New Password</label>
                            <input type="password" class="form-control" wire:model="password">
                            <small class="text-muted">Leave blank if you do not want to change the password.</small>
                            <br>
                            @error('password') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>

                        <!-- BUTTON -->
                        <div class="text-end">
                            <a href="{{ route('profile.admin') }}" class="btn btn-secondary px-4">
                                Cancel
                            </a>

                            <button type="submit" class="btn btn-primary px-4 ms-2">
                                Save Changes
                            </button>
                        </div>

                    </form>
                </div>
            </div>

        </div>
    </div>

</div>