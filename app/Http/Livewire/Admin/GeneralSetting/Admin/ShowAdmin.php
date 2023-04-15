<?php

namespace App\Http\Livewire\Admin\GeneralSetting\Admin;

use App\Models\Admin;
use Livewire\Component;

class ShowAdmin extends Component
{
    public function updateStatus($id)
    {
        $admin    = Admin::findOrFail($id);
        $admin->update(['is_active' => !$admin->is_active]);
    }

    public function render()
    {
        return view('livewire.admin.general-setting.admin.show-admin', ['admins' => $this->getAdmins()]);
    }

    public function getAdmins()
    {
        return  Admin::paginate(PAGINATION_COUNT);;
    }
}