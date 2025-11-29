<?php

namespace App\Livewire\Products;

use Livewire\Component;
use App\Models\Products;

class ListProducts extends Component
{
    public $products;

    protected $listeners = [
        'deleteProduct' => 'delete'
    ];

    public function mount()
    {
        $this->products = Products::with('category')->latest()->get();
    }

    public function delete($id)
    {
        $product = Products::findOrFail($id);
        if ($product->image && file_exists(public_path('storage/' . $product->image))) {
            unlink(public_path('storage/' . $product->image));
        }
        $product->delete();

        // Refresh list
        $this->products = Products::with('category')->latest()->get();
        
        $this->js(<<<JS
        Swal.fire({
            icon: 'success',
            title: 'Product deleted successfully!',
            toast: true,
            position: 'top-end',
            timer: 2000,
            showConfirmButton: false
        });
    JS);
    }

    public function render()
    {
        return view('livewire.products.list-products');
    }
}
