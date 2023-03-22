<?php

namespace App\Http\Livewire\Admin\Setting;

use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class ChangePassword extends Component
{
    public $current_password, $password, $password_confirmation;

    protected $rules = [
        'current_password'          => ['required', 'min:6'],
        'password'                  => ['required', 'min:6'],
        'password_confirmation'     => ['required', 'same:password']
    ];

    public function updated($fields)
    {
        return $this->validateOnly($fields, $this->rules);
    }

    public function updatePassword()
    {
        try {
            $this->validate();

            if (!Hash::check($this->current_password, auth()->guard('admin')->user()->password)) {
                toastr()->error(__('msgs.not_valid', ['name' => __('setting.current_password')]));
                $this->reset();
                return false;
            }

            $admin  = Admin::findOrFail(auth()->guard('admin')->id());
            $admin->update(['password' => Hash::make($this->password)]);
            toastr()->success(__('msgs.updated', ['name' => __('auth.password')]));
            $this->reset();
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors(['error' => $th->getMessage()]);
        }
    }

    public function render()
    {
        return view('livewire.admin.setting.change-password');
    }
}
