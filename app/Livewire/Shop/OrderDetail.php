<?php

namespace App\Livewire\Shop;

use Livewire\Component;
use App\Models\Orders;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.master')]
class OrderDetail extends Component
{
    public $orderId;
    public $order;
    public $cancel_reason;

    protected $listeners = [
        'acceptOrderConfirmed' => 'acceptOrder'
    ];


    public function mount($hashid)
    {
        // Decode hashid → ambil ID asli
        $decoded = \Vinkla\Hashids\Facades\Hashids::decode($hashid);
        $orderId = $decoded[0] ?? null;

        if (!$orderId) {
            abort(404);
        }

        // Ambil order milik user
        $this->order = Orders::with(['items.product', 'address'])
            ->where('id', $orderId)
            ->where('user_id', Auth::id())
            ->firstOrFail();
    }


    public function cancelOrder()
    {
        $this->validate([
            'cancel_reason' => 'required|min:3'
        ]);

        $allowed = ['Waiting for Payment', 'Waiting for Payment Confirmation'];

        if (!in_array($this->order->status, $allowed)) {
            session()->flash('error', 'Orders cannot be cancelled.');
            return;
        }

        $this->order->update([
            'status' => 'Cancelled',
            'cancellation_reason' => $this->cancel_reason,
            'cancelled_at' => now(),
        ]);

        // Tutup modal Bootstrap
        $this->dispatch('close-modal');

        // SweetAlert sukses
        $this->js(<<<JS
        Swal.fire({
            icon: 'success',
            title: 'Order cancelled!',
            text: 'Order has been successfully cancelled.',
            toast: true,
            position: 'top-end',
            timer: 2000,
            showConfirmButton: false
        });
    JS);

        // Refresh supaya status langsung berubah
        $this->order = $this->order->fresh();
    }
    public function acceptOrder()
    {
        $this->order->update([
            'status' => 'Accepted',
        ]);

        // SweetAlert sukses
        $this->js(<<<JS
        Swal.fire({
            icon: 'success',
            title: 'Order accepted!',
            text: 'Order has been successfully accepted.',
            toast: true,
            position: 'top-end',
            timer: 2000,
            showConfirmButton: false
        });
    JS);

        // Refresh supaya status langsung berubah
        $this->order = $this->order->fresh();
    }



    public function render()
    {
        return view('livewire.shop.order-detail', [
            'order' => $this->order
        ]);
    }
}
