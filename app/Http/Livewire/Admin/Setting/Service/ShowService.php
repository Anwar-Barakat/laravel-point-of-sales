<?php

namespace App\Http\Livewire\Admin\Setting\Service;

use App\Models\Service;
use Livewire\Component;
use Livewire\WithPagination;

class ShowService extends Component
{
    use WithPagination;

    public $name,
        $type,
        $order_by   = 'name',
        $sort_by    = 'asc',
        $per_page   = CUSTOM_PAGINATION;

    public function updateStatus(Service $servuce)
    {
        $servuce->update(['is_active' => !$servuce->is_active]);
    }

    public function render()
    {
        return view('livewire.admin.setting.service.show-service', ['services' => $this->getServices()]);
    }

    public function getServices()
    {
        return Service::search(trim($this->name))
            ->when($this->type, fn ($q) => $q->where('type', $this->type))
            ->orderBy($this->order_by, $this->sort_by)
            ->paginate($this->per_page);
    }
}
