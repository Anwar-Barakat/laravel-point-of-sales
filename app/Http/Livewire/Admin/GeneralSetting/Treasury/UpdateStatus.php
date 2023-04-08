<?php

namespace App\Http\Livewire\Admin\GeneralSetting\Treasury;

use App\Models\Treasury;
use Livewire\Component;

class UpdateStatus extends Component
{
    public $is_active, $treasury_id;

    public function updateStatus($treasury_id)
    {
        $treasury           = Treasury::findOrFail($treasury_id);
        $treasury->update(['is_active' => !$treasury->is_active]);
        $this->is_active    = $treasury->is_active;
    }

    public function render()
    {
        return view('livewire.admin.general-setting.treasury.update-status');
    }
}