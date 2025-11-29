<div class="container-fluid">
    <div class="row">
        <div class="col-12 col-lg-12 mx-auto">
            <div class="card w-100">
                <div class="card-body p-4">
                    <h5 class="card-title fw-semibold mb-4">Edit Product</h5>

                    <form wire:submit.prevent="updateProduct" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label class="form-label">Product Name</label>
                            <input wire:model.defer="name" type="text" class="form-control @error('name') is-invalid @enderror">
                            @error('name') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Price</label>
                            <input
                                type="text"
                                x-data
                                x-init="$el.value = ({{ $price ?? 0 }}).toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.')"
                                x-on:input="
                                    let number = $el.value.replace(/[^\d]/g, '');
                                    $wire.set('price', number);
                                    $el.value = number.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
                                "
                                class="form-control @error('price') is-invalid @enderror"
                                placeholder="Masukkan harga">
                            @error('price')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Stock</label>
                            <input wire:model.defer="stock" type="number" class="form-control @error('stock') is-invalid @enderror">
                            @error('stock') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Category</label>
                            <select wire:model.defer="category_id" class="form-select @error('category_id') is-invalid @enderror">
                                <option value="">-- Select Category --</option>
                                @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                            @error('category_id') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Description</label>
                            <textarea wire:model.defer="description" class="form-control @error('description') is-invalid @enderror" rows="4"></textarea>
                            @error('description') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Product Images</label>
                            <div class="row g-3">
                                @for ($i = 1; $i <= 4; $i++)
                                    <div class="col-md-3 text-center">
                                    <input wire:model="image{{ $i }}" type="file"
                                        class="form-control @error('image'.$i) is-invalid @enderror mb-2">

                                    @error('image'.$i)
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror

                                    <div class="border rounded p-2" style="height: 150px; display: flex; align-items: center; justify-content: center;">
                                        @php
                                        $currentImage = ${"image$i"} ?? null;
                                        $oldImage = isset($oldImages[$i - 1]) ? $oldImages[$i - 1] : null;
                                        @endphp

                                        @if ($currentImage)
                                        <img src="{{ $currentImage->temporaryUrl() }}" class="rounded" width="120">
                                        @elseif ($oldImage)
                                        <img src="{{ asset('storage/' . $oldImage) }}" class="rounded" width="120">
                                        @else
                                        <span class="text-muted small">No images yet</span>
                                        @endif
                                    </div>
                            </div>
                            @endfor
                        </div>
                </div>

                <div class="d-flex justify-content-end gap-2 mt-4">
                    <a href="{{ route('products') }}" wire:navigate class="btn btn-secondary">
                        <i class="ti ti-arrow-left"></i> Back
                    </a>
                    <button type="submit" class="btn btn-primary" wire:loading.attr="disabled">
                        <span wire:loading.remove>Update Product</span>
                        <span wire:loading>Updating...</span>
                    </button>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>