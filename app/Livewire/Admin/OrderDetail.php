<?php

namespace App\Livewire\Admin;

use App\Models\Orders;
use Livewire\Component;
use App\Models\Transactions;

class OrderDetail extends Component
{
    public $order;
    public $resi;

    protected $rules = [
        'resi' => 'required|string|max:50'
    ];


    public function mount($id)
    {
        // Ambil data pesanan beserta relasinya
        $this->order = Orders::with(['user', 'address.city', 'address.province', 'items', 'payment'])
            ->findOrFail($id);
    }

    public function confirmPayment($orderId)
    {
        // Ambil data order beserta relasi payment
        $order = Orders::with('payment')->find($orderId);

        if (!$order) {
            $this->js(<<<'JS'
            Swal.fire({
                icon: 'error',
                title: 'Order not found!',
                toast: true,
                position: 'top-end',
                timer: 2000,
                showConfirmButton: false
            });
        JS);
            return;
        }

        // Pastikan ada bukti pembayaran
        if (!$order->payment || !$order->payment->proof) {
            $this->js(<<<'JS'
            Swal.fire({
                icon: 'warning',
                title: 'No payment proof yet!',
                toast: true,
                position: 'top-end',
                timer: 2000,
                showConfirmButton: false
            });
        JS);
            return;
        }

        // Update status order jadi "Packing"
        $order->update(['status' => 'Packing']);

        // Update status pembayaran jadi "Confirmed"
        $order->payment->update([
            'status' => 'Confirmed',
            'payment_date' => now(),
        ]);

        // Buat transaksi baru
        Transactions::create([
            'user_id' => $order->user_id,
            'payment_id' => $order->payment->id,
            'order_id' => $order->id,
            'transaction_code' => 'TRX' . now()->format('YmdHis'),
            'transaction_date' => now(),
            'total_amount' => $order->total_amount,
            'status' => 'Berhasil',
        ]);

        // Tampilkan notifikasi sukses
        $this->js(<<<'JS'
        Swal.fire({
            icon: 'success',
            title: 'Payment confirmed successfully!',
            toast: true,
            position: 'top-end',
            timer: 2000,
            showConfirmButton: false
        });
    JS);

        // Refresh ulang data (opsional)
        $this->mount($orderId);
    }

    public function sendOrder($orderId)
    {
        $this->validate();

        $order = Orders::find($orderId);

        if (!$order) {
            $this->js(<<<'JS'
        Swal.fire({
            icon: 'error',
            title: 'Order not found!',
            toast: true,
            position: 'top-end',
            timer: 2000,
            showConfirmButton: false
        });
        JS);
            return;
        }

        if ($order->status !== 'Packing') {
            $this->js(<<<'JS'
        Swal.fire({
            icon: 'warning',
            title: 'Order not ready to be shipped!',
            toast: true,
            position: 'top-end',
            timer: 2000,
            showConfirmButton: false
        });
        JS);
            return;
        }

        // Update status + resi
        $order->update([
            'status' => 'Shipped',
            'tracking_number' => $this->resi,
            'shipping_date' => now(),
        ]);

        $this->js(<<<'JS'
        Swal.fire({
            icon: 'success',
            title: 'Order shipped successfully!',
            toast: true,
            position: 'top-end',
            timer: 2000,
            showConfirmButton: false
        });
    JS);

        $this->resi = null;

        // Refresh data
        $this->mount($orderId);
    }


    public function render()
    {
        return view('livewire.admin.order-detail', [
            'order' => $this->order
        ]);
    }
}
