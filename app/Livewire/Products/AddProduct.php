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

    public $name, $price, $description, $stock, $category_id, $image1, $image2, $image3, $image4;

    protected $rules = [
        'name' => 'required|string|max:255',
        'price' => 'required|numeric',
        'description' => 'nullable|string',
        'stock' => 'required|integer|min:0',
        'category_id' => 'required|exists:categories,id',
        'image1' => 'required|image|max:2048',
        'image2' => 'nullable|image|max:2048',
        'image3' => 'nullable|image|max:2048',
        'image4' => 'nullable|image|max:2048',
    ];

    public function saveProduct()
    {
        $this->validate();

        $slug = Str::slug($this->name);
        $originalSlug = $slug;
        $count = 1;

        while (Products::where('slug', $slug)->exists()) {
            $slug = "{$originalSlug}-{$count}";
            $count++;
        }

        $images = [];

        foreach (['image1', 'image2', 'image3', 'image4'] as $field) {
            if ($this->$field) {
                $extension = $this->$field->getClientOriginalExtension();
                $filename = $slug . '-' . uniqid() . '.' . $extension;
                $path = $this->$field->storeAs('product', $filename, 'public');
                $images[] = $path;
            }
        }

        Products::create([
            'name' => $this->name,
            'slug' => $slug,
            'price' => $this->price,
            'description' => $this->description,
            'stock' => $this->stock,
            'category_id' => $this->category_id,
            'image' => json_encode($images),
        ]);

        $this->reset(['name', 'price', 'description', 'stock', 'category_id', 'image1', 'image2', 'image3', 'image4']);

        $this->js(<<<JS
        Swal.fire({
            icon: 'success',
            title: 'Product successfully saved!',
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
