<div class="container py-5">
    <div class="row justify-content-center card mb-4 mb-md-0 border-0">
        <div class="col-md-12 p-4 rounded shadow-sm" >
            <h4 class="fw-bold text-center text-success">Pembayaran Pesanan</h4>
            <p class="mt-1 mb-4 text-center text-muted">
                Silakan transfer sesuai nominal di atas.
            </p>

            <div class="mb-3">
                <p><strong>Status:</strong> {{ $order->status }}</p>
                <p><strong>Total Pembayaran:</strong> Rp {{ number_format($order->total_amount, 0, ',', '.') }}</p>
                <p><strong>Kurir:</strong> {{ $order->courier }}</p>
            </div>

            <div class="alert alert-info">
                <strong>Nomor Rekening Admin:</strong><br>
                Bank BRI - <strong>1234 5678 900</strong> a.n <strong>Toko Online</strong><br>
                Silakan transfer sesuai nominal di atas.
            </div>

            <hr>

            <div class="mb-3">
                <label class="form-label fw-semibold">Upload Bukti Pembayaran</label>
                <input type="file" wire:model="proof" class="form-control">
                @error('proof') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            @if ($proof)
                <div class="text-center mb-3">
                    <img src="{{ $proof->temporaryUrl() }}" class="img-fluid rounded shadow-sm" width="300">
                </div>
            @endif

            <div>
                <button wire:click="uploadProof" class="btn btn-primary w-100 fw-semibold rounded-pill shadow-sm">
                    <i class="bi bi-upload me-2"></i> Upload Bukti Pembayaran
                </button>
            </div>
        </div>
    </div>
</div>
