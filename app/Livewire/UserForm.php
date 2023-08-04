<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;

class UserForm extends Component
{
    protected $listeners = ['triggerEdit'];

    public $name;
    public $email;
    public $age;
    public $address;

    public function render()
    {
        return view('livewire.user-form');
    }

    // add this
    public function save()
    {
        $validated = $this->validate([
            'name' => 'required|min:10',
            'email' => 'required|email|min:10',
            'age' => 'required|integer',
            'address' => 'required|min:10',
        ]);

        User::create(array_merge($validated, [
            'user_type' => 'user',
            'password' => bcrypt($this->email)
        ]));

        $this->resetForm();
        return redirect()->to('/table')->with('status', 'Post created!');
    }

    public function triggerEdit($user)
    {
        dd($user);
        $this->user_id = $user['id'];
        $this->name = $user['name'];
        $this->email = $user['email'];
        $this->age = $user['age'];
        $this->address = $user['address'];

        $this->emit('dataFetched', $user);
    }

    public function resetForm()
    {
        $this->user_id = null;
        $this->name = null;
        $this->email = null;
        $this->age = null;
        $this->address = null;
    }
}
