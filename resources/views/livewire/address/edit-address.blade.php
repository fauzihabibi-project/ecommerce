<div class="container py-12">
    <div class="row justify-content-center">
        <div class="col-md-12 p-4 rounded shadow-sm">
            <h4 class="mb-4 fw-bold">Edit Address</h4>

            <form wire:submit.prevent="update">
                <div class="mb-3">
                    <label>Recipient Name</label>
                    <input type="text" wire:model="recipient_name" class="form-control">
                    @error('recipient_name') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="mb-3">
                    <label>Phone Number</label>
                    <input type="text" wire:model="recipient_phone" class="form-control">
                    @error('recipient_phone') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label>Province</label>
                        <select wire:model.live="province_id" class="form-select">
                            <option value="">-- Select Province --</option>
                            @foreach ($provinces as $province)
                            <option value="{{ $province['id'] }}">{{ $province['name'] }}</option>
                            @endforeach
                        </select>
                        @error('province_id') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">City / Regency</label>
                        <div class="position-relative">

                            <!-- Spinner ketika loading -->
                            <div wire:loading wire:target="province_id"
                                class="spinner-border spinner-border-sm text-primary position-absolute top-50 end-0 translate-middle-y me-3"
                                role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>

                            <select class="form-select" wire:model="city_id" @disabled(empty($cities))>
                                <option value="">-- Select City / Regency --</option>
                                @foreach ($cities as $city)
                                <option value="{{ $city['id'] }}">{{ $city['name'] }}</option>
                                @endforeach
                            </select>
                        </div>

                        @error('city_id') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                </div>

                <div class="mb-3">
                    <label>Full Address</label>
                    <textarea wire:model="address_detail" class="form-control"></textarea>
                    @error('address_detail') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="mb-3">
                    <label>Postal Code</label>
                    <input type="text" wire:model="postal_code" class="form-control">
                    @error('postal_code') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="mb-3">
                    <label>Notes (Optional)</label>
                    <input type="text" wire:model="notes" class="form-control">
                </div>

                <div class="form-check mb-3">
                    <input class="form-check-input" type="checkbox" wire:model="is_default" id="is_default">
                    <label class="form-check-label" for="is_default">Set as default address</label>
                </div>

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

@push('scripts')
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
@endpush