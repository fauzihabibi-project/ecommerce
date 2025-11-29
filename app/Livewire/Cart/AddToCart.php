<?php

namespace App\Livewire\Cart;

use Livewire\Component;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use App\Models\Products;

class AddToCart extends Component
{
    public $productId;

    public function mount($productId)
    {
        $this->productId = $productId;
    }

    public function addToCart()
    {
        // Jika belum login, arahkan ke halaman login
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // Pastikan produk valid
        $product = Products::find($this->productId);
        if (!$product) {
            $this->js(<<<JS
                Swal.fire({
                    icon: 'error',
                    title: 'Product not found!',
                    toast: true,
                    position: 'top-end',
                    timer: 2000,
                    showConfirmButton: false
                });
            JS);
            return;
        }

        // Cek apakah produk sudah ada di keranjang
        $cartItem = Cart::where('user_id', Auth::id())
            ->where('product_id', $this->productId)
            ->first();

        if ($cartItem) {
            // Tambah quantity
            $cartItem->increment('quantity');
        } else {
            // Tambahkan item baru
            Cart::create([
                'user_id' => Auth::id(),
                'product_id' => $this->productId,
                'quantity' => 1,
            ]);
        }

        // Kirim event ke komponen lain (misalnya navbar cart count)
        $this->dispatch('cartUpdated');

        // Notifikasi sukses
        $this->js(<<<JS
            Swal.fire({
                icon: 'success',
                title: 'Product added to cart!',
                toast: true,
                position: 'top-end',
                timer: 2000,
                showConfirmButton: false
            });
        JS);
    }

    public function render()
    {
        return view('livewire.cart.add-to-cart');
    }
}
