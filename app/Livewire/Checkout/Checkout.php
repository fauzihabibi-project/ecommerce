<?php

namespace App\Livewire\Checkout;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Addresses;
use App\Models\Orders;
use App\Models\OrderItems;
use App\Models\Cart;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.master')]
class Checkout extends Component
{
    public $selectedAddress = '';
    public $shippingCost = 0;
    public $cartTotal = 0;
    public $courier = '';
    public $addresses = [];

    public function mount()
    {
        $this->addresses = Addresses::where('user_id', Auth::id())->get();

        if ($this->addresses->count() == 0) {

            $url = route('add.address'); // ganti sesuai route kamu

            $this->js(<<<JS
            Swal.fire({
                icon: 'warning',
                title: 'Address Not Available Yet',
                text: 'Please add an address before checking out.',
                showCancelButton: true,
                confirmButtonText: 'Add Address Now',
                cancelButtonText: 'Maybe Later',
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = '$url';
                }
            });
        JS);
        }

        // Hitung total harga keranjang
        $this->cartTotal = Cart::where('user_id', Auth::id())
            ->with('product')
            ->get()
            ->sum(fn($item) => $item->product->price * $item->quantity);
    }

    // ✅ Fungsi ini akan otomatis dipanggil saat user ganti alamat
    public function updatedSelectedAddress($addressId)
    {
        $address = Addresses::find($addressId);

        if (!$address) {
            $this->shippingCost = 0;
            return;
        }

        // Simulasi biaya kirim berdasarkan provinsi
        $this->shippingCost = match ($address->province_id) {
            23 => 50000, // Sumatera Barat
            16 => 70000, // Sumatera Utara
            default => 100000, // Lainnya
        };

        // 🔥 Tambahkan baris ini biar langsung render ulang di browser
        $this->dispatch('ongkir-diperbarui');
    }

    public function placeOrder()
    {
        $this->validate([
            'selectedAddress' => 'required',
            'courier' => 'required',
        ]);

        $total = $this->cartTotal + $this->shippingCost;

        $order = Orders::create([
            'user_id' => Auth::id(),
            'address_id' => $this->selectedAddress,
            'total_amount' => $total,
            'shipping_cost' => $this->shippingCost,
            'courier' => $this->courier,
            'status' => 'Waiting for Payment',
        ]);

        $cartItems = Cart::where('user_id', Auth::id())->with('product')->get();

        foreach ($cartItems as $item) {

            // 👉 Simpan item ke tabel order_items
            OrderItems::create([
                'order_id' => $order->id,
                'product_id' => $item->product_id,
                'quantity' => $item->quantity,
                'price' => $item->product->price,
                'subtotal' => $item->product->price * $item->quantity,
            ]);

            // 👉 Kurangi stok produk
            $product = $item->product;

            // Pastikan stok tidak minus
            if ($product->stock >= $item->quantity) {
                $product->stock -= $item->quantity;
            } else {
                $product->stock = 0; // fallback aman
            }

            $product->save();
        }

        // 👉 Hapus semua cart setelah pesanan dibuat
        Cart::where('user_id', Auth::id())->delete();

        return redirect()->route('user.payment', ['orderId' => $order->id]);
    }


    public function render()
    {
        $cartItems = Cart::where('user_id', Auth::id())->with('product')->get();

        return view('livewire.checkout.checkout', [
            'cartItems' => $cartItems,
        ]);
    }
}
