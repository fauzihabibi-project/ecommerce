<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Orders as OrdersModel;

class Orders extends Component
{
    protected $listeners = [
        'deleteOrder' => 'delete'
    ];
    public function delete($id)
    {
        $order = OrdersModel::find($id);
        if ($order) {
            $order->delete();
        }

        $this->js(<<<JS
            Swal.fire({
                icon: 'success',
                title: 'Order deleted successfully!',
                toast: true,
                position: 'top-end',
                timer: 2000,
                showConfirmButton: false
            });
        JS);
    }

    public function render()
    {
        $orders = OrdersModel::with(['user', 'address.city', 'address.province'])
            ->orderByDesc('created_at')
            ->get();

        return view('livewire.admin.orders', compact('orders'));
    }
}
