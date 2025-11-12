<div>
    <!-- Product List Section -->
    <section class="container py-5">
        <div class="row justify-content-between align-items-center mb-4">
            <div class="col-md-6">
                <h4 class="fw-bold mb-0">Daftar Produk Laptop</h4>
                <p class="text-muted small">Temukan laptop terbaik sesuai kebutuhanmu</p>
            </div>
            <div class="col-md-4">
                <form class="d-flex" role="search">
                    <input class="form-control rounded-start-pill" type="search" placeholder="Cari laptop..." aria-label="Search">
                    <button class="btn btn-primary rounded-end-pill px-3" type="submit">
                        <i class="fa-solid fa-magnifying-glass" style="color: #ffffff;"></i>
                    </button>
                </form>
            </div>
        </div>

        <!-- Product Grid -->
        <div class="row g-4">
            @foreach($products as $index => $product)
            <div class="col-xl-3 col-lg-4 col-md-6">
                <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden position-relative">
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
                        <small class="text-muted d-block text-truncate mb-2" style="max-width: 100%;">
                            {{ $product->description }}
                        </small>
                        <div class="d-flex justify-content-between align-items-center mt-2">
                            <span class="h6 text-primary fw-bold mb-0">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                            <span class="badge bg-success-subtle text-success border border-success-subtle">
                                Stok: {{ $product->stock }}
                            </span>
                        </div>

                        <a wire:navigate
                            href="{{ route('user.product.detail', $product->slug) }}"
                            class="btn btn-primary w-100 mt-3 rounded-pill shadow-sm">
                            <i class="fa fa-eye me-2"></i> Lihat Detail
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </section>
</div>
