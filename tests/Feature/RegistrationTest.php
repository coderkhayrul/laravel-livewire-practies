<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Livewire;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    

    /** @test */
    function can_register()
    {
        Livewire::test('auth.register')
            ->set('name', 'Khayrul')
            ->set('email', 'khayrul@gmail.com')
            ->set('password', 'password')
            ->set('passwordConfirmation', 'password')
            ->call('register')
            ->assertRedirect('/');

        $this->assertTrue(User::whereEmail('khayrul@gmail.com')->exists());
        $this->assertEquals('khayrul@gmail.com', Auth::user()->email);
    }

    /** @test */
    function email_is_required()
    {
        Livewire::test('auth.register')
            ->set('name', 'Khayrul')
            ->set('email', '')
            ->set('password', 'password')
            ->set('passwordConfirmation', 'password')
            ->call('register')
            ->assertHasErrors(['email' => 'required']);
    }
    /** @test */
    function email_is_valid_email()
    {
        Livewire::test('auth.register')
            ->set('name', 'Khayrul')
            ->set('email', 'shanto')
            ->set('password', 'password')
            ->set('passwordConfirmation', 'password')
            ->call('register')
            ->assertHasErrors(['email' => 'email']);
    }

    /** @test */
    function email_has_taken_already()
    {
        User::create([
            'name' => 'Shanto',
            'email' => 'shanto@gmail.com',
            'password' => Hash::make('password'),
        ]);

        Livewire::test('auth.register')
            ->set('name', 'Khayrul')
            ->set('email', 'shanto@gmail.com')
            ->set('password', 'password')
            ->set('passwordConfirmation', 'password')
            ->call('register')
            ->assertHasErrors(['email' => 'unique']);
    }

    /** @test */
    function password_is_required()
    {

        Livewire::test('auth.register')
            ->set('name', 'Khayrul')
            ->set('email', 'shanto@gmail.com')
            ->set('password', '')
            ->set('passwordConfirmation', 'password')
            ->call('register')
            ->assertHasErrors(['password' => 'required']);
    }

    /** @test */
    function password_is_min_six_characters()
    {

        Livewire::test('auth.register')
            ->set('name', 'Khayrul')
            ->set('email', 'shanto@gmail.com')
            ->set('password', '1234')
            ->set('passwordConfirmation', 'password')
            ->call('register')
            ->assertHasErrors(['password' => 'min:6']);
    }

    /** @test */
    function password_matched_password_confirmation()
    {

        Livewire::test('auth.register')
            ->set('name', 'Khayrul')
            ->set('email', 'shanto@gmail.com')
            ->set('password', 'pass')
            ->set('passwordConfirmation', 'password')
            ->call('register')
            ->assertHasErrors(['password' => 'same']);
    }
}
