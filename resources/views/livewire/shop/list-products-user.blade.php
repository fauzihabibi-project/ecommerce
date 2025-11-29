<div>
    <!-- Product List Section -->
    <section class="container py-5">
        <div class="card-header d-flex justify-content-between align-items-center mb-5">
            <h5 class="card-title mb-0">
            </h5>

            <form class="d-flex" role="search" wire:submit.prevent>
                <div class="input-group">
                    <input
                        type="text"
                        wire:model.live="search"
                        class="form-control rounded-start-pill border-end-0"
                        placeholder="Cari laptop..."
                        aria-label="Search">
                    <button
                        class="btn rounded-end-pill border-start-0"
                        type="button"
                        style="background-color: #0d6efd; color: #fff;">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </button>
                </div>
            </form>
        </div>

        <!-- Spinner Loading -->
        <div wire:loading.delay wire:target="search">
            <div class="d-flex justify-content-center my-3">
                <div class="spinner-border text-primary" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </div>
        </div>


        <!-- Product Grid -->
        <div class="row g-4">
            @foreach($products as $index => $product)
            <div class="col-xl-3 col-lg-4 col-md-6">
                <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden position-relative">
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
                        <div class="d-flex justify-content-between align-items-center mt-2">
                            <span class="h6 text-primary fw-bold mb-0">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                        </div>

                        <a wire:navigate
                            href="{{ route('user.product.detail', $product->slug) }}"
                            class="btn btn-primary w-100 mt-3 rounded-pill shadow-sm">
                            <i class="fa fa-eye me-2"></i>Detail
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </section>
</div>