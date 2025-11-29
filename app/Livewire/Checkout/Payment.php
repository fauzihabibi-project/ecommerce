<?php

namespace App\Livewire\Checkout;

use Livewire\Component;
use App\Models\Orders;
use App\Models\Payments;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.master')]
class Payment extends Component
{
    use WithFileUploads;

    public $order;
    public $proof;

    public function mount($orderId)
    {
        $this->order = Orders::where('id', $orderId)
            ->where('user_id', Auth::id())
            ->firstOrFail();
    }

    public function uploadProof()
    {
        $this->validate([
            'proof' => 'required|image|max:2048',
        ]);

        $path = $this->proof->store('payments', 'public');

        Payments::create([
            'order_id' => $this->order->id,
            'method' => 'Transfer Bank',
            'payment_date' => now(),
            'amount' => $this->order->total_amount, // otomatis dari order
            'proof' => $path,
            'status' => 'Pending',
        ]);

        $this->order->update(['status' => 'Waiting for Payment Confirmation']);

        $this->js(<<<JS
            Swal.fire({
                icon: 'success',
                title: 'Proof of payment successfully uploaded!',
                text: 'Admin will verify your payment.',
                toast: true,
                position: 'top-end',
                timer: 3000,
                showConfirmButton: false
            });
        JS);

        return redirect()->route('home');
    }

    public function render()
    {
        return view('livewire.checkout.payment');
    }
}
