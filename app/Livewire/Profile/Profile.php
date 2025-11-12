<?php

namespace App\Livewire\Profile;

use App\Models\Addresses;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Auth;

#[Layout('components.layouts.master')]
class Profile extends Component
{
    public $user;
    public $addresses = [];

    protected $listeners = ['addressAdded' => 'refreshAddresses'];

    public function mount()
    {
        $this->user = Auth::user();

        $this->refreshAddresses();
    }

    public function delete($id)
    {
        $address = Addresses::findOrFail($id);
        
        $address->delete();
        $this->addresses = Addresses::where('user_id', $this->user->id)->get();
        session()->flash('success', 'Address deleted successfully.');
    }

    public function refreshAddresses()
    {
        $this->addresses = Addresses::with(['province', 'city'])
            ->where('user_id', $this->user->id)
            ->get();
    }


    public function render()
    {
        return view('livewire.profile.profile');
    }
}
