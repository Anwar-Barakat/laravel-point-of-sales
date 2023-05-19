<?php

namespace App\Http\Livewire\Admin\Stock\Section;

use App\Models\Section;
use Livewire\Component;
use Livewire\WithPagination;

class DisplaySection extends Component
{
    use WithPagination;

    public function updateStatus($section_id)
    {
        $section  = Section::findOrFail($section_id);
        $section->update(['is_active' => !$section->is_active]);
    }

    public function render()
    {
        return view('livewire.admin.stock.section.display-section', ['sections' => $this->getSections()]);
    }

    public function getSections()
    {
        return Section::latest()->paginate(CUSTOM_PAGINATION);
    }
}
