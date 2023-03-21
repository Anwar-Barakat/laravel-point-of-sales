<?php

namespace App\Http\Livewire\Admin\Profile;

use Livewire\Component;

class AdminProfile extends Component
{
    public $email, $name, $address, $bio;

    public function mount()
    {
        $this->email    = auth()->guard('admin')->user()->email;
        $this->name     = auth()->guard('admin')->user()->name;
        $this->bio      = auth()->guard('admin')->user()->bio;
        $this->address  = auth()->guard('admin')->user()->address;
    }

    public function render()
    {
        return view('livewire.admin.profile.admin-profile');
    }
}
