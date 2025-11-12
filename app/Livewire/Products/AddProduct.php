<?php

namespace App\Livewire\Products;

use Illuminate\Support\Str;
use Livewire\Component;
use App\Models\Products;
use App\Models\Categories;
use Livewire\WithFileUploads;

class AddProduct extends Component
{
    use WithFileUploads;

    public $name, $price, $description, $stock, $category_id, $image;

    protected $rules = [
        'name' => 'required|string|max:255',
        'price' => 'required|numeric',
        'description' => 'nullable|string',
        'stock' => 'required|integer|min:0',
        'category_id' => 'required|exists:categories,id',
        'image' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
    ];

    public function saveProduct()
    {
        $this->validate();

        $slug = Str::slug($this->name);

        // Jika slug sudah ada, tambahkan angka unik di belakang
        $originalSlug = $slug;
        $count = 1;
        while (Products::where('slug', $slug)->exists()) {
            $slug = "{$originalSlug}-{$count}";
            $count++;
        }

        $extension = $this->image->getClientOriginalExtension();
        $filename = $slug . '-' . uniqid() . '.' . $extension;
        $imagePath = $this->image->storeAs('product', $filename, 'public');

        Products::create([
            'name' => $this->name,
            'slug' => $slug, 
            'price' => $this->price,
            'description' => $this->description,
            'stock' => $this->stock,
            'category_id' => $this->category_id,
            'image' => $imagePath,
        ]);

        $this->reset();

        $this->js(<<<JS
        Swal.fire({
            icon: 'success',
            title: 'Product berhasil disimpan!',
            toast: true,
            position: 'top-end',
            timer: 2000,
            showConfirmButton: false
        });
    JS);

        return redirect()->route('products');
    }

    public function render()
    {
        $categories = Categories::all();
        return view('livewire.products.add-product', [
            'categories' => $categories
        ]);
    }
}
