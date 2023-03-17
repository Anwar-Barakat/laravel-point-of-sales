<?php

namespace App\Http\Livewire\Backend\Auth;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class AdminLogin extends Component
{
    public $email, $password;

    protected $rules =  [
        'email'     => ['required', 'email', 'max:100'],
        'password'  => ['required', 'min:6', 'max:30'],
    ];

    public function updated($fields)
    {
        $this->validateOnly($fields);
    }

    public function login(Request $request)
    {
        $credentials = $this->validate();

        if (!Auth::guard('admin')->attempt($credentials)) {
            toastr()->error(__('msg.email_pass_not_valid'));
            return redirect()->route('admin.login.show');
        }

        Auth::guard('admin')->attempt($credentials);
        toastr()->success(__('msg.welcome_back'));
        return redirect()->route('admin.dashboard');
    }
    public function render()
    {
        return view('livewire.backend.auth.admin-login');
    }
}
