<div class="container py-5">
    <h4 class="fw-bold text-center mb-4 text-success">
        Daftar Pesanan Saya
    </h4>

    @if($orders->isEmpty())
        <div class="text-center p-5 rounded shadow-sm">
            <i class="bi bi-box-seam display-4 text-secondary mb-3"></i>
            <p class="text-muted mb-0">Belum ada pesanan yang dibuat.</p>
        </div>
    @else
        @foreach($orders as $order)
            <div class="card mb-4 shadow-sm border-0">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <h6 class="fw-bold mb-0 text-success">Pesanan {{ $order->id }}</h6>
                        <span class="badge bg-warning text-dark">{{ $order->status }}</span>
                    </div>

                    <p class="mb-2 text-muted small">
                        Alamat: {{ $order->address->recipient_name ?? '-' }} -
                        {{ $order->address->city->name ?? '' }}
                    </p>

                    <!-- Daftar Produk -->
                    @foreach($order->items as $item)
                        <div class="d-flex align-items-center mb-2 border-bottom pb-2">
                            <img 
                                src="{{ asset('storage/' . ($item->product->image ?? 'default.jpg')) }}" 
                                alt="{{ $item->product->name }}" 
                                class="rounded me-3" 
                                style="width: 60px; height: 60px; object-fit: cover;"
                            >
                            <div class="flex-grow-1">
                                <strong>{{ $item->product->name }}</strong><br>
                                <small class="text-muted">Jumlah: {{ $item->quantity }}</small>
                            </div>
                            <span class="fw-semibold">
                                Rp {{ number_format($item->subtotal, 0, ',', '.') }}
                            </span>
                        </div>
                    @endforeach

                    <!-- Ringkasan -->
                    <div class="d-flex justify-content-between mt-3">
                        <span class="fw-semibold">Total (termasuk ongkir):</span>
                        <span class="fw-bold text-success">
                            Rp {{ number_format($order->total_amount, 0, ',', '.') }}
                        </span>
                    </div>

                    <div class="text-end mt-3">
                        @if($order->status === 'Menunggu Pembayaran')
                            <a href="{{ route('user.payment', ['orderId' => $order->id]) }}" 
                               class="btn btn-sm btn-outline-success rounded-pill px-3">
                                <i class="bi bi-credit-card me-1"></i> Bayar Sekarang
                            </a>
                        @else
                            <a href="#" class="btn btn-sm btn-outline-secondary rounded-pill px-3">
                                <i class="bi bi-info-circle me-1"></i> Detail
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    @endif
</div>
