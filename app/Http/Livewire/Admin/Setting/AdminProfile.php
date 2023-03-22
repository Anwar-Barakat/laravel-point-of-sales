<?php

namespace App\Http\Livewire\Admin\Setting;

use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;

class AdminProfile extends Component
{
    use WithFileUploads;

    public $auth;

    public $email, $name, $address, $bio, $avatar;

    protected $rules = [
        'name'      => ['required', 'min:3'],
        'bio'       => ['required', 'min:10'],
        'address'   => ['required', 'min:10'],
        'avatar'    => ['nullable', 'image', 'max:2048']
    ];

    public function mount()
    {
        $this->auth     = auth()->guard('admin')->user();
        $this->email    = $this->auth->email;
        $this->name     = $this->auth->name;
        $this->bio      = $this->auth->bio;
        $this->address  = $this->auth->address;
    }

    public function updated($fields)
    {
        $this->validateOnly($fields, $this->rules);
    }

    public function updateInfo()
    {
        try {
            $validation = $this->validate();
            $admin      = Admin::find(Auth::guard('admin')->id());
            $admin->update($validation);

            if ($this->avatar) {
                $admin->clearMediaCollection('admin_avatar');
                $admin->addMedia($this->avatar)->toMediaCollection('admin_avatar');
            }
            toastr()->success(__('msgs.updated', ['name' => __('partials.profile')]));
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors(['error' => $th->getMessage()]);
        }
    }

    public function render()
    {
        return view('livewire.admin.setting.admin-profile');
    }
}
