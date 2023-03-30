<?php

namespace App\Http\Livewire\Admin\Unit;

use App\Models\Unit;
use Livewire\Component;

class IndexUnit extends Component
{
    public function render()
    {
        $units  = Unit::latest()->paginate(PAGINATION_COUNT);
        return view('livewire.admin.unit.index-unit', ['units' => $units])->layout('layouts.master-layout');
    }
}
