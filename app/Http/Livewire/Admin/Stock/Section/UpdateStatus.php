<?php

namespace App\Http\Livewire\Admin\Stock\Section;

use App\Models\Section;
use Livewire\Component;

class UpdateStatus extends Component
{
    public $is_active, $section_id;

    public function updateStatus($section_id)
    {
        $section            = Section::findOrFail($section_id);
        $section->update(['is_active' => !$section->is_active]);
        $this->is_active    = $section->is_active;
    }

    public function render()
    {
        return view('livewire.admin.stock.section.update-status');
    }
}