<div class="container py-5">

    <div class="card shadow-sm">
        <div class="card-body">

            <h3 class="mb-3">Detail Order</h3>

            <!-- Informasi Order -->
            <div class="mb-4">
                <p><strong>Status:</strong>
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
                </p>
                <p><strong>Order Date:</strong>
                    {{ $order->created_at->format('d M Y H:i') }}
                </p>
                @if($order->tracking_number !== null)
                <p><strong>Tracking Number:</strong>
                    {{ $order->tracking_number ?? '-' }}
                </p>
                @endif
            </div>

            <hr>

            <!-- Alamat Pengiriman -->
            <h5 class="mb-3">Shipping Address</h5>
            <div class="mb-4">
                <p class="mb-1">
                    <strong>{{ $order->address->recipient_name }}</strong>
                </p>

                <p class="mb-1">
                    {{ $order->address->recipient_phone }}
                </p>

                <p class="mb-1">
                    {{ $order->address->address_detail }},
                    {{ $order->address->city->name ?? '-' }},
                    {{ $order->address->province->name ?? '-' }},
                    {{ $order->address->postal_code }}
                    <br>
                    {{ $order->address->notes ?? '-' }}
                </p>

            </div>

            <hr>

            <!-- Daftar Produk -->
            <h5 class="mb-3">Order Products</h5>

            <div class="list-group list-group-flush mb-4">

                @foreach ($order->items as $item)
                @php
                $images = json_decode($item->product->image, true) ?? [];
                $firstImage = $images[0] ?? null;
                @endphp

                <div class="list-group-item py-3 border-0">
                    <div class="d-flex align-items-center">

                        <!-- Gambar Produk -->
                        <img src="{{ $firstImage ? asset('storage/' . $firstImage) : 'https://via.placeholder.com/80' }}"
                            class="rounded"
                            width="80" height="80"
                            style="object-fit: cover;">

                        <!-- Nama & Qty -->
                        <div class="ms-3 flex-grow-1">
                            <h6 class="mb-1">{{ $item->product->name }}</h6>
                            <small class="text-muted">Qty: {{ $item->quantity }}</small>
                        </div>

                        <!-- Harga -->
                        <div class="text-end">
                            <strong>
                                Rp {{ number_format($item->subtotal, 0, ',', '.') }}
                            </strong>
                        </div>

                    </div>
                </div>

                @endforeach

            </div>

            <hr>

            <!-- Total -->
            <div class="d-flex justify-content-between">
                <h5>Total Payment:</h5>
                <h5 class="text-primary">
                    Rp {{ number_format($order->total_amount, 0, ',', '.') }}
                </h5>
            </div>

            <!-- Tombol ke pembayaran -->

            <div class="d-flex justify-content-between align-items-center mt-4">
                <a href="{{ route('orders') }}" wire:navigate class="btn btn-secondary rounded-pill">
                    ← Beck
                </a>
                @if($order->status == 'Waiting for Payment')
                <a href="{{ route('user.payment', ['orderId' => $order->id]) }}"
                    class="btn btn-primary btn-lg">
                    Pay Now
                </a>
                @endif
                @if($order->status == 'Shipped')
                <button
                    wire:click="$dispatch('confirm-accept-order', { id: {{ $order->id }} })"
                    class="btn btn-primary btn-lg">
                    Accept Order
                </button>
                @endif
                <!-- Tombol Batal -->
                @if(in_array($order->status, ['Waiting for Payment', 'Waiting for Payment Confirmation']))
                <button class="btn btn-danger btn-lg rounded-pill" data-bs-toggle="modal" data-bs-target="#cancelModal">
                    Cancel Order
                </button>
                @endif
            </div>

            <!-- Modal Pembatalan -->
            <div wire:ignore.self class="modal fade" id="cancelModal" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">

                        <div class="modal-header">
                            <h5 class="modal-title">Cancel Order</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>

                        <div class="modal-body">
                            <label class="form-label">Cancellation Reason</label>
                            <textarea wire:model="cancel_reason" class="form-control" rows="4" placeholder="Masukkan alasan..."></textarea>

                            @error('cancel_reason')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="modal-footer">
                            <button class="btn btn-secondary" data-bs-dismiss="modal">Beck</button>
                            <button wire:click="cancelOrder" class="btn btn-danger">Cancel Order</button>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@push('scripts')
<script>
    window.addEventListener('close-modal', () => {
        let modal = bootstrap.Modal.getInstance(document.getElementById('cancelModal'));
        modal.hide();
    });
</script>
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
document.addEventListener('livewire:initialized', () => {

    Livewire.on('confirm-accept-order', data => {

        Swal.fire({
            title: 'Accept this order?',
            text: "Order status will become Accepted.",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Yes, accept it!',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                Livewire.dispatch('acceptOrderConfirmed', { id: data.id });
            }
        });

    });

});
</script>
@endpush
