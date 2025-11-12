<div>
    <!-- Hero Section -->
    <section class="hero-section position-relative text-white p-5 m-5"
        style="background: url('img/hero-bg.jpg') center/cover no-repeat; border-radius: 20px;">

        <div class="overlay position-absolute top-0 start-0 w-100 h-100"
            style="background-color: rgba(0,0,0,0.55); border-radius: 20px;"></div>

        <div class="container py-5 position-relative">
            <div class="row align-items-center g-4">
                <div class="col-lg-5">
                    <div class="hero-content">
                        <span class="badge bg-light bg-opacity-25 text-white mb-3 px-3 py-2">Welcome to Our Store</span>
                        <h1 class="display-4 fw-bold mb-3">Discover Amazing Products</h1>
                        <p class="lead text-light mb-4">
                            Temukan produk berkualitas dengan harga terbaik. Pengalaman berbelanja yang mudah dan aman untuk Anda.
                        </p>
                        <div class="d-flex gap-3">
                            <a href="#products" class="btn btn-primary btn-lg px-4 shadow-sm">
                                <i class="bi bi-shop me-2"></i>Shop Now
                            </a>
                            <a href="#repair" class="btn btn-outline-light btn-lg px-4">
                                Learn More
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Products Section -->
    <section id="products" class="py-5">
        <div class="container">
            <div class="text-center mb-5">
                <span class="badge bg-primary bg-opacity-10 text-primary mb-2 px-3 py-2">Our Products</span>
                <h2 class="display-6 fw-bold mb-3">Featured Collection</h2>
                <p class="text-muted">Pilihan produk terbaik dengan kualitas unggulan</p>
            </div>

            <div class="row g-4">
                @foreach($products as $product)
                <div class="col-xl-3 col-lg-4 col-md-6">
                    <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden position-relative">
                        <div class="ratio ratio-4x3">
                            <img src="{{ asset('storage/' . $product->image) }}"
                                class="card-img-top"
                                alt="{{ $product->name }}"
                                style="object-fit: cover;">
                        </div>

                        <div class="card-body p-3">
                            <h6 class="card-title fw-semibold text-truncate mb-1">{{ $product->name }}</h6>
                            <small class="text-muted d-block text-truncate mb-2">{{ $product->description }}</small>
                            <div class="d-flex justify-content-between align-items-center mt-2">
                                <span class="h6 text-primary fw-bold mb-0">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
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
                @endforeach
            </div>
        </div>
    </section>

    <!-- Repair Service Section -->
    <section id="repair" class="py-5">
        <div class="container">
            <div class="repair-card rounded-4 shadow-lg overflow-hidden">
                <div class="row g-0 align-items-center">
                    <div class="col-lg-6">
                        <div class="repair-image-wrapper position-relative"
                            style="background: url('img/repair.jpg') center/cover no-repeat; height: 100%; min-height: 400px; border-radius: 20px;">
                            <div class="overlay position-absolute top-0 start-0 w-100 h-100"
                                style="background-color: rgba(0,0,0,0.55); border-radius: 20px;"></div>
                            <div class="position-absolute top-50 start-50 translate-middle text-white text-center">
                                <i class="bi bi-laptop display-1 mb-3"></i>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="repair-content p-5">
                            <span class="badge bg-success bg-opacity-10 text-success mb-3 px-3 py-2">
                                <i class="bi bi-tools me-1"></i>Repair Service
                            </span>
                            <h2 class="fw-bold mb-3">Need Laptop Repair?</h2>
                            <p class="text-muted mb-4">
                                Kami menyediakan layanan perbaikan laptop profesional dengan teknisi berpengalaman.
                                Hubungi admin kami melalui WhatsApp untuk konsultasi gratis.
                            </p>

                            <div class="features mb-4">
                                <div class="d-flex align-items-center mb-3">
                                    <div class="feature-icon bg-success bg-opacity-10 text-success rounded-circle p-2 me-3">
                                        <i class="bi bi-check-circle-fill"></i>
                                    </div>
                                    <span>Teknisi Berpengalaman</span>
                                </div>
                                <div class="d-flex align-items-center mb-3">
                                    <div class="feature-icon bg-success bg-opacity-10 text-success rounded-circle p-2 me-3">
                                        <i class="bi bi-check-circle-fill"></i>
                                    </div>
                                    <span>Garansi Perbaikan</span>
                                </div>
                                <div class="d-flex align-items-center">
                                    <div class="feature-icon bg-success bg-opacity-10 text-success rounded-circle p-2 me-3">
                                        <i class="bi bi-check-circle-fill"></i>
                                    </div>
                                    <span>Harga Terjangkau</span>
                                </div>
                            </div>

                            <a href="https://wa.me/YOUR_WHATSAPP_NUMBER" target="_blank"
                                class="btn btn-success btn-lg shadow-sm rounded-pill">
                                <i class="bi bi-whatsapp me-2"></i>Chat on WhatsApp
                            </a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
</div>