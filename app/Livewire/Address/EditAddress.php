<?php

namespace App\Livewire\Address;

use App\Models\Cities;
use Livewire\Component;
use App\Models\Addresses;
use App\Models\Provinces;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Auth;

#[Layout('components.layouts.master')]
class EditAddress extends Component
{
    public $address_id;
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

    public function mount($id)
    {
        $this->provinces = Provinces::orderBy('name', 'asc')
            ->get(['id', 'name'])
            ->toArray();

        $address = Addresses::where('user_id', Auth::id())
            ->findOrFail($id);

        $this->address_id = $address->id;
        $this->recipient_name = $address->recipient_name;
        $this->recipient_phone = $address->recipient_phone;
        $this->province_id = $address->province_id;
        $this->address_detail = $address->address_detail;
        $this->postal_code = $address->postal_code;
        $this->notes = $address->notes;
        $this->is_default = $address->is_default ? true : false;

        // Load kota berdasarkan provinsi saat form dibuka
        $this->cities = Cities::where('province_id', $this->province_id)
            ->orderBy('name', 'asc')
            ->get(['id', 'name'])
            ->toArray();

        $this->city_id = $address->city_id;
    }

    public function updatedProvinceId($provinceId)
    {
        $this->city_id = '';
        $this->cities = Cities::where('province_id', $provinceId)
            ->orderBy('name', 'asc')
            ->get(['id', 'name'])
            ->toArray();
    }

    public function update()
    {
        $this->validate();

        $address = Addresses::where('user_id', Auth::id())
            ->findOrFail($this->address_id);

        $address->update([
            'recipient_name' => $this->recipient_name,
            'recipient_phone' => $this->recipient_phone,
            'province_id' => $this->province_id,
            'city_id' => $this->city_id,
            'address_detail' => $this->address_detail,
            'postal_code' => $this->postal_code,
            'notes' => $this->notes,
            'is_default' => $this->is_default ? 1 : 0,
        ]);

        // ✅ SweetAlert sukses
        $this->js(<<<JS
            Swal.fire({
                icon: 'success',
                title: 'Alamat berhasil diperbarui!',
                toast: true,
                position: 'top-end',
                timer: 2000,
                showConfirmButton: false
            });
        JS);

        // ✅ Redirect balik ke halaman profil
        return redirect()->route('profile');
    }

    public function render()
    {
        return view('livewire.address.edit-address');
    }
}
