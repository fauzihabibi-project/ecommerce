<div>

    <!-- Detail Produk -->
    <section class="container py-5">
        <a wire:navigate href="{{ route('shop') }}" class="btn btn-secondary mb-4 rounded-pill shadow-sm">
            ← Beck
        </a>

        <div class="row g-5 align-items-start">
            <!-- Gambar Produk -->
            <!-- Gambar Produk -->
            <div class="col-lg-5">

                @php
                $images = json_decode($product->image, true) ?? [];
                $firstImage = $images[0] ?? null;
                @endphp

                <!-- Gambar Utama -->
                <div class="rounded-4 shadow-sm overflow-hidden mb-3" style="border: none;">
                    <img id="mainImage"
                        src="{{ $firstImage ? asset('storage/' . $firstImage) : 'https://via.placeholder.com/600' }}"
                        class="img-fluid d-block"
                        alt="{{ $product->name }}"
                        style="object-fit: cover; width: 100%; height: 400px;">
                </div>

                <!-- Thumbnail -->
                <div class="d-flex gap-3">
                    @foreach ($images as $img)
                    <img src="{{ asset('storage/' . $img) }}"
                        onclick="document.getElementById('mainImage').src=this.src"
                        class="rounded"
                        style="width: 80px; height: 80px; object-fit: cover; cursor: pointer;">
                    @endforeach
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

                <div class="small text-secondary mb-4 d-flex flex-column gap-1">
                    <div><i class="bi bi-tags text-primary me-2"></i>Category:
                        <strong>{{ $product->category->name ?? '-' }}</strong>
                    </div>
                    <div><i class="bi bi-box-seam text-primary me-2"></i>Stock:
                        <strong>{{ $product->stock }}</strong>
                    </div>
                </div>

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
                    <h4 class="fw-bold mb-1">Related Products</h4>
                    <p class="text-muted mb-0">Product recommendations for you that you might like</p>
                </div>
            </div>

            <div class="row g-4">
                @forelse($relatedProducts as $product)
                <div class="col-xl-3 col-lg-4 col-md-6">
                    <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden">
                        <!-- Gambar Produk -->
                        <div class="ratio ratio-4x3">
                            @if ($product->image)
                            @php
                            // Ubah JSON menjadi array
                            $images = json_decode($product->image, true);
                            // Ambil gambar pertama jika ada
                            $firstImage = $images[0] ?? null;
                            @endphp

                            @if ($firstImage)
                            <img src="{{ asset('storage/' . $firstImage) }}" alt="image"
                                width="60" class="rounded">
                            @else
                            <img src="https://via.placeholder.com/60" alt="no image"
                                class="rounded">
                            @endif
                            @else
                            <img src="https://via.placeholder.com/60" alt="no image"
                                class="rounded">
                            @endif
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
                                href="{{ route('user.product.detail', $product->slug) }}"
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