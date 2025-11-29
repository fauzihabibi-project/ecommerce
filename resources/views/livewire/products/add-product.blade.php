<div class="container-fluid">
    <div class="row">
        <div class="col-12 col-lg-12 mx-auto">
            <div class="card w-100">
                <div class="card-body p-4">
                    <h5 class="card-title fw-semibold mb-4">Add New Product</h5>

                    <form wire:submit.prevent="saveProduct" enctype="multipart/form-data">
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
                                x-on:input="
                                let number = $el.value.replace(/[^\d]/g, '');
                                $wire.set('price', number);
                                $el.value = number.replace(/\B(?=(\d{3})+(?!\d))/g, '.');"
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

                            <!-- Image 1 -->
                            <input wire:model="image1" type="file"
                                class="form-control mb-4 @error('image1') is-invalid @enderror"
                                required>
                            @error('image1') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror

                            <!-- Image 2 -->
                            <input wire:model="image2" type="file"
                                class="form-control mb-4 @error('image2') is-invalid @enderror">
                            @error('image2') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror

                            <!-- Image 3 -->
                            <input wire:model="image3" type="file"
                                class="form-control mb-4 @error('image3') is-invalid @enderror">
                            @error('image3') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror

                            <!-- Image 4 -->
                            <input wire:model="image4" type="file"
                                class="form-control mb-4 @error('image4') is-invalid @enderror">
                            @error('image4') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror

                            <!-- Preview -->
                            <div class="mt-3 d-flex flex-wrap gap-2">
                                @foreach ([$image1, $image2, $image3, $image4] as $img)
                                @if ($img)
                                <img src="{{ $img->temporaryUrl() }}" width="120" class="rounded shadow-sm">
                                @endif
                                @endforeach
                            </div>
                        </div>
                        
                        <div class="d-flex justify-content-end gap-2 mt-4">
                            <a href="{{ route('products') }}" wire:navigate class="btn btn-secondary">
                                <i class="ti ti-arrow-left"></i> Back
                            </a>
                            <button type="submit" class="btn btn-primary" wire:loading.attr="disabled">
                                <span wire:loading.remove>Save Product</span>
                                <span wire:loading>Saving...</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>