<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Orders;

class Dashboard extends Component
{
    public $laporanPenjualan;

    public function mount()
    {
        // Hitung jumlah order per bulan pada tahun berjalan
        $this->laporanPenjualan = Orders::selectRaw('MONTH(created_at) as bulan, COUNT(*) as total')
            ->whereYear('created_at', now()->year)
            ->groupBy('bulan')
            ->pluck('total', 'bulan');
    }

    public function render()
    {
        return view('livewire.admin.dashboard');
    }
}
