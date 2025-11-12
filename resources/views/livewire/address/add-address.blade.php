<div class="card shadow-sm border-0 p-4 m-3">
    <div class="card-body">
        <h5 class="fw-bold mb-3">Tambah Alamat Baru</h5>

        @if (session()->has('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form wire:submit.prevent="save">
            <div class="row">
                {{-- Nama dan Telepon --}}
                <div class="col-md-6 mb-3" >
                    <label class="form-label">Nama Penerima</label>
                    <input type="text" class="form-control" wire:model="recipient_name">
                    @error('recipient_name') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Nomor Telepon</label>
                    <input type="text" class="form-control" wire:model="recipient_phone">
                    @error('recipient_phone') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                {{-- Provinsi --}}
                <div class="col-md-6 mb-3">
                    <label class="form-label">Provinsi</label>
                    <select class="form-select" wire:model.live="province_id">
                        <option value="">-- Pilih Provinsi --</option>
                        @foreach ($provinces as $province)
                            <option value="{{ $province['id'] }}">{{ $province['name'] }}</option>
                        @endforeach
                    </select>
                    @error('province_id') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                {{-- Kota --}}
                <div class="col-md-6 mb-3">
                    <label class="form-label">Kota / Kabupaten</label>
                    <div class="position-relative">
                        {{-- Spinner ketika loading --}}
                        <div wire:loading wire:target="province_id" class="spinner-border spinner-border-sm text-primary position-absolute top-50 end-0 translate-middle-y me-3" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>

                        <select class="form-select" wire:model="city_id" @disabled(empty($cities))>
                            <option value="">-- Pilih Kota / Kabupaten --</option>
                            @foreach ($cities as $city)
                                <option value="{{ $city['id'] }}">{{ $city['name'] }}</option>
                            @endforeach
                        </select>
                    </div>
                    @error('city_id') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                {{-- Alamat lengkap --}}
                <div class="col-12 mb-3">
                    <label class="form-label">Alamat Lengkap</label>
                    <textarea class="form-control" rows="3" wire:model="address_detail"></textarea>
                    @error('address_detail') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                {{-- Kode pos & Catatan --}}
                <div class="col-md-6 mb-3">
                    <label class="form-label">Kode Pos</label>
                    <input type="text" class="form-control" wire:model="postal_code">
                    @error('postal_code') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Catatan (opsional)</label>
                    <input type="text" class="form-control" wire:model="notes">
                </div>

                {{-- Checkbox --}}
                <div class="col-12 mb-3" >
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" wire:model="is_default" id="defaultCheck">
                        <label class="form-check-label" for="defaultCheck">
                            Jadikan sebagai alamat utama
                        </label>
                    </div>
                </div>

                {{-- Tombol --}}
                <div class="d-flex justify-content-between align-items-center mt-4">
                    <a href="{{ route('profile') }}" wire:navigate class="btn btn-outline-secondary rounded-pill">
                        Batal
                    </a>
                    <button type="submit" class="btn btn-primary rounded-pill">
                        Simpan Perubahan
                    </button>
                </div>
            </div>
        </form>
    </div>

    {{-- 🔥 Script tambahan agar animasi kota muncul halus --}}
    <script>
        document.addEventListener("livewire:init", () => {
            Livewire.on("kota-diperbarui", () => {
                const citySelect = document.querySelector('[wire\\:model="city_id"]');
                if (citySelect) {
                    citySelect.classList.add("fade");
                    setTimeout(() => citySelect.classList.remove("fade"), 500);
                }
            });
        });

        document.addEventListener("livewire:load", () => {
            if (AOS) AOS.init();

            Livewire.hook("morph.updated", () => {
                if (AOS) AOS.refreshHard();
            });
        });
    </script>
</div>
