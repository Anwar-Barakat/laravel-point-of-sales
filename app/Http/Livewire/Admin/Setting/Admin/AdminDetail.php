<?php

namespace App\Http\Livewire\Admin\Setting\Admin;

use App\Models\Admin;
use App\Models\Treasury;
use Livewire\Component;

class AdminDetail extends Component
{
    public Admin $admin;

    public function mount(Admin $admin)
    {
        $this->admin = $admin;
    }

    public function updateStatus($id)
    {
        $treasury = Treasury::findOrFail($id);
        $treasury->update(['is_active' => !$treasury->is_active]);
    }

    public function render()
    {
        $treasuries = Treasury::where(['company_id' => auth()->guard('admin')->user()->company->id, 'admin_id' => $this->admin->id])
            ->paginate(CUSTOM_PAGINATION);
        return view('livewire.admin.setting.admin.admin-detail', ['treasuries' => $treasuries]);
    }
}
