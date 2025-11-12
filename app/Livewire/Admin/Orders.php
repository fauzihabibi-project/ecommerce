<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Orders as OrdersModel;

class Orders extends Component
{
    public function delete($id)
    {
        $order = OrdersModel::find($id);
        if ($order) {
            $order->delete();
            session()->flash('success', 'Pesanan berhasil dihapus!');
        }
    }

    public function render()
    {
        $orders = OrdersModel::with(['user', 'address.city', 'address.province'])
            ->orderByDesc('created_at')
            ->get();

        return view('livewire.admin.orders', compact('orders'));
    }
}
