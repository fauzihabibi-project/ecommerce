<?php

namespace App\Livewire\Admin;

use App\Models\Orders;
use Livewire\Component;
use App\Models\Transactions;

class OrderDetail extends Component
{
    public $order;

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
                title: 'Pesanan tidak ditemukan!',
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
                title: 'Belum ada bukti pembayaran!',
                toast: true,
                position: 'top-end',
                timer: 2000,
                showConfirmButton: false
            });
        JS);
            return;
        }

        // Update status order jadi "Dikemas"
        $order->update(['status' => 'Dikemas']);

        // Update status pembayaran jadi "Dikonfirmasi"
        $order->payment->update([
            'status' => 'Dikonfirmasi',
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
            title: 'Pembayaran berhasil dikonfirmasi!',
            toast: true,
            position: 'top-end',
            timer: 2000,
            showConfirmButton: false
        });
    JS);

        // Refresh ulang data (opsional)
        $this->mount($orderId);
    }


    public function render()
    {
        return view('livewire.admin.order-detail', [
            'order' => $this->order
        ]);
    }
}
