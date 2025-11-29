@push('css')
<style>
    .credit-card {
        width: 100%;
        max-width: 430px;
        background: linear-gradient(135deg, #0d6efd, #6610f2);
        color: white;
        border-radius: 20px;
        padding: 25px;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
        position: relative;
        overflow: hidden;
    }

    .credit-card:before {
        content: "";
        position: absolute;
        top: -30px;
        right: -30px;
        width: 120px;
        height: 120px;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 50%;
    }

    .credit-card:after {
        content: "";
        position: absolute;
        bottom: -40px;
        left: -40px;
        width: 150px;
        height: 150px;
        background: rgba(255, 255, 255, 0.15);
        border-radius: 50%;
    }

    .bank-name {
        font-size: 1.3rem;
        font-weight: bold;
        letter-spacing: 1px;
    }

    .account-number {
        font-size: 1.6rem;
        font-weight: bold;
        letter-spacing: 3px;
        margin: 15px 0;
    }

    .account-holder {
        font-size: 1rem;
        opacity: 0.8;
    }

    .chip {
        width: 50px;
        margin-bottom: 10px;
    }
</style>
@endpush
<div class="container py-5">
    <div class="row justify-content-center mb-4 mb-md-0">
        <div class="col-md-12 p-4 rounded shadow-sm">

            <h4 class="fw-bold text-center text-success">Order Payment</h4>
            <p class="mt-1 mb-4 text-center text-muted">
                Please transfer the amount listed below and upload proof of payment after making the transfer.
            </p>

            <div class="row g-4">
                <!-- KIRI -->
                <div class="col-md-6">
                    <div class="p-3 border rounded">
                        <p><strong>Status:</strong> {{ $order->status }}</p>
                        <p><strong>Total payment:</strong> Rp {{ number_format($order->total_amount, 0, ',', '.') }}</p>
                        <p><strong>Courier:</strong> {{ $order->courier }}</p>
                    </div>
                </div>

                <!-- KANAN (CREDIT CARD) -->
                <div class="col-md-6 d-flex justify-content-center">
                    <div class="credit-card">
                        <div class="bank-name">BANK BRI</div>

                        <img class="chip" style="width: 35px; height: 35px;" src="{{ asset('img/chip.png') }}" alt="Chip">

                        <div class="account-number">
                            1234 5678 900
                        </div>

                        <div class="account-holder">
                            a.n <strong>Toko Online</strong>
                        </div>

                        <div class="mt-3" style="opacity:0.7;font-size:13px;">
                            Please transfer the exact payment amount.
                        </div>
                    </div>
                </div>
            </div>

            <hr class="my-4">

            <!-- Upload Proof -->
            <div class="mb-3">
                <label class="form-label fw-semibold">Upload Proof of Payment</label>
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
                    <i class="bi bi-upload me-2"></i> Upload Proof of Payment
                </button>
            </div>

        </div>
    </div>
</div>