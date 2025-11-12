<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-12 p-4 rounded shadow-sm">
            <h4 class="fw-bold text-center text-success">Checkout Pesanan</h4>
            <p class="mt-1 mb-4 text-center text-muted">Silakan isi alamat pengiriman dan pilih kurir. dan pastikan pesanan sesuai sebelum di Checkout</p>

            <!-- Daftar Barang -->
            <div class="mb-4">
                <h6 class="fw-bold mb-3">Barang di Keranjang</h6>
                @foreach ($cartItems as $item)
                <div class="d-flex align-items-center border-bottom py-3">
                    <!-- Gambar Produk -->
                    <img
                        src="{{ asset('storage/' . $item->product->image) }}"
                        alt="{{ $item->product->name }}"
                        class="rounded me-3"
                        style="width: 70px; height: 70px; object-fit: cover;">

                    <!-- Detail Produk -->
                    <div class="flex-grow-1">
                        <strong>{{ $item->product->name }}</strong>
                        <p class="mb-0 text-muted small">
                            Jumlah: {{ $item->quantity }}
                        </p>
                        <p class="mb-0 text-muted small">
                            Harga: Rp {{ number_format($item->product->price, 0, ',', '.') }}
                        </p>
                    </div>

                    <!-- Subtotal -->
                    <span class="fw-semibold">
                        Rp {{ number_format($item->product->price * $item->quantity, 0, ',', '.') }}
                    </span>
                </div>
                @endforeach
            </div>

            <!-- Pilih Alamat -->
            <div class="mb-4">
                <label class="form-label fw-semibold">Pilih Alamat Pengiriman</label>
                <select wire:model.live="selectedAddress" class="form-select">
                    <option value="">-- Pilih Alamat --</option>
                    @foreach ($addresses as $address)
                        <option value="{{ $address->id }}">
                            {{ $address->recipient_name }} - {{ $address->city->name ?? '' }}
                        </option>
                    @endforeach
                </select>
                @error('selectedAddress') 
                    <small class="text-danger">{{ $message }}</small> 
                @enderror
            </div>

            <!-- Pilih Kurir -->
            <div class="mb-4">
                <label class="form-label fw-semibold">Pilih Kurir Pengiriman</label>
                <select wire:model="courier" class="form-select">
                    <option value="">-- Pilih Kurir --</option>
                    <option value="JNE">JNE</option>
                    <option value="J&T">J&T</option>
                    <option value="TIKI">TIKI</option>
                    <option value="POS Indonesia">POS Indonesia</option>
                    <option value="Manual">Manual (Ambil Sendiri)</option>
                </select>
                @error('courier') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <!-- Ringkasan Biaya -->
            <div class="border rounded p-3 mb-3">
                <h6 class="fw-bold mb-3">Ringkasan Pembayaran</h6>
                <div class="d-flex justify-content-between">
                    <span>Total Barang:</span>
                    <span>Rp {{ number_format($cartTotal, 0, ',', '.') }}</span>
                </div>
                <div class="d-flex justify-content-between">
                    <span>Ongkir:</span>
                    <span>Rp {{ number_format($shippingCost, 0, ',', '.') }}</span>
                </div>
                <hr>
                <div class="d-flex justify-content-between fw-bold text-success">
                    <span>Total Bayar:</span>
                    <span>Rp {{ number_format($cartTotal + $shippingCost, 0, ',', '.') }}</span>
                </div>
            </div>

            <!-- Tombol -->
            <div class="text-end">
                <button wire:click="placeOrder" class="btn btn-success px-4 fw-semibold rounded-pill shadow-sm">
                    <i class="bi bi-cart-check me-2"></i> Buat Pesanan
                </button>
            </div>
        </div>
    </div>

    {{-- Tambahkan script agar teks ongkir update realtime --}}
    <script>
        document.addEventListener("livewire:init", () => {
            Livewire.on("ongkir-diperbarui", () => {
                const ongkirText = document.getElementById("ongkirText");
                const totalBayarText = document.getElementById("totalBayarText");

                // animasi halus saat berubah
                ongkirText.classList.add("fade");
                totalBayarText.classList.add("fade");

                setTimeout(() => {
                    ongkirText.classList.remove("fade");
                    totalBayarText.classList.remove("fade");
                }, 500);
            });
        });
    </script>
</div>