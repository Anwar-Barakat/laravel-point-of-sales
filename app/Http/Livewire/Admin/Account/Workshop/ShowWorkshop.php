<?php

namespace App\Http\Livewire\Admin\Account\Workshop;

use App\Models\Workshop;
use Livewire\Component;
use Livewire\WithPagination;

class ShowWorkshop extends Component
{
    use WithPagination;

    public $name,
        $order_by   = 'name',
        $sort_by    = 'asc',
        $per_page   = CUSTOM_PAGINATION;

    public function updateStatus(Workshop $workshop)
    {
        $workshop->update(['is_active' => !$workshop->is_active]);
    }

    public function render()
    {
        return view('livewire.admin.account.workshop.show-workshop', ['workshops' => $this->getWorkshops()]);
    }

    public function getWorkshops()
    {
        return  Workshop::with(['account'])
            ->search(trim($this->name))
            ->orderBy($this->order_by, $this->sort_by)
            ->paginate($this->per_page);
    }
}
