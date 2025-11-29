<?php

namespace App\Livewire\Auth;

use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.auth')]
class Register extends Component
{
    public $name, $email, $phone, $password, $password_confirmation;

    private function generateUsername($name)
    {
        $username = str()->slug($name);

        if (! User::where('username', $username)->exists()) {
            return $username;
        }

        // Jika sudah ada, tambahkan angka di belakang
        $counter = 1;
        $newUsername = $username . '-' . $counter;

        while (User::where('username', $newUsername)->exists()) {
            $counter++;
            $newUsername = $username . '-' . $counter;
        }

        return $newUsername;
    }


    public function register()
    {
        $this->validate([
            'name'      => ['required', 'string', 'max:255'],
            'email'     => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone'     => ['required', 'string', 'max:15'],
            'password'  => ['required', 'string', 'min:5', 'confirmed'],
        ]);

        // Generate username dari name
        $username = $this->generateUsername($this->name);

        $user = User::create([
            'name'      => $this->name,
            'username'  => $username,
            'email'     => $this->email,
            'phone'     => $this->phone,
            'password'  => bcrypt($this->password),
            'status'    => 'inactive',
        ]);

        auth()->login($user);

        // Kirim email verifikasi
        $user->sendEmailVerificationNotification();

        $this->reset();

        $this->js(<<<JS
        Swal.fire({
            icon : 'success',
            title : 'Berhasil',
            text : 'Akun Anda telah terdaftar, silakan login.',
            timer : 3000,
        })
    JS);

        return $this->redirect(route('verification.notice'), navigate: true);
    }


    public function render()
    {
        return view('livewire.auth.register');
    }
}
