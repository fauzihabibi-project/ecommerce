<?php

namespace App\Livewire\Profile;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileAdminEdit extends Component
{
    use WithFileUploads;

    public $name;
    public $email;
    public $phone;
    public $password;
    public $foto;

    public function mount()
    {
        $user = Auth::user();

        $this->name   = $user->name;
        $this->email  = $user->email;
        $this->phone  = $user->phone;
    }

    protected $rules = [
        'name'     => 'required|string|max:255',
        'email'    => 'required|email',
        'phone'    => 'nullable|string|max:15',
        'password' => 'nullable|min:6',
        'foto'     => 'nullable|image|max:2048',
    ];

    public function updateProfile()
    {
        $this->validate();

        $user = Auth::user();

        $data = [
            'name'  => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
        ];

        if ($this->foto) {
            $path = $this->foto->store('profile_photos', 'public');
            $data['foto'] = $path;
        }

        if ($this->password) {
            $data['password'] = Hash::make($this->password);
        }

        $user->update($data);

        $this->js(<<<JS
            Swal.fire({
                icon: 'success',
                title: 'Profile updated successfully!',
                toast: true,
                position: 'top-end',
                timer: 2000,
                showConfirmButton: false
            });
        JS);

        return redirect()->route('profile.admin');
    }

    public function render()
    {
        return view('livewire.profile.profile-admin-edit');
    }
}
