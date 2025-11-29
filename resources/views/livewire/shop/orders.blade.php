<div class="container py-5">
    <h3 class="fw-bold text-center mb-4">
        MY ORDERS
    </h3>

    @if($orders->isEmpty())
    <div class="text-center p-5 rounded shadow-sm">
        <i class="bi bi-box-seam display-4 text-secondary mb-3"></i>
        <p class="text-muted mb-0">No orders have been placed yet.</p>
    </div>
    @else
    @foreach($orders as $order)
    <div class="card mb-4 shadow-sm border-0">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <p class="mb-2 text-muted small">
                    Address: {{ $order->address->recipient_name ?? '-' }} -
                    {{ $order->address->city->name ?? '' }}
                </p>
                @php
                $color = match ($order->status) {
                'Dibatalkan' => 'bg-danger',
                'Dikirim' => 'bg-success',
                default => 'bg-primary',
                };
                @endphp

                <span class="badge {{ $color }}">
                    {{ $order->status }}
                </span>

            </div>

            <!-- Product List -->
            @foreach($order->items as $item)
            @php
            $images = json_decode($item->product->image, true) ?? [];
            $firstImage = $images[0] ?? null;
            @endphp

            <div class="card mb-3 border-0 shadow-sm rounded-4 p-3">
                <div class="d-flex align-items-center">

                    <!-- Gambar Produk -->
                    <img src="{{ $firstImage ? asset('storage/' . $firstImage) : 'https://via.placeholder.com/90' }}"
                        width="90"
                        height="90"
                        class="rounded-4 me-3"
                        style="object-fit: cover;"
                        alt="{{ $item->product->name }}">

                    <!-- Detail Produk -->
                    <div class="flex-grow-1">
                        <strong>{{ $item->product->name }}</strong><br>
                        <small class="text-muted">Qty: {{ $item->quantity }}</small>
                    </div>

                    <!-- Subtotal -->
                    <span class="fw-bold">
                        Rp {{ number_format($item->subtotal, 0, ',', '.') }}
                    </span>
                </div>
            </div>
            @endforeach

            <hr>

            <!-- Ringkasan -->
            <div class="d-flex justify-content-between mt-3">
                <span class="fw-semibold">Total (including shipping):</span>
                <span class="fw-bold text-primary">
                    Rp {{ number_format($order->total_amount, 0, ',', '.') }}
                </span>
            </div>

            <div class="text-end mt-3">
                @if($order->status === 'Menunggu Pembayaran')
                <a href="{{ route('user.payment', ['orderId' => $order->id]) }}"
                    class="btn btn-sm btn-outline-primary rounded-pill px-3">
                    <i class="bi bi-credit-card me-1"></i> Pay Now
                </a>
                @else
                <a href="{{ route('user.order.detail', $order->hashid) }}" class="btn btn-sm btn-outline-primary rounded-pill px-3">
                    <i class="fa fa-eye me-1"></i> Details
                </a>
                @endif
            </div>
        </div>
    </div>
    @endforeach
    @endif
</div>