<?php

namespace App\Livewire\User;

use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.master')]
class Services extends Component
{
    public function render()
    {
        return view('livewire.user.services');
    }
}
