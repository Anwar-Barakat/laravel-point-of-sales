<?php

namespace App\Http\Livewire\Admin\Stock\Unit;

use App\Models\Unit;
use Livewire\Component;

class ShowUnit extends Component
{
    public function updateStatus($id)
    {
        $unit  = Unit::findOrFail($id);
        $unit->update(['is_active' => !$unit->is_active]);
    }

    public function render()
    {
        return view('livewire.admin.stock.unit.show-unit', ['units' => $this->getUnits()]);
    }

    public function getUnits()
    {
        return Unit::latest()->paginate(CUSTOM_PAGINATION);
    }
}