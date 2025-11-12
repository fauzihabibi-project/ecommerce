<div>

    <!-- Detail Produk -->
    <section class="container py-5">
        <a wire:navigate href="{{ route('shop') }}" class="btn btn-secondary mb-4 rounded-pill shadow-sm">
            ← Kembali ke Toko
        </a>

        <div class="row g-5 align-items-start">
            <!-- Gambar Produk -->
            <div class="col-lg-5">
                <div class="border rounded-4 shadow-sm overflow-hidden">
                    <img src="{{ asset('storage/' . $product->image) }}"
                         class="img-fluid"
                         alt="{{ $product->name }}"
                         style="object-fit: cover; width: 100%; height: 100%;">
                </div>
            </div>

            <!-- Informasi Produk -->
            <div class="col-lg-7">
                <h2 class="fw-bold mb-3">{{ $product->name }}</h2>
                <h4 class="text-primary fw-semibold mb-2">
                    Rp {{ number_format($product->price, 0, ',', '.') }}
                </h4>
                <span class="badge {{ $product->stock > 0 ? 'bg-success' : 'bg-danger' }} mb-3">
                    {{ $product->stock > 0 ? 'Tersedia' : 'Stok Habis' }}
                </span>

                <p class="text-muted mb-4">
                    {{ $product->description }}
                </p>

                <ul class="list-group list-group-flush mb-4">
                    <li class="list-group-item">
                        <i class="bi bi-tags me-2 text-primary"></i>Kategori:
                        <strong>{{ $product->category->name ?? '-' }}</strong>
                    </li>
                    <li class="list-group-item">
                        <i class="bi bi-box-seam me-2 text-primary"></i>Stok:
                        <strong>{{ $product->stock }}</strong>
                    </li>
                    <li class="list-group-item">
                        <i class="bi bi-clock-history me-2 text-primary"></i>Diperbarui:
                        {{ $product->updated_at->diffForHumans() }}
                    </li>
                </ul>

                <div class="d-flex gap-3">
                    <livewire:cart.add-to-cart :productId="$product->id" />
                </div>
            </div>
        </div>
    </section>

    <!-- Produk Terkait -->
    <section class="py-5 border-top">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h4 class="fw-bold mb-1">Produk Terkait</h4>
                    <p class="text-muted mb-0">Rekomendasi untuk Anda</p>
                </div>
            </div>

            <div class="row g-4">
                @forelse($relatedProducts as $product)
                <div class="col-xl-3 col-lg-4 col-md-6">
                    <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden bg-white">
                        <!-- Gambar Produk -->
                        <div class="ratio ratio-4x3">
                            <img src="{{ asset('storage/' . $product->image) }}"
                                 class="card-img-top"
                                 alt="{{ $product->name }}"
                                 style="object-fit: cover;">
                        </div>

                        <!-- Isi Card -->
                        <div class="card-body p-3">
                            <h6 class="card-title fw-semibold text-truncate mb-1">{{ $product->name }}</h6>
                            <small class="text-muted d-block text-truncate mb-2">
                                {{ $product->description }}
                            </small>
                            <div class="d-flex justify-content-between align-items-center mt-2">
                                <span class="h6 text-primary fw-bold mb-0">
                                    Rp {{ number_format($product->price, 0, ',', '.') }}
                                </span>
                                <span class="badge bg-success-subtle text-success border border-success-subtle">
                                    Stok: {{ $product->stock }}
                                </span>
                            </div>

                            <a wire:navigate
                               href="{{ route('user.product.detail', Crypt::encrypt($product->id)) }}"
                               class="btn btn-primary w-100 mt-3 rounded-pill shadow-sm">
                                <i class="fa fa-eye me-2"></i> Lihat Detail
                            </a>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-12 text-center py-5">
                    <p class="text-muted">Tidak ada produk terkait.</p>
                </div>
                @endforelse
            </div>
        </div>
    </section>
</div>
