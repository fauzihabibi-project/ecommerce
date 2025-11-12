<div class="container py-12">
    <div class="row justify-content-center">
        <div class="col-md-12 bg-white p-4 rounded shadow-sm">
            <h4 class="mb-4 fw-bold">Edit Alamat</h4>

            <form wire:submit.prevent="update">
                <div class="mb-3">
                    <label>Nama Penerima</label>
                    <input type="text" wire:model="recipient_name" class="form-control">
                    @error('recipient_name') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="mb-3">
                    <label>No. Telepon</label>
                    <input type="text" wire:model="recipient_phone" class="form-control">
                    @error('recipient_phone') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label>Provinsi</label>
                        <select wire:model="province_id" class="form-select">
                            <option value="">-- Pilih Provinsi --</option>
                            @foreach ($provinces as $province)
                            <option value="{{ $province['id'] }}">{{ $province['name'] }}</option>
                            @endforeach
                        </select>
                        @error('province_id') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Kota / Kabupaten</label>
                        <select wire:model="city_id" class="form-select" @disabled(empty($cities))>
                            <option value="">-- Pilih Kota / Kabupaten --</option>
                            @foreach ($cities as $city)
                            <option value="{{ $city['id'] }}">{{ $city['name'] }}</option>
                            @endforeach
                        </select>
                        @error('city_id') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label>Detail Alamat</label>
                    <textarea wire:model="address_detail" class="form-control"></textarea>
                    @error('address_detail') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="mb-3">
                    <label>Kode Pos</label>
                    <input type="text" wire:model="postal_code" class="form-control">
                    @error('postal_code') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="mb-3">
                    <label>Catatan (Opsional)</label>
                    <input type="text" wire:model="notes" class="form-control">
                </div>

                <div class="form-check mb-3">
                    <input class="form-check-input" type="checkbox" wire:model="is_default" id="is_default">
                    <label class="form-check-label" for="is_default">Jadikan Alamat Utama</label>
                </div>

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