<?php

namespace App\Http\Livewire\Admin\Unit;

use App\Models\Unit;
use Livewire\Component;

class UpdateStatus extends Component
{
    public $is_active, $unit_id;

    public function updateStatus($unit_id)
    {
        $unit               = Unit::findOrFail($unit_id);
        $unit->update(['is_active' => !$unit->is_active]);
        $this->is_active    = $unit->is_active;
    }

    public function render()
    {
        return view('livewire.admin.unit.update-status');
    }
}