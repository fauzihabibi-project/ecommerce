<?php

namespace App\Livewire\Shop;

use Livewire\Component;
use App\Models\Products;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Crypt;

#[Layout('components.layouts.master')]
class DetailProductUser extends Component
{
    public $product;
    public $relatedProducts;

    public function mount($slug)
{
    $this->product = Products::where('slug', $slug)->firstOrFail();

    $this->relatedProducts = Products::where('category_id', $this->product->category_id)
        ->where('id', '!=', $this->product->id)
        ->take(4)
        ->get();
}

    public function render()
    {
        return view('livewire.shop.detail-product-user');
    }
}
