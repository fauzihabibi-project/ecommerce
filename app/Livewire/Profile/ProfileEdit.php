<?php

namespace App\Livewire\Profile;

use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

#[Layout('components.layouts.master')]
class ProfileEdit extends Component
{
    use WithFileUploads;

    public $name, $username, $email, $phone, $password, $foto;

    public function mount()
    {
        $user = Auth::user();

        $this->name = $user->name;
        $this->username = $user->username;
        $this->email = $user->email;
        $this->phone = $user->phone;
    }

    protected function rules()
    {
        return [
            'foto'      => ['nullable', 'image', 'max:2048'],
            'name'      => ['required', 'string', 'max:255'],
            'username'  => [
                'required',
                'string',
                'max:255',
                Rule::unique('users', 'username')->ignore(Auth::id())
            ],
            'phone'     => ['nullable', 'string', 'max:15'],
            'password'  => ['nullable', 'string', 'min:5', 'confirmed'],
        ];
    }

    public function updateProfile()
    {
        $this->validate();

        $user = Auth::user();

        $data = [
            'name' => $this->name,
            'username' => $this->username,
            'email' => $this->email,
            'phone' => $this->phone,
        ];

        if ($this->foto) {
            $data['foto'] = $this->foto->store('profile_photos', 'public');
        }

        if ($this->password) {
            $data['password'] = bcrypt($this->password);
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

        return redirect()->route('profile');
    }

    public function render()
    {
        return view('livewire.profile.profile-edit');
    }
}
