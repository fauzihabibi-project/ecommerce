<div class="container py-5">
    <div class="row g-4">

        <!-- KIRI: Produk di keranjang -->
        <div class="col-lg-8">
            @if ($cartItems->isEmpty())
                <div class="alert alert-warning text-center py-4 rounded-4 shadow-sm">
                    <i class="bi bi-cart-x fs-3 d-block mb-2"></i>
                    Keranjang Anda kosong.
                </div>
            @else
                @foreach ($cartItems as $index => $item)
                    <div class="card mb-3 border-0 shadow-sm rounded-4">
                        <div class="card-body d-flex flex-wrap align-items-center justify-content-between">
                            <!-- Kiri: Gambar & Detail Produk -->
                            <div class="d-flex align-items-center flex-grow-1">
                                <img src="{{ asset('storage/' . $item->product->image) }}"
                                    width="90"
                                    height="90"
                                    class="rounded me-3 object-fit-cover border"
                                    alt="{{ $item->product->name }}">

                                <div>
                                    <h6 class="fw-semibold mb-1 text-truncate" style="max-width: 200px;">
                                        {{ $item->product->name }}
                                    </h6>
                                    <small class="text-muted d-block text-truncate mb-1" style="max-width: 200px;">
                                        {{ $item->product->description }}
                                    </small>
                                    <small class="text-success fw-semibold">Stok: {{ $item->product->stock }}</small>
                                </div>
                            </div>

                            <!-- Kanan: Harga, Jumlah, Tombol -->
                            <div class="text-end mt-3 mt-lg-0">
                                <p class="fw-bold mb-1 text-primary">
                                    Rp{{ number_format($item->product->price, 0, ',', '.') }}
                                </p>

                                <div class="d-flex align-items-center justify-content-end">
                                    <button wire:click="decrement({{ $item->id }})" class="btn btn-sm btn-outline-secondary rounded-circle">−</button>
                                    <input type="text" readonly value="{{ $item->quantity }}"
                                        class="form-control form-control-sm text-center mx-2"
                                        style="width: 50px;">
                                    <button wire:click="increment({{ $item->id }})" class="btn btn-sm btn-outline-secondary rounded-circle">+</button>
                                </div>

                                <button wire:click="removeItem({{ $item->id }})"
                                    class="btn btn-link text-danger mt-2 small text-decoration-none">
                                    <i class="bi bi-trash me-1"></i> Hapus
                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>

        <!-- KANAN: Ringkasan harga -->
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body">
                    <h5 class="fw-bold mb-4">Rincian Pembayaran</h5>

                    <div class="d-flex justify-content-between mb-2">
                        <span>{{ $cartItems->count() }} Produk</span>
                        <span>Rp{{ number_format($total, 0, ',', '.') }}</span>
                    </div>

                    <hr>

                    <div class="d-flex justify-content-between fw-bold mb-3">
                        <span>Total Bayar</span>
                        <span class="text-primary">
                            Rp{{ number_format($total , 0, ',', '.') }}
                        </span>
                    </div>

                    <button wire:click="proceedToCheckout"
                        class="btn btn-primary w-100 py-2 fw-semibold rounded-pill shadow-sm">
                        <i class="bi bi-credit-card me-2"></i> Lanjut ke Pembayaran
                    </button>
                </div>
            </div>
        </div>

    </div>
</div>
