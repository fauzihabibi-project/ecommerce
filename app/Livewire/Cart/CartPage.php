<?php

namespace App\Livewire\Cart;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use Illuminate\Database\Eloquent\Collection;

#[Layout('components.layouts.master')]
class CartPage extends Component
{
    public Collection $cartItems;
    public $total = 0;

    public function mount()
    {
        $this->loadCart();
    }

    public function loadCart()
    {
        if (Auth::check()) {
            $this->cartItems = Cart::with('product')
                ->where('user_id', Auth::id())
                ->get();
        } else {
            $this->cartItems = collect(); // kosong tapi tetap Collection
        }

        $this->total = $this->cartItems->sum(fn($item) => $item->subtotal);
    }

    public function increment($cartId)
    {
        $cart = Cart::with('product')->find($cartId);

        if (!$cart) return;

        $stokTersedia = $cart->product->stock;

        // Jika quantity di cart sudah mencapai stok, hentikan
        if ($cart->quantity >= $stokTersedia) {
            $this->js(<<<JS
            Swal.fire({
                icon: 'warning',
                title: 'Insufficient stock!',
                text: 'Order quantity exceeds product stock.',
                timer: 2000,
                showConfirmButton: false
            });
        JS);
            return;
        }

        // Kalau masih cukup stok → increment
        $cart->quantity++;
        $cart->save();

        $this->loadCart();
    }


    public function decrement($cartId)
    {
        $cart = Cart::find($cartId);
        if ($cart && $cart->quantity > 1) {
            $cart->quantity--;
            $cart->save();
            $this->loadCart();
        }
    }

    public function removeItem($cartId)
    {
        Cart::destroy($cartId);
        $this->loadCart();

        $this->js(<<<JS
            Swal.fire({
                icon: 'success',
                title: 'Product removed from cart!',
                toast: true,
                position: 'top-end',
                timer: 2000,
                showConfirmButton: false
            });
        JS);
    }

    // ✅ Tambahkan fungsi ini
    public function proceedToCheckout()
    {
        if ($this->cartItems->isEmpty()) {
            $this->js(<<<JS
                Swal.fire({
                    icon: 'warning',
                    title: 'Cart is empty!',
                    text: 'Cannot proceed to payment before adding products to the cart.',
                    confirmButtonText: 'OK'
                });
            JS);
            return;
        }

        return redirect()->route('checkout');
    }

    public function render()
    {
        return view('livewire.cart.cart-page');
    }
}
