<?php

namespace App\Livewire\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class Register extends Component
{
    public $name = '';
    public $email = '';
    public $password = '';
    public $passwordConfirmation = '';


    public function register()
    {
        $data = $this->validate([
            'name' => 'required|min:6',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|same:passwordConfirmation',
        ]);


        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        auth()->login($user);

        return redirect('/');
    }


    public function render()
    {
        return view('livewire.auth.register')->layout('layouts.app');
    }
}
