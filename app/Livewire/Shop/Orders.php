<?php

namespace App\Livewire\Shop;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Auth;
use App\Models\Orders as OrdersModel;

#[Layout('components.layouts.master')]
class Orders extends Component
{
    public $orders;

    public function mount()
    {
        // Ambil semua pesanan berdasarkan user yang login
        $this->orders = OrdersModel::where('user_id', Auth::id())
            ->with(['items.product', 'address'])
            ->latest()
            ->get();
    }

    public function render()
    {
        return view('livewire.shop.orders', [
            'orders' => $this->orders,
        ]);
    }
}
