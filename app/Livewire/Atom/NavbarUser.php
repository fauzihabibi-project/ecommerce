<?php

namespace App\Livewire\Atom;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class NavbarUser extends Component
{
    public $user;

    protected $listeners = ['addressAdded' => 'refreshAddresses'];

    public function mount()
    {
        $this->user = Auth::user();
    }

    public function render()
    {
        return view('livewire.atom.navbar-user');
    }
}
