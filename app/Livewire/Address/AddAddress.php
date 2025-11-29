<?php

namespace App\Livewire\Address;

use App\Models\Cities;
use Livewire\Component;
use App\Models\Addresses;
use App\Models\Provinces;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Auth;

#[Layout('components.layouts.master')]
class AddAddress extends Component
{
    public $recipient_name;
    public $recipient_phone;
    public $province_id;
    public $city_id;
    public $address_detail;
    public $postal_code;
    public $notes;
    public $is_default = false;

    public $provinces = [];
    public $cities = [];

    protected $rules = [
        'recipient_name' => 'required|string',
        'recipient_phone' => 'required|string',
        'province_id' => 'required',
        'city_id' => 'required',
        'address_detail' => 'required|string',
        'postal_code' => 'required|string',
    ];

    public function mount()
    {
        $this->provinces = Provinces::orderBy('name', 'asc')
            ->get(['id', 'name'])
            ->toArray();
    }

    public function updatedProvinceId($provinceId)
    {
        $this->cities = Cities::where('province_id', $provinceId)
            ->orderBy('name', 'asc')
            ->get(['id', 'name'])
            ->toArray();
    }

    public function save()
    {
        $this->validate();

        Addresses::create([
            'user_id' => Auth::id(),
            'recipient_name' => $this->recipient_name,
            'recipient_phone' => $this->recipient_phone,
            'province_id' => $this->province_id,
            'city_id' => $this->city_id,
            'address_detail' => $this->address_detail,
            'postal_code' => $this->postal_code,
            'notes' => $this->notes,
            'is_default' => $this->is_default ? 1 : 0,
        ]);

        // ✅ SweetAlert toast sukses
        $this->js(<<<JS
            Swal.fire({
                icon: 'success',
                title: 'Address added successfully!',
                toast: true,
                position: 'top-end',
                timer: 2000,
                showConfirmButton: false
            });
        JS);

        // ✅ Redirect balik ke halaman profil (contohnya 'user.profile')
        return redirect()->route('profile');
    }

    public function render()
    {
        return view('livewire.address.add-address');
    }
}
