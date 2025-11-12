<div class="container-fluid">
    <div class="card shadow-sm">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Detail Pesanan</h5>

            <!-- Informasi Umum -->
            <div class="row mb-4">
                <div class="col-md-6">
                    <p><strong>Nama Pemesan:</strong> {{ $order->user->name }}</p>
                    <p><strong>Email:</strong> {{ $order->user->email }}</p>
                    <p><strong>Kurir:</strong> {{ $order->courier }}</p>
                </div>
                <div class="col-md-6">
                    <p><strong>Status:</strong>
                        <span class="badge bg-info">{{ $order->status }}</span>
                    </p>
                    <p><strong>Total:</strong> Rp {{ number_format($order->total_amount, 0, ',', '.') }}</p>
                    <p><strong>Tanggal Pesanan:</strong> {{ $order->created_at->format('d M Y') }}</p>
                </div>
            </div>

            <!-- Alamat & Bukti Pembayaran -->
            <div class="row mb-4">
                <!-- Kolom kiri: Alamat Pengiriman -->
                <div class="col-md-6">
                    <h6 class="fw-bold mb-2">Alamat Pengiriman</h6>
                    <p class="mb-0">
                        {{ $order->address->recipient_name }} <br>
                        {{ $order->address->address }} <br>
                        {{ $order->address->city->name ?? '' }}, {{ $order->address->province->name ?? '' }} <br>
                        {{ $order->address->postal_code }}
                    </p>
                </div>

                <!-- Kolom kanan: Bukti Pembayaran -->
                <div class="col-md-6">
                    <h6 class="fw-bold mb-2">Bukti Pembayaran</h6>
                    @if($order->payment && $order->payment->proof)
                    <div class="text-start">
                        <img src="{{ asset('storage/' . $order->payment->proof) }}"
                            alt="Bukti Pembayaran"
                            class="img-fluid rounded shadow-sm"
                            style="max-width: 200px;">
                    </div>
                    @else
                    <p class="text-danger">Belum ada bukti pembayaran yang diunggah.</p>
                    @endif
                </div>
            </div>

            <!-- Daftar Produk -->
            <div class="table-responsive mb-4">
                <table class="table text-nowrap align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Foto</th>
                            <th>Produk</th>
                            <th>Harga</th>
                            <th>Qty</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($order->items as $index => $item)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>
                                @if ($item->product && $item->product->image)
                                <img src="{{ asset('storage/' . $item->product->image) }}"
                                    alt="{{ $item->product->name }}"
                                    width="60" class="rounded">
                                @else
                                <img src="https://via.placeholder.com/60" alt="no image" class="rounded">
                                @endif
                            </td>
                            <td>{{ $item->product->name ?? '-' }}</td>
                            <td>Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>Rp {{ number_format($item->subtotal, 0, ',', '.') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Tombol Aksi -->
            <div class="d-flex justify-content-between">
                <a href="{{ route('list.orders') }}" wire:navigate class="btn btn-secondary rounded-pill px-4">
                    ← Kembali
                </a>

                <div class="d-flex gap-2">
                    @if($order->status === 'Menunggu Konfirmasi Pembayaran')
                    <button wire:click="confirmPayment({{ $order->id }})"
                        class="btn btn-success rounded-pill px-4">
                        Konfirmasi Pembayaran
                    </button>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>