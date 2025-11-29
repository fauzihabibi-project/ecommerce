<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card w-100">
                <div class="card-body p-4">
                    <h5 class="card-title fw-semibold mb-4">List Products</h5>

                    <div class="d-flex justify-content-end mb-3">
                        <a href="{{ route('product.add') }}" wire:navigate class="btn btn-primary">
                            Add Product
                        </a>

                    </div>

                    <div class="table-responsive">
                        <table class="table text-nowrap mb-0 align-middle">
                            <thead class="text-dark fs-4">
                                <tr>
                                    <th>
                                        <h6 class="fw-semibold mb-0">No</h6>
                                    </th>
                                    <th>
                                        <h6 class="fw-semibold mb-0">Image</h6>
                                    </th>
                                    <th>
                                        <h6 class="fw-semibold mb-0">Product Name</h6>
                                    </th>
                                    <th>
                                        <h6 class="fw-semibold mb-0">Category</h6>
                                    </th>
                                    <th>
                                        <h6 class="fw-semibold mb-0">Price</h6>
                                    </th>
                                    <th>
                                        <h6 class="fw-semibold mb-0">Stock</h6>
                                    </th>
                                    <th>
                                        <h6 class="fw-semibold mb-0">Action</h6>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($products as $index => $product)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>
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
                                    </td>

                                    <td>{{ $product->name }}</td>
                                    <td>
                                        <span class="badge bg-primary rounded-3 fw-semibold">
                                            {{ $product->category->name ?? '-' }}
                                        </span>
                                    </td>
                                    <td>{{ number_format($product->price, 0, ',', '.') }}</td>
                                    <td>{{ $product->stock }}</td>
                                    <td>
                                        <div class="d-flex gap-2">
                                            <a href="{{ route('product.detail', $product->id) }}"
                                                wire:navigate
                                                class="btn btn-sm btn-primary">
                                                <i class="ti ti-eye"></i>
                                            </a>

                                            <a href="{{ route('product.edit', $product->id) }}"
                                                wire:navigate
                                                class="btn btn-sm btn-warning">
                                                <i class="ti ti-edit"></i>
                                            </a>

                                            <button wire:click="$dispatch('confirm-delete', { id: {{ $product->id }} })"
                                                class="btn btn-sm btn-danger">
                                                <i class="ti ti-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="text-center text-muted">
                                        Belum ada produk
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@push('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    document.addEventListener('livewire:initialized', () => {
        Livewire.on('confirm-delete', data => {

            Swal.fire({
                title: 'Delete Product?',
                text: "This product will be permanently deleted.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.dispatch('deleteProduct', {
                        id: data.id
                    });
                }
            });

        });
    });
</script>
@endpush